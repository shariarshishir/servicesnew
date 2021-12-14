<?php

namespace App\Http\Controllers\Wholesaler;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Carbon\Carbon;
use File;
use Image;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use DB;
use App\Models\ProductCategory;
use App\Models\ProductVideo;
use App\Models\Vendor;
use DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use stdClass;
use App\Models\RelatedProduct;
use App\Rules\MoqUnitRule;
use App\Rules\ReadyStockPriceBreakDownRule;
use App\Rules\NonClothingPriceBreakDownRule;
use App\Rules\NonClothingFullStockRule;
use App\Rules\ReadyStockFullStockRule;

class ProductController extends Controller
{
    public function index(Request $request, $business_profile_id)
   {

        $business_profile=BusinessProfile::where('id', $business_profile_id)->first();
        if((auth()->id() == $business_profile->user_id) || (auth()->id() == $business_profile->representative_user_id))
        {
            if ($request->ajax())
            {
                $data =Product::latest()->where('business_profile_id',$business_profile_id)->with('images');
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image',function($row){
                        if($row->images->isEmpty()){return '';}
                            $source=asset('storage/'.$row->images[0]->image);
                            if($row->availability==0 && ($row->product_type == 2 || $row->product_type == 3)){
                                return $image='<span class="new badge red" data-badge-caption="sold"></span><img src="'.$source.'" class="responsive-img" alt="" width="150" height="80"/> ';
                            }
                            return $image='<img src="'.$source.'" class="responsive-img" alt="" width="150" height="80"/>';

                    })
                    ->addColumn('action', function($row){
                        //$actionBtn = '<a href="javascript:void(0)" class="seller-edit-product btn waves-effect waves-light green" id="'.$row->sku.'"><i class="material-icons dp48">edit</i></a> <a href="javascript:void(0)" class="seller-delete-prodcut seller-publish-unpublish-prodcut btn waves-effect waves-light green" id="'.$row->sku.'"><i class="material-icons dp48">close</i></a>';
                        $actionBtn = '<a href="javascript:void(0)" class="seller-edit-product btn waves-effect waves-light green" id="'.$row->sku.'">';
                        $actionBtn .= '<i class="material-icons dp48">edit</i>';
                        $actionBtn .= '</a>';
                        if($row->state==1)
                        {
                            $actionBtn .= '&nbsp; <a href="javascript:void(0)" data-status="1" class="seller-delete-prodcut seller-publish-unpublish-prodcut btn waves-effect waves-light red" id="'.$row->sku.'">';
                            $actionBtn .= '<i class="material-icons dp48">close</i>';
                            $actionBtn .= '</a>';
                        }
                        else
                        {
                            $actionBtn .= '&nbsp; <a href="javascript:void(0)" data-status="0" class="seller-delete-prodcut seller-publish-unpublish-prodcut btn waves-effect waves-light green" id="'.$row->sku.'">';
                            $actionBtn .= '<i class="material-icons dp48">check</i>';
                            $actionBtn .= '</a>';
                        }
                        return $actionBtn;
                    })
                    ->editColumn('state', function($row) {
                        if($row->state==1) return 'Published';
                        else return 'Not Published';
                    })
                    ->editColumn('is_featured', function($row) {
                        if($row->is_featured==1) return 'YES';
                        else return 'NO';
                    })
                    ->editColumn('is_new_arrival', function($row) {
                        if($row->is_new_arrival==1) return 'YES';
                        else return 'NO';
                    })
                    ->filter(function ($instance) use ($request) {
                        if ($request->get('state') == '0' || $request->get('state') == '1') {
                            $instance->where('state', $request->get('state'));
                        }
                        if ($request->get('product_type')!= null) {
                            $instance->where('product_type', $request->get('product_type'));
                        }
                        if (!empty($request->get('search'))) {
                            $instance->where('name', 'like', "%{$request->get('search')}%");
                        }

                    })
                    ->rawColumns(['action','image'])
                    ->make(true);
            }

            return view('wholesaler_profile.products.index', compact('business_profile'));
        }

        abort(401);




   }

   public function store(Request $request)
   {

        $validator = Validator::make($request->all(), [
            'business_profile_id' => 'required',
            'images'  => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,JPEG,PNG,JPG,GIF,SVG|max:5120',
            'name'      => 'required',
            'category_id' => 'required',
            'product_type' => 'required',
            'description'  => 'required',
            'moq'         => [new MoqUnitRule($request, $request->product_type)],
            'product_unit'  =>[new MoqUnitRule($request, $request->product_type)],
            'ready_stock_availability'  => 'required_if:product_type,2',
            'non_clothing_availability'  => 'required_if:product_type,3',
            'quantity_min.*' => 'required_if:product_type,1',
            'quantity_max.*' => 'required_if:product_type,1',
            'price.*' => 'required_if:product_type,1',
            'lead_time.*' => 'required_if:product_type,1',
            'ready_quantity_min.*' => [new ReadyStockPriceBreakDownRule($request, $request->product_type)],
            'ready_quantity_max.*' => [new ReadyStockPriceBreakDownRule($request, $request->product_type)],
            'ready_price.*' => [new ReadyStockPriceBreakDownRule($request, $request->product_type)],
            'non_clothing_min.*' => [new NonClothingPriceBreakDownRule($request, $request->product_type)],
            'non_clothing_max.*' => [new NonClothingPriceBreakDownRule($request, $request->product_type)],
            'non_clothing_price.*' => [new NonClothingPriceBreakDownRule($request, $request->product_type)],
            'full_stock_price' => [new ReadyStockFullStockRule($request, $request->product_type)],
            'non_clothing_full_stock_price' => [new NonClothingFullStockRule($request, $request->product_type)],
            'videos.*' => 'mimes:mp4,3gp,mkv,mov|max:20000',


        ]);

        if ($validator->fails())
        {
            return response()->json(array(
            'success' => false,
            'error' => $validator->getMessageBag()),
            400);
        }

        DB::beginTransaction();

        try {
            $date=Carbon::now()->timestamp;
            $number=mt_rand(0,9999);
            $remove[] = "'";
            $remove[] = '"';
            $remove[] = "-";
            $remove[] = "#";
            $FileName = str_replace($remove, "", $request->name);
            $name= explode(' ',strtolower($FileName));
            $sku=$name[0].$date.$number;

            $full_stock_negotiable=false;
            $full_stock = false;
            $full_stock_price = null;
            $availability=null;
            if($request->product_type==1){
                $price_break_down=[];
                for($i=0; $i < count($request->quantity_min); $i++){
                    array_push($price_break_down,[(int)$request->quantity_min[$i],(int)$request->quantity_max[$i],is_numeric($request->price[$i]) ? $request->price[$i] : 'Negotiable',$request->lead_time[$i]]);
                }
            }

            if($request->product_type==2){
                $colors_sizes=[];
                if(isset($request->color_size['color'])){
                    foreach($request->color_size as $key => $value)
                    {
                        foreach($value as $key2 => $value2 )
                            {
                                if($key=='color'){
                                    $colors_sizes[$key2][$key]=$value2;
                                }else{
                                    $colors_sizes[$key2][$key]=(int)$value2;
                                }

                            }
                    }

                }

                $price_break_down=[];
                for($i=0; $i < count($request->ready_quantity_min); $i++){
                    array_push($price_break_down,[(int)$request->ready_quantity_min[$i],(int)$request->ready_quantity_max[$i],is_numeric($request->ready_price[$i]) ? $request->ready_price[$i] : 'Negotiable']);
                }
                $full_stock= isset($request->full_stock) ? true : false;
                $full_stock_price = isset($request->full_stock_price) ? $request->full_stock_price : null;
                $availability=$request->ready_stock_availability;
                $full_stock_negotiable= isset($request->ready_full_stock_negotiable) ? true : false;

            }

            //non clothing item
            if($request->product_type==3)
            {
                $colors_sizes=[];
                if(isset($request->non_clothing_attr)){
                    foreach($request->non_clothing_attr as $key => $value)
                    {
                        foreach($value as $key2 => $value2 )
                            {
                                if($key=='color'){
                                    $colors_sizes[$key2][$key]=$value2;
                                }else{
                                    $colors_sizes[$key2][$key]=(int)$value2;
                                }

                            }
                    }

                }

                $price_break_down=[];
                for($i=0; $i < count($request->non_clothing_min); $i++){
                    array_push($price_break_down,[(int)$request->non_clothing_min[$i],(int)$request->non_clothing_max[$i],is_numeric($request->non_clothing_price[$i]) ? $request->non_clothing_price[$i] : 'Negotiable']);
                }
                $full_stock= isset($request->non_clothing_full_stock) ? true : false;
                $full_stock_price = isset($request->non_clothing_full_stock_price) ? $request->non_clothing_full_stock_price : null;
                $availability=$request->non_clothing_availability;
                $full_stock_negotiable= isset($request->non_clothing_full_stock_negotiable) ? true : false;
            }

            $business_profile=BusinessProfile::where('id', $request->business_profile_id)->first();
            $business_profile_name=$business_profile->business_name;
            //tiny mc text editor file upload
            $temporary_folder= public_path('storage/temp').'/'. $business_profile_name.'/'.'pdf/';
            if (!file_exists($temporary_folder)) {
                mkdir($temporary_folder, 0777, true);
            }
            $pdfFolder= File::files(public_path('storage/temp').'/'. $business_profile_name.'/'.'pdf/');
            if($pdfFolder){
                foreach($pdfFolder as $path) {
                    $file = pathinfo($path);
                    $full_path=$file['dirname'].'/'.$file['basename'];
                    $destination_folder=public_path('storage/images/'). $business_profile_name.'/'.'pdf/';
                    if (!file_exists($destination_folder)) {
                        mkdir($destination_folder, 0777, true);
                    }
                    $destination=$destination_folder.$file['basename'];
                    File::move($full_path, $destination);
                }
            }


            $product=Product::create([
                'business_profile_id' => $business_profile->id,
                'name'      => $request->name,
                'sku'       => $sku,
                'product_category_id' => $request->category_id,
                'product_type'  => $request->product_type,
                'attribute' => json_encode($price_break_down) ?? null,
                'is_featured' => $request->is_featured=='on'? 1:0,
                'is_new_arrival' => $request->is_new_arrival=='on'? 1:0,
                'state'   => $request->published=='on'? 1:0,
                'description' => $request->description,
                'additional_description' => $request->additional_description ?? null,
                'colors_sizes'  => isset($colors_sizes)  ?  json_encode($colors_sizes) : null,
                'moq'         => $request->moq ?? null,
                'product_unit'         => $request->product_unit ?? null,
                'availability'     => $availability,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'copyright_price'  => $request->product_type==1 ? $request->copyright_price : null,
                'full_stock'     => $full_stock,
                'full_stock_price' =>  $full_stock_price,
                'full_stock_negotiable' => $full_stock_negotiable,
                'customize'      => isset($request->customize) ? true : false,
                'created_by'  => auth()->id(),

           ]);

        //    $user=User::where('id',auth()->id())->first();
        //    $vendorName=Str::slug($user->vendor->vendor_name,'-');
           foreach ($request->images as $image) {
                $filename = $image->store('images/'.$business_profile_name.'/products/small','public');
                $image_resize = Image::make(public_path('storage/'.$filename));
                $image_resize->fit(300, 300);
                $image_resize->save(public_path('storage/'.$filename));
                $original=$image->store('images/'.$business_profile_name.'/products/original','public');
                $product_image = ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $filename,
                    'original' => $original,
                ]);
            }
            //related products
            if($request->related_products)
            {
                foreach($request->related_products as $item){
                    RelatedProduct::create([
                        'business_profile_id'  => $business_profile->id,
                        'product_id' => $product->id,
                        'related_product_id' => $item,
                    ]);
                }

            }

            //upload video
            if($request->hasFile('videos')){
                $folder='video/'.$business_profile_name;
                foreach ($request->videos as $video) {
                    $filename = $video->store($folder,'public');
                        $product_video = ProductVideo::create([
                            'product_id' => $product->id,
                            'video' => $filename,
                        ]);
                    }
            }
            DB::commit();

            return response()->json(array('success' => true, 'msg' => 'Product Created Successfully'),200);
        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(array(
                'success' => false,
                'error' => $e->getMessage(),),
                500);
        }

    }

    public function edit($sku)
    {
       try{
            $product=Product::with('videos')->where('sku',$sku)->first();
            $colors_sizes=json_decode($product->colors_sizes);
            $attr=json_decode($product->attribute);
            $preloaded=array();
            foreach($product->images as $key=>$image){
                $obj[$key] = new stdClass;
                $obj[$key]->id = $image->id;
                $obj[$key]->src = asset('storage/'.$image->image);
                $preloaded[]=$obj[$key];
            }
            $related_products=RelatedProduct::where('business_profile_id',$product->business_profile_id)->where('product_id',$product->id)->pluck('related_product_id');
            return response()->json(array(
                'success' => true,
                'product' => $product,
                'attr'    => $attr,
                'colors_sizes' => $colors_sizes,
                'product_image'  => $preloaded,
                'related_products' => $related_products,
            ), 200);
       }catch(\Exception $e){
            return response()->json(array(
                'success' => false,
                'error' => $e->getMessage(),),
                500);
       }

    }

    public function update(Request $request, $sku)
    {

        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'category_id' => 'required',
            'description'  => 'required',
            'moq'         => [new MoqUnitRule($request, $request->p_type)],
            'product_unit'  =>[new MoqUnitRule($request, $request->p_type)],
            'p_type'      => 'required',
            'ready_stock_availability'  => 'required_if:p_type,2',
            'non_clothing_availability'  => 'required_if:p_type,3',
            'quantity_min.*' => 'required_if:p_type,1',
            'quantity_max.*' => 'required_if:p_type,1',
            'price.*' => 'required_if:p_type,1',
            'lead_time.*' => 'required_if:p_type,1',
            'ready_quantity_min.*' => [new ReadyStockPriceBreakDownRule($request, $request->p_type)],
            'ready_quantity_max.*' => [new ReadyStockPriceBreakDownRule($request,$request->p_type)],
            'ready_price.*' => [new ReadyStockPriceBreakDownRule($request, $request->p_type)],
            'non_clothing_min.*' => [new NonClothingPriceBreakDownRule($request, $request->p_type)],
            'non_clothing_max.*' => [new NonClothingPriceBreakDownRule($request, $request->p_type)],
            'non_clothing_price.*' => [new NonClothingPriceBreakDownRule($request, $request->p_type)],
            'full_stock_price' => [new ReadyStockFullStockRule($request, $request->p_type)],
            'non_clothing_full_stock_price' => [new NonClothingFullStockRule($request, $request->p_type)],
            'videos.*' => 'mimes:mp4,3gp,mkv,mov|max:20000',

        ]);

        if ($validator->fails())
        {
            return response()->json(array(
            'success' => false,
            'error' => $validator->getMessageBag()->toArray()),
            400);
        }

        DB::beginTransaction();
            try {

                $full_stock_negotiable=false;
                $full_stock = false;
                $full_stock_price = null;
                $availability=null;
                if($request->p_type==1)
                {
                    $price_break_down=[];
                    for($i=0; $i < count($request->quantity_min); $i++){
                        array_push($price_break_down,[(int)$request->quantity_min[$i],(int)$request->quantity_max[$i],is_numeric($request->price[$i]) ? $request->price[$i] : 'Negotiable',$request->lead_time[$i]]);
                    }

                }

                if($request->p_type==2)
                {
                    $colors_sizes=[];
                    if(isset($request->color_size['color'])){
                        foreach($request->color_size as $key => $value)
                        {
                            foreach($value as $key2 => $value2 )
                                {   if($key=='color'){
                                        $colors_sizes[$key2][$key]=$value2;
                                    }else{
                                        $colors_sizes[$key2][$key]=(int)$value2;
                                    }

                                }
                        }
                    }
                    $price_break_down=[];
                    for($i=0; $i < count($request->ready_quantity_min); $i++){
                        array_push($price_break_down,[(int)$request->ready_quantity_min[$i],(int)$request->ready_quantity_max[$i],is_numeric($request->ready_price[$i]) ? $request->ready_price[$i] : 'Negotiable']);
                    }
                    $full_stock= isset($request->full_stock) ? true : false;
                    $full_stock_price = isset($request->full_stock_price) ? $request->full_stock_price : null;
                    $availability=$request->ready_stock_availability;
                    $full_stock_negotiable= isset($request->ready_full_stock_negotiable) ? true : false;
                }
                //non clothing item
                if($request->p_type==3)
                {
                    $colors_sizes=[];
                    if(isset($request->non_clothing_attr)){
                        foreach($request->non_clothing_attr as $key => $value)
                        {
                            foreach($value as $key2 => $value2 )
                                {
                                    if($key=='color'){
                                        $colors_sizes[$key2][$key]=$value2;
                                    }else{
                                        $colors_sizes[$key2][$key]=(int)$value2;
                                    }

                                }
                        }

                    }

                    $price_break_down=[];
                    for($i=0; $i < count($request->non_clothing_min); $i++){
                        array_push($price_break_down,[(int)$request->non_clothing_min[$i],(int)$request->non_clothing_max[$i],is_numeric($request->non_clothing_price[$i]) ? $request->non_clothing_price[$i] : 'Negotiable']);
                    }
                    $full_stock= isset($request->non_clothing_full_stock) ? true : false;
                    $full_stock_price = isset($request->non_clothing_full_stock_price) ? $request->non_clothing_full_stock_price : null;
                    $availability=$request->non_clothing_availability;
                    $full_stock_negotiable= isset($request->non_clothing_full_stock_negotiable) ? true : false;

                }




                Product::where('sku',$sku)->update([
                    'name'      => $request->name,
                    'product_category_id' => $request->category_id,
                    'is_featured' => $request->is_featured=='on'? 1:0,
                    'is_new_arrival' => $request->is_new_arrival=='on'? 1:0,
                    'state'   => $request->published=='on'? 1:0,
                    'description' => $request->description,
                    'additional_description' => $request->additional_description ?? null,
                    'attribute' => json_encode($price_break_down) ?? null,
                    'colors_sizes'  => isset($colors_sizes)  ?  json_encode($colors_sizes) : null,
                    'moq'         => $request->moq ?? null,
                    'product_unit'     => $request->product_unit ?? null,
                    'availability'     =>  $availability,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->header('User-Agent'),
                    'copyright_price'  => $request->p_type==1 ? $request->copyright_price : null,
                    'full_stock'     => $full_stock,
                    'full_stock_price' =>  $full_stock_price,
                    'full_stock_negotiable' => $full_stock_negotiable,
                    'customize'      => isset($request->customize) ? true : false,
                    'updated_by'  => auth()->id(),
            ]);
            $product=Product::where('sku',$sku)->first();
            // $user=User::where('id',auth()->id())->first();
            // $vendorName=Str::slug($user->vendor->vendor_name,'-');

            $business_profile=BusinessProfile::where('id', $product->business_profile_id)->first();
            $business_profile_name=$business_profile->business_name;
             //tiny mc text editor file upload
             $temporary_folder= public_path('storage/temp').'/'. $business_profile_name.'/'.'pdf/';
             if (!file_exists($temporary_folder)) {
                 mkdir($temporary_folder, 0777, true);
             }
             $pdfFolder= File::files(public_path('storage/temp').'/'. $business_profile_name.'/'.'pdf/');
             if($pdfFolder){
                 foreach($pdfFolder as $path) {
                     $file = pathinfo($path);
                     $full_path=$file['dirname'].'/'.$file['basename'];
                     $destination_folder=public_path('storage/images/'). $business_profile_name.'/'.'pdf/';
                     if (!file_exists($destination_folder)) {
                         mkdir($destination_folder, 0777, true);
                     }
                     $destination=$destination_folder.$file['basename'];
                     File::move($full_path, $destination);
                 }
             }


            if(isset($request->preloaded)){
                $productImages=ProductImage::where('product_id',$product->id)->whereNotIn('id',$request->preloaded)->get();
            }
            else{
                $productImages=ProductImage::where('product_id',$product->id)->get();
            }
            if($productImages->isNotEmpty()){
                foreach($productImages as $productImage){
                    if(Storage::exists('public/'.$productImage->image) && Storage::exists('public/'.$productImage->original)){
                        Storage::delete('public/'.$productImage->image);
                        Storage::delete('public/'.$productImage->original);
                    }
                    $productImage->delete();
                }
            }
            if(isset($request->images))
            {
                foreach ($request->images as $image) {
                    $filename = $image->store('images/'.$business_profile_name.'/products/small','public');
                    $image_resize = Image::make(public_path('storage/'.$filename));
                    $image_resize->fit(300, 300);
                    $image_resize->save(public_path('storage/'.$filename));
                    $original=$image->store('images/'.$business_profile_name.'/products/original','public');
                    $product_image = ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $filename,
                        'original' => $original,
                    ]);
                }
            }

            //video
            if(isset($request->remove_video_id)){
               if( count(json_decode($request->remove_video_id)) > 0 )
               {
                $productVideos=ProductVideo::whereIn('id',json_decode($request->remove_video_id))->get();
                if($productVideos->isNotEmpty()){
                     foreach($productVideos as $video){
                         if(Storage::exists($video->video)){
                             Storage::delete($video->video);
                         }
                         $video->delete();
                     }
                 }
               }
            }

            if($request->hasFile('videos')){
                $folder='video/'.$business_profile_name;
                foreach ($request->videos as $video) {
                $filename = $video->store($folder,'public');
                    $product_video = ProductVideo::create([
                        'product_id' => $product->id,
                        'video' => $filename,
                    ]);
                }
            }
            //related products
            if(!isset($request->related_products))
            {
                $relatedProduct=RelatedProduct::where('business_profile_id',$product->business_profile_id)->where('product_id',$product->id)->get();
                if($relatedProduct){
                    foreach($relatedProduct as $rel_product)
                    {
                        $rel_product->delete();
                    }
                }
            }
            if($request->related_products)
            {
                $relatedProduct=RelatedProduct::where('business_profile_id',$product->business_profile_id)->where('product_id',$product->id)->get();
                if($relatedProduct){
                    foreach($relatedProduct as $rel_product)
                        {
                            $rel_product->delete();
                        }
                }
                foreach($request->related_products as $item){
                    RelatedProduct::create([
                        'business_profile_id' => $product->business_profile_id,
                        'product_id' => $product->id,
                        'related_product_id' => $item,
                    ]);
                }

            }
            DB::commit();
            // all good
            return response()->json(array('success' => true, 'msg' => 'Product Updated Successfully'),200);
            }catch (\Exception $e) {
                DB::rollback();
                return response()->json(array(
                    'success' => false,
                    'error' => $e->getMessage(),),
                    500);
            }
    }


    public function publishUnpublish($sku)
    {
      $product=Product::where('sku',$sku)->first();
      if($product->state==1){
          $product->update(['state' => 0]);
          return response()->json(array('success' => true, 'msg' => 'Product Unpublished Successfully'),200);
        }
      else{
        $product->update(['state' => 1]);
        return response()->json(array('success' => true, 'msg' => 'Product Published Successfully'),200);
      }
    }
}

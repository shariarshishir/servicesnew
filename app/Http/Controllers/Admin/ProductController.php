<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;
use File;
use Image;
use stdClass;
use App\Models\RelatedProduct;
use App\Models\User;


class ProductController extends Controller
{

    public function index($vendorId)
    {
        //dd($vendorId);
        $products=Product::where('vendor_id',$vendorId)->get();
        //dd($products);
        return view('admin.vendor.product.index',compact('products','vendorId'));
    }


    public function create($vendorId)
    {
        $source = ProductCategory::select('id', 'name', 'parent_id')->get()->toArray();
        $inArray = array();
        foreach($source as $key => $value)
        {
            $inArray[$key] = $value;
        }

        $category = array();
        $this->makeParentChildRelations($inArray, $category);
        //$category=ProductCategory::get();

       return view('admin.vendor.product.create',compact('category','vendorId'));
    }

    public function makeParentChildRelations(&$inArray, &$outArray, $currentParentId = 0) {
        if(!is_array($inArray)) {
            return;
        }
        if(!is_array($outArray)) {
            return;
        }
        foreach($inArray as $key => $tuple) {
            if($tuple['parent_id'] == $currentParentId) {
                $tuple['children'] = array();
                $this->makeParentChildRelations($inArray, $tuple['children'], $tuple['id']);
                $outArray[] = $tuple;
            }
        }
    }


   public function store(Request $request,$vendorId)
   {

            $request->validate
            (
                [
                    'images'  => 'required',
                    'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
                    'name'      => 'required',
                    'category_id' => 'required',
                    'product_type' => 'required',
                    'description'  => 'required',
                    'additional_description'  => 'required',
                    'moq'         => 'required',
                    'availability'  => 'required_if:product_type,2',
                ],
                [
                    'category_id.required'=>'The category field is required',

                ]

            );

            // $date=Carbon::today()->toDateString();
            // $date=Carbon::parse($date)->format('dmY');
            // $number=mt_rand(0,9999);
            // $name= explode(' ',trim($request->name));
            // $sku=$name[0].$date.$number;

            //generate unqiue sku
            $date=Carbon::today()->toDateString();
            $date=Carbon::parse($date)->format('dmY');
            $number=mt_rand(0,9999999);
            $name= Str::slug($request->name,'-');
            $sku=$name.'-'.$date.$number;


            if($request->product_type==1){
                $fresh_attr=[];
                for($i=0; $i < count($request->quantity_min); $i++){
                    array_push($fresh_attr,[$request->quantity_min[$i],$request->quantity_max[$i],$request->price[$i],$request->lead_time[$i]]);
                }
            }

            if($request->product_type==2){
                $ready_attr=[];
                for($i=0; $i < count($request->ready_quantity_min); $i++){
                    array_push($ready_attr,[$request->ready_quantity_min[$i],$request->ready_quantity_max[$i],$request->ready_price[$i]]);
                }
                $colorArray = array();
                foreach ( $request->color_size as $k => $arr)
                {
                    $total = count($arr);
                    $i = 0;
                    foreach ( $arr as $val )
                    {
                        $colorArray[$i][$k] = $val;
                        $i++;
                    }
                }
            }


            $product=Product::create([
                'vendor_id' => $request->vendor_id,
                'name'      => $request->name,
                'sku'       => $sku,
                'product_category_id' => $request->category_id,
                'product_type'  => $request->product_type,
                'attribute' => $request->product_type==2 ? json_encode($ready_attr) : json_encode($fresh_attr),
                'is_featured' => $request->is_featured=='on'? 1:0,
                'is_new_arrival' => $request->is_new_arrival=='on'? 1:0,
                'state'   => $request->published=='on'? 1:0,
                'description' => $request->description,
                'additional_description' => $request->additional_description,
                'colors_sizes'  => $request->product_type==2 ? json_encode($colorArray) : null,
                'moq'         => $request->moq,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'availability'     => $request->product_type==2 ? $request->availability : null,
                'copyright_price'  => $request->product_type==1 ? $request->copyright_price : null,
                'created_by'  => Auth::guard('admin')->user()->id,
           ]);

           $vendor=Vendor::where('id' ,$vendorId)->first();
           $vendorName=Str::slug($vendor->vendor_name,'-');
            foreach ($request->images as $image) {
                $filename = $image->store('images/'.$vendorName.'/products/small','public');
                $image_resize = Image::make(public_path('storage/'.$filename));
                $image_resize->fit(300, 300);
                $image_resize->save(public_path('storage/'.$filename));
                $original=$image->store('images/'.$vendorName.'/products/original','public');
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
                        'vendor_id'  =>$vendor->id,
                        'product_id' => $product->id,
                        'related_product_id' => $item,
                    ]);
                }

            }
            Session::flash('success','Product Added successfully!!!!');
            return redirect()->route('product.index',$vendorId);

    }



    public function show(Product $product)
    {
        //
    }



    public function edit($vendorId,$productSku)
    {
        //$category=ProductCategory::get();
        $source = ProductCategory::select('id', 'name', 'parent_id')->get()->toArray();
        $inArray = array();
        foreach($source as $key => $value)
        {
            $inArray[$key] = $value;
        }

        $category = array();
        $this->makeParentChildRelations($inArray, $category);

        $product=Product::with('images')->where('sku',$productSku)->first();
        //generating preloaded image array
        $preloaded=array();
        foreach($product->images as $key=>$image){
            $obj[$key] = new stdClass;
            $obj[$key]->id = $image->id;
            $obj[$key]->src = asset('storage/'.$image->image);
            $preloaded[]=$obj[$key];
        }

        $colors_sizes=json_decode($product->colors_sizes);
        $fresh_attr=json_decode($product->attribute);
        $productCategories=ProductCategory::select('name','id')->get();
        $related_products=Product::where('vendor_id',$vendorId)->pluck('name','id');
        $related_products_id=RelatedProduct::where('vendor_id',$vendorId)->where('product_id',$product->id)->pluck('related_product_id')->toArray();
        return view('admin.vendor.product.edit',compact('category','product','colors_sizes','fresh_attr','vendorId','preloaded','related_products','related_products_id'));
    }


    public function update(Request $request, $vendorId,$productSku)
    {

        $request->validate
        (
            [
                'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
                'name'      => 'required',
                'category_id' => 'required',
                'product_type' => 'required',
                'description'  => 'required',
                'additional_description'  => 'required',
                'moq'          => 'required',
                'availability'  => 'required_if:product_type,2',

            ],
            [
                'category_id.required'=>'caregory needed',

            ]

        );

        try{


        if($request->product_type==1){
            $fresh_attr=[];
            for($i=0; $i < count($request->quantity_min); $i++){
                array_push($fresh_attr,[$request->quantity_min[$i],$request->quantity_max[$i],$request->price[$i],$request->lead_time[$i]]);
            }
        }

        if($request->product_type==2){
            $ready_attr=[];
            for($i=0; $i < count($request->ready_quantity_min); $i++){
                array_push($ready_attr,[$request->ready_quantity_min[$i],$request->ready_quantity_max[$i],$request->ready_price[$i]]);
            }
            $colorArray = array();
            foreach ( $request->color_size as $k => $arr)
            {
                $total = count($arr);
                $i = 0;
                foreach ( $arr as $val )
                {
                    $colorArray[$i][$k] = $val;
                    $i++;
                }
            }
        }


        Product::where('sku',$productSku)->update([
            'vendor_id' => $vendorId,
            'name'      => $request->name,
            'sku'       =>$productSku,
            'product_category_id' => $request->category_id,
            'product_type'  => $request->product_type,
            'is_featured' => $request->is_featured=='on'? 1:0,
            'is_new_arrival' => $request->is_new_arrival=='on'? 1:0,
            'state'   => $request->published=='on'? 1:0,
            'description' => $request->description,
            'additional_description' => $request->additional_description,
            'colors_sizes'  => $request->product_type==2 ? json_encode($colorArray) : null,
            'attribute' => $request->product_type==2 ?json_encode($ready_attr):json_encode($fresh_attr),
            'moq'         => $request->moq,
            'availability'     => $request->availability,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'copyright_price'  => $request->product_type==1 ? $request->copyright_price : null,
            'updated_by'  => Auth::guard('admin')->user()->id,
        ]);

        $product=Product::where('sku',$productSku)->first();
        $vendor=Vendor::where('id' ,$vendorId)->first();
        $vendorName=Str::slug($vendor->vendor_name,'-');
        $productImages=ProductImage::where('product_id',$product->id)->whereNotIn('id',$request->preloaded)->get();
        if(isset($productImages)){
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
                $filename = $image->store('images/'.$vendorName.'/products/small','public');
                $image_resize = Image::make(public_path('storage/'.$filename));
                $image_resize->fit(300, 300);
                $image_resize->save(public_path('storage/'.$filename));
                $original=$image->store('images/'.$vendorName.'/products/original','public');
                $product_image = ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $filename,
                    'original' => $original,
                ]);
            }
        }
         //related products
         if(!isset($request->related_products))
         {
             $relatedProduct=RelatedProduct::where('vendor_id',$vendorId)->where('product_id',$product->id)->get();
             if($relatedProduct){
                 foreach($relatedProduct as $rel_product)
                 {
                     $rel_product->delete();
                 }
             }
         }
         if($request->related_products)
         {
             $relatedProduct=RelatedProduct::where('vendor_id',$vendorId)->where('product_id',$product->id)->get();
             if($relatedProduct){
                 foreach($relatedProduct as $rel_product)
                     {
                         $rel_product->delete();
                     }
             }
             foreach($request->related_products as $item){
                 RelatedProduct::create([
                     'vendor_id'  => $vendorId,
                     'product_id' => $product->id,
                     'related_product_id' => $item,
                 ]);
             }

         }

        Session::flash('success','Product Updated successfully!!!!');

        return redirect()->route('product.index',$vendorId);
        }catch(Exception $e){
              return $e->getMessage().'-'.$e->getLine();
        }

    }


    public function destroy($vendorId,$productSku)
    {
        $product=Product::where('sku',$productSku)->first();
        $productImages=ProductImage::where('product_id',$product->id)->get();
        $result=$product->delete();
        if($result){
            if(isset($productImages)){
                foreach($productImages as $productImage){
                    if(Storage::exists('public/'.$productImage->image) && Storage::exists('public/'.$productImage->original)){
                        Storage::delete('public/'.$productImage->image);
                        Storage::delete('public/'.$productImage->original);
                    }
                    $productImage->delete();
                }
            }
            Session::flash('success','Product deleted successfully!!!!');
        }
        return redirect()->route('product.index',$vendorId);
    }


    public function uploadSubmit(Request $request)
    {
        $vendor=Vendor::find($request->vendorId);
        $vendorName=Str::slug($vendor->vendor_name,'-');
        $images = [];
        foreach ($request->images as $image) {
            $filename = $image->store('images/'.$vendorName.'/products','public');
            //$img = Image::make($filename);
            $product_image = ProductImage::create([
                'image' => $filename
            ]);
            $image_object = new \stdClass();
            $image_object->name = $image->getClientOriginalName();
            $image_object->size = round(Storage::size('public/'.$filename) / 1024, 2);
            $image_object->fileID = $product_image->id;
            $images[] = $image_object;
        }
        return response()->json(array('files' => $images), 200);
    }


    public function deleteSingleImage(Request $request)
    {
        $productImage=ProductImage::find($request->id);
        if(Storage::exists('public/'.$productImage->image)){
            Storage::delete('public/'.$productImage->image);
        }
        $productImage->delete();
        return response()->json([
            'success' => 'Image Deleted successfully!'
        ]);

    }

    public function relatedProducts()
    {
        $vendor_id=User::where('id',Auth::guard('admin')->id())->first();
        $related_products=Product::where('vendor_id',$vendor_id->vendor->id)->get();
        return response()->json($related_products,200);
    }

}

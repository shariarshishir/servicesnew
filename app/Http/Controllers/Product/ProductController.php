<?php

namespace App\Http\Controllers\Product;


use Carbon\Carbon;
use App\Models\ProductTag;
use App\Rules\MoqUnitRule;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product as WholesalerProduct;


class ProductController extends Controller
{
    public function index($alias, Request $request)
    {
        $business_profile=BusinessProfile::where('alias',$alias)->firstOrFail();
        $collection=collect(WholesalerProduct::withTrashed()
                ->where(function($query) use ($request, $business_profile){
                    $query->where('business_profile_id', $business_profile->id)->get();
                    if(isset($request->search)){
                        $query->where('name','like', '%'.$request->search.'%')->get();
                    }})
                ->latest()
                ->with('images','video')
                ->get());

                $controller_max_moq=$collection->max('moq');
                $controller_min_moq=$collection->min('moq');
                $controller_max_lead_time=0;
                $controller_min_lead_time=0;
                foreach($collection as $product){
                    if(isset($product->attribute) && $product->product_type == 1){
                        foreach(json_decode($product->attribute) as $lead_time)
                        {
                            if ($lead_time[3] > $controller_max_lead_time) {
                                $controller_max_lead_time = $lead_time[3];
                            }

                            if ($lead_time[3] < $controller_min_lead_time) {
                                $controller_min_lead_time = $lead_time[3];
                            }
                        }
                    }
                }

                if(isset($request->product_tag)){
                    $ptags=[];
                    foreach($request->product_tag as $tag){
                        $product_tag=ProductTag::where('id',$tag)->first();
                        array_push($ptags,$product_tag->name);
                    }
                    $collection= $collection->filter(function($item) use ($ptags){
                        if(isset($item['product_tag'])){
                            $check=array_intersect($item['product_tag'], $ptags);
                            if(empty($check)){
                                return false;
                            }
                            return true;
                        }
                        return false;

                    });
                }

                if(isset($request->product_type_mapping_child_id)){
                    $collection= $collection->filter(function($item) use ($request){
                        if(isset($item['product_type_mapping_child_id'])){
                            $check=array_intersect($item['product_type_mapping_child_id'], $request->product_type_mapping_child_id);
                            if(empty($check)){
                                return false;
                            }
                            return true;
                        }
                        return false;
                    });
                }

                if(isset($request->min_lead) && isset($request->max_lead)){
                    $p_id=[];
                    foreach($collection as $product){
                        if(isset($product->attribute) && $product->product_type == 1){
                            foreach(json_decode($product->attribute) as $lead_time)
                            {
                                if ( $lead_time[3] >= $request->min_lead && $lead_time[3] <= $request->max_lead){
                                    array_push($p_id,$product->id);
                                }
                            }
                        }
                    }

                    $collection = $collection->whereIn('id', $p_id);
                    $collection->all();
                }

                if(isset($request->min_moq) && isset($request->max_moq)){
                    $collection = $collection->whereBetween('moq', [$request->min_moq, $request->max_moq]);
                    $collection->all();
                }

                $page = Paginator::resolveCurrentPage() ?: 1;
                $perPage = 8;
                $products = new \Illuminate\Pagination\LengthAwarePaginator(
                    $collection->forPage($page, $perPage),
                    $collection->count(),
                    $perPage,
                    $page,
                    ['path' => Paginator::resolveCurrentPath()],
                );

                $view=isset($request->view)? $request->view : 'grid';
                return view('new_product.wholesaler_products.index',compact('alias','products','business_profile','view','controller_max_moq','controller_min_moq','controller_max_lead_time','controller_min_lead_time'));
    }



    public function store(StoreProductRequest $request)
    {

        $business_profile=BusinessProfile::withTrashed()->where('id', $request->business_profile_id)->first();
        $business_profile_name=$business_profile->business_name;
        //sku id
        $date=Carbon::now()->timestamp;
        $number=mt_rand(0,9999);
        $pattern= '/[^A-Za-z0-9\-]/';
        $FileName= preg_replace($pattern, '', $request->name);
        $name= explode(' ',strtolower($FileName));
        $sku=$name[0].$date.$number;

        $full_stock_negotiable=false;
        $full_stock = false;
        $full_stock_price = null;
        $color_size_availability=null;
        if($request->product_type == 2){
            $full_stock= isset($request->full_stock) ? true : false;
            $full_stock_price = isset($request->full_stock_price) ? $request->full_stock_price : null;
            $color_size_availability = (int)$request->ready_stock_availability;
            $full_stock_negotiable= isset($request->ready_full_stock_negotiable) ? true : false;
        }
        if($request->product_type == 3){
            $full_stock= isset($request->non_clothing_full_stock) ? true : false;
            $full_stock_price = isset($request->non_clothing_full_stock_price) ? $request->non_clothing_full_stock_price : null;
            $color_size_availability=(int)$request->non_clothing_availability;
            $full_stock_negotiable= isset($request->non_clothing_full_stock_negotiable) ? true : false;
        }

        $data['id']=(int)$date.$number;
        $data['business_profile_id']=(int)$request->business_profile_id;
        $data['name']=$request->name;
        $data['product_tag']=$request->product_tag;
        $data['sku']    =$sku;
        $data['product_type'] =(int)$request->product_type;
        $data['product_type_mapping_id'] = (int)$request->product_type_mapping;
        $data['product_type_mapping_child_id']=$request->product_type_mapping == 1 ? $request->studio_id : $request->raw_materials_id;
        $data['moq'] =(int)$request->moq??null;
        $data['colors_sizes'] =$this->colorsSizes($request);;
        $data['price_break_down'] =$this->priceBreakDown($request);;
        $data['qty_unit'] =$request->qty_unit;
        $data['price_unit'] =$request->price_unit;
        $data['gender'] = $request->gender;
        $data['sample_availability'] = (boolean)$request->sample_availability;
        $data['state'] = $request->published=='on'? true:false;
        $data['is_new_arrival'] = $request->is_new_arrival=='on'? true:false;
        $data['is_featured'] = $request->is_featured=='on'? true:false;
        $data['customize'] = $request->customize=='on'? true:false;
        $data['description'] = $request->description;
        $data['additional_description'] = $request->additional_description ?? null;
        $data['full_stock_negotiable'] = $full_stock_negotiable;
        $data['full_stock'] = $full_stock;
        $data['full_stock_price'] = $full_stock_price;
        $data['color_size_availability'] = $color_size_availability;
        $data['video'] = $this->uploadVideo($request,$business_profile_name);

        $product=Product::create($data);
        return $product;
    }


    public function colorsSizes($request)
    {
        $colors_sizes=[];
        if($request->product_type==2){
            $colors_sizes_init=[];
            if(isset($request->color_size['color'])){
                foreach($request->color_size as $key => $value)
                {
                    foreach($value as $key2 => $value2 )
                    {
                        if($key!='color'){
                            $colors_sizes_init[$key2][$key]=$value2;
                        }else{
                            $colors_sizes_init[$key2][$key]=$value2;
                        }
                    }
                }
                foreach($colors_sizes_init as $k =>$v){
                    $id=1;
                    $size=[];
                    foreach($v as $k2 => $v2){
                        if($v2 != 0 && $k2 != 'color'){
                             array_push($size,['id'=>$id++,'sizeName' => $k2, 'count' => (int)$v2]);
                        }elseif ($k2== 'color'){
                            $colors_sizes[$k]['colorName']=$v2;
                        }
                        $colors_sizes[$k]['size']=$size;
                        $colors_sizes[$k]['quantity']=null;
                    }
                }

            }
        }
        //non clothing item
        if($request->product_type==3)
        {
            if(isset($request->non_clothing_attr)){
                foreach($request->non_clothing_attr as $key => $value)
                {
                    foreach($value as $key2 => $value2 )
                    {
                        if($key=='color'){
                            $colors_sizes[$key2]['colorName']=$value2;
                        }else{
                            $colors_sizes[$key2]['quantity']=(int)$value2;
                        }
                        $colors_sizes[$key2]['size']=null;
                    }
                }
            }
        }
        if($request->product_type==4){
            if(isset($request->mb_color_size['color'])){
                $colors_sizes_init=[];
                foreach($request->mb_color_size as $key => $value)
                {
                    foreach($value as $key2 => $value2 )
                    {
                        $colors_sizes_init[$key2][$key]=$value2;
                    }
                }
                foreach($colors_sizes_init as $k =>$v){
                    $id=1;
                    $size=[];
                    foreach($v as $k2 => $v2){
                        if($v2 != 0 && $k2 != 'color'){
                             array_push($size,['id'=>$id++,'sizeName' => $k2, 'count' => null]);
                        }elseif ($k2== 'color'){
                            $colors_sizes[$k]['colorName']=$v2;
                        }
                        $colors_sizes[$k]['size']=$size;
                        $colors_sizes[$k]['quantity']=null;
                    }
                }

            }
        }
        return $colors_sizes;
    }

    public function priceBreakDown($request)
    {
        $price_break_down=[];
        if($request->product_type==1){
            for($i=0; $i < count($request->quantity_min); $i++){
                array_push($price_break_down,['qty_min'=>(int)$request->quantity_min[$i],'qty_max' =>(int)$request->quantity_max[$i],'price' =>is_numeric($request->price[$i]) ? $request->price[$i] : 'Negotiable','lead_time'=>$request->lead_time[$i]]);
            }
        }
        if($request->product_type == 2){
            for($i=0; $i < count($request->ready_quantity_min); $i++){
                array_push($price_break_down,['qty_min'=>(int)$request->ready_quantity_min[$i],'qty_max' =>(int)$request->ready_quantity_max[$i],'price' =>is_numeric($request->ready_price[$i]) ? $request->ready_price[$i] : 'Negotiable','lead_time'=>null]);
            }
        }
        if($request->product_type == 3){
            for($i=0; $i < count($request->non_clothing_min); $i++){
                array_push($price_break_down,['qty_min'=>(int)$request->non_clothing_min[$i],'qty_max' =>(int)$request->non_clothing_max[$i],'price' =>is_numeric($request->non_clothing_price[$i]) ? $request->non_clothing_price[$i] : 'Negotiable','lead_time'=>null]);
            }
        }
        if($request->product_type == 4){
            $price_break_down[]=['qty_min'=>null,'qty_max' =>null,'price' => $request->price_range ,'lead_time'=>$request->lead_time];
        }

        return $price_break_down;
    }

    public function uploadVideo($request,$business_profile_name)
    {
         if($request->hasFile('video')){
            $uniqueStringForSmallImage = generateUniqueString();
            $original_image_file_unique_name = uniqid().$uniqueStringForSmallImage.'.'. $request->video->getClientOriginalExtension();
            $s3FilePath='public/video/test/'.$business_profile_name.'/'.$original_image_file_unique_name;
            $filePathForDB = 'video/test/'.$business_profile_name.'/'.$original_image_file_unique_name;
            Storage::disk('s3')->put($s3FilePath, file_get_contents($request->video));
            return $filePathForDB;
        }
        return null;
    }
}

<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Product as ManufactureProduct;
use App\Models\User;
use App\Models\ProductImage;
use App\Models\RelatedProduct;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Image;
use DB;
use Illuminate\Http\Request;
use stdClass;
use Helper;


class ProductController extends Controller
{
    public function index($businessProfileId){

        $products=Product::with('images','productReview')->where('business_profile_id',$businessProfileId)->where('state',1)->where('sold',0)->paginate(20);
        $productsArray=[];
        if($products->total()>0){
            foreach($products as $product){

                if($product->product_type==1 ){
                    foreach(json_decode($product->attribute) as $attribute){
                        $attribute_array[] = (object) array('quantity_min' =>$attribute[0], 'quantity_max' => $attribute[1],'price'=>$attribute[2],'lead_time'=>$attribute[3]);
                    }
                }else{
                    foreach(json_decode($product->attribute) as $attribute){
                        $attribute_array[] = (object) array('ready_quantity_min' =>$attribute[0], 'ready_quantity_max' => $attribute[1],'ready_price'=>$attribute[2]);
                    }
                }

                $newFormatedProduct= new stdClass();
                $newFormatedProduct->id=$product->id;
                $newFormatedProduct->name=$product->name;
                $newFormatedProduct->business_profile_id=$product->business_profile_id;
                $newFormatedProduct->business_name=$product->businessProfile->business_name;
                $newFormatedProduct->sku=$product->sku;
                $newFormatedProduct->copyright_price=$product->copyright_price;
                $newFormatedProduct->full_stock= $product->full_stock;
                $newFormatedProduct->full_stock_price= $product->full_stock_price;
                $newFormatedProduct->attribute=  $attribute_array;
                $newFormatedProduct->colors_sizes=$product->product_type==1 ? [] : json_decode($product->colors_sizes);
                $newFormatedProduct->product_category_id=$product->product_category_id;
                $newFormatedProduct->product_type=$product->product_type;
                $newFormatedProduct->moq=$product->moq;
                $newFormatedProduct->product_unit=$product->product_unit;
                $newFormatedProduct->is_new_arrival=$product->is_new_arrival;
                $newFormatedProduct->is_featured=$product->is_featured;
                $newFormatedProduct->description=$product->description;
                $newFormatedProduct->state= $product->state;
                $newFormatedProduct->sold= $product->sold;
                $newFormatedProduct->additional_description=$product->additional_description;
                $newFormatedProduct->availability=$product->availability;
                $newFormatedProduct->images=$product->images;
                $newFormatedProduct->productReviews=$product->productReview;
                $newFormatedProduct->productTotalAverageRating=productRating($product->id);
                array_push($productsArray,$newFormatedProduct);
                $attribute_array=[];

            }


        }
        if(count($productsArray)>0){
            return response()->json(array('success' => true, 'product' => $productsArray),200);

        }
        else{
            return response()->json(array('success' => false, 'product' => $productsArray,'message' => "No products found"),200);
        }
    }

    public function productList($storeId){

        $products=Product::where('vendor_id',$storeId)->where('state',1)->where('sold',0)->get();
        $productsArray=[];
        if(count($products)>0){
            foreach($products as $product){

                $newFormatedProduct= new stdClass();
                $newFormatedProduct->id=$product->id;
                $newFormatedProduct->name=$product->name;
                array_push($productsArray,$newFormatedProduct);

            }

        }
        if(count($productsArray)>0){
            return response()->json(array('success' => true, 'products' => $productsArray),200);
        }
        else{
            return response()->json(array('success' => false, 'products' => $productsArray,'message' => "No products found"),200);
        }

    }

    public function readyStockProducts(){

        $readyStockProducts=Product::with('images','productReview')->whereIn('product_type',[2,3])->where('state',1)->where('sold',0)->paginate(9);
        $readyStockProductsArray=[];
        if($readyStockProducts->total()>0){
            foreach($readyStockProducts as $product){
                if($product->product_type==2){
                    
                    foreach(json_decode($product->attribute) as $attribute){
                        $attribute_array[] = (object) array('ready_quantity_min' =>$attribute[0], 'ready_quantity_max' => $attribute[1],'ready_price'=>$attribute[2]);
                    }

                }
                else{
                   
                    foreach(json_decode($product->attribute) as $attribute){
    
                        $attribute_array[] = (object) array('non_clothing_quantity_min' =>$attribute[0], 'non_clothing_quantity_max' => $attribute[1],'non_clothing_price'=>$attribute[2]);
                    }
                }
             
                $newFormatedProduct= new stdClass();
                $newFormatedProduct->id=$product->id;
                $newFormatedProduct->name=$product->name;
                $newFormatedProduct->business_profile_id=$product->business_profile_id;
                $newFormatedProduct->business_name=$product->businessProfile->business_name;
                $newFormatedProduct->sku=$product->sku;
                $newFormatedProduct->copyright_price=$product->copyright_price;
                $newFormatedProduct->full_stock= $product->full_stock;
                $newFormatedProduct->full_stock_price= $product->full_stock_price;
                $newFormatedProduct->attribute=  $attribute_array;
                $newFormatedProduct->colors_sizes=json_decode($product->colors_sizes);
                $newFormatedProduct->product_category_id=$product->product_category_id;
                $newFormatedProduct->product_type=$product->product_type;
                $newFormatedProduct->moq=$product->moq;
                $newFormatedProduct->product_unit=$product->product_unit;
                $newFormatedProduct->is_new_arrival=$product->is_new_arrival;
                $newFormatedProduct->is_featured=$product->is_featured;
                $newFormatedProduct->description=$product->description;
                $newFormatedProduct->state= $product->state;
                $newFormatedProduct->sold= $product->sold;
                $newFormatedProduct->additional_description=$product->additional_description;
                $newFormatedProduct->availability=$product->availability;
                $newFormatedProduct->images=$product->images;
                $newFormatedProduct->productReviews=$product->productReview;
                $newFormatedProduct->productTotalAverageRating=productRating($product->id);
                array_push($readyStockProductsArray,$newFormatedProduct);
                $attribute_array=[];

            }
           
        }
        if(count($readyStockProductsArray)>0){
            return response()->json(array('success' => true, 'products' => $readyStockProductsArray),200);
        }
        else{
            return response()->json(array('success' => false,'products' => $readyStockProductsArray, 'message' => "No products found"),200);
        }
    }

    public function buyDesignProducts(){

        $buyDesignProducts=Product::with('images','productReview')->where('product_type',1)->where('state',1)->where('sold',0)->paginate(9);
        $buyDesignProductsArray=[];
        if($buyDesignProducts->total()>0){
            foreach($buyDesignProducts as $product){

                foreach(json_decode($product->attribute) as $attribute){
                    $attribute_array[] = (object) array('quantity_min' =>$attribute[0], 'quantity_max' => $attribute[1],'price'=>$attribute[2],'lead_time'=>$attribute[3]);
                }
                $newFormatedProduct= new stdClass();

                $newFormatedProduct->id=$product->id;
                $newFormatedProduct->name=$product->name;
                $newFormatedProduct->business_profile_id=$product->business_profile_id;
                $newFormatedProduct->business_name=$product->businessProfile->business_name;
                $newFormatedProduct->sku=$product->sku;
                $newFormatedProduct->copyright_price=$product->copyright_price;
                $newFormatedProduct->full_stock= $product->full_stock;
                $newFormatedProduct->full_stock_price= $product->full_stock_price;
                $newFormatedProduct->attribute=  $attribute_array;
                $newFormatedProduct->colors_sizes=$product->product_type==1 ? [] :json_decode($product->colors_sizes);
                $newFormatedProduct->product_category_id=$product->product_category_id;
                $newFormatedProduct->product_type=$product->product_type;
                $newFormatedProduct->moq=$product->moq;
                $newFormatedProduct->product_unit=$product->product_unit;
                $newFormatedProduct->is_new_arrival=$product->is_new_arrival;
                $newFormatedProduct->is_featured=$product->is_featured;
                $newFormatedProduct->description=$product->description;
                $newFormatedProduct->state= $product->state;
                $newFormatedProduct->sold= $product->sold;
                $newFormatedProduct->additional_description=$product->additional_description;
                $newFormatedProduct->availability=$product->availability;
                $newFormatedProduct->images=$product->images;
                $newFormatedProduct->productReviews=$product->productReview;
                $newFormatedProduct->productTotalAverageRating=productRating($product->id);
                array_push($buyDesignProductsArray,$newFormatedProduct);
                $attribute_array=[];

            }
        }

        if(count($buyDesignProductsArray)>0){
            return response()->json(array('success' => true, 'products' => $buyDesignProductsArray),200);
        }
        else{
            return response()->json(array('success' => false, 'products' => $buyDesignProductsArray,'message' => "No products found"),200);
        }
    }


    public function nonClothingProducts(){

        $nonClothingProducts=Product::with('images','productReview')->where('product_type',3)->where('state',1)->where('sold',0)->paginate(9);
        $nonClothingProductsArray=[];
        if($nonClothingProducts->total()>0){
            foreach($nonClothingProducts as $product){

                foreach(json_decode($product->attribute) as $attribute){
                    $attribute_array[] = (object) array('non_clothing_quantity_min' =>$attribute[0], 'non_clothing_quantity_max' => $attribute[1],'non_clothing_price'=>$attribute[2]);
                }
                $newFormatedProduct= new stdClass();

                $newFormatedProduct->id=$product->id;
                $newFormatedProduct->name=$product->name;
                $newFormatedProduct->business_profile_id=$product->business_profile_id;
                $newFormatedProduct->business_name=$product->businessProfile->business_name;
                $newFormatedProduct->sku=$product->sku;
                $newFormatedProduct->copyright_price=$product->copyright_price;
                $newFormatedProduct->full_stock= $product->full_stock;
                $newFormatedProduct->full_stock_price= $product->full_stock_price;
                $newFormatedProduct->attribute=  $attribute_array;
                $newFormatedProduct->colors_sizes=$product->product_type==1 ? [] :json_decode($product->colors_sizes);
                $newFormatedProduct->product_category_id=$product->product_category_id;
                $newFormatedProduct->product_type=$product->product_type;
                $newFormatedProduct->moq=$product->moq;
                $newFormatedProduct->product_unit=$product->product_unit;
                $newFormatedProduct->is_new_arrival=$product->is_new_arrival;
                $newFormatedProduct->is_featured=$product->is_featured;
                $newFormatedProduct->description=$product->description;
                $newFormatedProduct->state= $product->state;
                $newFormatedProduct->sold= $product->sold;
                $newFormatedProduct->additional_description=$product->additional_description;
                $newFormatedProduct->availability=$product->availability;
                $newFormatedProduct->images=$product->images;
                $newFormatedProduct->productReviews=$product->productReview;
                $newFormatedProduct->productTotalAverageRating=productRating($product->id);
                array_push($nonClothingProductsArray,$newFormatedProduct);
                $attribute_array=[];
            }
        }

        if(count($nonClothingProductsArray)>0){
            return response()->json(array('success' => true, 'products' => $nonClothingProductsArray),200);
        }
        else{
            return response()->json(array('success' => false, 'products' => $nonClothingProductsArray,'message' => "No products found"),200);
        }
    }

    public function show($storeId,$productId){

        $product = Product::with('images','productReview')->where('id',$productId)->where('vendor_id',$storeId)->where('state',1)->where('sold',0)->first();

        if($product){

            if($product->product_type==1 ){
                foreach(json_decode($product->attribute) as $attribute){
                    $attribute_array[] = (object) array('quantity_min' =>$attribute[0], 'quantity_max' => $attribute[1],'price'=>$attribute[2],'lead_time'=>$attribute[3]);
                }
            }
            else if($product->product_type==2){
                foreach(json_decode($product->attribute) as $attribute){
                    $attribute_array[] = (object) array('ready_quantity_min' =>$attribute[0], 'ready_quantity_max' => $attribute[1],'ready_price'=>$attribute[2]);
                }
            }
            else{
                foreach(json_decode($product->attribute) as $attribute){
                    $attribute_array[] = (object) array('non_clothing_quantity_min' =>$attribute[0], 'non_clothing_quantity_max' => $attribute[1],'non_clothing_price'=>$attribute[2]);
                }

            }


            $newFormatedProduct= new stdClass();
            $newFormatedProduct->id=$product->id;
            $newFormatedProduct->name=$product->name;
            $newFormatedProduct->business_profile_id=$product->business_profile_id;
            $newFormatedProduct->business_name=$product->businessProfile->business_name;
            $newFormatedProduct->sku=$product->sku;
            $newFormatedProduct->copyright_price=$product->copyright_price;
            $newFormatedProduct->full_stock= $product->full_stock;
            $newFormatedProduct->full_stock_price= $product->full_stock_price;
            $newFormatedProduct->attribute=  $attribute_array;
            $newFormatedProduct->colors_sizes=$product->product_type==1 ? [] :json_decode($product->colors_sizes);
            $newFormatedProduct->product_category_id=$product->product_category_id;
            $newFormatedProduct->product_type=$product->product_type;
            $newFormatedProduct->moq=$product->moq;
            $newFormatedProduct->product_unit=$product->product_unit;
            $newFormatedProduct->is_new_arrival=$product->is_new_arrival;
            $newFormatedProduct->is_featured=$product->is_featured;
            $newFormatedProduct->description=$product->description;
            $newFormatedProduct->state= $product->state;
            $newFormatedProduct->sold= $product->sold;
            $newFormatedProduct->additional_description=$product->additional_description;
            $newFormatedProduct->availability=$product->availability;
            $newFormatedProduct->productReview=$product->productReview;
            $newFormatedProduct->productTotalAverageRating=productRating($product->id);
            $newFormatedProduct->images=$product->images;


        }


        if(isset($newFormatedProduct)){
            return response()->json(array('success' => true, 'product' => $newFormatedProduct),200);
        }
        else{
            return response()->json(array('success' => false, 'message' => "No products found"),200);
        }

    }



    public function productById($productId){

        $product = Product::with('images','productReview')->where('id',$productId)->where('state',1)->where('sold',0)->first();

        if($product){

            if($product->product_type==1 ){
                foreach(json_decode($product->attribute) as $attribute){
                    $attribute_array[] = (object) array('quantity_min' =>$attribute[0], 'quantity_max' => $attribute[1],'price'=>$attribute[2],'lead_time'=>$attribute[3]);
                }
            }else if($product->product_type==2 ){
                foreach(json_decode($product->attribute) as $attribute){
                    $attribute_array[] = (object) array('ready_quantity_min' =>$attribute[0], 'ready_quantity_max' => $attribute[1],'ready_price'=>$attribute[2]);
                }
            }
             else{
                foreach(json_decode($product->attribute) as $attribute){
                    $attribute_array[] = (object) array('non_clothing_quantity_min' =>$attribute[0], 'non_clothing_quantity_max' => $attribute[1],'non_clothing_price'=>$attribute[2]);
                }

            }


            $newFormatedProduct= new stdClass();
            $newFormatedProduct->id=$product->id;
            $newFormatedProduct->name=$product->name;
            $newFormatedProduct->business_profile_id=$product->business_profile_id;
            $newFormatedProduct->business_name=$product->businessProfile->business_name;
            $newFormatedProduct->sku=$product->sku;
            $newFormatedProduct->copyright_price=$product->copyright_price;
            $newFormatedProduct->full_stock= $product->full_stock;
            $newFormatedProduct->full_stock_price= $product->full_stock_price;
            $newFormatedProduct->attribute=  $attribute_array;
            $newFormatedProduct->colors_sizes=$product->product_type==1 ? [] :json_decode($product->colors_sizes);
            $newFormatedProduct->product_category_id=$product->product_category_id;
            $newFormatedProduct->product_type=$product->product_type;
            $newFormatedProduct->moq=$product->moq;
            $newFormatedProduct->product_unit=$product->product_unit;
            $newFormatedProduct->is_new_arrival=$product->is_new_arrival;
            $newFormatedProduct->is_featured=$product->is_featured;
            $newFormatedProduct->description=$product->description;
            $newFormatedProduct->state= $product->state;
            $newFormatedProduct->sold= $product->sold;
            $newFormatedProduct->additional_description=$product->additional_description;
            $newFormatedProduct->availability=$product->availability;
            $newFormatedProduct->productReview=$product->productReview;
            $newFormatedProduct->productTotalAverageRating=productRating($product->id);
            $newFormatedProduct->images=$product->images;


        }


        if(isset($newFormatedProduct)){
            return response()->json(array('success' => true, 'product' => $newFormatedProduct),200);
        }
        else{
            return response()->json(array('success' => false, 'message' => "No products found"),200);
        }

    }

    //customizable products
    public function customizableProducts()
    {
        $products = Product::with('images')->where('customize', true)->where('state',1)->where('sold',0)->inRandomOrder()->paginate(9);
        $customizableProductsArray=[];
        if($products->total()>0){
            foreach($products as $product){

                foreach(json_decode($product->attribute) as $attribute){
                    $attribute_array[] = (object) array('quantity_min' =>$attribute[0], 'quantity_max' => $attribute[1],'price'=>$attribute[2],'lead_time'=>$attribute[3]);
                }
                $newFormatedProduct= new stdClass();

                $newFormatedProduct->id=$product->id;
                $newFormatedProduct->name=$product->name;
                $newFormatedProduct->business_profile_id=$product->business_profile_id;
                $newFormatedProduct->business_name=$product->businessProfile->business_name;
                $newFormatedProduct->sku=$product->sku;
                $newFormatedProduct->copyright_price=$product->copyright_price;
                $newFormatedProduct->full_stock= $product->full_stock;
                $newFormatedProduct->full_stock_price= $product->full_stock_price;
                $newFormatedProduct->attribute=  $attribute_array;
                $newFormatedProduct->colors_sizes=$product->product_type==1 ? [] :json_decode($product->colors_sizes);
                $newFormatedProduct->product_category_id=$product->product_category_id;
                $newFormatedProduct->product_type=$product->product_type;
                $newFormatedProduct->moq=$product->moq;
                $newFormatedProduct->product_unit=$product->product_unit;
                $newFormatedProduct->is_new_arrival=$product->is_new_arrival;
                $newFormatedProduct->is_featured=$product->is_featured;
                $newFormatedProduct->description=$product->description;
                $newFormatedProduct->state= $product->state;
                $newFormatedProduct->sold= $product->sold;
                $newFormatedProduct->additional_description=$product->additional_description;
                $newFormatedProduct->availability=$product->availability;
                $newFormatedProduct->images=$product->images;
                $newFormatedProduct->productReviews=$product->productReview;
                $newFormatedProduct->productTotalAverageRating=productRating($product->id);
                array_push($customizableProductsArray,$newFormatedProduct);
                $attribute_array=[];

            }
        }

        if(count($customizableProductsArray)>0){
            return response()->json(array('success' => true, 'products' => $customizableProductsArray),200);
        }
        else{
            return response()->json(array('success' => false, 'products' => $customizableProductsArray,'message' => "No products found"),200);
        }
    }



    public function showProductByCategoryId($categoryId){

        $products = Product::with('images','productReview')->where('product_category_id',$categoryId)->where('state',1)->where('sold',0)->paginate(9);
        $productsArray=[];
        if($products->total()>0){
            foreach($products as $product){

                    if($product->product_type==1 ){
                        foreach(json_decode($product->attribute) as $attribute){
                            $attribute_array[] = (object) array('quantity_min' =>$attribute[0], 'quantity_max' => $attribute[1],'price'=>$attribute[2] ,'lead_time'=>$attribute[3]);
                        }
                    }else if($product->product_type==2 ){
                        foreach(json_decode($product->attribute) as $attribute){
                            $attribute_array[] = (object) array('ready_quantity_min' =>$attribute[0], 'ready_quantity_max' => $attribute[1],'ready_price'=>$attribute[2]);
                        }
                    }
                    else{
                        foreach(json_decode($product->attribute) as $attribute){
                            $attribute_array[] = (object) array('non_clothing_quantity_min' =>$attribute[0], 'non_clothing_quantity_max' => $attribute[1],'non_clothing_price'=>$attribute[2]);
                        }
        
                    }


                    $newFormatedProduct= new stdClass();
                    $newFormatedProduct->id=$product->id;
                    $newFormatedProduct->name=$product->name;
                    $newFormatedProduct->business_profile_id=$product->business_profile_id;
                    $newFormatedProduct->business_name=$product->businessProfile->business_name;
                    $newFormatedProduct->sku=$product->sku;
                    $newFormatedProduct->copyright_price=$product->copyright_price;
                    $newFormatedProduct->full_stock= $product->full_stock;
                    $newFormatedProduct->full_stock_price= $product->full_stock_price;
                    $newFormatedProduct->attribute=  $attribute_array;
                    $newFormatedProduct->colors_sizes=$product->product_type==1 ? [] :json_decode($product->colors_sizes);
                    $newFormatedProduct->product_category_id=$product->product_category_id;
                    $newFormatedProduct->product_type=$product->product_type;
                    $newFormatedProduct->moq=$product->moq;
                    $newFormatedProduct->product_unit=$product->product_unit;
                    $newFormatedProduct->is_new_arrival=$product->is_new_arrival;
                    $newFormatedProduct->is_featured=$product->is_featured;
                    $newFormatedProduct->description=$product->description;
                    $newFormatedProduct->state= $product->state;
                    $newFormatedProduct->sold= $product->sold;
                    $newFormatedProduct->additional_description=$product->additional_description;
                    $newFormatedProduct->availability=$product->availability;
                    $newFormatedProduct->images=$product->images;
                    $newFormatedProduct->productReviews=$product->productReview;
                    $newFormatedProduct->productTotalAverageRating=productRating($product->id);
                    array_push($productsArray,$newFormatedProduct);
                    $attribute_array=[];

                }

        }
        if(count($productsArray)>0){
            return response()->json(array('success' => true, 'product' => $productsArray),200);

        }
        else{
            return response()->json(array('success' => false, 'product' => $productsArray,'message' => "No products found"),200);
        }


    }


    public function destroy($storeId,$productId)
    {
      $product=Product::where('id',$productId)->first();
      if($product->state==1){
          $product->update(['state' => 0]);
          return response()->json(array('success' => true, 'msg' => 'Product Unpublish Successfully'),200);
        }
      else{
        $product->update(['state' => 1]);
        return response()->json(array('success' => true, 'msg' => 'Product Publish Successfully'),200);
      }
    }




    public function store(Request $request,$storeId)
    {

        
      
        $request->validate([

            'images'  => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name'      => 'required',
            'product_category_id' => 'required',
            'product_type' => 'required',
            'description'  => 'required',
            'additional_description'  => 'required',
            'moq'         => 'required',
            'product_unit'         => 'required',
            'availability'  => 'required_if:product_type,[2,3]',
            'quantity_min.*' => 'required_if:product_type,1',
            'quantity_max.*' => 'required_if:product_type,1',
            'price.*' => 'required_if:product_type,1',
            'lead_time.*' => 'required_if:product_type,1',
            'full_stock_price' => 'required_if:full_stock,on',
         ]);



         DB::beginTransaction();

         try {
            $date=Carbon::now()->timestamp;
            $number=mt_rand(0,9999);
            $remove[] = "'";
            $remove[] = '"';
            $remove[] = "-";
            $FileName = str_replace($remove, "", $request->name);
            $name= explode(' ',strtolower($FileName));
            $sku=$name[0].$date.$number;
            if($request->product_type==1){
                $price_break_down=[];
                for($i=0; $i < count($request->quantity_min); $i++){
                    array_push($price_break_down,[(int)$request->quantity_min[$i],(int)$request->quantity_max[$i],is_numeric($request->price[$i]) ? $request->price[$i] : 'Negotiable',$request->lead_time[$i]]);
                }

                $full_stock = false;
                $full_stock_price = null;
                $availability=null;
            }

            if($request->product_type==2){
                $colors_sizes=[];
                if(isset($request->color_size)){

                    for($i=0; $i < count($request->color_size); $i++){
                        array_push($colors_sizes,$request->color_size[$i]);

                    }
                }

                $price_break_down=[];
                for($i=0; $i < count($request->ready_quantity_min); $i++){
                    array_push($price_break_down,[(int)$request->ready_quantity_min[$i],(int)$request->ready_quantity_max[$i],is_numeric($request->ready_price[$i]) ? $request->ready_price[$i] : 'Negotiable']);
                }

                $full_stock= isset($request->full_stock) ? true : false;
                $full_stock_price = isset($request->full_stock_price) ? $request->full_stock_price : null;
                $availability=$request->availability;
            }

            if($request->product_type==3)
            {
                $colors_sizes=[];
                if(isset($request->color_size)){

                    for($i=0; $i < count($request->color_size); $i++){
                        array_push($colors_sizes,$request->color_size[$i]);
                    }
                }

                $price_break_down=[];
                for($i=0; $i < count($request->non_clothing_quantity_min); $i++){
                    array_push($price_break_down,[(int)$request->non_clothing_quantity_min[$i],(int)$request->non_clothing_quantity_max[$i],is_numeric($request->non_clothing_price[$i]) ? $request->non_clothing_price[$i] : 'Negotiable']);
                }

                $full_stock= isset($request->full_stock) ? true : false;
                $full_stock_price = isset($request->full_stock_price) ? $request->full_stock_price : null;
                $availability=$request->availability;
            }
           

            $product=Product::create([
                'vendor_id' => $storeId,
                'name'      => $request->name,
                'sku'       => $sku,
                'product_category_id' => $request->product_category_id,
                'product_type'  => $request->product_type,
                'attribute' => json_encode($price_break_down) ?? null,
                'is_featured' => $request->is_featured=='on'? 1:0,
                'is_new_arrival' => $request->is_new_arrival=='on'? 1:0,
                'state'   => $request->published=='on'? 1:0,
                'description' => $request->description,
                'additional_description' => $request->additional_description,
                'colors_sizes'  => isset($colors_sizes)  ? json_encode($colors_sizes): null,
                'moq'         => $request->moq,
                'product_unit'     => $request->product_unit,
                'availability'     => $availability,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'copyright_price'  => $request->product_type==1 ? $request->copyright_price : null,
                'full_stock'     => $full_stock,
                'full_stock_price' =>  $full_stock_price,
                'created_by'  => auth()->id(),

            ]);

            $user=User::where('id',auth()->id())->first();
            $vendorName=Str::slug($user->vendor->vendor_name,'-');
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
                        'vendor_id'  => auth()->user()->vendor->id,
                        'product_id' => $product->id,
                        'related_product_id' => $item,
                    ]);
                }

            }
            DB::commit();
            // all good
            return response()->json(array('success' => true, 'message' => 'Product Created Successfully','product'=>$product),200);
        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(array(
                'success' => false,
                'error' => $e->getMessage(),
                'line'=>$e->getLine(),),
                500);
        }

    }

    public function update(Request $request,$storeId,$productId)
    {

        $request->validate([
            'images'  => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name'      => 'required',
            'product_category_id' => 'required',
            'product_type' => 'required',
            'description'  => 'required',
            'additional_description'  => 'required',
            'moq'         => 'required',
            'product_unit'         => 'required',
            'availability'  => 'required_if:product_type,[2,3]',
            'quantity_min.*' => 'required_if:product_type,1',
            'quantity_max.*' => 'required_if:product_type,1',
            'price.*' => 'required_if:product_type,1',
            'lead_time.*' => 'required_if:product_type,1',
            'full_stock_price' => 'required_if:full_stock,on',

        ]);


        DB::beginTransaction();
        try {

            //buy design products
            if($request->product_type==1){
                $price_break_down=[];
                for($i=0; $i < count($request->quantity_min); $i++){
                    array_push($price_break_down,[(int)$request->quantity_min[$i],(int)$request->quantity_max[$i],is_numeric($request->price[$i]) ? $request->price[$i] : 'Negotiable',$request->lead_time[$i]]);
                }

                $full_stock = false;
                $full_stock_price = null;
                $availability=null;
            }

            //ready stock products
            if($request->product_type==2){
                $colors_sizes=[];
                if(isset($request->color_size)){

                    for($i=0; $i < count($request->color_size); $i++){
                        array_push($colors_sizes,$request->color_size[$i]);

                    }
                }

                $price_break_down=[];
                for($i=0; $i < count($request->ready_quantity_min); $i++){
                    array_push($price_break_down,[(int)$request->ready_quantity_min[$i],(int)$request->ready_quantity_max[$i],is_numeric($request->ready_price[$i]) ? $request->ready_price[$i] : 'Negotiable']);
                }

                $full_stock= isset($request->full_stock) ? true : false;
                $full_stock_price = isset($request->full_stock_price) ? $request->full_stock_price : null;
                $availability=$request->availability;
            }


            //non-clothing products
            if($request->product_type==3)
            {
                $colors_sizes=[];
                if(isset($request->color_size)){

                    for($i=0; $i < count($request->color_size); $i++){
                        array_push($colors_sizes,$request->color_size[$i]);
                    }
                }

                $price_break_down=[];
                for($i=0; $i < count($request->non_clothing_quantity_min); $i++){
                    array_push($price_break_down,[(int)$request->non_clothing_quantity_min[$i],(int)$request->non_clothing_quantity_max[$i],is_numeric($request->non_clothing_price[$i]) ? $request->non_clothing_price[$i] : 'Negotiable']);
                }

                $full_stock= isset($request->full_stock) ? true : false;
                $full_stock_price = isset($request->full_stock_price) ? $request->full_stock_price : null;
                $availability=$request->availability;
            }

            Product::where('id',$productId)->update([
                'name'      => $request->name,
                'product_category_id' => $request->category_id,
                'is_featured' => $request->is_featured=='on'? 1:0,
                'is_new_arrival' => $request->is_new_arrival=='on'? 1:0,
                'state'   => $request->published=='on'? 1:0,
                'description' => $request->description,
                'additional_description' => $request->additional_description,
                'attribute' => json_encode($price_break_down) ?? null,
                'colors_sizes'  =>  isset($colors_sizes)  ? json_encode($colors_sizes): null,
                'moq'         => $request->moq,
                'product_unit'     => $request->product_unit,
                'availability'     =>  $availability,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'copyright_price'  => $request->product_type==1 ? $request->copyright_price : null,
                'full_stock'     => $full_stock,
                'full_stock_price' =>  $full_stock_price,
                'updated_by'  => auth()->id(),
            ]);

            $product=Product::where('id',$productId)->first();
            $user=User::where('id',auth()->id())->first();
            $vendorName=Str::slug($user->vendor->vendor_name,'-');
            $productImages=ProductImage::whereIn('id',$request->product_images_id)->get();
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
                $relatedProduct=RelatedProduct::where('vendor_id',auth()->user()->vendor->id)->where('product_id',$product->id)->get();
                if($relatedProduct){
                    foreach($relatedProduct as $rel_product)
                    {
                        $rel_product->delete();
                    }
                }
            }
            if($request->related_products)
            {
                $relatedProduct=RelatedProduct::where('vendor_id',auth()->user()->vendor->id)->where('product_id',$product->id)->get();
                if($relatedProduct){
                    foreach($relatedProduct as $rel_product)
                        {
                            $rel_product->delete();
                        }
                }
                foreach($request->related_products as $item){
                    RelatedProduct::create([
                        'vendor_id'  => auth()->user()->vendor->id,
                        'product_id' => $product->id,
                        'related_product_id' => $item,
                    ]);
                }

            }
            DB::commit();
            $product=Product::where('id',$productId)->first();

        return response()->json(array('success' => true, 'message' => 'Product Updated Successfully','product'=>$product),200);
        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(array(
                'success' => false,
                'error' => $e->getMessage(),
                'line'=>$e->getLine(),),
                500);
        }
    }



    public function searchByProductName(Request $request){
          
        if(!empty($request->search_input) && $request->type="wholesaler"){
            $products=Product::with('images','businessProfile','productReview')->where('name', 'like', '%'.$request->search_input.'%')->paginate(10);
                if($products->total()>0){
                    return response()->json(['products' => $products, 'message' => 'Products found','code'=>false], 200);
                }
                else{
                    return response()->json(['products' => $products, 'message' => 'Products not found','code'=>False], 200);
                }
        }
        elseif(!empty($request->search_input) && $request->type="manufacture"){
            $products=ManufactureProduct::with('product_images','businessProfile')->where('name', 'like', '%'.$request->search_input.'%')->paginate(10);
            if($products->total()>0){
                return response()->json(['products' => $products, 'message' => 'Products found','code'=>false], 200);
            }
            else{
                return response()->json(['products' => $products, 'message' => 'Products not found','code'=>False], 200);
            }
        }
        else{
            return response()->json(['products' => [], 'message' => 'Search key is empty','code'=>False], 200);
        }

    }





   public function filterSearch(Request $request)
   {

      if($request->search_category_id){
          $home_page_cat_id= explode(",", $request->search_category_id);
          $products=Product::whereIn('product_category_id',$home_page_cat_id)->where('state',1)->where('sold',0)->get();
        }
      else{
          if($request->product_type_category_id){
            $product_type_cat_id= explode(",", $request->product_type_category_id);
            $products=Product::where('product_type', $request->product_type)->whereIn('product_category_id',$product_type_cat_id)->where('state',1)->where('sold',0)->get();
          }
          else{
            $products=Product::where('product_type',$request->product_type)->where('state',1)->where('sold',0)->get();
          }
      }

      $search_id=[];

      foreach($products as $product)
        {
          if(isset($product->colors_sizes))
            {
              foreach(json_decode($product->colors_sizes) as $color_attr)
                {
                    if(isset($request->color))
                    {
                        if(in_array($color_attr->color, $request->color)){
                            array_push($search_id, $product->id);
                        }
                    }
                    if (isset($request->size))
                    {
                        foreach($color_attr as $key=>$attr)
                        {
                            if(in_array($key, $request->size) && !empty($attr))
                            {
                               array_push($search_id,$product->id);
                            }
                        }
                    }

                }
            }

          if(isset($request->rating))
          {
             foreach($product->productReview as $review)
             {
                 if(in_array($review->average_rating, $request->rating))
                 {
                     array_push($search_id,$product->id);
                 }
             }
          }

          if(!empty($request->minimum_value) && !empty($request->maximum_value))
          {
            foreach(json_decode($product->attribute) as $price)
            {
              if (  $price[2] >= $request->minimum_value && $price[2] <= $request->maximum_value){
                  array_push($search_id,$product->id);
              }
            }
          }


        }

        $productList=Product::whereIn('id',array_unique($search_id))->paginate(9);
        $data=view('product._products_list',['products' => $productList])->with('products', $productList)->render();
        return response()->json([
               'success' => true,
               'data'    => $data,
        ],200);

    }

    public function recommandedProducts($id){

        $product=Product::where('id',$id)->first();
        $recommandProducts=Product::where('state',1)
        ->where('id','!=',$product->id)
        ->whereHas('category', function($q) use ($product){
             $q->where('id',$product->product_category_id);

        })
        ->orWhere(function($query) use ($product){
            $query->where('product_type',$product->product_type)
                  ->where('id', '!=', $product->id);
        })
        ->with(['images','vendor'])
        ->get();


        if(count($recommandProducts)>0){
            return response()->json([
                'success' => true,
                'recommandProducts' => $recommandProducts,
         ],200);

        }
        else{
            return response()->json([
                'success' => false,
                'recommandProducts' => $recommandProducts,
         ],200);

        }
    }


    public function relatedProducts()
    {
        $relatedProducts=Product::where('vendor_id',auth()->user()->vendor->id)->get();
        if(count($relatedProducts)>0){
            return response()->json([
                'success' => true,
                'relatedProducts' => $relatedProducts,
         ],200);

        }
        else{
            return response()->json([
                'success' => false,
                'relatedProducts' => $relatedProducts,
         ],200);

        }
    }


    // public function destroy($storeId,$productId)
    // {

    //     try {
    //         $product=Product::with('images')->where('id',$productId)->first();
    //         $productImages=ProductImage::where('product_id',$productId)->get();

    //         $relatedProduct=RelatedProduct::where('product_id',$product->id)->get();
    //         if($relatedProduct){
    //             foreach($relatedProduct as $product)
    //                 {
    //                     $product->delete();
    //                 }
    //         }
    //         $result=$product->delete();
    //         if($result)
    //         {
    //             if(isset($productImages))
    //             {
    //                 foreach($productImages as $productImage)
    //                 {
    //                     if(Storage::exists('public/'.$productImage->image) && Storage::exists('public/'.$productImage->original) )
    //                     {
    //                         Storage::delete('public/'.$productImage->image);
    //                         Storage::delete('public/'.$productImage->original);

    //                     }
    //                     $productImage->delete();
    //                 }
    //             }

    //             return response()->json(array('success' => true, 'msg' => 'Product Deteted Successfully'),200);
    //         }
    //     }catch (\Exception $e) {
    //         return response()->json(array(
    //             'success' => false,
    //             'error' => $e->getMessage(),),
    //             500);
    //     }
    // }


}

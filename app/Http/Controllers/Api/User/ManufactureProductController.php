<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manufacture\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Manufacture\ProductImage;
use Illuminate\Support\Facades\Validator;
use DB;

class ManufactureProductController extends Controller
{
    public function index($businessProfileID){
        $products=Product::with('product_images')->where('business_profile_id',$businessProfileID)->latest()->paginate(20);
        if($products->total()>0){
            return response()->json([
                'success' => true,
                'message' => 'Product Uploaded Successfully',
                'products' => $products,
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'products' => $products,
            ],200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'business_profile_id' => 'required',
            'title'=>'required',
            'moq'=>'required|numeric',
            'product_details'=>'required',
            'product_specification'=>'required',
            'lead_time'=>'required',
            'industry' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(array(
            'success' => false,
            'error' => $validator->getMessageBag()),
            400);
        }

        DB::beginTransaction();

        try{

            $Data=[
                'business_profile_id' => $request->business_profile_id,
                'product_category' => $request->category_id,
                'title'=> $request->title,
                'moq'=> $request->moq,
                'product_details'=>$request->product_details,
                'product_specification'=>$request->product_specification,
                'lead_time'=>$request->lead_time,
                'colors'=>$request->colors ?? [],
                'sizes'=>$request->sizes ?? [],
                'industry' => $request->industry== 'apparel' ? 'apparel' : 'non-apparel',
                'price_per_unit' => $request->price_per_unit,
                'price_unit'   => $request->price_unit,
                'qty_unit'    =>$request->qty_unit,
                'created_by' => auth()->id(),

            ];
            $product=Product::create($Data);

            if($request->hasFile('product_images')){
                foreach ($request->file('product_images') as $index=>$product_image){
                    $path=$product_image->store('images','public');

                    $large_image = Image::make(Storage::get($path))->fit(1600, 1061)->encode();
                    $image = Image::make(Storage::get($path))->fit(370, 370)->encode();
                    $medium_image = Image::make(Storage::get($path))->fit(350, 231)->encode();
                    $small_image = Image::make(Storage::get($path))->fit(66, 43)->encode();

                    Storage::put($path, $image);
                    Storage::put('large/'.$path, $large_image);
                    Storage::put('medium/'.$path, $medium_image);
                    Storage::put('small/'.$path, $small_image);

                    ProductImage::create(['product_id'=>$product->id, 'product_image'=>$path]);
                }
            }
            DB::commit();
            $products=Product::where('business_profile_id',$product->business_profile_id)->latest()->with(['product_images','category'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Product Uploaded Successfully',
                'products' => $products,
            ],200);


        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'success' => false,
                'error'   => ['message' => $e->getMessage().$e->getLine()],
            ],500);

        }
    }


    public function update(Request $request,$productId)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title'=>'required',
            'moq'=>'required|numeric',
            'product_details'=>'required',
            'product_specification'=>'required',
            'lead_time'=>'required',
           
        ]);

        if ($validator->fails()){
            return response()->json(array(
            'success' => false,
            'error' => $validator->getMessageBag()),
            400);
        }

        DB::beginTransaction();

        try{
            $product = Product::find($productId);
            $product->created_by=auth()->id();
            $product->title=$request->title;
            $product->price_per_unit=$request->price_per_unit;
            $product->price_unit=$request->price_unit;
            $product->moq=$request->moq;
            $product->qty_unit=$request->qty_unit;
            $product->product_category=$request->category_id;
            $product->product_details=$request->product_details;
            $product->product_specification=$request->product_specification;
            $product->colors=$request->colors ?? [];
            $product->sizes=$request->sizes ?? [];
            $product->lead_time=$request->lead_time;
            $product->save();

            $productImages=ProductImage::whereIn('id',$request->product_images_id)->get();
            if(isset($productImages)){
                foreach($productImages as $productImage){
                    if(Storage::exists('public/'.$productImage->product_image)){
                        Storage::delete('public/'.$productImage->product_image);
                    }
                    $productImage->delete();
                }
            }

            if ($request->hasFile('product_images')){
                if(Storage::exists('upload/test.png')){
                    Storage::delete('upload/test.png');
                }
                foreach ($request->file('product_images') as $index=>$product_image){
                    $path=$product_image->store('images','public');

                    $large_image = Image::make(Storage::get($path))->fit(1600, 1061)->encode();
                    $image = Image::make(Storage::get($path))->fit(370, 370)->encode();
                    $medium_image = Image::make(Storage::get($path))->fit(350, 231)->encode();
                    $small_image = Image::make(Storage::get($path))->fit(66, 43)->encode();

                    Storage::put($path, $image);
                    Storage::put('large/'.$path, $large_image);
                    Storage::put('medium/'.$path, $medium_image);
                    Storage::put('small/'.$path, $small_image);

                    ProductImage::create(['product_id'=>$product->id, 'product_image'=>$path]);
                }
            }
            $product=Product::with(['product_images','category'])->where('id',$productId)->first();
            return response()->json([
                'success' => true,
                'message' => 'Product Updated Successfully',
                'product' => $product,
            ],200);

        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'success' => false,
                'error'   => ['message' => $e->getMessage().$e->getLine()],
            ],500);
        }
    }
    public function show($productId){
       
        $product=Product::with('product_images')->where('id',$productId)->first();
        if($product){
            return response()->json([
                'success' => true,
                'product' => $product,
                ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
                ],404);
        }
       
    } 

    public function delete($businessProfileId,$productId)
    {

        try{
            $product=Product::where('id',$productId)->first();
            $result=$product->delete();
            $products=Product::whereNotIn('id',[$productId])->where('business_profile_id',$businessProfileId)->latest()->with(['product_images','category'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Product deleted Successfully',
                'products' => $products,
                ],200);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'success' => false,
                'error'   => ['message' => $e->getMessage().$e->getLine()],
            ],500);

        }
            

    }
}

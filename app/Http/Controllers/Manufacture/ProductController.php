<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manufacture\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Manufacture\ProductImage;
use Illuminate\Support\Facades\Validator;
use DB;

class ProductController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'business_profile_id' => 'required',
            'title'=>'required',
            //'price_per_unit'=>'required|numeric',
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
                'colors'=>$request->colors?? [],
                'sizes'=>$request->sizes?? [],
                'industry' => $request->industry== 'apparel' ? 'apparel' : 'non-apparel',
                'price_per_unit' => $request->price_per_unit,
                'price_unit'   => $request->price_unit,
                'qty_unit'    =>$request->qty_unit,
                'created_by' => auth()->id(),

            ];
            $product=Product::create($Data);

            if ($request->hasFile('product_images')){
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
            $data=view('business_profile._product_table_data', compact('products'))->render();
            return response()->json([
                'success' => true,
                'msg' => 'Profile Created Successfully',
                'data' => $data,
            ],200);


        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'success' => false,
                //'error'   => ['msg' => 'Something Went Worng'],
                'error'   => ['msg' => $e->getMessage().$e->getLine()],
            ],500);

         }
    }


//get business type by industy type
public function edit($product_id)
{
    $product=Product::where('id', $product_id)->with('product_images')->first();
    if(!$product){
        return response()->json([
            'success' => false,
            'error'   => 'Product Not Found',
        ],401);
    }
    $colors=['Red','Blue','Green','Black','Brown','Pink','Yellow','Orange','Lightblue','Multicolor'];
    $sizes=['S','M','L','XL','XXL','XXXL'];
    $data=view('business_profile._edit_modal_data',compact('product','colors','sizes'))->render();
    return response()->json([
        'success' => true,
        'data'    => $data,
    ],200);
}

public function update(Request $request, $product_id)
{
    $validator = Validator::make($request->all(), [
        'category_id' => 'required',
        'title'=>'required',
        //'price_per_unit'=>'required|numeric',
        'moq'=>'required|numeric',
        'product_details'=>'required',
        'product_specification'=>'required',
        'lead_time'=>'required',
        
    ]);

    if ($validator->fails())
    {
        return response()->json(array(
        'success' => false,
        'error' => $validator->getMessageBag()),
        400);
    }

        $product=Product::find($product_id);
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

        if ($request->hasFile('product_images')){
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
        $products=Product::where('business_profile_id',$product->business_profile_id)->latest()->with(['product_images','category'])->get();
        $data=view('business_profile._product_table_data', compact('products'))->render();
        return response()->json([
            'success' => true,
            'msg' => 'Profile Updated Successfully',
            'data' => $data,
        ],200);

}

public function delete($product_id, $business_profile_id)
{

    $product=Product::where('id',$product_id)->first();
    $product->delete();
    $products=Product::whereNotIn('id',[$product_id])->where('business_profile_id',$business_profile_id)->latest()->with(['product_images','category'])->get();
    $data=view('business_profile._product_table_data', compact('products'))->render();

        return response()->json([
            'success' => true,
            'msg' => 'Profile Deleted Successfully',
            'data' => $data,
        ],200);

}




}

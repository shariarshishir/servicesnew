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
use App\Models\BusinessProfile;
use App\Models\Manufacture\ProductVideo;

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
            'video' => 'mimes:mp4,3gp,mkv,mov|max:150000',
            'price_unit' => 'required',
            'qty_unit'   => 'required',
            // 'colors'  => 'required',
            // 'sizes'  => 'required',
            'product_images' =>'required',
            'product_images.*' =>'image|mimes:jpeg,png,jpg,gif,svg,JPEG,PNG,JPG,GIF,SVG|max:25600',
            'overlay_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,JPEG,PNG,JPG,GIF,SVG|max:25600',
            'price_per_unit'=> 'required',
            'gender' => 'required',
            'sample_availability' => 'required',
            'product_type_mapping' => 'required',
            'studio_id'         => 'required_if:product_type_mapping,1',
            'raw_materials_id'  => 'required_if:product_type_mapping,2',
        ],[
            'price_per_unit.required' => 'The price range field is required.',
            'category_id.required' => 'The product category field is required',
            'studio_id.required_if' => 'the studio type is required when studio selected',
            'raw_materials_id.required_if' => 'the raw materials type is required when raw materials selected',
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
            $path=null;
            if ($request->hasFile('overlay_image')){
                $path = $request->overlay_image->store('images','public');
                $small_image = Image::make(Storage::get($path))->fit(370, 370)->encode();
                Storage::put('overlay_large_image/'.$path, $path);
                Storage::put('overlay_small_image/'.$path, $small_image);
            }


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
                'gender'     => $request->gender,
                'sample_availability' =>$request->sample_availability,
                'overlay_image' => $path,
                'product_type_mapping_id' => $request->product_type_mapping,
                'product_type_mapping_child_id' => $request->product_type_mapping == 1 ? $request->studio_id : $request->raw_materials_id,

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

            //upload video

            if($request->hasFile('video')){
                $business_profile=BusinessProfile::where('id', $request->business_profile_id)->first();
                $business_profile_name=$business_profile->business_name;
                $folder='video/'.$business_profile_name;
                $filename = $request->video->store($folder,'public');
                $product_video = ProductVideo::create([
                    'product_id' => $product->id,
                    'video' => $filename,
                ]);

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
    $product=Product::where('id', $product_id)->with('product_images','product_video')->first();
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
        'price_per_unit'=>'required',
        'price_unit' => 'required',
        'moq'=>'required|numeric',
        'qty_unit'   => 'required',
        'overlay_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,JPEG,PNG,JPG,GIF,SVG|max:25600',
        // 'colors'  => 'required',
        // 'sizes'  => 'required',
        'product_details'=>'required',
        'product_specification'=>'required',
        'lead_time'=>'required',
        'video' => 'mimes:mp4,3gp,mkv,mov|max:150000',
        'gender' => 'required',
        'sample_availability' => 'required',
        'product_type_mapping' => 'required',
        'studio_id'         => 'required_if:product_type_mapping,1',
        'raw_materials_id'  => 'required_if:product_type_mapping,2',
    ],[
        'price_per_unit.required' => 'The price range field is required.',
        'category_id.required' => 'The product category field is required',
        'studio_id.required_if' => 'the studio type is required when studio selected',
        'raw_materials_id.required_if' => 'the raw materials type is required when raw materials selected',
    ]);

    if ($validator->fails())
    {
        return response()->json(array(
        'success' => false,
        'error' => $validator->getMessageBag()),
        400);
    }
        $product=Product::find($product_id);
        if ($request->hasFile('overlay_image')){
            if($product->overlay_image){

                if(Storage::exists($product->overlay_image)){
                    Storage::delete($product->overlay_image);
                }
            }
            $path = $request->overlay_image->store('images','public');
            $small_image = Image::make(Storage::get($path))->fit(370, 370)->encode();
            Storage::put('overlay_large_image/'.$path, $path);
            Storage::put('overlay_small_image/'.$path, $small_image);
        }


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
        $product->gender=$request->gender;
        $product->sample_availability=$request->sample_availability;
        $product->overlay_image = $path ?? $product->overlay_image;
        $product->product_type_mapping_id = $request->product_type_mapping;
        $product->product_type_mapping_child_id = $request->product_type_mapping == 1 ? $request->studio_id : $request->raw_materials_id;
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
        //video
        if(isset($request->remove_video_id)){
            if( count(json_decode($request->remove_video_id)) > 0 )
            {
             $productVideo=ProductVideo::where('id',json_decode($request->remove_video_id))->first();
             if($productVideo){

                      if(Storage::exists($productVideo->video)){
                          Storage::delete($productVideo->video);
                      }
                      $productVideo->delete();
              }
            }
         }

         if($request->hasFile('video')){
            $business_profile=BusinessProfile::where('id', $product->businessProfile->id)->first();
            $business_profile_name=$business_profile->business_name;
            $folder='video/'.$business_profile_name;
            $filename = $request->video->store($folder,'public');
            $product_video = ProductVideo::create([
                'product_id' => $product->id,
                'video' => $filename,
            ]);
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

public function publishUnpublish($pid, $bid)
    {
      $product=Product::withTrashed()->where('id',$pid)->first();
      if($product->deleted_at){
          $product->restore();
          $products=Product::withTrashed()->where('business_profile_id',$bid)->latest()->with(['product_images','category'])->get();
          $data=view('business_profile._product_table_data', compact('products'))->render();
          return response()->json(array('success' => true, 'msg' => 'Product Published Successfully','data' => $data),200);
        }
      else{
        $product->delete();
        $products=Product::withTrashed()->where('business_profile_id',$bid)->latest()->with(['product_images','category'])->get();
        $data=view('business_profile._product_table_data', compact('products'))->render();
        return response()->json(array('success' => true, 'msg' => 'Product Unpublished Successfully', 'data' => $data),200);
      }
    }




}

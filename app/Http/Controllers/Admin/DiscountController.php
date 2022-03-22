<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Discount;
use App\Models\Admin\ProductDiscount;
use App\Models\BusinessProfile;
use App\Models\Manufacture\Product as ManufactureProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $collection=Discount::latest()->paginate(10);
        return view('admin.discount.index', compact('collection'));
    }


    public function create()
    {
        return view('admin.discount.create');
    }

    public function store(Request $request)
    {
       $data=[
           'title' => $request->title,
           'start_date' => $request->start_date,
           'end_date'   => $request->end_date,
           'from_mb'    =>$request->from_mb,
           'from_seller' => $request->from_seller,
           'ttl_discount' => $request->ttl_discount,
       ];

       $discount= Discount::create($data);
       $business_profile=BusinessProfile::pluck('business_name', 'id')->toArray();
       return redirect()->route('admin.discount.add.products', $discount->id)->with(['business_profile' => $business_profile]);
      // return view('admin.discount.add_products', compact('discount', 'business_profile'));
    }

    public function addProducts(Request $request, $id)
    {
       $discount= Discount::findOrFail($id);
       $business_profile=BusinessProfile::pluck('business_name', 'id')->toArray();
       return view('admin.discount.add_products', compact('discount', 'business_profile'));
    }

    public function edit($id)
    {
        $discount=Discount::findOrFail($id);
        $business_profile=BusinessProfile::pluck('business_name', 'id')->toArray();
        if(isset($discount->business_profile_id)){
            $selected_business_profile=BusinessProfile::with(['wholesalerProducts.discount', 'manufactureProducts.discount'])->whereIn('id', $discount->business_profile_id)->get();
        }else{
            $selected_business_profile=[];
        }

        return view('admin.discount.edit', compact('discount', 'business_profile', 'selected_business_profile'));
    }

    public function getProductsFromBusiness($id)
    {
        $business_profile=BusinessProfile::findOrFail($id);

        if($business_profile->business_type == 1){
            $products=ManufactureProduct::with('discount.discount')->where('business_profile_id', $business_profile->id)->get();
            $type = 'mb';
        }
        if($business_profile->business_type == 2 || $business_profile->business_type == 3){
            $products=Product::with('discount.discount')->where(['state' =>  1, 'sold' => 0, 'business_profile_id' => $business_profile->id])->get();
            $type= 'shop';
        }


        return response()->json(['products' => $products, 'type' =>$type], 200);

    }
    public function storeProducts(Request $request)
    {

        $request->validate([
            'discount_id' => 'required',
            'business_id' => 'required',
            'business_id.*' => 'required',
            'products_id' => 'required',
            'products_id.*' => 'required',
        ]);

        foreach($request->products_id as $key => $items){
            $business_profile=BusinessProfile::where('id', $request->business_id[$key])->first();
            foreach($items as $item){
                ProductDiscount::create([
                    'discount_id' => $request->discount_id,
                    'product_id'  => $item,
                    'type'        => $business_profile->business_type == 1 ? 'mb' : 'shop',
                ]);
            }
        }

        $business_profile_id=[];

        foreach($request->business_id as $key => $id){
            foreach($id as $i){
               array_push($business_profile_id, $i);
            }
        }

        $discount=Discount::where('id', $request->discount_id)->first();
        $discount->update(['business_profile_id' => $business_profile_id]);


        return redirect()->route('admin.discount.index')->withSuccess('discount products added successfully');
    }


    public function update(Request $request, $id)
    {

        $discount=Discount::findOrFail($id);
        $data=[
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'from_mb'    =>$request->from_mb,
            'from_seller' => $request->from_seller,
            'ttl_discount' => $request->ttl_discount,
        ];

        $discount->update($data);

        ProductDiscount::where('discount_id',$id)->forceDelete();
        if(isset($request->products_id)){
            foreach($request->products_id as $key => $items){
                $business_profile=BusinessProfile::where('id', $request->business_id[$key])->first();
                foreach($items as $item){
                    ProductDiscount::create([
                        'discount_id' => $request->discount_id,
                        'product_id'  => $item,
                        'type'        => $business_profile->business_type == 1 ? 'mb' : 'shop',
                    ]);
                }
            }

            $business_profile_id=[];

            foreach($request->business_id as $key => $id){
                foreach($id as $i){
                   array_push($business_profile_id, $i);
                }
            }

            $discount=Discount::where('id', $request->discount_id)->first();
            $discount->update(['business_profile_id' => $business_profile_id]);
        }else{
            $discount=Discount::where('id', $request->discount_id)->first();
            $discount->update(['business_profile_id' => []]);
        }


        return redirect()->route('admin.discount.index')->withSuccess('discount updarted successfully');
    }


    public function destroy($id)
    {
        $discount=Discount::findOrFail($id);
        if($discount->product_discount()->exists()){
            ProductDiscount::where('discount_id', $discount->id)->delete();
        }
        $discount->delete();
        return redirect()->back()->withSuccess('Discount deleted successfully');
    }

}

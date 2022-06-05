<?php

namespace App\Http\Controllers\BusinessProfile;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use App\Models\Manufacture\Product;
use App\Models\Product as WholesalerProduct;
use Illuminate\Http\Request;

class BusinessProfileController extends Controller
{

    public function __construct()
    {

    }

    public function index($alias){
        $business_profile = BusinessProfile::with('user')->where('alias',$alias)->firstOrFail();
        if((auth()->id() == $business_profile->user_id) || (auth()->id() == $business_profile->representative_user_id))
        {
            return view('new_business_profile.index',compact('alias','business_profile'));
        }
        abort(401);
    }

    public function rfqs($alias){
        return view('new_business_profile.rfqs',compact('alias'));
    }

    public function myRfqs($alias){
        return view('new_business_profile.my_rfqs',compact('alias'));
    }



    public function developmentCenter($alias){
        $business_profile = BusinessProfile::with('user')->where('alias',$alias)->firstOrFail();
        return view('new_business_profile.development_center',compact('alias', 'business_profile'));
    }

    public function orderManagement($alias){
        $business_profile = BusinessProfile::with('user')->where('alias',$alias)->firstOrFail();
        return view('new_business_profile.order_management',compact('alias', 'business_profile'));
    }

    public function products($alias,Request $request){

        $business_profile=BusinessProfile::where('alias',$alias)->firstOrFail();
        if((auth()->id() == $business_profile->user_id) || (auth()->id() == $business_profile->representative_user_id))
        {
            if($business_profile->profile_type == 'supplier' && $business_profile->business_type == 'manufacturer'){
                $products=Product::withTrashed()
                ->latest()
                ->with('product_images','product_video')
                ->where('business_profile_id', $business_profile->id)
                ->where(function($query) use ($request){
                    if(isset($request->search)){
                        $query->where('title','like', '%'.$request->search.'%')->get();
                    }

                })
                ->paginate(8);
                $colors=['Red','Blue','Green','Black','Brown','Pink','Yellow','Orange','Lightblue','Multicolor'];
                $sizes=['S','M','L','XL','XXL','XXXL'];
                $view=isset($request->view)? $request->view : 'grid';
                return view('new_business_profile.manufacturer_products.index',compact('alias','products','business_profile','colors','sizes','view'));
            }

            if($business_profile->profile_type == 'supplier' && $business_profile->business_type == 'wholesaler'){
                $products=WholesalerProduct::withTrashed()
                ->latest()
                ->with('images','video')
                ->where(function($query) use ($request, $business_profile){
                    $query->where('business_profile_id', $business_profile->id)->get();
                    if(isset($request->search)){
                        $query->where('name','like', '%'.$request->search.'%')->get();
                    }

                })
                ->paginate(8);
                $view=isset($request->view)? $request->view : 'grid';
                return view('new_business_profile.wholesaler_products.index',compact('alias','products','business_profile','view'));
            }

        }
        abort(401);

    }

    public function profileInsights($alias){
        return view('new_business_profile.profile_insights',compact('alias'));
    }

    public function profileHome($alias){
        return view('new_business_profile.profile_home',compact('alias'));
    }


}

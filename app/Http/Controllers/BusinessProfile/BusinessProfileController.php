<?php

namespace App\Http\Controllers\BusinessProfile;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use App\Models\Manufacture\Product;
use Illuminate\Http\Request;

class BusinessProfileController extends Controller
{

    public function __construct()
    {

    }

    public function index($alias){
        $business_profile=BusinessProfile::with('user')->where('alias',$alias)->firstOrFail();
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

    public function profomaPendingOrders($alias){
        return view('new_business_profile.proforma_orders',compact('alias'));

    }
    public function profomaOngoingOrders($alias){
        return view('new_business_profile.proforma_orders',compact('alias'));
    }

    public function profomaShippedOrders($alias){
        return view('new_business_profile.proforma_orders',compact('alias'));
    }

    public function developmentCenter($alias){
        return view('new_business_profile.development_center',compact('alias'));
    }

    public function orderManagement($alias){
        return view('new_business_profile.order_management',compact('alias'));
    }

    public function products($alias){

        $business_profile=BusinessProfile::where('alias',$alias)->firstOrFail();
        if((auth()->id() == $business_profile->user_id) || (auth()->id() == $business_profile->representative_user_id))
        {
            if($business_profile->profile_type == 'supplier' || $business_profile->business_type == 'manufacturer'){
                $products=Product::withTrashed()->with('product_images')->latest()->where('business_profile_id', $business_profile->id)->get();
                $colors=['Red','Blue','Green','Black','Brown','Pink','Yellow','Orange','Lightblue','Multicolor'];
                $sizes=['S','M','L','XL','XXL','XXXL'];
                return view('new_business_profile.manufacturer_products.index',compact('alias','products','business_profile','colors','sizes'));
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

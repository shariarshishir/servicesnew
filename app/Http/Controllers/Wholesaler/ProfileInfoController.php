<?php

namespace App\Http\Controllers\Wholesaler;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;

class ProfileInfoController extends Controller
{
    public function index($business_profile_id)
    {
        $business_profile=BusinessProfile::withTrashed()->where('id', $business_profile_id)->first();
        if((auth()->id() == $business_profile->user_id) || (auth()->id() == $business_profile->representative_user_id))
        {
            return view('wholesaler_profile.profile_info.index', compact('business_profile'));
        }
        abort(401);
    }
    public function show($id)
    {
        $business_profile= BusinessProfile::withTrashed()->with('companyOverview','machineriesDetails','categoriesProduceds','productionCapacities','productionFlowAndManpowers','certifications','mainbuyers','exportDestinations','associationMemberships','pressHighlights','businessTerms','samplings','specialCustomizations','sustainabilityCommitments','walfare','security')->findOrFail($id);
        if((auth()->id() == $business_profile->user_id) || (auth()->id() == $business_profile->representative_user_id))
        {
            $colors=['Red','Blue','Green','Black','Brown','Pink','Yellow','Orange','Lightblue'];
            $sizes=['S','M','XL','XXL','XXXL'];
            $products=Product::withTrashed()->latest()->where('business_profile_id', $business_profile->id)->get();
            if($business_profile->business_type == 1){
                return view('wholesaler_profile.index',compact('business_profile', 'colors', 'sizes','products'));
            }
            if($business_profile->business_type == 2){
               return view('wholesaler_profile.index',compact('business_profile'));
            }


        }
        abort(401);

    }
}

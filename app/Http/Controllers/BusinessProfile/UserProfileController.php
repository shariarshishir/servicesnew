<?php

namespace App\Http\Controllers\BusinessProfile;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use App\Models\CompanyFactoryTour;
use App\Models\Admin\Certification;
use App\Models\Country;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function profileInsights($alias)
    {
        return view('new_business_profile.profile_insights',compact('alias'));
    }

    public function profileHome($alias)
    {
        $business_profile = BusinessProfile::withTrashed()->with('companyOverview','machineriesDetails','categoriesProduceds','productionCapacities','productionFlowAndManpowers','certifications','mainbuyers','exportDestinations','associationMemberships','pressHighlights','businessTerms','samplings','specialCustomizations','sustainabilityCommitments','walfare','security')->where('alias',$alias)->firstOrFail();
        $companyFactoryTour = CompanyFactoryTour::with('companyFactoryTourImages','companyFactoryTourLargeImages')->where('business_profile_id',$business_profile->id)->first();
        $default_certification = Certification::get();
        $country = Country::pluck('name','id');

        if((auth()->id() == $business_profile->user_id) || (auth()->id() == $business_profile->representative_user_id))
        {
            return view('new_business_profile.profile_home', compact('business_profile', 'companyFactoryTour', 'alias', 'default_certification', 'country'));
        }
        abort(401);
    }

    public function profileEdit($alias)
    {
        $business_profile = BusinessProfile::withTrashed()->with('companyOverview','machineriesDetails','categoriesProduceds','productionCapacities','productionFlowAndManpowers','certifications','mainbuyers','exportDestinations','associationMemberships','pressHighlights','businessTerms','samplings','specialCustomizations','sustainabilityCommitments','walfare','security')->where('alias',$alias)->firstOrFail();
        $companyFactoryTour = CompanyFactoryTour::with('companyFactoryTourImages','companyFactoryTourLargeImages')->where('business_profile_id',$business_profile->id)->first();
        $default_certification = Certification::get();
        $country = Country::pluck('name','id');

        if((auth()->id() == $business_profile->user_id) || (auth()->id() == $business_profile->representative_user_id))
        {
            return view('new_business_profile.profile_edit', compact('business_profile', 'companyFactoryTour', 'alias', 'default_certification', 'country'));
        }
        abort(401);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessProfile;

class ManageBusinessProfileController extends Controller
{
    public function delete($id)
    {
        $business_profile=BusinessProfile::findOrFail($id);
        $business_profile->delete();
        return redirect()->back()->with('success', 'Business profile deactivated successfull.');
    }

    public function restore($id)
    {
        $business_profile=BusinessProfile::onlyTrashed()
        ->where('id', $id)
        ->first();

        $business_profile->restore();
        return redirect()->back()->with('success', 'Business profile restored successfull.');
    }

}

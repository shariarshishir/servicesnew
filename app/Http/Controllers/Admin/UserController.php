<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        $users= User::where('is_representative', false)->latest()->get();
        return view('admin.users.index',compact('users'));
    }

    public function show($id)
    {
        $user=User::where('id', $id)->with('businessProfile')->first();
        if(!$user)
        {
            abort(404);
        }
        return view('admin.users.show',compact('user'));
    }

    public function businessProfileDetails($profile_id)
    {
        $business_profile=BusinessProfile::where('id', $profile_id)->with('companyOverview')->first();
        if(!$business_profile)
        {
            abort(404);
        }
        return view('admin.users.business_profile_details', compact('business_profile'));
    }


}

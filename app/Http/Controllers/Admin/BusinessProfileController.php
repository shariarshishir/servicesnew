<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyOverview;
use Illuminate\Http\Request;

class BusinessProfileController extends Controller
{
    public function companyOverviewVarifie(Request $request,$company_overview_id)
    {
        $company_overview=CompanyOverview::findOrFail($company_overview_id);
        $data=[];
        foreach($request->name as $key => $value)
        {
            array_push($data,['name' => $key, 'value' => $value, 'status' => $request->status[$key]]);
        }
        $company_overview->update(['data' => $data]);
        return redirect()->back()->with('success', 'company overview updated');
    }
}

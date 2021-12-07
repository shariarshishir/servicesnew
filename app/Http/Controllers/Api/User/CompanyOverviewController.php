<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\CompanyOverview;
use Illuminate\Http\Request;

class CompanyOverviewController extends Controller
{
    public function companyOverviewUpdate(Request $request)
    {
        try{
            $company_overview= CompanyOverview::findOrFail($request->company_overview_id);
            $data=[];
            $count=0;
            foreach($request->name as $key => $value){
                foreach(json_decode($company_overview->data) as $data2){
                    if($data2->name == $key && $value != $data2->value){
                        array_push($data,['name' => $key, 'value' => $value, 'status' => 0]);
                    }
                    if($data2->name == $key && $value == $data2->value){
                        array_push($data,['name' => $key, 'value' => $value, 'status' =>  $data2->status]);
                    }
                }

                $count++;
            }

            $company_overview->update(['data' => json_encode($data),'about_company'=>$request->about_company]);
            
            return response()->json([
                'success' =>true,
                'message'     => 'Company Overview Updated',
                'data'    => json_decode($company_overview->data),
                'about_company'=>$company_overview->about_company

            ],200);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                //'error'   => ['msg' => 'Something Went Worng'],
                'error'   => ['msg' => $e->getMessage()],
            ],500);

        }

    }
}

<?php

namespace App\Imports;

use App\Models\BusinessProfile;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\CompanyOverview;

class ImportUser implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $user_id = IdGenerator::generate(['table' => 'users', 'field' => 'user_id','reset_on_prefix_change' =>true,'length' => 18, 'prefix' => date('ymd').time()]);
            //create user
            $user= User::create([
                'user_id' => $user_id,
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => $row['password'],
                'phone'   => $row['phone'],
                'user_type' => 'buyer',
                'company_name' => $row['company_name'],
                'is_email_verified' => 1,
            ]);
            //create business profile
            $business_profile=BusinessProfile::create([
                'user_id' => $user->id,
                'business_name' => $row['business_name'],
                'location'   => $row['location'],
                'business_type' => 1,
                'has_representative' => 1,
                'industry_type' => $row['industry_type'],
                'business_category_id' => $row['business_category_id'],
            ]);
            //create company overview
            $name=['annual_revenue','number_of_worker','number_of_female_worker','trade_license_number','year_of_establishment','opertaing_hours','shift_details','main_products'];
            $value=[null,null,null,$row['trade_license'],$row['year_of_establishment'],null,null,$row['main_products']];
            $data=[];
            foreach($name as $key => $value2){
                array_push($data,['name' => $value2, 'value' => $value[$key], 'status' => 0]);
            }
            CompanyOverview::create([
                'business_profile_id' => $business_profile->id,
                'data'        => json_encode($data),
            ]);


        }
    }


}

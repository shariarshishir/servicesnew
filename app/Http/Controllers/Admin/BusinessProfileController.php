<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyOverview;
use Illuminate\Http\Request;
use App\Models\CategoriesProduced;
use App\Models\MachineriesDetail;
use App\Models\ProductionCapacity;
use App\Models\BusinessTerm;
use App\Models\Sampling;
use App\Models\SpecialCustomization;
use App\Models\SustainabilityCommitment;
use App\Models\ProductionFlowAndManpower;
use App\Models\Walfare;
use App\Models\Security;
use stdClass;
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
    public function capacityAndMachineriesInformationVerify(Request $request)
    {
        
        $machineriesDetails = MachineriesDetail::where('business_profile_id',$request->business_profile_id)->delete();
        $categoriesProduceds = CategoriesProduced::where('business_profile_id',$request->business_profile_id)->delete();
        $productionCapacities = ProductionCapacity::where('business_profile_id',$request->business_profile_id)->delete();
        if(isset($request->machine_type)){
            $noOfMachineType=count($request->machine_type);
            if($noOfMachineType>0){
                for($i=0;$i<$noOfMachineType ;$i++){
                    $productionCapacity  =  new ProductionCapacity();
                    $productionCapacity->machine_type = $request->machine_type[$i];
                    $productionCapacity->annual_capacity = $request->annual_capacity[$i];
                    $productionCapacity->business_profile_id = $request->business_profile_id;
                    $productionCapacity->status = $request->production_capacity_status[$i];
                    $productionCapacity->save();
                }
            }
        }


        if(isset($request->type)){
            $noOftype=count($request->type);
            if($noOftype>0){
                for($i=0;$i<$noOftype; $i++){
                    $categoriesProduced  =  new CategoriesProduced();
                    $categoriesProduced->type = $request->type[$i];
                    $categoriesProduced->percentage = $request->percentage[$i];
                    $categoriesProduced->business_profile_id = $request->business_profile_id;
                    $categoriesProduced->status = $request->categories_produced_status[$i];
                    $categoriesProduced->save();
                }
            }

        }

        if(isset($request->machine_name)){
            $noOfMachineName=count($request->machine_name);
            if($noOfMachineName>0){
                for($i=0; $i<$noOfMachineName ;$i++){

                    $machineriesDetail   =  new MachineriesDetail();
                    $machineriesDetail->machine_name = $request->machine_name[$i];
                    $machineriesDetail->quantity = $request->quantity[$i];
                    $machineriesDetail->business_profile_id = $request->business_profile_id;
                    $machineriesDetail->status = $request->machineries_detail_status[$i];
                    $machineriesDetail->save();
                }

            }
        }

        $machineriesDetails = MachineriesDetail::where('business_profile_id',$request->business_profile_id)->get();
        $categoriesProduceds = CategoriesProduced::where('business_profile_id',$request->business_profile_id)->get();
        $productionCapacities = ProductionCapacity::where('business_profile_id',$request->business_profile_id)->get();
        return redirect()->back()->with('success', 'capacity and machineries information  updated');
    }


    public function businessTermsInformationVerify(Request $request)
    {
        
        $result = BusinessTerm::where('business_profile_id',$request->business_profile_id)->delete();
        if(isset($request->business_term_title)){
            $noOfBusinessTermTitle=count($request->business_term_title);
            if($noOfBusinessTermTitle>0){
                for($i=0;$i<$noOfBusinessTermTitle ;$i++){
                    $businessTerm  =  new BusinessTerm();
                    $businessTerm->title = $request->business_term_title[$i];
                    $businessTerm->quantity = $request->business_term_quantity[$i];
                    $businessTerm->business_profile_id = $request->business_profile_id;
                    $businessTerm->status = $request->business_term_status[$i];
                    $businessTerm->save();
                }
            }
        }

        $businessTerms = BusinessTerm::where('business_profile_id',$request->business_profile_id)->get();
        return redirect()->back()->with('success', 'BusinessTerm information  updated');
    }

    public function samplingsInformationVerify(Request $request)
    {
        
        $result = Sampling::where('business_profile_id',$request->business_profile_id)->delete();
        if(isset($request->sampling_title)){
            $noOfSamplingTitle=count($request->sampling_title);
            if($noOfSamplingTitle>0){
                for($i=0;$i<$noOfSamplingTitle ;$i++){
                    $sampling  =  new Sampling();
                    $sampling->title = $request->sampling_title[$i];
                    $sampling->quantity = $request->sampling_quantity[$i];
                    $sampling->business_profile_id = $request->business_profile_id;
                    $sampling->status = $request->sampling_status[$i];
                    $sampling->save();
                }
            }
        }

        $samplings = Sampling::where('business_profile_id',$request->business_profile_id)->get();
        return redirect()->back()->with('success', 'Sampling information  updated');
    }


    public function specialCustomizationInformationVerify(Request $request)
    {
        
        $result = SpecialCustomization::where('business_profile_id',$request->business_profile_id)->delete();
        if(isset($request->special_customization_title)){
            $noOfSpecialCustomizationTitle=count($request->special_customization_title);
            if($noOfSpecialCustomizationTitle>0){
                for($i=0;$i<$noOfSpecialCustomizationTitle ;$i++){
                    $specialCustomization  =  new SpecialCustomization();
                    $specialCustomization->title = $request->special_customization_title[$i];
                    $specialCustomization->business_profile_id = $request->business_profile_id;
                    $specialCustomization->status =$request->special_customization_status[$i];
                    $specialCustomization->save();
                }
            }
        }
        $specialCustomizations = SpecialCustomization::where('business_profile_id',$request->business_profile_id)->get();

        return redirect()->back()->with('success', 'Special Customization information  updated');
    }

    public function sustainabilityCommitmentsInformationVerify(Request $request)
    {

        $result = SustainabilityCommitment::where('business_profile_id',$request->business_profile_id)->delete();
        if(isset($request->sustainability_commitment_title)){
            $noOfSustainabilityCommitmentTitle=count($request->sustainability_commitment_title);
            if($noOfSustainabilityCommitmentTitle>0){
                for($i=0;$i<$noOfSustainabilityCommitmentTitle ;$i++){
                    $sustainabilityCommitment  =  new SustainabilityCommitment();
                    $sustainabilityCommitment->title = $request->sustainability_commitment_title[$i];
                    $sustainabilityCommitment->business_profile_id = $request->business_profile_id;
                    $sustainabilityCommitment->status = $request->sustainability_commitment_status[$i];
                    $sustainabilityCommitment->save();
                }
            }
        }

        $sustainabilityCommitments = SustainabilityCommitment::where('business_profile_id',$request->business_profile_id)->get();
        return redirect()->back()->with('success', 'Special Customization information  updated');
    }


    public function productionflowAndManpowerInformationVerify(Request $request){
        
        $productionFlowAndManpowers = ProductionFlowAndManpower::where('business_profile_id',$request->business_profile_id)->delete();
        if(isset($request->production_type)){
            if(count($request->production_type)>0){
               
                for($i=0; $i < count($request->production_type); $i++){


                    //jacquardMachines object
                    $jacquardMachinesStatusArray=[];
                    foreach($request->no_of_jacquard_machines_status as $key=>$status){
                            array_push($jacquardMachinesStatusArray,$status);
                    }
                    $jacquardMachines = new stdClass();
                    $jacquardMachines->name='No of Jacquard Machines';
                    foreach($jacquardMachinesStatusArray as $key=>$status){
                        if($key==$i){
                            $jacquardMachines->status=$status;
                        }
                    }
                    $jacquardMachines->value=$request->no_of_jacquard_machines[$i];
           
            

                    //manpower object
                    $manpowerStatusArray=[];
                    foreach($request->manpower_status as $key=>$status){
                            array_push($manpowerStatusArray,$status);
                    }
                    $manpower = new stdClass();
                    $manpower->name='Manpower';
                    $manpower->value=$request->manpower[$i];
                    foreach($manpowerStatusArray as $key=>$status){
                        if($key==$i){
                            $manpower->status=$status;
                        }
                    }
          
                    //daily Capacity object
                    $dailyCapacityStatusArray=[];
                    foreach($request->daily_capacity_status as $key=>$status){
                            array_push($dailyCapacityStatusArray,$status);
                    }
                    $dailyCapacity = new stdClass();
                    $dailyCapacity->name='Capacity Daily';
                    $dailyCapacity->value=$request->daily_capacity[$i];
                    foreach($dailyCapacityStatusArray as $key=>$status){
                        if($key==$i){
                            $dailyCapacity->status=$status;
                        }
                    }

                    //push all object into array
                    $flowAndManpowerArray=[];
                    array_push($flowAndManpowerArray,$jacquardMachines,$manpower,$dailyCapacity);
        
                    $productionFlowAndManpower=new ProductionFlowAndManpower;
                    $productionFlowAndManpower->production_type=$request->production_type[$i];
                    $productionFlowAndManpower->flow_and_manpower=json_encode($flowAndManpowerArray);
                    $productionFlowAndManpower->business_profile_id = $request->business_profile_id;
                    $productionFlowAndManpower->save();
                }



            }
        }
        
        $productionFlowAndManpowers = ProductionFlowAndManpower::where('business_profile_id',$request->business_profile_id)->get();
        return redirect()->back()->with('success', 'ProductionFlow And Manpower information  updated');
    }

    public function walfareInformationVerify(Request $request){
        $walfare = Walfare::where('business_profile_id',$request->business_profile_id)->delete();
            
            $walfareArray=[];
            $healthcareFacility = new stdClass();
            $healthcareFacility->name='healthcare_facility';
            $healthcareFacility->checked=$request->healthcare_facility;
            $healthcareFacility->status=$request->healthcare_facility_status;
            
            $dayCare = new stdClass();
            $dayCare->name='day_care';
            $dayCare->checked=$request->day_care;
            $dayCare->status=$request->day_care_status;

            $doctor = new stdClass();
            $doctor->name='doctor';
            $doctor->checked=$request->doctor_work;
            $doctor->status=$request->doctor_status;

            $maternityLeave = new stdClass();
            $maternityLeave->name='maternity_leave';
            $maternityLeave->checked=$request->maternity_leave;
            $maternityLeave->status=$request->maternity_leave_status;

            $playground = new stdClass();
            $playground->name='playground';
            $playground->checked=$request->playground;
            $playground->status=$request->playground_status;

            $socialWork = new stdClass();
            $socialWork->name='social_work';
            $socialWork->checked=$request->social_work;
            $socialWork->status=$request->social_work_status;

            array_push($walfareArray,$healthcareFacility,$dayCare,$doctor,$maternityLeave,$playground,$socialWork);
            
            $walfare = new Walfare();
            $walfare->walfare_and_csr=json_encode($walfareArray);
            $walfare->business_profile_id = $request->business_profile_id;
            $walfare->save();
            
            $walfare = Walfare::where('business_profile_id',$request->business_profile_id)->first();
            return redirect()->back()->with('success', 'Worker walfare information  updated');
    } 

    public function securityInformationVerify(Request $request){
            
        $security = Security::where('business_profile_id',$request->business_profile_id)->delete();
            
        $securityArray=[];
        $fireExit = new stdClass();
        $fireExit->name='fire_exit';
        $fireExit->checked=$request->fire_exit;
        $fireExit->status=$request->fire_exit_status;
        
        $fireHydrant = new stdClass();
        $fireHydrant->name='fire_hydrant';
        $fireHydrant->checked=$request->fire_hydrant;
        $fireHydrant->status=$request->fire_hydrant_status;

        $waterSource = new stdClass();
        $waterSource->name='water_source';
        $waterSource->checked=$request->water_source;
        $waterSource->status=$request->water_source_status;

        $protocols = new stdClass();
        $protocols->name='protocols';
        $protocols->checked=$request->protocols;
        $protocols->status=$request->water_source_status;

        array_push($securityArray,$fireExit,$fireHydrant,$waterSource,$protocols);
        
        $security = new Security();
        $security->security_and_others=json_encode($securityArray);
        $security->business_profile_id = $request->business_profile_id;
        $security->save();
                    
        $security = Security::where('business_profile_id',$request->business_profile_id)->first();
        return redirect()->back()->with('success', 'Worker walfare information  updated');
    } 
}

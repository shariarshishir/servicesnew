<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Certification;
use App\Models\Admin\Certification as CertificationType;

class CertificationController extends Controller
{

    public function certificationTypesList(){
        $certificationTypes = CertificationType::get();
        if(count($certificationTypes)){
            return response()->json([
                'success' => true,
                'certifications'=>$certificationTypes,
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'certifications'=>$certificationTypes,
            ],200);
        }


    }
    public function certificationDetailsUpload(Request $request ){
       
        $validator = Validator::make($request->all(), [
            'title.*' => 'string|min:1|max:50',
            'image.*' => 'mimes:jpeg,bmp,png,gif,svg,pdf',
            'short_description.*' => 'string|max:500',
        ]);
        if ($validator->fails())
        {
            return response()->json(array(
            'success' => false,
            'error' => $validator->getMessageBag()),
            400);
        }
        try{
        
            if(isset($request->title)){
                if(count($request->title)>0){
                    for($i=0; $i<count($request->title) ;$i++){
                        $certification=new Certification();
                        if ($request->hasFile('image'))
                        {
                            
                            $extension = $request->image[$i]->getClientOriginalExtension();
                            if($extension=='pdf' ||$extension=='PDF'){
                                $filename = $request->image[$i]->store('images/certificates','public');

                            }else{
                                $filename = $request->image[$i]->store('images/certificates','public');
                                $image_resize = Image::make(public_path('storage/'.$filename));
                                $image_resize->save(public_path('storage/'.$filename));
                            }
                            
                        }
                      
                        $certification->title=$request->title[$i];
                        $certification->image=$filename;
                        $certification->short_description=$request->short_description[$i];
                        $certification->business_profile_id = $request->business_profile_id;
                        $certification->created_by = Auth::user()->id;
                        $certification->updated_by = NULL;
                        $certification->save();
                        
                    }

                }
            }
            
            $certifications = Certification::where('business_profile_id',$request->business_profile_id)->get();
            if($certification){
                return response()->json([
                    'success' => true,
                    'message' => 'Certification Added',
                    'certifications'=>$certifications,
                ],200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update certification',
                ],200);
            }

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'error'   => ['error_line' => $e->getLine()],
            ],500);
        }  
    }
    public function deleteCertificate($id){
        $certification=Certification::where('id',$id)->first();
        $businessId=$certification->business_profile_id;
        $result=$certification->delete();
        if($result){
            $certifications = Certification::where('business_profile_id',$businessId)->get();
            return response()->json([
                'success' => true,
                'message' => 'Certification deleted successfully',
                'certifications'=>$certifications,
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => ' delete Certification',
            ],404);
        }

    }
}

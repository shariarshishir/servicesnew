<?php

namespace App\Http\Controllers;

use App\Models\Admin\Certification as AdminCertification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Certification;

class CertificationController extends Controller
{
    public function certificationDetailsUpload(Request $request ){

        $validator = Validator::make($request->all(), [
            // 'title.*' => 'string|min:1|max:255',
            'certification_id.*' => 'required',
            'image.*' => 'mimes:jpg,jpeg,bmp,png,gif,svg,pdf,PDF,JPG,JPEG,PNG,GIF,doc,docx,DOC,DOCX|max:5120',
            'short_description.*' => 'string|max:500|nullable',
            'issue_date.*' => 'required',
            'expiry_date.*' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json(array(
            'success' => false,
            'error' => $validator->getMessageBag()),
            400);
        }
        try{

            if(isset($request->certification_id)){
                if(count($request->certification_id)>0){
                    for($i=0; $i<count($request->certification_id) ;$i++){
                        $certification=new Certification();
                        if ($request->hasFile('image'))
                        {

                            $extension = $request->image[$i]->getClientOriginalExtension();
                            if($extension=='pdf' ||$extension=='PDF' || $extension=='doc'||$extension=='docx'||$extension=='DOC'||$extension=='DOCX'){
                                $filename = $request->image[$i]->store('images/certificates','public');

                            }else{
                                $filename = $request->image[$i]->store('images/certificates','public');
                                $image_resize = Image::make(public_path('storage/'.$filename));
                                $image_resize->save(public_path('storage/'.$filename));
                            }

                        }
                        $admin_certification=AdminCertification::where('id', $request->certification_id[$i])->first();
                        $certification->title=$admin_certification->certification_programs;
                        $certification->admin_certification_id=$request->certification_id[$i];
                        $certification->issue_date= $request->issue_date[$i];
                        $certification->expiry_date= $request->expiry_date[$i];
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
            return response()->json([
                'success' => true,
                'message' => 'Certification Added',
                'certifications'=>$certifications,
            ],200);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'error'   => ['error_line' => $e->getLine(), 'error' => $e->getMessage()],
            ],500);
        }
    }
    public function deleteCertificate(Request $request){
        $certification=Certification::where('id',$request->id)->first();
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
            ],500);
        }

    }
}

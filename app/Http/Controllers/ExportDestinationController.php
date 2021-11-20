<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\ExportDestination;

class ExportDestinationController extends Controller
{
    public function exportDestinationDetailsUpload(Request $request ){
     
        $validator = Validator::make($request->all(), [
            'title.*' => 'string|min:1|max:50',
            'image.*' => 'image',
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
                        $exportDestination=new ExportDestination();
                        if ($request->hasFile('image'))
                        {
                            $filename = $request->image[$i]->store('images/export-destinations','public');
                            $image_resize = Image::make(public_path('storage/'.$filename));
                            $image_resize->fit(250, 250);
                            $image_resize->save(public_path('storage/'.$filename));
                        }
                      
                        $exportDestination->title=$request->title[$i];
                        $exportDestination->image=$filename;
                        $exportDestination->short_description=$request->short_description[$i];
                        $exportDestination->business_profile_id = $request->business_profile_id;
                        $exportDestination->created_by = Auth::user()->id;
                        $exportDestination->updated_by = NULL;
                        $exportDestination->save();
                        
                    }

                }
            }
            
            $exportDestinations = ExportDestination::where('business_profile_id',$request->business_profile_id)->get();
            return response()->json([
                'success' => true,
                'message' => 'Export destination Added',
                'exportDestinations'=>$exportDestinations,
            ],200);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'error'   => ['error_line' => $e->getLine()],
            ],500);
        }  
    }
    public function deleteExportDestination(Request $request){
        $exportDestination=ExportDestination::where('id',$request->id)->first();
        $businessId=$exportDestination->business_profile_id;
        $result=$exportDestination->delete();
        if($result){
            $exportDestinations = ExportDestination::where('business_profile_id',$businessId)->get();
            return response()->json([
                'success' => true,
                'message' => 'Export destination deleted successfully',
                'exportDestinations'=>$exportDestinations,
            ],200);
        }else{
            return response()->json([
                'success' => false,
            ],500);
        }

    }
}

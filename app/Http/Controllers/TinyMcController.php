<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Storage;
use App\Models\BusinessProfile;

class TinyMcController extends Controller
{
     // tinymc file upload

     public function tinyMcFileUpload(Request $request)
     {
        if($request->hasFile('tiny_mc_file')){
            $business_profile=BusinessProfile::where('id', $request->business_profile_id)->first();
            $business_profile_name=$business_profile->business_name;
            $filename=$request->tiny_mc_file->store('temp/'.$business_profile_name.'/pdf','public');
            $basename=basename($filename);
            $finalPath=asset('storage/images/'.$business_profile_name.'/pdf'.'/'.$basename);
            $originalFileName=$request->file('tiny_mc_file')->getClientOriginalName();
            return response()->json(['fileName' => $finalPath, 'originalFileName' => $originalFileName], 200);

        }
     }

     //tinymc untracked file deleted
     public function tinyMcUntrackedFileDelete($business_profile_id)
     {
        $business_profile=BusinessProfile::where('id', $business_profile_id)->first();
        $business_profile_name=$business_profile->business_name;
        $pdfFolder= File::files(public_path('storage/temp').'/'.$business_profile_name.'/'.'pdf/');
         if($pdfFolder){
             foreach($pdfFolder as $file){
                 $path_info=pathinfo($file);
                 $file_path='temp/'.$business_profile_name.'/'.'pdf/'.$path_info['basename'];
                 Storage::delete($file_path);
             }
             return response()->json(['msg' => 'success'], 200);
         }
         return response()->json(['msg' => 'not exists'], 200);

     }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Models\BusinessProfile;
use Illuminate\Support\Str;

class ImportController extends Controller
{
    public function importView()
    {
        return view('import.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required',
        ]);
        $file = $request->file('import_file');

        $import = new ImportUser;
        $import->import($file);

        // $import=Excel::import(new ImportUser, $request->file('import_file') );


        // if ($import->failures()->isNotEmpty()) {
        //     return back()->withFailures($import->failures());
        // }
        return back()->withStatus('Import successfull.');


        // try{

        //     $import=Excel::import(new ImportUser, $request->file('import_file') );
        //     return $import;
        //     return redirect()->back()->with('success', 'file inserted successfully');

        // }catch(\Exception $e) {
        //     return redirect()->back()->with('error', $e->getMessage());
        // }
    }

    public function generateAlias()
    {
        $profile=BusinessProfile::get();
        //$profile=BusinessProfile::where('alias', NULL)->get();
        foreach($profile as $p){
           $alias= $this->createAlias($p->business_name);
           $p->update(['alias' => $alias]);
        }
        return 'done!';
    }

    public function createAlias($name)
    {
        $lowercase=strtolower($name);
        $pattern= '/[^A-Za-z0-9\-]/';
        $preg_replace= preg_replace($pattern, '-', $lowercase);
        $single_hypen= preg_replace('/-+/', '-', $preg_replace);
        $alias= $single_hypen;
        return $this->checkExistsAlias($alias);
    }

    public function checkExistsAlias($alias)
    {
        $check_exists=BusinessProfile::where('alias', $alias)->first();
        if($check_exists){
            $create_array= explode('-',$alias);
            $last_key=array_slice($create_array,-1,1);
            $last_key_string=implode(' ',$last_key);
            if(is_numeric($last_key_string)){
                $last_key_string++;
                array_pop($create_array);
                array_push($create_array,$last_key_string);
            }else{
                array_push($create_array,1);
            }
            $alias=implode("-",$create_array);
            return $this->checkExistsAlias($alias);

        }

        return $alias;
    }


}

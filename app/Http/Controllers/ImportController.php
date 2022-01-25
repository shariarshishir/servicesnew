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
        foreach($profile as $p){
           $b_name= strtolower($p->business_name);
           $alias=Str::replace(' ', '-', $b_name);
           $p->update(['alias' => $alias]);
        }
        return 'done!';
    }


}

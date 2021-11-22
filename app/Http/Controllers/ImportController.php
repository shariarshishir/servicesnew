<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;


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

        try{

            Excel::import(new ImportUser, $request->file('import_file') );
            return redirect()->back()->with('success', 'file inserted successfully');

        }catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


}

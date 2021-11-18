<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function certificationDetailsUpload(Request $request ){
        dd($request->all());
    }
}

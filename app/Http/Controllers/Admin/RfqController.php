<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rfq;
use Illuminate\Http\Request;

class RfqController extends Controller
{
    public function index()
    {
        $collection=Rfq::with('user','category')->latest()->get();
        return view('admin.rfq.index',['collection' => $collection]);
    }

    public function show($id)
    {
       $rfq=Rfq::with('user','bids')->findOrFail($id);
       return view('admin.rfq.show', compact('rfq'));
    }
}

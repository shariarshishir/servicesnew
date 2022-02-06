<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rfq;
use Illuminate\Http\Request;
use DataTables;

class RfqController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Rfq::with('category','user')->select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('title', function($row) {
                       return ucwords($row->title);
                    })
                    ->editColumn('category', function($row){
                        return $row->category->name;
                    })
                    ->editColumn('delivery_time', function ($row) {
                        return \Carbon\Carbon::parse($row->delivery_time)->isoFormat('MMMM Do YYYY');
                    })
                    ->editColumn('created_by', function($row){
                        return $row->user->name;
                    })
                    ->editColumn('created_at', function ($row) {
                        return \Carbon\Carbon::parse($row->created_at)->isoFormat('MMMM Do YYYY');
                    })
                    ->addColumn('details', function($row){
                        $route= route('admin.rfq.show', $row->id);
                        $action='<a href="'.$route.'">Details</a>';
                        return $action;
                    })
                    ->rawColumns(['details'])
                    ->make(true);
        }

        return view('admin.rfq.index');
    }

    public function show($id)
    {
       $rfq=Rfq::with('user','bids')->findOrFail($id);
       return view('admin.rfq.show', compact('rfq'));
    }
}

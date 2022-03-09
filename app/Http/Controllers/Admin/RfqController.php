<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Rfq;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\NewRfqHasAddedEvent;
use App\Http\Controllers\Controller;

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
                    ->editColumn('category_id', function($row){
                        return $row->category->name;
                    })
                    ->editColumn('delivery_time', function ($row) {
                        return \Carbon\Carbon::parse($row->delivery_time)->isoFormat('MMMM Do YYYY');
                    })
                    ->editColumn('created_by', function($row){
                        return $row->user->name;
                    })
                    ->editColumn('status', function($row){
                        $ucfirst=ucfirst($row->status);
                        if($row->status== 'pending'){
                            $status= '<span class="text-danger">'.$ucfirst.'</span>';
                        }else{
                            $status= '<span class="text-primary">'.$ucfirst.'</span>';
                        }

                       return $status;
                    })
                    ->editColumn('created_at', function ($row) {
                        return \Carbon\Carbon::parse($row->created_at)->isoFormat('MMMM Do YYYY');
                    })
                    ->addColumn('details', function($row){
                        $route= route('admin.rfq.show', $row->id);
                        $action='<a href="'.$route.'">Details</a>';
                        return $action;
                    })
                    ->rawColumns(['details','status'])
                    ->make(true);
        }

        return view('admin.rfq.index');
    }

    public function show($id)
    {
       $rfq=Rfq::with('user','bids')->findOrFail($id);
       return view('admin.rfq.show', compact('rfq'));
    }

    public function status($id)
    {
        $rfq=Rfq::findOrFail($id);
        if($rfq->status == 'pending'){
            $rfq->update(['status' => 'approved']);
            if(env('APP_ENV') == 'production')
            {
                $selectedUsersToSendMail = User::where('id','<>', $rfq->created_by)->take(10)->get();
                foreach($selectedUsersToSendMail as $selectedUserToSendMail) {
                    event(new NewRfqHasAddedEvent($selectedUserToSendMail,$rfq));
                }
            }

            return redirect()->back()->withSuccess('Rfq published successfully');
        }
        if($rfq->status == 'approved'){
            $rfq->update(['status' => 'pending']);
            return redirect()->back()->withSuccess('Rfq unpublished successfully');
        }


    }
}

@extends('layouts.admin')
@section('content')

@if(auth()->guard('admin')->user()->unreadNotifications)
    @foreach (auth()->guard('admin')->user()->unreadNotifications as $notification)
        @if($notification->type == "App\Notifications\NewRfqNotification")
            @if($notification->data['rfq_data']['id']== $rfq->id)
               {{  $notification->markAsRead(); }}
            @endif
        @endif
    @endforeach
@endif
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Rfq Details </li>
                    </ol>
                </div>
            </div>
            <div class="row float-sm-right">
                <a href="{{route('admin.rfq.status', $rfq->id)}}" class="btn btn-info" onclick="return confirm('are you sure?');">{{$rfq->status== 'pending' ? 'Published' : 'Unpublished'}}</a>
            </div>
            <div class="clearfix">
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content admin_rfq_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <legend>Buyer Info</legend>
                                <div class="admin_rfq_left">
                                    <p><b>Name:</b> {{$rfq->user->name}}</p>
                                    <p><b>Email: </b> {{$rfq->user->email}}</p>
                                    <p><b>Phone:</b> {{$rfq->user->phone}}</p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-8">
                                <div class="admin_rfq_right">
                                    <legend>Details</legend>
                                    <p><b>Title :</b> {{$rfq->title}}</p>
                                    <p><b>Category :</b> {{$rfq->category->name}}</p>
                                    <p><b>Quantity :</b> {{$rfq->quantity}}</p>
                                    <p><b>Unit :</b> {{$rfq->unit}}</p>
                                    <p><b>Unit Price :</b> {{$rfq->unit_price}}</p>
                                    <p><b>Destination :</b> {{$rfq->destination}}</p>
                                    <p><b>Payment Method :</b> {{$rfq->payment_method}}</p>
                                    <p><b>Created At :</b> {{\Carbon\Carbon::parse($rfq->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</p>
                                    <p><b>Delivery Time :</b> {{\Carbon\Carbon::parse($rfq->delivery_time, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</p>
                                    <p><b>Short Description :</b> {{$rfq->short_description}}</p>
                                    <p><b>Full Specification :</b> {{$rfq->full_specification}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <legend>Business Profiles Of Category {{$rfq->category->name}}</legend>
                                <div class="rfq_business_profile_list">
                                    @foreach($businessProfiles as $key=>$businessProfile)
                                    <div class="business_profile_name">
                                        <div class="form-check">
                                            <input class="form-check-input business_profile_check" type="checkbox" value="{{$businessProfile['id']}}" data-businessprofilename="{{$businessProfile['business_name']}}"  data-alias="{{$businessProfile['alias']}}" >
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{$businessProfile['business_name']}}
                                            </label>
                                        </div>
                                        <input type="number" value="" name="propose_price" class="propose_price"/>
                                    </div>
                                    @endforeach
                                </div>
                                <a href="javascript:void(0);" class="business_profile_list_trigger_from_backend btn btn-success">Send To the Buyer</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>    

            <div class="card">
                <div class="row">
                    <legend>Replay</legend>
                    @foreach ($rfq->bids as $bid)
                        <div class="col-md-12">
                            <div class="rfq_replay_box">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h6>Company Info</h6>
                                        <p>Company Name: <b>{{$bid->businessProfile->business_name}}</b></p>
                                        <p>Phone : {{$bid->user->phone}}</p>
                                        <p>Email: {{$bid->user->email}}</p>
                                    </div>
                                    <div class="col-md-8">
                                        <h6>Replay Details</h6>
                                        <p>Offer Price: <b>{{$bid->unit_price}}</b></p>
                                        <p>Description : {!! $bid->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            
        </div>
    </section>
</div>

@endsection
@push('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            var envMode = "{{ env('APP_ENV') }}";
            if(envMode == 'production') {
                var fromId = '5771';
            } else {
                var fromId = '5552';
            }
            var selectedValues = [];
            var serverURL = "{{ env('CHAT_URL'), 'localhost' }}:3000";
            var socket = io.connect(serverURL);
            socket.on('connect', function(data) {
                console.log("Socket Connect successfully.");
            });
            $(document).on('click', '.business_profile_check', function(){
                var price = $(this).closest(".business_profile_name").children(".propose_price").val();
                if(price != ''){
                    url = "{{ $app->make('url')->to('/') }}/"+$(this).data('alias');
                    selectedValues.push("<a href='"+url+"'><b>"+$(this).data("businessprofilename")+"</b></a>" + " Offers - "+$(this).closest(".business_profile_name").children(".propose_price").val());
                }
                else{
                    $(this).prop("checked", false);
                    alert('Enter offer price first');
                }
               
            });


            $(".business_profile_list_trigger_from_backend").click(function(){
                if(selectedValues.length > 0){
                    var html = '<b>Our Suggested Profiles</b><br />';
                    selectedValues.forEach(function(value){
                        html += value + "<br />";
                    });
                    let message = {'message': html, 'image': "", 'from_id' : fromId, 'to_id' : "{{$rfq->user->id}}", 'product': null};
                    socket.emit('new message', message);
                    swal({  icon: 'success',  title: 'Success !!',  text: 'Proposal Sent successfully!',buttons: false});
                } 
                else{
                    alert('Enter offer price first');
                }
            })

        });  
        
    </script>
@endpush


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
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content admin_rfq_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="admin_rfq_left">
                                    <legend>RFQ Details</legend>
                                    <div class="rfq_buyer_info">
                                        <p><b>Name:</b> {{$rfq->user->name}}</p>
                                        <p><b>Email: </b> {{$rfq->user->email}}</p>
                                        <p><b>Phone:</b> {{$rfq->user->phone}}</p>
                                    </div>
                                    <div class="rfq_info_details">
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
                                    <a href="{{route('admin.rfq.status', $rfq->id)}}" class="{{$rfq->status== 'pending' ? 'btn btn-success' : 'btn btn-danger'}} rfq-status-trigger" onclick="return confirm('are you sure?');">{{$rfq->status== 'pending' ? 'Published' : 'Unpublished'}}</a>
                                    <a href="javascript:void(0);" class="business-profile-list-trigger btn btn-info" data-toggle="modal" data-target="#businessProfileListByCategoryModal">Send Proposals</a>                                                                                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                


                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">Home</div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Profile</div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Contact</div>
                                </div>                               
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="businessProfileListByCategoryModal" tabindex="-1" role="dialog" aria-labelledby="businessProfileListByCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="businessProfileListByCategoryModalLabel">Business Profiles Of Category {{$rfq->category->name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
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
                    /*
                    var user_image= "{{asset('storage')}}"+'/'+"images/supplier.png";
                    var html ='<div class="chat chat-right">';
                    html +='<div class="chat-avatar">';
                    html +='<a class="avatar">';
                    html +='<img src='+user_image+' class="circle" alt="avatar">';
                    html +='</a>';
                    html +='</div>';
                    html +='<div class="chat-body left-align">';
                    html +='<div class="chat-text">';
                    html +='<b>Our Suggested Profiles</b><br/>';
                    selectedValues.forEach(function(value){
                        html += value + '<br/>';
                    });
                    html +='</div>';
                    html +='</div>';
                    html +='</div>';
                    */
                    // var user_image = "{{asset('storage')}}"+'/'+"images/supplier.png";
                    var html = '<b>Our Suggested Profiles</b><br />';
                    selectedValues.forEach(function(value){
                        html += value + "<br />";
                    });
                    var envMode = "{{ env('APP_ENV') }}";
                    if(envMode == 'production') {
                        var fromId = '5771';
                    } else {
                        var fromId = '5552';
                    }
                    console.log(html);
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
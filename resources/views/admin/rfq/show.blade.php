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
                                        <a class="nav-link active" id="buyer-tab" data-toggle="tab" href="#buyer" role="tab" aria-controls="buyer" aria-selected="true">{{$rfq->user->name}}</a>
                                    </li>
                                    <li class="nav-item" style="display: none;">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">BP 1</a>
                                    </li>
                                    <li class="nav-item" style="display: none;">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">BP 2</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="buyer" role="tabpanel" aria-labelledby="buyer-tab">
                                        <div class="chatting_app_wrapper">
                                            <div class="chat-application">
                                                <div class="app-chat">
                                                    <div class="content-area content-right">
                                                        <div class="app-wrapper">
                                                            <div class="card card card-default scrollspy border-radius-6 fixed-width">
                                                                <div class="card-content chat-content p-0">
                                                                    <!-- Content Area -->
                                                                    <div class="chat-content-area animate fadeUp">
                                                                        <!-- Chat content area -->
                                                                        <div class="chat-area ps ps--active-y">
                                                                            <div class="chats">
                                                                                <div class="chats-box chat_messagedata" id="messagedata">
                                                                                @if($chatdata)
                                                                                    @foreach($chatdata as $chat)
                                                                                        @if($chat['from_id'] == $user)
                                                                                        <div class="chat chat-right">
                                                                                            <div class="chat-avatar">
                                                                                                <a class="avatar">
                                                                                                    <img src='{{$from_user_image}}' class="circle" alt="avatar">
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="chat-body left-align">
                                                                                                <div class="chat-text">
                                                                                                    <p>
                                                                                                    @php echo html_entity_decode($chat['message']); @endphp 
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>        
                                                                                        @else
                                                                                        <div class="chat chat-left">
                                                                                            <div class="chat-avatar">
                                                                                                <a class="avatar">
                                                                                                    <img src='{{$to_user_image}}' class="circle" alt="avatar">
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="chat-body left-align">
                                                                                                <div class="chat-text">
                                                                                                    <p>@php echo html_entity_decode($chat['message']); @endphp </p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="ps__rail-x" style="">
                                                                                <div class="ps__thumb-x" tabindex="0" style=""></div>
                                                                            </div>
                                                                            <div class="ps__rail-y" style="">
                                                                                <div class="ps__thumb-y" tabindex="0" style=""></div>
                                                                            </div>
                                                                        </div>
                                                                        <!--/ Chat content area -->
                                                                        <!-- Chat footer <-->
                                                                        <div class="chat-footer">
                                                                            <form action="javascript:void(0);" class="chat-input">
                                                                                <input type="text" placeholder="Type message here.." id="messagebox" class="message mb-0">
                                                                                <a class="btn_green send messageSendButton">Send</a>
                                                                            </form>
                                                                        </div>
                                                                        <!--/ Chat footer -->
                                                                    </div>
                                                                    <!--/ Content Area -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                    
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        Business Profile 1
                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        Business Profile 2
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="businessProfileListByCategoryModal" tabindex="-1" role="dialog" aria-labelledby="businessProfileListByCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="businessProfileListByCategoryModalLabel">Business Profiles Of Category {{$rfq->category->name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="send_suggested_profiles_to_buyer">
                                <div class="business_profile_filter">
                                    <div class="factory_type_filter">
                                        <label>Factory Type</label>
                                        <select class="form-select form-control" name="factory_type" id="factory_type">
                                            <option value="">Select factory type</option>
                                            @foreach($productCategories as $productCategory)
                                                <option value="{{$productCategory->id}}" {{ ( $productCategory->id == $rfq->category->id ) ? ' selected' : '' }}>{{$productCategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="rating_type_filter">
                                        <label>Rating</label>
                                        <select class="form-select form-control" name="profile_rating" id="profile_rating">
                                            <option value="0">All</option>
                                            <option value="5">5 star</option>
                                            <option value="4">4 star</option>
                                            <option value="3">3 star</option>
                                            <option value="2">2 star</option>
                                            <option value="1">1 star</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="rfq_business_profile_list">
                                    @if($businessProfiles)
                                    @foreach($businessProfiles as $key=>$businessProfile)
                                    <div class="business_profile_name">
                                        <div class="form-check">
                                            <input class="form-check-input business_profile_check" type="checkbox" value="{{$businessProfile['id']}}" data-businessprofilename="{{$businessProfile['business_name']}}"  data-alias="{{$businessProfile['alias']}}" >
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <p>{{$businessProfile['business_name']}}</p>
                                                
                                                @if($businessProfile['business_type'] == 1)
                                                <p>Manufacturer</p>
                                                @elseif($businessProfile['business_type'] == 2)
                                                <p>Wholesaler</p>
                                                @else
                                                <p>Design Studio</p>
                                                @endif

                                                <p>Rating: 5 Start</p>
                                                <p>Total Order: 100</p>
                                            </label>
                                        </div>
                                        <input type="number" value="" name="propose_price" class="propose_price"/>
                                    </div>
                                    @endforeach
                                    @else
                                        <div><p>No profile found</p></div>
                                    @endif
                                </div>
                                <a href="javascript:void(0);" class="business_profile_list_trigger_from_backend btn btn-success">Send To the Buyer</a>
                                <button type="button" class="btn btn-secondary" id="modal_close_button" data-dismiss="modal">Close</button>
                                </form>
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
        //function enter_chat(a){var e=$(".message").val();if(""!=e){var t='<div class="chat-text"><p>'+e+"</p></div>";$(".chat:last-child .chat-body").append(t),$(".message").val(""),$(".chat-area").scrollTop($(".chat-area > .chats").height())}}
        $(document).ready(function() {
            $(".chat-area").animate({ scrollTop:$('#messagedata').prop("scrollHeight")});
            var selectedValues = [];
            var serverURL = "{{ env('CHAT_URL') }}?chatID={{$rfq->id}}";
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

            $(document).on('click', '#factory_type', function(){
                var category_id = $( "#factory_type option:selected" ).val();
                var profile_rating = $( "#profile_rating option:selected" ).val();
                console.log(category_id);
                console.log(profile_rating);
                if( category_id !=''){
                    $.ajax({
                        method: 'get',
                        data: {category_id:category_id,profile_rating:profile_rating},
                        url: '{{ route("admin.rfq.business.profiles.filter") }}',
                        success:function(response){
                            console.log(response.businessProfiles);
                            if(response.businessProfiles.length >0){
                                $('.rfq_business_profile_list').empty();
                                response.businessProfiles.forEach((item, index)=>{
                                    var html ='<div class="business_profile_name">';
                                    html+='<div class="form-check">';
                                    html+='<input class="form-check-input business_profile_check" type="checkbox" value="{{$businessProfile['id']}}" data-businessprofilename="{{$businessProfile['business_name']}}"  data-alias="{{$businessProfile['alias']}}" >';
                                    html+='<label class="form-check-label" for="flexCheckDefault">';
                                    html+='<p>'+item.business_name+'</p>';
                                    if( item.business_type == 1 ){
                                        html+='<p>Manufacturer</p>';
                                    }else if( item.business_type == 2){
                                        html+='<p>Wholesaler</p>';
                                    }
                                    html+='<p>Rating: 5 Start</p>';
                                    html+='<p>Total Order: 100</p>';
                                    html+='</label>';
                                    html+='</div>';
                                    html+='<input type="number" value="" name="propose_price" class="propose_price"/>';
                                    html+='</div>';
                                    $('.rfq_business_profile_list').append(html);
                                })
                            }else{
                                $('.rfq_business_profile_list').empty();
                                var html = '<div>';
                                html += '<p>No Profile found</p>';
                                html += '</div>';
                                $('.rfq_business_profile_list').append(html);
                            }
                        }
                    });
                }
            });


            $(document).on('click', '#profile_rating', function(){
                var category_id = $( "#factory_type option:selected" ).val();
                var profile_rating = $( "#profile_rating option:selected" ).val();
                console.log(category_id);
                console.log(profile_rating);
                    $.ajax({
                        method: 'get',
                        data: {category_id:category_id,profile_rating:profile_rating},
                        url: '{{ route("admin.rfq.business.profiles.filter") }}',
                        success:function(response){
                            console.log(response.businessProfiles);
                            if(response.businessProfiles.length >0){
                                $('.rfq_business_profile_list').empty();
                                response.businessProfiles.forEach((item, index)=>{
                                    var html ='<div class="business_profile_name">';
                                    html+='<div class="form-check">';
                                    html+='<input class="form-check-input business_profile_check" type="checkbox" value="{{$businessProfile['id']}}" data-businessprofilename="{{$businessProfile['business_name']}}"  data-alias="{{$businessProfile['alias']}}" >';
                                    html+='<label class="form-check-label" for="flexCheckDefault">';
                                    html+='<p>'+item.business_name+'</p>';
                                    if( item.business_type == 1 ){
                                        html+='<p>Manufacturer</p>';
                                    }else if( item.business_type == 2){
                                        html+='<p>Wholesaler</p>';
                                    }
                                    html+='<p>Rating: 5 Start</p>';
                                    html+='<p>Total Order: 100</p>';
                                    html+='</label>';
                                    html+='</div>';
                                    html+='<input type="number" value="" name="propose_price" class="propose_price"/>';
                                    html+='</div>';
                                    $('.rfq_business_profile_list').append(html);
                                })
                            }else{
                                $('.rfq_business_profile_list').empty();
                                var html = '<div>';
                                html += '<p>No Profile found</p>';
                                html += '</div>';
                                $('.rfq_business_profile_list').append(html);
                            }
                        }
                    });
            });
            
            $(".business_profile_list_trigger_from_backend").click(function(){
                if(selectedValues.length > 0){
                    var html = '<b>Our Suggested Profiles</b><br />';
                    selectedValues.forEach(function(value){
                        html += value + "<br />";
                    });
                    var envMode = "{{ env('APP_ENV') }}";
                    if(envMode == 'production') {
                        var fromId = '5771';
                    } else{
                        var fromId = '5552';
                    }
                    let message = {'message': html, 'image': "", 'from_id' : fromId, 'to_id' : "{{$rfq->user->id}}", 'rfq_id': "{{$rfq->id}}",'factory':true,'product': null};
                    socket.emit('new message', message);
                    var admin_user_image= "{{asset('storage')}}"+'/'+"images/merchantbay_admin/profile/uG2WX6gF2ySIX3igETUVoSy8oqlJ12Ff6BmD8K64.jpg";
                    var msgHtml = '<div class="chat chat-right">';
                    msgHtml += '<div class="chat-avatar">';
                    msgHtml += '<a class="avatar">';
                    msgHtml += '<img src="'+admin_user_image+'" class="circle" alt="avatar">';
                    msgHtml += '</a>';
                    msgHtml += '</div>';
                    msgHtml += '<div class="chat-body left-align">';
                    msgHtml += '<div class="chat-text">';
                    msgHtml += '<p>'+html+'</p>';
                    msgHtml += '</div>';
                    msgHtml += '</div>';
                    msgHtml += '</div>';
                    $('.chats-box').append(msgHtml);
                    $(".chat-area").animate({ scrollTop:$('#messagedata').prop("scrollHeight")});
                    $('#businessProfileListByCategoryModal').modal('hide');
                    $('#send_suggested_profiles_to_buyer')[0].reset();
                    $("#factory_type option[value={{$rfq->category->id}}]").attr('selected', 'selected');
                    $("#factory_type option[value=0]").attr('selected', 'selected');
                    var businessProfiles = @json($businessProfiles);
                    if( businessProfiles.length >0 ){
                        $('.rfq_business_profile_list').empty();
                        businessProfiles.forEach((item, index)=>{
                            var html ='<div class="business_profile_name">';
                            html+='<div class="form-check">';
                            html+='<input class="form-check-input business_profile_check" type="checkbox" value="{{$businessProfile['id']}}" data-businessprofilename="{{$businessProfile['business_name']}}"  data-alias="{{$businessProfile['alias']}}" >';
                            html+='<label class="form-check-label" for="flexCheckDefault">';
                            html+='<p>'+item.business_name+'</p>';
                            if( item.business_type == 1 ){
                                html+='<p>Manufacturer</p>';
                            }else if( item.business_type == 2){
                                html+='<p>Wholesaler</p>';
                            }
                            html+='<p>Rating: 5 Start</p>';
                            html+='<p>Total Order: 100</p>';
                            html+='</label>';
                            html+='</div>';
                            html+='<input type="number" value="" name="propose_price" class="propose_price"/>';
                            html+='</div>';
                            $('.rfq_business_profile_list').append(html);
                        })
                    }else{
                        $('.rfq_business_profile_list').empty();
                        var html = '<div>';
                        html += '<p>No Profile found</p>';
                        html += '</div>';
                        $('.rfq_business_profile_list').append(html);
                    }
                    swal({  icon: 'success',  title: 'Success !!',  text: 'Proposal Sent successfully!',buttons: false});
                } 
                else{
                    alert('Enter offer price first');
                }
            })

            $("#modal_close_button").click(function(){
                $('#send_suggested_profiles_to_buyer')[0].reset();
                $("#factory_type option[value={{$rfq->category->id}}]").attr('selected', 'selected');
                $("#factory_type option[value=0]").attr('selected', 'selected');
                var businessProfiles = @json($businessProfiles);
                if( businessProfiles.length >0 ){
                    $('.rfq_business_profile_list').empty();
                    businessProfiles.forEach((item, index)=>{
                        var html ='<div class="business_profile_name">';
                        html+='<div class="form-check">';
                        html+='<input class="form-check-input business_profile_check" type="checkbox" value="{{$businessProfile['id']}}" data-businessprofilename="{{$businessProfile['business_name']}}"  data-alias="{{$businessProfile['alias']}}" >';
                        html+='<label class="form-check-label" for="flexCheckDefault">';
                        html+='<p>'+item.business_name+'</p>';
                        if( item.business_type == 1 ){
                            html+='<p>Manufacturer</p>';
                        }else if( item.business_type == 2){
                            html+='<p>Wholesaler</p>';
                        }
                        html+='<p>Rating: 5 Start</p>';
                        html+='<p>Total Order: 100</p>';
                        html+='</label>';
                        html+='</div>';
                        html+='<input type="number" value="" name="propose_price" class="propose_price"/>';
                        html+='</div>';
                        $('.rfq_business_profile_list').append(html);
                    })
                }else{
                    $('.rfq_business_profile_list').empty();
                    var html = '<div>';
                    html += '<p>No Profile found</p>';
                    html += '</div>';
                    $('.rfq_business_profile_list').append(html);
                }
            });

            $('.messageSendButton').click(function(){
                //event.preventDefault();
                var msg = $('#messagebox').val();
                var envMode = "{{ env('APP_ENV') }}";
                if(envMode == 'production') {
                    var fromId = '5771';
                } else{
                    var fromId = '5552';
                }
                let message = {'message': msg, 'image': "", 'from_id' : fromId, 'to_id' : "{{$rfq->user->id}}",'rfq_id': "{{$rfq->id}}",'factory':false, 'product': null};
                socket.emit('new message', message);
                var admin_user_image= "{{asset('storage')}}"+'/'+"images/merchantbay_admin/profile/uG2WX6gF2ySIX3igETUVoSy8oqlJ12Ff6BmD8K64.jpg";
                var msgHtml = '<div class="chat chat-right">';
                    msgHtml += '<div class="chat-avatar">';
                    msgHtml += '<a class="avatar">';
                    msgHtml += '<img src="'+admin_user_image+'" class="circle" alt="avatar">';
                    msgHtml += '</a>';
                    msgHtml += '</div>';
                    msgHtml += '<div class="chat-body left-align">';
                    msgHtml += '<div class="chat-text">';
                    msgHtml += '<p>'+msg+'</p>';
                    msgHtml += '</div>';
                    msgHtml += '</div>';
                    msgHtml += '</div>';
                    $('#messagebox').val('');
                    $('.chats-box').append(msgHtml);
                    $(".chat-area").animate({ scrollTop:$('#messagedata').prop("scrollHeight")});
            });

            

            socket.on('new message', function(data) {
                console.log(data);
                var from_user_image= "{{asset('storage')}}"+'/'+"{{$rfq->user->image}}";
                var msgHtml = '<div class="chat chat-left">';
                    msgHtml += '<div class="chat-avatar">';
                    msgHtml += '<a class="avatar">';
                    msgHtml += '<img src="'+from_user_image+'" class="circle" alt="avatar">';
                    msgHtml += '</a>';
                    msgHtml += '</div>';
                    msgHtml += '<div class="chat-body left-align">';
                    msgHtml += '<div class="chat-text">';
                    msgHtml += '<p>'+data.message+'</p>';
                    msgHtml += '</div>';
                    msgHtml += '</div>';
                    msgHtml += '</div>';
                    $('.chats-box').append(msgHtml);
                    $(".chat-area").animate({ scrollTop:$('#messagedata').prop("scrollHeight")});
            });
        }); 
    </script>
@endpush
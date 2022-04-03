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
                <div class="col-md-9">
                    <div class="card">
                        <div class="rfq_label_block">
                            <h4>RFQ Id: ABCD-001</h4>
                            <a href="{{route('admin.rfq.status', $rfq->id)}}" class="{{$rfq->status== 'pending' ? 'btn btn-success' : 'btn btn-danger'}} rfq-status-trigger" onclick="return confirm('are you sure?');">{{$rfq->status== 'pending' ? 'Published' : 'Unpublished'}}</a>
                            <a href="javascript:void(0);" class="business-profile-list-trigger btn btn-default" data-toggle="modal" data-target="#businessProfileListByCategoryModal">Send Proposals</a>                                                                                                                                
                        </div>
                        <div class="rfq_user_block">
                            <div class="rfq_user_img">
                                <img src="{{asset('storage/' .$rfq->user->image)}}" alt="" />
                            </div>
                            <div class="rfq_user_info">
                                <h4>{{$rfq->user->name}}</h4>
                                <p>{{$rfq->user->email}}</p>
                                <p>{{$rfq->user->phone}}</p>
                            </div>
                        </div>
                        <div class="rfq_details_block">
                            <h5>{{$rfq->title}}</h5>
                            <p>Query for {{$rfq->category->name}}</p>
                            <p>Details: {{$rfq->full_specification}}</p>
                            <p>Qty: {{$rfq->quantity}} {{$rfq->unit}}, Target Price: $ {{$rfq->unit_price}}, Deliver To: {{$rfq->destination}}, Within: {{\Carbon\Carbon::parse($rfq->delivery_time, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ss a')}}, Payment Method: {{$rfq->payment_method}}</p>
                        </div>             
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="message_header">
                        <img src="{{asset('storage/' .$rfq->user->image)}}" alt="" />
                        {{$rfq->user->name}}
                    </div>
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


                <div class="modal fade" id="businessProfileListByCategoryModal" tabindex="-1" role="dialog" aria-labelledby="businessProfileListByCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="businessProfileListByCategoryModalLabel">Business Profiles Of Category {{$rfq['category'][0]['name']}}</h5>
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
                                                <option value="{{$productCategory->id}}" {{ ( $productCategory->id == $rfq['category'][0]['id'] ) ? ' selected' : '' }}>{{$productCategory->name}}</option>
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
                                            <!--input class="form-check-input business_profile_check" type="checkbox" value="{{$businessProfile['id']}}" data-businessprofilename="{{$businessProfile['business_name']}}"  data-alias="{{$businessProfile['alias']}}" -->
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
                                        <div class="propose_price_block">
                                            <div class="print_block">
                                                <label>Offer Price</label>
                                                <div class="propose_price_input_block">
                                                    $ <input data-businessprofilename="{{$businessProfile['business_name']}}" type="number" value="" name="propose_price" class="propose_price" />
                                                </div>
                                            </div>
                                            <div class="separator_block"> / </div>
                                            <div class="uom_block">
                                                <label>Price Unit</label>
                                                <select name="propose_uom" class="propose_uom form-select form-control">
                                                    <option value="" selected="true" disabled="">Choose your option</option>
                                                    <option value="Pcs">Pcs</option>
                                                    <option value="Lbs">Lbs</option>
                                                    <option value="Gauge">Gauge</option>
                                                    <option value="Yard">Yards</option>
                                                    <option value="Kg">Kg</option>
                                                    <option value="Meter">Meter</option>
                                                    <option value="Dozens">Dozens</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                        <div><p>No profile found</p></div>
                                    @endif
                                </div>
                                <a href="javascript:void(0);" class="business_profile_list_trigger_from_backend btn btn-success">Send Proposals</a>
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
            var serverURL = "{{ env('CHAT_URL') }}?chatID={{$rfq['id']}}";
            var socket = io.connect(serverURL);
            socket.on('connect', function(data) {
                console.log("Socket Connect successfully.");
            });

            // $(document).on('click', '.business_profile_check', function(){
            //     var price = $(this).closest(".business_profile_name").children(".propose_price").val();
            //     if(price != ''){
            //         url = "{{ $app->make('url')->to('/') }}/"+$(this).data('alias');
            //         selectedValues.push("<a href='"+url+"'><b>"+$(this).data("businessprofilename")+"</b></a>" + " Offers - "+$(this).closest(".business_profile_name").children(".propose_price").val());
            //     }
            //     else{
            //         $(this).prop("checked", false);
            //         alert('Enter offer price first');
            //     }
            // });

            // $(document).on("change", ".propose_price", function(){
            //     var price = $(this).val();
            //     var price_unit = $(this).closest(".business_profile_name").children(".propose_uom").val();
            //     if(price != ''){
            //         url = "{{ $app->make('url')->to('/') }}/"+$(this).data('alias');
            //         selectedValues.push("<a href='"+url+"'><b>"+$(this).data("businessprofilename")+"</b></a>" + " Offers - $"+$(this).val()+"/"+price_unit);
            //     }                
            // });

            $(document).on("change", ".propose_price", function(){
                var price = $(this).val();
                //var price_unit = $(this).closest(".business_profile_name").children(".propose_uom").val();
                if(price != ''){
                    url = "{{ $app->make('url')->to('/') }}/"+$(this).data('alias');
                    selectedValues.push("<a href='"+url+"'><b>"+$(this).data("businessprofilename")+"</b></a>" + " Offers - $"+$(this).val()+"/ Pcs");
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
                                    //html+='<input class="form-check-input business_profile_check" type="checkbox" value="{{$businessProfile['id']}}" data-businessprofilename="{{$businessProfile['business_name']}}"  data-alias="{{$businessProfile['alias']}}" >';
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
                                    //html+='<input type="number" value="" name="propose_price" class="propose_price"/>';
                                    html+='<div class="propose_price_block">';
                                    html+='<div class="print_block">';
                                    html+='<label>Offer Price</label>';
                                    html+='<div class="propose_price_input_block">';
                                    html+='$ <input data-businessprofilename="{{$businessProfile['business_name']}}" type="number" value="" name="propose_price" class="propose_price" />';
                                    html+='</div>';
                                    html+='</div>';
                                    html+='<div class="separator_block"> / </div>';
                                    html+='<div class="uom_block">';
                                    html+='<label>Price Unit</label>';
                                    html+='<select name="propose_uom" class="propose_uom form-select form-control">';
                                    html+='<option value="" selected="true" disabled="">Choose your option</option>';
                                    html+='<option value="Pcs">Pcs</option>';
                                    html+='<option value="Lbs">Lbs</option>';
                                    html+='<option value="Gauge">Gauge</option>';
                                    html+='<option value="Yard">Yards</option>';
                                    html+='<option value="Kg">Kg</option>';
                                    html+='<option value="Meter">Meter</option>';
                                    html+='<option value="Dozens">Dozens</option>';
                                    html+='</select>';
                                    html+='</div>';
                                    html+='</div>';
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
                                    //html+='<input class="form-check-input business_profile_check" type="checkbox" value="{{$businessProfile['id']}}" data-businessprofilename="{{$businessProfile['business_name']}}"  data-alias="{{$businessProfile['alias']}}" >';
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
                                    //html+='<input type="number" value="" name="propose_price" class="propose_price"/>';
                                    html+='<div class="propose_price_block">';
                                    html+='<div class="print_block">';
                                    html+='<label>Offer Price</label>';
                                    html+='<div class="propose_price_input_block">';
                                    html+='$ <input data-businessprofilename="{{$businessProfile['business_name']}}" type="number" value="" name="propose_price" class="propose_price" />';
                                    html+='</div>';
                                    html+='</div>';
                                    html+='<div class="separator_block"> / </div>';
                                    html+='<div class="uom_block">';
                                    html+='<label>Price Unit</label>';
                                    html+='<select name="propose_uom" class="propose_uom form-select form-control">';
                                    html+='<option value="" selected="true" disabled="">Choose your option</option>';
                                    html+='<option value="Pcs">Pcs</option>';
                                    html+='<option value="Lbs">Lbs</option>';
                                    html+='<option value="Gauge">Gauge</option>';
                                    html+='<option value="Yard">Yards</option>';
                                    html+='<option value="Kg">Kg</option>';
                                    html+='<option value="Meter">Meter</option>';
                                    html+='<option value="Dozens">Dozens</option>';
                                    html+='</select>';
                                    html+='</div>';
                                    html+='</div>';
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
                    let message = {'message': html, 'image': "", 'from_id' : fromId, 'to_id' : "{{$rfq['user']['user_id']}}", 'rfq_id': "{{$rfq['id']}}",'factory':true,'product': null};
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
                    $("#factory_type option[value={{$rfq['category'][0]['id']}}]").attr('selected', 'selected');
                    $("#factory_type option[value=0]").attr('selected', 'selected');
                    var businessProfiles = @json($businessProfiles);
                    if( businessProfiles.length >0 ){
                        $('.rfq_business_profile_list').empty();
                        businessProfiles.forEach((item, index)=>{
                            var html ='<div class="business_profile_name">';
                            html+='<div class="form-check">';
                            //html+='<input class="form-check-input business_profile_check" type="checkbox" value="{{$businessProfile['id']}}" data-businessprofilename="{{$businessProfile['business_name']}}"  data-alias="{{$businessProfile['alias']}}" >';
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
                            //html+='<input type="number" value="" name="propose_price" class="propose_price"/>';
                            html+='<div class="propose_price_block">';
                            html+='<div class="print_block">';
                            html+='<label>Offer Price</label>';
                            html+='<div class="propose_price_input_block">';
                            html+='$ <input data-businessprofilename="{{$businessProfile['business_name']}}" type="number" value="" name="propose_price" class="propose_price" />';
                            html+='</div>';
                            html+='</div>';
                            html+='<div class="separator_block"> / </div>';
                            html+='<div class="uom_block">';
                            html+='<label>Price Unit</label>';
                            html+='<select name="propose_uom" class="propose_uom form-select form-control">';
                            html+='<option value="" selected="true" disabled="">Choose your option</option>';
                            html+='<option value="Pcs">Pcs</option>';
                            html+='<option value="Lbs">Lbs</option>';
                            html+='<option value="Gauge">Gauge</option>';
                            html+='<option value="Yard">Yards</option>';
                            html+='<option value="Kg">Kg</option>';
                            html+='<option value="Meter">Meter</option>';
                            html+='<option value="Dozens">Dozens</option>';
                            html+='</select>';
                            html+='</div>';
                            html+='</div>';
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
                $("#factory_type option[value={{$rfq['category'][0]['id']}}]").attr('selected', 'selected');
                $("#factory_type option[value=0]").attr('selected', 'selected');
                var businessProfiles = @json($businessProfiles);
                if( businessProfiles.length >0 ){
                    $('.rfq_business_profile_list').empty();
                    businessProfiles.forEach((item, index)=>{
                        var html ='<div class="business_profile_name">';
                        html+='<div class="form-check">';
                        //html+='<input class="form-check-input business_profile_check" type="checkbox" value="{{$businessProfile['id']}}" data-businessprofilename="{{$businessProfile['business_name']}}"  data-alias="{{$businessProfile['alias']}}" >';
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
                        //html+='<input type="number" value="" name="propose_price" class="propose_price"/>';
                        html+='<div class="propose_price_block">';
                        html+='<div class="print_block">';
                        html+='<label>Offer Price</label>';
                        html+='<div class="propose_price_input_block">';
                        html+='$ <input data-businessprofilename="{{$businessProfile['business_name']}}" type="number" value="" name="propose_price" class="propose_price" />';
                        html+='</div>';
                        html+='</div>';
                        html+='<div class="separator_block"> / </div>';
                        html+='<div class="uom_block">';
                        html+='<label>Price Unit</label>';
                        html+='<select name="propose_uom" class="propose_uom form-select form-control">';
                        html+='<option value="" selected="true" disabled="">Choose your option</option>';
                        html+='<option value="Pcs">Pcs</option>';
                        html+='<option value="Lbs">Lbs</option>';
                        html+='<option value="Gauge">Gauge</option>';
                        html+='<option value="Yard">Yards</option>';
                        html+='<option value="Kg">Kg</option>';
                        html+='<option value="Meter">Meter</option>';
                        html+='<option value="Dozens">Dozens</option>';
                        html+='</select>';
                        html+='</div>';
                        html+='</div>';
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
                let message = {'message': msg, 'image': "", 'from_id' : fromId, 'to_id' : "{{$rfq['user']['user_id']}}",'rfq_id': "{{$rfq['id']}}",'factory':false, 'product': null};
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

            

            
        }); 
    </script>
@endpush
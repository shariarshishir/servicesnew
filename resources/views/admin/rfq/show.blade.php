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
                        <div class="rfq_admin_chat_topwrap">
                            <div class="rfq_chat_top">
                                <span class="chat_idBox">RFQ ID: <span class="rfq_id">3669700</span></span>
                                <div class="chat_top_right">
                                    <ul>
                                        <li class="active"><a href="javascript:void(0);" class="btn_grBorder">Generate PI</a></li>
                                        <li><a href="{{route('admin.rfq.status', $rfq['id'])}}" class="{{$rfq['status']== 'pending' ? 'btn_grBorder' : 'btn_grBorder'}} rfq-status-trigger" onclick="return confirm('are you sure?');">{{$rfq['status']== 'pending' ? 'Published' : 'Unpublished'}}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="rfq_chat_info">
                                <div class="chat_pro_infobox">
                                    <div class="chat_info_leftWrap">
                                        <div class="chat_info_left">
                                            <div class="pro_omg">
                                                <img src="{{asset('admin-assets/img/avatar04.png')}}" alt="">
                                            </div>
                                        </div>
                                        <div class="chat_info_right">
                                            <h3>{{$rfq['user']['user_name']}}</h3>
                                            <p>{{$rfq['user']['email']}}, <br/> {{$rfq['user']['phone']}}</p>
                                        </div>
                                    </div>
                                    <div class="chat_info_rightWrap">
                                        <span><i class="fa fa-clock"></i> {{ \Carbon\Carbon::parse($rfq['created_at'])->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</span>
                                    </div>
                                </div>
                                <div class="infoBox">
                                    <p>{{$rfq['title']}}</p>
                                    <p>Query for {{$rfq['category'][0]['name']}}</p>
                                    <p>Details: {{$rfq['full_specification']}}</p>
                                    <p>Qty: {{$rfq['quantity']}} {{$rfq['unit']}}, Target Price: $ {{$rfq['unit_price']}}, Deliver To: {{$rfq['destination']}}, Within: {{\Carbon\Carbon::parse($rfq['delivery_time'], 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ss a')}}, Payment Method: {{$rfq['payment_method']}}</p>
                                </div>
                            </div>
                        </div>           
                    </div>
                    <div class="card">
                        <div class="rfq_data_top">
                            <h3>Matched Suppliers</h3>
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
                        </div>
                        <div class="matched_suppliers_wrap">
                            <div class="rfq_business_profile_list row">
                                @if($businessProfiles)
                                @foreach($businessProfiles as $key=>$businessProfile)
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="suppliersBoxWrap">
                                        <div class="suppliers_box">
                                            <div class="suppliers_imgBox">
                                                <div class="imgBox">
                                                    <img src="./images/logo.png" alt="" />
                                                </div>
                                                <h5>MB Pool</h5>
                                            </div>
                                            <div class="suppliers_textBox">
                                                <div class="title_box">
                                                    <h3>{{$businessProfile['business_name']}}</h3>
                                                    <div class="sms_img">
                                                        <a href="javascript:void(0);"><i class="fa fa-envelope"></i></a>
                                                    </div>
                                                </div>
                                                <div class="sms_details_box">
                                                    <div class="sms_details">
                                                        Contact Person <br/>
                                                        <span>Ron Wisley</span>
                                                    </div>
                                                    <div class="sms_details">
                                                        Contact Number <br/>
                                                        <span>01234567899</span>
                                                    </div>
                                                </div>
                                                <div class="send_box">
                                                    <a href="javascript:void(0);" class="businessProfileModal{{$businessProfile['id']}}" data-toggle="modal" data-target="#businessProfileModal{{$businessProfile['id']}}">Send <i class="fa fa-chevron-circle-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="businessProfileModal{{$businessProfile['id']}}" tabindex="-1" role="dialog" aria-labelledby="businessProfileModal{{$businessProfile['id']}}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-body">
                                                <h4>{{$businessProfile['business_name']}}</h4>
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
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" data-businessprofilename="{{$businessProfile['business_name']}}" class="btn btn-primary send_offer_price_trigger">Send</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div> 
                                                                       
                                </div>
                                @endforeach
                                @else
                                    <div><p>No profile found</p></div>
                                @endif
                            </div>                    
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="message_header">
                        {{$rfq['user']['user_name']}}
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
            var serverURL = "{{ env('CHAT_URL') }}?userId=5552";
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
                                    var html ='<div class="col-md-3">';
                                    html+='<div class="form-check">';
                                    html+='<label class="form-check-label" for="flexCheckDefault">';
                                    html+='<p>'+item.business_name+'</p>';
                                    html+='</label>';
                                    html+='</div>';
                                    html+='<a href="javascript:void(0);" class="businessProfileModal'+item.id+'" data-toggle="modal" data-target="#businessProfileModal'+item.id+'">Send <i class="fa fa-chevron-circle-right"></i></a>';
                                    html+='<a href="javascript:void(0);"><i class="fa fa-envelope"></i></a>';
                                    html+='<div class="modal fade" id="businessProfileModal'+item.id+'" tabindex="-1" role="dialog" aria-labelledby="businessProfileModal'+item.id+'Label" aria-hidden="true">';
                                    html+='<div class="modal-dialog" role="document">';
                                    html+='<div class="modal-content">';
                                    html+='<div class="modal-body">';
                                    html+='<h4>'+item.business_name+'</h4>';
                                    html+='<div class="propose_price_block">';
                                    html+='<div class="print_block">';
                                    html+='<label>Offer Price</label>';
                                    html+='<div class="propose_price_input_block">';
                                    html+='$ <input data-businessprofilename="'+item.business_name+'" type="number" value="" name="propose_price" class="propose_price" />';
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
                                    html+='<div class="modal-footer">';
                                    html+='<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                                    html+='<button type="button" data-businessprofilename="'+item.business_name+'" class="btn btn-primary send_offer_price_trigger">Send</button>';
                                    html+='</div>';
                                    html+='</div>';
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
                                    var html ='<div class="col-md-3">';
                                    html+='<div class="form-check">';
                                    html+='<label class="form-check-label" for="flexCheckDefault">';
                                    html+='<p>'+item.business_name+'</p>';
                                    html+='</label>';
                                    html+='</div>';
                                    html+='<a href="javascript:void(0);" class="businessProfileModal'+item.id+'" data-toggle="modal" data-target="#businessProfileModal'+item.id+'">Send <i class="fa fa-chevron-circle-right"></i></a>';
                                    html+='<a href="javascript:void(0);"><i class="fa fa-envelope"></i></a>';
                                    html+='<div class="modal fade" id="businessProfileModal'+item.id+'" tabindex="-1" role="dialog" aria-labelledby="businessProfileModal'+item.id+'Label" aria-hidden="true">';
                                    html+='<div class="modal-dialog" role="document">';
                                    html+='<div class="modal-content">';
                                    html+='<div class="modal-body">';
                                    html+='<h4>'+item.business_name+'</h4>';
                                    html+='<div class="propose_price_block">';
                                    html+='<div class="print_block">';
                                    html+='<label>Offer Price</label>';
                                    html+='<div class="propose_price_input_block">';
                                    html+='$ <input data-businessprofilename="'+item.business_name+'" type="number" value="" name="propose_price" class="propose_price" />';
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
                                    html+='<div class="modal-footer">';
                                    html+='<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                                    html+='<button type="button" data-businessprofilename="'+item.business_name+'" class="btn btn-primary send_offer_price_trigger">Send</button>';
                                    html+='</div>';
                                    html+='</div>';
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
                            html+='<label class="form-check-label" for="flexCheckDefault">';
                            html+='<p>'+item.business_name+'</p>';
                            if( item.business_type == 1 ){
                                html+='<p>Manufacturer</p>';
                            }else if( item.business_type == 2){
                                html+='<p>Wholesaler</p>';
                            }
                            html+='<p>Rating: 5 Star</p>';
                            html+='<p>Total Order: 100</p>';
                            html+='</label>';
                            html+='</div>';
                            html+='<div class="propose_price_block">';
                            html+='<div class="print_block">';
                            html+='<label>Offer Price</label>';
                            html+='<div class="propose_price_input_block">';
                            html+='$ <input data-businessprofilename="" type="number" value="" name="propose_price" class="propose_price" />';
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

            //$(".send_offer_price_trigger").click(function(){        
            $(document).on("click", ".send_offer_price_trigger", function(){
                var html = $(this).data("businessprofilename")+" offers "+$(this).closest(".modal-content").find(".propose_price").val()+" / "+$(this).closest(".modal-content").find(".propose_uom").val();
                var envMode = "{{ env('APP_ENV') }}";
                if(envMode == 'production') {
                    var fromId = '5771';
                } else{
                    var fromId = '5552';
                }
                let message = {'message': html, 'image': "", 'from_id' : fromId, 'to_id' : "{{$rfq['user']['user_id']}}", 'rfq_id': "{{$rfq['id']}}",'factory':true,'product': null};
                socket.emit('new message', message);                
            });

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
                        html+='<label class="form-check-label" for="flexCheckDefault">';
                        html+='<p>'+item.business_name+'</p>';
                        if( item.business_type == 1 ){
                            html+='<p>Manufacturer</p>';
                        }else if( item.business_type == 2){
                            html+='<p>Wholesaler</p>';
                        }
                        html+='<p>Rating: 5 Star</p>';
                        html+='<p>Total Order: 100</p>';
                        html+='</label>';
                        html+='</div>';
                        html+='<div class="propose_price_block">';
                        html+='<div class="print_block">';
                        html+='<label>Offer Price</label>';
                        html+='<div class="propose_price_input_block">';
                        html+='$ <input data-businessprofilename="" type="number" value="" name="propose_price" class="propose_price" />';
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
                // var admin_user_image= "{{asset('storage')}}"+'/'+"images/merchantbay_admin/profile/uG2WX6gF2ySIX3igETUVoSy8oqlJ12Ff6BmD8K64.jpg";
                // var msgHtml = '<div class="chat chat-right">';
                //     msgHtml += '<div class="chat-avatar">';
                //     msgHtml += '<a class="avatar">';
                //     msgHtml += '<img src="'+admin_user_image+'" class="circle" alt="avatar">';
                //     msgHtml += '</a>';
                //     msgHtml += '</div>';
                //     msgHtml += '<div class="chat-body left-align">';
                //     msgHtml += '<div class="chat-text">';
                //     msgHtml += '<p>'+msg+'</p>';
                //     msgHtml += '</div>';
                //     msgHtml += '</div>';
                //     msgHtml += '</div>';
                    $('#messagebox').val('');
                //     $('.chats-box').append(msgHtml);
                    $(".chat-area").animate({ scrollTop:$('#messagedata').prop("scrollHeight")});
            });

            socket.on('new message', function(data) {
                var msgHtml = '<div class="chat chat-left">';
                    msgHtml += '<div class="chat-avatar">';
                    msgHtml += '<a class="avatar">';
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
@extends('layouts.app')


@push('js')
    <!--script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script-->
 <script>
      function extractEmails (text) {
            return text.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi);
        }

         $( document ).ready(function() {
            $('#messageCenterLoaderOuter').show();
            $('#allchatter').children().eq(0).click();
            var serverURL ="{{ env('CHAT_URL'), 'localhost' }}:4000";
            var socket = io(serverURL, { transports : ['websocket'] });
            socket.on('connect', function(data) {
                console.log('connect');
                var selectedBusinessId = "{{ Request::get('bid') }}";
                var selectedUserId = "{{ Request::get('uid') }}";
                if(selectedBusinessId > 0)
                {
                    $('#allchatter').children('div.all-chatter-div').each(function()
                    {
                        if($(this).data('businessid') == selectedBusinessId) {

                            $(this).addClass('active');
                            $(this).click();
                            message_userid = $(this).data("userid");
                            message_businessid = $(this).data("businessid");

                            var s = new Array;
                            var i = 0;
                            var x = $("#allchatter .all-chatter-div").length;

                            $("#allchatter .all-chatter-div").each( function() {
                                s[i] = $(this).data("businessid");
                                i++;
                            });
                            var g = s.sort(function(a,b){return a-b});
                            for(var c = 0; c < x; c++) {
                                var div = g[c];
                                var d = $("#allchatter .all-chatter-div[data-businessid="+selectedBusinessId+"]").clone();
                                var s = $("#allchatter .all-chatter-div[data-businessid="+selectedBusinessId+"]").remove();
                                $("#allchatter").prepend(d);
                            }

                        }
                    });
                    $('#allchatter').children('div.all-chatter-div').click(function()
                    {
                        $('#allchatter').children('div.all-chatter-div').removeClass('active');
                        $(this).addClass('active');
                        $('.generate-po-btn').attr("href", "{{ env('APP_URL') }}/po/add/toid="+$(this).data('toid'));
                        message_userid = $(this).data("userid");
                        message_businessid = $(this).data("businessid");
                    });
                }

                if(selectedUserId > 0)
                {
                    $('#allchatter').children('div.all-chatter-div').each(function()
                    {
                        if($(this).data('userid') == selectedUserId) {

                            $(this).addClass('active');
                            $(this).click();
                            message_userid = $(this).data("userid");
                            message_businessid = $(this).data("businessid");

                            var s = new Array;
                            var i = 0;
                            var x = $("#allchatter .all-chatter-div").length;

                            $("#allchatter .all-chatter-div").each( function() {
                                s[i] = $(this).data("businessid");
                                i++;
                            });
                            var g = s.sort(function(a,b){return a-b});
                            for(var c = 0; c < x; c++) {
                                var div = g[c];
                                var d = $("#allchatter .all-chatter-div[data-businessid="+selectedUserId+"]").clone();
                                var s = $("#allchatter .all-chatter-div[data-businessid="+selectedUserId+"]").remove();
                                $("#allchatter").prepend(d);
                            }

                        }
                    });

                    $('#allchatter').children('div.all-chatter-div').click(function()
                    {
                        $('#allchatter').children('div.all-chatter-div').removeClass('active');
                        $(this).addClass('active');
                        $('.generate-po-btn').attr("href", "{{ env('APP_URL') }}/po/add/toid="+$(this).data('toid'));
                        message_userid = $(this).data("userid");
                        message_businessid = $(this).data("businessid");
                    });
                }

                $('#allchatter').children('div.all-chatter-div').click(function()
                {
                    $('#allchatter').children('div.all-chatter-div').removeClass('active');
                    $(this).addClass('active');
                    message_userid = $(this).data("userid");
                    message_businessid = $(this).data("businessid");
                })

            });
            //keypress
            $('#messagebox').keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                var type= $('#type').val();
                var user_id=$('#user_id').val();
                var business_id=$('#business_id').val();
                if(type == 'buyer'){
                    var from_user_id=user_id;
                    var from_business_id=null;
                     var check_exists_image= "{{$user->image}}";
                    if(check_exists_image){
                        var image= "{{asset('storage')}}"+'/'+"{{$user->image}}";
                    }else{
                        var image= "{{asset('storage')}}"+'/'+"images/supplier.png";
                    }
                }else{
                    var from_user_id=null;
                    var from_business_id=business_id;
                    var image = $('#b_image').val();
                }

                if(keycode == '13'){
                    var intRegex = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
                    if( intRegex.test($('#messagebox').val()) || extractEmails($('#messagebox').val()) )
                    {
                        alert('You will not be able to share any phone number or email address.');
                        return false;
                    }
                    event.preventDefault();
                    let message = {'message' : $('#messagebox').val(), 'image': "", 'user_id' : user_id, 'business_id' : business_id,'from_user_id' : from_user_id, 'from_business_id' : from_business_id , 'product' : null};
                    socket.emit('new message', message);
                    $('#messagebox').val('');
                        $('#messagedata').append('<div class="chat chat-right"><div class="chat-avatar"><a class="avatar"><img src="'+image+'" class="circle" alt="avatar"></a></div><div class="chat-body left-align"><div class="chat-text"><p>'+message.message+'</p></div></div></div>');
                    var height = 0;
                    $('#messagedata div').each(function(i, value){
                        height += parseInt($(this).height());
                    });

                    height += '';

                    $('.chat-area').animate({scrollTop: (height + 10)});

                    updateUserLastActivityByReceiverBusinessId( user_id, business_id );


                    // var message_notification_form_id = "{{Auth::user()->id}}";
                    // var message_notification_to_id = "{{Request::get('uid')}}";
                    // var csrftoken = $("[name=_token]").val();

                    // data_json = {
                    //     "message_notification_form_id": message_notification_form_id,
                    //     "message_notification_to_id": message_notification_to_id,
                    //     "csrftoken": csrftoken
                    // }
                    // var url = '{{route("message.center.notification.user")}}';
                    // jQuery.ajax({
                    //     method: "POST",
                    //     url: url,
                    //     headers:{
                    //         "X-CSRF-TOKEN": csrftoken
                    //     },
                    //     data: data_json,
                    //     dataType:"json",

                    //     success: function(data){
                    //         console.log(data);
                    //     }
                    // });
                }
            });
            //sendbutton click
            $('.messageSendButton').click(function(){
                var type= $('#type').val();
                var user_id=$('#user_id').val();
                var business_id=$('#business_id').val();
                if(type == 'buyer'){
                    var from_user_id=user_id;
                    var from_business_id=null;
                    var check_exists_image= "{{$user->image}}";
                    if(check_exists_image){
                        var image= "{{asset('storage')}}"+'/'+"{{$user->image}}";
                    }else{
                        var image= "{{asset('storage')}}"+'/'+"images/supplier.png";
                    }

                }else{
                    var from_user_id=null;
                    var from_business_id=business_id;
                    var image = $('#b_image').val();
                }

                var intRegex = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
                if( intRegex.test($('#messagebox').val()) || extractEmails($('#messagebox').val()) )
                {
                    alert('You will not be able to share any phone number or email address.');
                    return false;
                }
                event.preventDefault();

                let message = {'message' : $('#messagebox').val(), 'image': "", 'user_id' : user_id, 'business_id' : business_id, 'from_user_id': from_user_id , 'from_business_id': from_business_id, 'product' : null};
                socket.emit('new message', message);
                $('#messagebox').val('');
                $('#messagedata').append('<div class="chat chat-right"><div class="chat-avatar"><a class="avatar"><img src="'+image+'" class="circle" alt="avatar"></a></div><div class="chat-body left-align"><div class="chat-text"><p>'+message.message+'</p></div></div></div>');
                var height = 0;
                $('#messagedata div').each(function(i, value){
                    height += parseInt($(this).height());
                });

                height += '';
                $('.chat-area').animate({scrollTop: (height + 10)});

                //send push notification after sending message
                if(type == "buyer"){
                    data_json = {
                            "user_id": user_id,
                            "business_id":business_id,
                            "message":message.message,
                            "type":"buyer",
                            "csrftoken": csrftoken
                        }

                }
                else{
                     //push notification json data 
                     data_json = {
                        "user_id": user_id,
                        "business_id":business_id,
                        "message":message.message,
                        "type":"supplier",
                        "csrftoken": csrftoken
                    }

                }
               
                var csrftoken = $("[name=_token]").val();
                var url='{{route("message.center.send.push.notification")}}';
                    jQuery.ajax({
                        method: "POST",
                        url: url,
                        headers:{
                            "X-CSRF-TOKEN": csrftoken
                        },
                        data: data_json,
                        dataType:"json",

                        success: function(response){
                            console.log(response);
                        }
                    });


               // updateUserLastActivity( message_formid, message_toid );
            });

            //socket on
            socket.on('new message', function(data) {
            
                console.log(data);
                var selectedBusinessIdFromUrl = "{{ Request::get('bid') }}";
                var selectedUserIdFromUrl = "{{ Request::get('uid') }}";
                if(data.from_business_id !=null){
                    var sender_buisness_id = data.from_business_id;
                    $('.chat-user').each(function() {
                        if($(this).data('businessid') == sender_buisness_id){
                            $(this).css("background-color", "red");
                             
                        }
                    })

                    var s = new Array;
                    var i = 0;
                    var x = $("#allchatter .chat-user").length;
                    
                    $("#allchatter .chat-user").each( function() {
                        s[i] = $(this).data("businessid");
                        i++;
                    });
                    var g = s.sort(function(a,b){return a-b});
                    for(var c = 0; c < x; c++) {
                        var div = g[c];
                        var d = $("#allchatter .chat-user[data-businessid="+sender_buisness_id+"]").clone();
                        var s = $("#allchatter .chat-user[data-businessid="+sender_buisness_id+"]").remove();
                        $("#allchatter").prepend(d);
                    } 
                    

                }
                else{
                    var sender_user_id = data.from_user_id;
                    $('.chat-user').each(function() {
                        if($(this).data('userid') == sender_user_id){
                            $(this).css("background-color", "red");
                        }
                    })
                }
                
               

                if(data.from_user_id != null){
                    var check_exists_image= "{{$user->image}}";
                    if(check_exists_image){
                        var image= "{{asset('storage')}}"+'/'+"{{$user->image}}";
                    }else{
                        var image= "{{asset('storage')}}"+'/'+"images/supplier.png";
                    }
                }else{
                    var image = $('#b_image').val();
                }

                if(data.user_id == $('#user_id').val() && data.business_id == $('#business_id').val())
                {
                    let msg = "";
                    if(data.product != null)
                    {
                        msg = '<div class="col-md-8 rgt-cb"><div class="clear10"></div><div class="col-md-4"><div class="row- prd-lt-con-gr"> <img src="'+data.product.imageurl+'" class="prd-lt-con-gr-img-bdr"></div><div class="row cer-ctxt2">Product ID: '+data.product.id+'</div></div><div class="col-md-8" style="border-left:1px solid #ddd;"><div class="col-md-12 plr0 prdd-bbg"><div class="col-md-12"><div class="row prd-lt-con-list"><div class="col-md-6 plr0">Product Name</div><div class="col-md-6 pr0">: '+data.product.name+'</div></div></div><div class="col-md-12"><div class="row prd-lt-con-list"><div class="col-md-6 plr0">Category</div><div class="col-md-6 pr0">: '+data.product.category+'</div></div></div><div class="col-md-12"><div class="row prd-lt-con-list"><div class="col-md-6 plr0">Min Quantity</div><div class="col-md-6 pr0">: '+data.product.moq+' Pcs</div></div></div><div class="col-md-12"><div class="row prd-lt-con-list bbdis"><div class="col-md-6 plr0">Unit Price</div><div class="col-md-6 pr0">: USD $'+data.product.price+'</div></div></div></div><div class="col-md-12 plr0 prd-gr" style="background: #55a860;font-size: 14px;color: #fff;padding: 10px;border-radius: 4px;margin-top: 10px;"> Greetings,<div class="clear10"></div><p>'+data.message+'</P></div></div><div class="col-md-12"><div class="byr-pb-ld text-right">Just Now</div></div></div>';
                    }
                    else
                    {
                        msg= '<div class="chat"><div class="chat-avatar"><a class="avatar"><img src="'+image+'" class="circle" alt="avatar"></a></div><div class="chat-body left-align"><div class="chat-text"><p>'+data.message+'</p> </div></div><p>Just Now</p></div>';
                    }
                    $('#messagedata').append(msg);
                    var height = 0;
                    $('#messagedata div').each(function(i, value){
                        height += parseInt($(this).height());
                    });

                    height += '';

                    $('.chat-area').animate({scrollTop: (height + 10)});

                }
            });

         });

         window.onload = () => {
            setTimeout(() => {
                $('#messageCenterLoaderOuter').hide();
            }, 2500)
        }

        function getchatdata(user_id, business_id, image, name, type)
        {
            var param = 'user_id='+user_id+'&business_id='+business_id;
            var url='{{route("message.center.getchatdata")}}';
            jQuery.ajax({
                type : "POST",
                data : param,
                url : url,
                cache : false,
                beforeSend: function(){
                },
                complete: function(){
                },
                success : function(msg){
                    $('#user_id').val(user_id);
                    $('#business_id').val(business_id);
                    $('#type').val(type);
                    $('#b_image').val(image);
                    $("#messagedata").html(msg);
                    $("#messagebox").removeAttr("disabled");
                    $("#chatheader").html('<div class="row valign-wrapper"><div class="col media-image online pr-0"><img src="'+image+'" alt="" class="circle z-depth-2 responsive-img"></div><div class="col"><p class="m-0 blue-grey-text text-darken-4 font-weight-700 left-align">'+name+'</p><p class="m-0 chat-text truncate"></p></div></div>');
                    // $("#chatheader").css('border-bottom', '2px solid #55A860');
                    // $("#messagedata").animate({ scrollTop: $('#messagedata').prop("scrollHeight")});
                    $(".chat-area").animate({ scrollTop:$('#messagedata').prop("scrollHeight")});

                }
            });
        }

        window.onload = () => {
            setTimeout(() => {
                $('#messageCenterLoaderOuter').hide();
            }, 2500)
        }

        function updateUserLastActivity(form_id, to_id)
        {
            var form_id = form_id;
            var to_id = to_id;
            var csrftoken = $("[name=_token]").val();

            data_json = {
                "form_id": form_id,
                "to_id": to_id,
                "csrftoken": csrftoken
            }
            var url='{{route("message.center.update.user.last.activity")}}';
            jQuery.ajax({
                method: "POST",
                url: url,
                headers:{
                    "X-CSRF-TOKEN": csrftoken
                },
                data: data_json,
                dataType:"json",

                success: function(data){
                    console.log(data);
                }
            });

        }
        function updateUserLastActivityByReceiverBusinessId(form_id, to_business_id)
        {
            var form_id = form_id;
            var to_business_id = to_business_id;
            var csrftoken = $("[name=_token]").val();

            data_json = {
                "form_id": form_id,
                "to_business_id": to_business_id,
                "csrftoken": csrftoken
            }
            var url='{{route("message.center.update.user.last.activity.by.business.id")}}';
            jQuery.ajax({
                method: "POST",
                url: url,
                headers:{
                    "X-CSRF-TOKEN": csrftoken
                },
                data: data_json,
                dataType:"json",

                success: function(data){
                    console.log(data);
                }
            });

        }

    </script>
@endpush

@section('content')
<div class="main_wrapper home_wrap">

    <!-- Main Container start -->
    <div class="container">
      <div class="chatting_app_wrapper">
        <div class="chat-application">
          <div class="app-chat">
            <div class="content-area content-right">
              <div class="app-wrapper">
                <!-- Sidebar menu for small screen -->
                <a href="#" data-target="chat-sidenav" class="sidenav-trigger hide-on-large-only">
                  <i class="material-icons">menu</i>
                </a>
                <!--/ Sidebar menu for small screen -->

                <div class="card card card-default scrollspy border-radius-6 fixed-width">
                  <div class="card-content chat-content p-0">
                    <!-- Sidebar Area -->
                    <div class="sidebar-left sidebar-fixed animate fadeUp animation-fast messagedata_leftbar">
                      <div class="sidebar animate fadeUp">
                        <div class="sidebar-content">
                          <div id="sidebar-list" class="sidebar-menu chat-sidebar list-group position-relative">
                            <div class="sidebar-list-padding app-sidebar" id="chat-sidenav">
                              <!-- Sidebar Header -->
                              <div class="sidebar-header">
                                {{-- <div class="row valign-wrapper">
                                  <div class="col s2 media-image pr-0">
                                    <img src="../images/img.jpg" alt="" class="circle z-depth-2 responsive-img">
                                  </div>
                                  <div class="col s10">
                                    <p class="m-0 blue-grey-text text-darken-4 font-weight-700 left-align">Users </p>
                                    <p class="m-0 info-text left-align">Currently online</p>
                                  </div>
                                </div> --}}
                                 <!-- Dropdown Trigger -->
                                @if($user_business_profile->isNotEmpty())
                                    <form action="{{route('message.center')}}" method="get">
                                        <div class="input-field">
                                            <label>Business</label>
                                            <select class="select2 select-business" name="business_id">
                                              <option value="" disabled selected>Choose your option</option>
                                              @foreach ($user_business_profile as $profile)
                                                <option value="{{$profile->id}}" {{ Request::get('business_id') == $profile->id ? 'selected' : '' }}>{{$profile->business_name}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </form>
                                @endif
                                <a href="{{route('message.center')}}">buyer</a>
                              </div>
                              <!--/ Sidebar Header -->

                              <!-- Sidebar Content List -->
                              <div class="sidebar-content sidebar-chat ps ps--active-y">
                                @if(count($chatusers) > 0)
                                    <div class="chat-list" id="allchatter">
                                        @foreach($chatusers as $cuser)
                                            {{-- <div class="chat-user animate fadeUp delay-1 all-chatter-div" data-formid="{{$user->id}}" data-toid="{{$cuser->id}}" onclick="$('#to_id').val('{{$cuser->id}}');getchatdata('{{$user->id}}','{{$cuser->id}}', '{{ asset($src) }}', '{{ $cuser->name }}', '08 September 2020')" style="cursor: pointer;"> --}}
                                                @if($type== 'buyer')
                                                    <div class="chat-user animate fadeUp delay-1 all-chatter-div" data-userid="{{$user->id}}" data-businessid="{{$cuser['business_id']}}" onclick="getchatdata('{{$user->id}}','{{$cuser['business_id']}}', '{{ $cuser['image'] }}', '{{ $cuser['name'] }}','{{$type}}')" style="cursor: pointer;">
                                                @elseif($type== 'business')
                                                    <div class="chat-user animate fadeUp delay-1 all-chatter-div" data-userid="{{$cuser['user_id']}}" data-businessid="{{$cuser['business_id']}}" onclick="getchatdata('{{$cuser['user_id']}}','{{$cuser['business_id']}}', '{{ $cuser['image'] }}', '{{ $cuser['name'] }}', '{{$type}}')" style="cursor: pointer;">
                                                @endif
                                                <div class="user-section">
                                                    <div class="row valign-wrapper">
                                                        <div class="col s2 media-image online pr-0">
                                                        <img src="{{ $cuser['image'] }}" alt="" class="circle z-depth-2 responsive-img">
                                                        </div>
                                                        <div class="col s10">
                                                        <p class="m-0 blue-grey-text text-darken-4 font-weight-700 left-align ">{{ $cuser['name'] }}</p>
                                                        <p class="m-0 info-text"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="info-section">
                                                    <div class="star-timing">
                                                        <div class="time">
                                                        {{-- <span>{{ date('F j, Y, g:i a', strtotime($cuser->last_activity)) }}</span> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="no-data-found">
                                        <h6 class="center">No Results Found</h6>
                                    </div>
                                @endif
                              <div class="ps__rail-x" style="left: 0px; bottom: -236px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 236px; height: 356px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 142px; height: 213px;"></div></div></div>
                              <!--/ Sidebar Content List -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--/ Sidebar Area -->

                    <!-- Content Area -->
                    <div class="chat-content-area animate fadeUp messagedata_content_wrap">
                      <!-- Chat header -->
                      <div class="chat-header" id="chatheader">

                      </div>
                      @if(auth()->check() && auth()->user()->businessProfile()->exists() && Request::get('uid'))
                            {{-- <a href="{{ env('APP_URL') }}po/add/toid={{ Request::get('uid') }}" class="btn btn-success generate-po-btn" style="position: absolute; top: 25px; right: 20px;border: 1px solid #398439;">Generate Pro-Forma Invoice</a> --}}
                            <a href="{{route('po.add',Request::get('uid'))}}" class="btn_green btn-success generate-po-btn" style="position: absolute; top: 25px; right: 20px;border: 1px solid #398439;">Generate Pro-Forma Invoice</a>

                      @endif
                      <!--/ Chat header -->

                      <!-- Chat content area -->
                      <div class="chat-area ps ps--active-y">
                        <div class="chats">
                          <div class="chats chat_messagedata" id="messagedata">


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

                        <!-- <form onsubmit="enter_chat();" action="javascript:void(0);" class="chat-input"> -->
                        <form class="chat-input">
                          <i class="material-icons mr-2">face</i>
                          <i class="material-icons mr-2">attachment</i>
                          <input type="text" placeholder="Type message here.." class="message mb-0" id="messagebox">
                          <input type="hidden" id="user_id" value="">
                          <input type="hidden" id="business_id" value="">
                          <input type="hidden" id="type" value="">
                          <input type="hidden" id="b_image" value="">
                          <a class="btn_green send messageSendButton" >Send</a>
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
     <!-- Main Container end -->



  </div>
@endsection

@push('js')
    <script src="{{ asset('js/jquery.tinyscrollbar.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".scrollabled").each(function(){
                $(this).tinyscrollbar();
            });
        });

        $('.select-business').change(function ()
        {
            $(this).closest('form').submit();
        });
    </script>
@endpush

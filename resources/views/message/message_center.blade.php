@extends('layouts.app')
@section('content')
<div class="main_wrapper home_wrap">
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
                                                                <div class="row valign-wrapper">
                                                                <div class="col s2 media-image pr-0">
                                                                    <img src="../images/img.jpg" alt="" class="circle z-depth-2 responsive-img">
                                                                </div>
                                                                <div class="col s10">
                                                                    <p class="m-0 blue-grey-text text-darken-4 font-weight-700 left-align">RFQ</p>
                                                                    <p class="m-0 info-text left-align">Currently online</p>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <!--/ Sidebar Header -->

                                                            <!-- Sidebar Content List -->
                                                            <div class="sidebar-content sidebar-chat ps ps--active-y">
                                                                @if(count($rfqs) > 0)
                                                                    <div class="chat-list" id="allchatter">
                                                                        @foreach($rfqs as $key=>$rfq)
                                                                            <div class="chat-user animate fadeUp delay-1 all-chatter-div select-rfq-for-chat-data  {{ ( $key == 0 ) ? 'active' : ''  }}" data-formid="{{$rfq['created_by']}}" data-toid="{{$adminUser}}" data-rfqid="{{ $rfq['id'] }}"  style="cursor: pointer;">
                                                                                <div class="user-section">
                                                                                    <div class="row valign-wrapper">
                                                                                        <div class="col s12">
                                                                                            <p class="m-0 blue-grey-text text-darken-4 font-weight-700 left-align ">{{ $rfq['id'] }}</p>
                                                                                            <p class="m-0 info-text"></p>
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
                                        <!--/ Chat header -->
                                        <!-- Chat content area -->
                                        <div class="chat-area ps ps--active-y">
                                            <div class="chats">
                                                <div class="chats-box chat_messagedata" id="messagedata">
                                                    @if($chatdata)
                                                        @foreach($chatdata as $chat)
                                                            @if($chat['from_id'] == auth()->user()->sso_reference_id)
                                                            <div class="chat chat-right">
                                                                <div class="chat-avatar">
                                                                    <a class="avatar">
                                                                        <img src="{{asset('storage/'.auth()->user()->image)}}" class="circle" alt="avatar">
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
                                                                        <img src="{{$adminUserImage??asset('images/frontendimages/no-image.png')}}" class="circle" alt="avatar">
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
                                            <!-- <form onsubmit="enter_chat();" action="javascript:void(0);" class="chat-input"> -->
                                            <form class="chat-input">
                                            <i class="material-icons mr-2">face</i>
                                            <i class="material-icons mr-2">attachment</i>
                                            <input type="text" placeholder="Type message here.." class="message mb-0" id="messagebox">
                                            <input type="hidden" id="to_id" value="">
                                            <a class="btn_green send messageSendButton" >Send</a>
                                            <input type="hidden" name="rfq_id" class="active_rfq_id" value="{{ $rfqs[0]['id'] }}" />
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
            var serverURL = "{{ env('CHAT_URL') }}?userId=5552";
            var socket = io.connect(serverURL);
            socket.on('connect', function(data) {
                console.log("Socket Connect successfully.");
            });

            socket.on('new message', function(data) {
               
            });

            $('.messageSendButton').click(function(){
                event.preventDefault();
                var from_user_image = '{{$userImage}}';
                let sent_message = $('#messagebox').val();
                
                    let message = {'message': sent_message, 'image': "", 'from_id' : "1", 'to_id' : '5552', 'rfq_id': $(".active_rfq_id").val(),'factory':true,'product': null};
                    socket.emit('new message', message);
                    var from_user_image = '{{$userImage}}';
                    var msgHtml = '<div class="chat chat-right">';
                        msgHtml += '<div class="chat-avatar">';
                        msgHtml += '<a class="avatar">';
                        msgHtml += '<img src="'+from_user_image+'" class="circle" alt="avatar">';
                        msgHtml += '</a>';
                        msgHtml += '</div>';
                        msgHtml += '<div class="chat-body left-align">';
                        msgHtml += '<div class="chat-text">';
                        msgHtml += '<p>'+sent_message+'</p>';
                        msgHtml += '</div>';
                        msgHtml += '</div>';
                        msgHtml += '</div>';
                        $('.chats-box').append(msgHtml);
                        $('#messagebox').val('');
                        $(".chat-area").animate({ scrollTop:$('#messagedata').prop("scrollHeight")});
            });    

            function extractEmails (text) {
                return text.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi);
            }

            $('.select-rfq-for-chat-data').click(function() {
                $(".select-rfq-for-chat-data").removeClass("active");
                $(this).addClass("active");
                var url='{{route("message.center.getchatdata")}}';
                var rfq_id =  $(this).data("rfqid");
                var user_id = {{auth()->user()->sso_reference_id}};
                $(".active_rfq_id").val(rfq_id);
                jQuery.ajax({
                    type : "POST",
                    data : {'rfq_id':rfq_id},
                    url : url,
                    success : function(response){
                        console.log(response);
                        $(".chats-box").empty();
                        $("#messagebox").removeAttr("disabled");
                        response.chatdata.forEach((item, index)=>{
                            if(item.from_id == user_id ){
                                var msgHtml = '<div class="chat chat-right">';
                                msgHtml += '<div class="chat-avatar">';
                                msgHtml += '<a class="avatar">';
                                msgHtml += '<img src="'+response.from_user_image+'" class="circle" alt="avatar">';
                                msgHtml += '</a>';
                                msgHtml += '</div>';
                                msgHtml += '<div class="chat-body left-align">';
                                msgHtml += '<div class="chat-text">';
                                msgHtml += '<p>'+item.message+'</p>';
                                msgHtml += '</div>';
                                msgHtml += '</div>';
                                msgHtml += '</div>';
                            }else{
                                var msgHtml = '<div class="chat chat-left">';
                                msgHtml += '<div class="chat-avatar">';
                                msgHtml += '<a class="avatar">';
                                msgHtml += '<img src="'+response.to_user_image+'" class="circle" alt="avatar">';
                                msgHtml += '</a>';
                                msgHtml += '</div>';
                                msgHtml += '<div class="chat-body left-align">';
                                msgHtml += '<div class="chat-text">';
                                msgHtml += '<p>'+item.message+'</p>';
                                msgHtml += '</div>';
                                msgHtml += '</div>';
                                msgHtml += '</div>';
                            }
                           
                            $('.chats-box').append(msgHtml);
                        })
                        $("#chatheader").html('<div class="row valign-wrapper"><div class="col media-image online pr-0"><img src="'+response.to_user_image+'" alt="" class="circle z-depth-2 responsive-img"></div><div class="col"><p class="m-0 blue-grey-text text-darken-4 font-weight-700 left-align">Merchant bAY</p><p class="m-0 chat-text truncate"></p></div></div>');
                        $(".chat-area").animate({ scrollTop:$('#messagedata').prop("scrollHeight")});

                    }
                });

            });

                
        });
           
    </script>
@endpush

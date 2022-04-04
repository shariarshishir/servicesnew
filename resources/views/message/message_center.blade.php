@extends('layouts.app')
@push('js')
 <script>
        $( document).ready(function() {
            var serverURL = "{{ env('CHAT_URL') }}?userId=5552";
            var socket = io.connect(serverURL);
                socket.on('connect', function(data) {
            });
            $('.messageSendButton').click(function(){
                event.preventDefault();
                //let message = {'message' : $('#messagebox').val(), 'image': "", 'from_id' : "{{$user->id}}", 'to_id' : $('#to_id').val(), 'product' : null};
                let message = {'message': $('#messagebox').val(), 'image': "", 'from_id' : "1", 'to_id' : '5552', 'rfq_id': "19b7c320-b3c7-11ec-9015-c14cf8f032b4",'factory':true,'product': null};
                socket.emit('new message', message);
                $('#messagebox').val('');
                $('#messagedata').append('<div class="col-md-offset-3 col-md-8 rgt-cbb"><p class="prd-gr2">'+message.message+'</P><div class="col-md-12" style="color:#55A860;"><div class="byr-pb-ld text-right">Just Now</div></div></div>');
                var height = 0;
                $('#messagedata div').each(function(i, value){
                    height += parseInt($(this).height());
                });
                height += '';
                // $('#messagedata').animate({scrollTop: (height + 10)});
                $('.chat-area').animate({scrollTop: (height + 10)});
            });    
            function extractEmails (text) {
                return text.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi);
            }
        });
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
                                <div class="row valign-wrapper">
                                  <div class="col s2 media-image pr-0">
                                    <img src="../images/img.jpg" alt="" class="circle z-depth-2 responsive-img">
                                  </div>
                                  <div class="col s10">
                                    <p class="m-0 blue-grey-text text-darken-4 font-weight-700 left-align">Users </p>
                                    <p class="m-0 info-text left-align">Currently online</p>
                                  </div>
                                </div>
                              </div>
                              <!--/ Sidebar Header -->

                              <!-- Sidebar Content List -->
                              <div class="sidebar-content sidebar-chat ps ps--active-y">
                                @if(count($rfqs) > 0)
                                    <div class="chat-list" id="allchatter">
                                        @foreach($rfqs as $rfq)
                                            <div class="chat-user animate fadeUp delay-1 all-chatter-div select-rfq-for-chat-data" data-formid="{{$rfq['created_by']}}" data-toid="5552" data-rfqid="{{ $rfq['id'] }}"  style="cursor: pointer;">
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
                      @if(auth()->check() && auth()->user()->businessProfile()->exists() && Request::get('uid'))
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
                          <input type="hidden" id="to_id" value="">
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

            $('.select-rfq-for-chat-data')on('click',function() {
                alert('hi');
                var rfq_id = rfq_id ;
                var url='{{route("message.center.getchatdata")}}';
                jQuery.ajax({
                    type : "POST",
                    data : rfq_id,
                    url : url,
                    cache : false,
                    beforeSend: function(){
                    },
                    complete: function(){
                    },
                    success : function(msg){
                        $("#messagedata").html(msg);
                        $("#messagebox").removeAttr("disabled");
                        $("#chatheader").html('<div class="row valign-wrapper"><div class="col media-image online pr-0"><img src="'+image+'" alt="" class="circle z-depth-2 responsive-img"></div><div class="col"><p class="m-0 blue-grey-text text-darken-4 font-weight-700 left-align">'+name+'</p><p class="m-0 chat-text truncate"></p></div></div>');
                        // $("#chatheader").css('border-bottom', '2px solid #55A860');
                        // $("#messagedata").animate({ scrollTop: $('#messagedata').prop("scrollHeight")});
                        $(".chat-area").animate({ scrollTop:$('#messagedata').prop("scrollHeight")});

                    }
                });

            });
                
        });


    </script>
@endpush

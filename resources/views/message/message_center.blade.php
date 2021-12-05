@extends('layouts.app')


@push('js')
    <!--script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script-->
    <script>

        function extractEmails (text) {
            return text.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi);
        }
        var message_formid;
        var message_toid;
        $( document ).ready(function() {
            $('#messageCenterLoaderOuter').show();
            $('#allchatter').children().eq(0).click();
            var allbuyers = @json($buyers);
            var serverURL = "{{ env('CHAT_URL'), 'localhost' }}:3000";
            var socket = io.connect(serverURL);
            socket.on('connect', function(data) {
                var selectedSupplierId = "{{ Request::get('uid') }}";
                if(selectedSupplierId > 0)
                {
                    $('#allchatter').children('div.col-md-12').each(function()
                    {
                        if($(this).data('toid') == selectedSupplierId) {
                            $(this).addClass('active');
                            $(this).click();
                            message_formid = $(this).data("formid");
                            message_toid = $(this).data("toid");

                            var s = new Array;
                            var i = 0;
                            var x = $("#allchatter .col-md-12").length;

                            $("#allchatter .col-md-12").each( function() {
                                s[i] = $(this).data("toid");
                                i++;
                            });
                            var g = s.sort(function(a,b){return a-b});
                            for(var c = 0; c < x; c++) {
                                var div = g[c];
                                var d = $("#allchatter .col-md-12[data-toid="+selectedSupplierId+"]").clone();
                                var s = $("#allchatter .col-md-12[data-toid="+selectedSupplierId+"]").remove();
                                $("#allchatter").prepend(d);
                            }
                        }
                    });

                    $('#allchatter').children('div.col-md-12').click(function()
                    {
                        $('#allchatter').children('div.col-md-12').removeClass('active');
                        $(this).addClass('active');
                        $('.generate-po-btn').attr("href", "{{ env('APP_URL') }}/po/add/toid="+$(this).data('toid'));
                        message_formid = $(this).data("formid");
                        message_toid = $(this).data("toid");
                    });
                }
                $('#allchatter').children('div.col-md-12').click(function()
                {
                    $('#allchatter').children('div.col-md-12').removeClass('active');
                    $(this).addClass('active');
                    message_formid = $(this).data("formid");
                    message_toid = $(this).data("toid");
                })

            });
            $('#messagebox').keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    var intRegex = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
                    if( intRegex.test($('#messagebox').val()) || extractEmails($('#messagebox').val()) )
                    {
                        alert('You will not be able to share any phone number or email address.');
                        return false;
                    }
                    event.preventDefault();
                    let message = {'message' : $('#messagebox').val(), 'image': "", 'from_id' : "{{$user->id}}", 'to_id' : $('#to_id').val(), 'product' : null};
                    socket.emit('new message', message);
                    $('#messagebox').val('');
                    $('#messagedata').append('<div class="col-md-offset-3 col-md-8 rgt-cbb"><p class="prd-gr2">'+message.message+'</P><div class="col-md-12" style="color:#55A860;"><div class="byr-pb-ld text-right">Just Now</div></div></div>');
                    var height = 0;
                    $('#messagedata div').each(function(i, value){
                        height += parseInt($(this).height());
                    });

                    height += '';

                    $('#messagedata').animate({scrollTop: (height + 10)});

                    updateUserLastActivity( message_formid, message_toid );

                    var message_notification_form_id = "{{Auth::user()->id}}";
                    var message_notification_to_id = "{{Request::get('uid')}}";
                    var csrftoken = $("[name=_token]").val();

                    data_json = {
                        "message_notification_form_id": message_notification_form_id,
                        "message_notification_to_id": message_notification_to_id,
                        "csrftoken": csrftoken
                    }

                    jQuery.ajax({
                        method: "POST",
                        url: "/message-center/notificationforuser",
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
            });
            $('.messageSendButton').click(function(){
                var intRegex = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
                if( intRegex.test($('#messagebox').val()) || extractEmails($('#messagebox').val()) )
                {
                    alert('You will not be able to share any phone number or email address.');
                    return false;
                }
                event.preventDefault();
                let message = {'message' : $('#messagebox').val(), 'image': "", 'from_id' : "{{$user->id}}", 'to_id' : $('#to_id').val(), 'product' : null};
                socket.emit('new message', message);
                $('#messagebox').val('');
                $('#messagedata').append('<div class="col-md-offset-3 col-md-8 rgt-cbb"><p class="prd-gr2">'+message.message+'</P><div class="col-md-12" style="color:#55A860;"><div class="byr-pb-ld text-right">Just Now</div></div></div>');
                var height = 0;
                $('#messagedata div').each(function(i, value){
                    height += parseInt($(this).height());
                });

                height += '';

                $('#messagedata').animate({scrollTop: (height + 10)});

                updateUserLastActivity( message_formid, message_toid );
            });
            socket.on('new message', function(data) {
                console.log(data);
                if(data.to_id == "{{$user->id}}" && data.from_id == $('#to_id').val())
                {
                    let msg = "";
                    if(data.product != null)
                    {
                        msg = '<div class="col-md-8 rgt-cb"><div class="clear10"></div><div class="col-md-4"><div class="row- prd-lt-con-gr"> <img src="'+data.product.imageurl+'" class="prd-lt-con-gr-img-bdr"></div><div class="row cer-ctxt2">Product ID: '+data.product.id+'</div></div><div class="col-md-8" style="border-left:1px solid #ddd;"><div class="col-md-12 plr0 prdd-bbg"><div class="col-md-12"><div class="row prd-lt-con-list"><div class="col-md-6 plr0">Product Name</div><div class="col-md-6 pr0">: '+data.product.name+'</div></div></div><div class="col-md-12"><div class="row prd-lt-con-list"><div class="col-md-6 plr0">Category</div><div class="col-md-6 pr0">: '+data.product.category+'</div></div></div><div class="col-md-12"><div class="row prd-lt-con-list"><div class="col-md-6 plr0">Min Quantity</div><div class="col-md-6 pr0">: '+data.product.moq+' Pcs</div></div></div><div class="col-md-12"><div class="row prd-lt-con-list bbdis"><div class="col-md-6 plr0">Unit Price</div><div class="col-md-6 pr0">: USD $'+data.product.price+'</div></div></div></div><div class="col-md-12 plr0 prd-gr" style="background: #55a860;font-size: 14px;color: #fff;padding: 10px;border-radius: 4px;margin-top: 10px;"> Greetings,<div class="clear10"></div><p>'+data.message+'</P></div></div><div class="col-md-12"><div class="byr-pb-ld text-right">Just Now</div></div></div>';
                    }
                    else
                    {
                        msg = '<div class="col-md-8 rgt-cb"><p class="prd-gr2">'+data.message+'</p><div class="col-md-12" style="color: rgb(85, 168, 96);"><div class="byr-pb-ld text-right">Just Now</div></div></div>';
                    }
                    $('#messagedata').append(msg);
                    var height = 0;
                    $('#messagedata div').each(function(i, value){
                        height += parseInt($(this).height());
                    });

                    height += '';

                    $('#messagedata').animate({scrollTop: (height + 10)});
                }
            });
            @if($user->user_type == "supplier")
                setTimeout(function(){
                    socket.emit('onlinecheck', {'test':'test'});
                }, 2000);
                socket.on('onlineinitiate', function(data) {
                    alert(data);
                });
                socket.on('online', function(data) {
                    var buyers = [];
                    data.forEach(function(item){
                        buyers.push(item.buyer);
                    });
                    var html = '';
                    allbuyers.forEach(function(buyer){
                    });
                    $('#nowonline').html(html);
                });
            @endif
        });

        function changecompany(value)
        {
            location.href = "{{ url('message-center')}}/"+value;
        }

        function getchatdata(user, to_id, image, name, company_name, position, lastchated)
        {
            var param = 'user='+user+'&to_id='+to_id;
            jQuery.ajax({
                type : "POST",
                data : param,
                url : "/message-center/getchatdata",
                cache : false,
                beforeSend: function(){
                },
                complete: function(){
                },
                success : function(msg){
                    $("#messagedata").html(msg);
                    $("#messagebox").removeAttr("disabled");
                    $("#chatheader").html('<div class="col-md-12 plr0" style="color: #FFF;"><div class="byr-pb-nm"><p>'+company_name+'</p><p style="font-size:11px;">In-Chat : '+name+'</p><p style="font-size:13px;font-style:italic;">'+position+'</p></div></div>');
                    $("#chatheader").css('border-bottom', '2px solid #55A860');
                    $("#messagedata").animate({ scrollTop: $('#messagedata').prop("scrollHeight")});
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

            jQuery.ajax({
                method: "POST",
                url: "/message-center/updateuserlastactivity",
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
<div class="col m12">
    <!--Chat Window-->
    <div class="row bu-ob">
        <!--Buyer List Left-->
        <div class="col m4 bu-rb" style="border-right: 0px;">
            <div class="row buyerChatHdCont" style="border-right: 3px solid #FFF;height: 85px;">
                <h6 class="buyerChatHd2">Users Currently Online Now</h6>
            </div>

            <div class="col m12 plr0 lft-cht-cont" id="allchatter">
                <!--1-->
                @foreach($chatusers as $cuser)
                @php
                $src = !empty($cuser->profile['company_logo'])? 'storage/' .$cuser->profile['company_logo'] : "images/supplier.png";
                $userRole = !empty($cuser->profile['personal_info']['job_title'])? $cuser->profile['personal_info']['job_title'] : "";
                @endphp
                {{-- <div class="col m12 chatted_user" data-formid="{{$user->id}}" data-toid="{{$cuser->id}}" onclick="$('#to_id').val('{{$cuser->id}}');getchatdata('{{$user->id}}','{{$cuser->id}}', '{{ asset($src) }}', '{{ $cuser->name }}', '{{ $cuser->profile['company_name'] }}', '{{ $userRole }}', '08 September 2020')" style="cursor: pointer;"> --}}
                <div class="col m12 chatted_user" data-formid="{{$user->id}}" data-toid="{{$cuser->id}}" onclick="$('#to_id').val('{{$cuser->id}}');getchatdata('{{$user->id}}','{{$cuser->id}}', '{{ asset($src) }}', '{{ $cuser->name }}', '08 September 2020')" style="cursor: pointer;">

                    <div class="row byr-ncnt">
                        <div class="col m4 pl0 byr-pb">
                            <img src="{{ asset($src) }}" class="pimg"/>
                        </div>
                        <div class="col m8 plr0">
                            <div class="byr-pb-nm">{{ $cuser->name }}</div>
                            {{-- <div class="byr-pb-dsg">{{ $cuser->profile['personal_info']['job_title'] ?? '' }}</div>
                            <div class="byr-pb-dsg">{{ $cuser->profile['company_name'] ?? '' }}</div> --}}
                            <div class="clear10"></div>
                            <div class="byr-pb-ld user_last_activity">
                                {{ date('F j, Y, g:i a', strtotime($cuser->last_activity)) }}
                            </div>
                        </div>

                    </div>
                </div>
                <!--/1-->
                @endforeach

            </div>
        </div>
        <!--/Buyer List Left-->

        <!--Buyer Chat right-->
        <div class="col m8" style="border-left: 3px solid #55A860;">
            <div class="row buyerChatHdCont"  id="chatheader" style="min-height: 85px;margin-bottom: 20px;">


            </div>
            @if(auth()->check() && in_array(auth()->user()->user_type, ['supplier']) && Request::get('uid'))
            <!--a href="{{ action('PoController@add', Request::get('uid')) }}" class="btn btn-success" style="position: absolute; top: 25px; right: 20px;border: 1px solid #398439;">Generate Pro-Forma Invoice</a-->
            <a href="{{ env('APP_URL') }}/po/add/toid={{ Request::get('uid') }}" class="btn btn-success generate-po-btn" style="position: absolute; top: 25px; right: 20px;border: 1px solid #398439;">Generate Pro-Forma Invoice</a>
            @endif
            <div class="col m12 plr0 rgt-cht-cont" id="messagedata">

            </div>

            <!--Sent Box-->
            <div class="col m12 sent-bx" style="margin-top: 20px;margin-bottom: 20px;">
                <div class="col m9">
                    <input type="text" class="ig-new-rgt" style="margin-bottom:0px; padding-left:0; border:0; width:100%; font-weight:normal;" placeholder="Enter Message Here" id="messagebox" />
                    <input type="hidden" id="to_id" value="">
                </div>
                <div class="col m1">
                    <a href="javascript:void(0);" class="ic-btn4" style="border-radius: 5px;padding-top: 7px;">
                        <i class="fa fa-paperclip fa-lg" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="col m2 plr0">
                    <a href="javascript:void(0);" class="ic-btn3 messageSendButton">Send</a>
                </div>
            </div>
            <!--/Sent Box-->
        </div>
    </div>
    <!--Chat Window-->
</div>
@endsection

@section('script')
    <script src="{{ asset('js/jquery.tinyscrollbar.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".scrollabled").each(function(){
                $(this).tinyscrollbar();
            });
        });
    </script>
@endsection

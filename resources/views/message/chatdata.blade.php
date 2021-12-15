@if(count($chatdata) > 0)


	@foreach($chatdata as $data)

		@if($data['from_id'] != $user)

			@if($data['product'] != null)

                <div class="chat">
                    <div class="chat-avatar">
                        <a class="avatar">
                            <img src="{{$to_user_image}}" class="circle" alt="avatar">
                        </a>
                    </div>
                    <div class="chat-body left-align">
                        <div class="chat-text chat_sms_box">
                            <div class="left_chat_sms">
                                <div class="col m8 chat_sms_left">
                                    @if(array_key_exists('rfq_bid_id', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Quotation Id</div>
                                                <div class="col m6 pr0">: {{ $data['product']['rfq_bid_id'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('title', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Quote Title</div>
                                                <div class="col m6 pr0">: {{ $data['product']['title'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('unit_price', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Unit Price</div>
                                                <div class="col m6 pr0">: {{ $data['product']['unit_price'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('total_price', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Total Price</div>
                                                <div class="col m6 pr0">: {{ $data['product']['total_price'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('delivery_time', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Delivery Time</div>
                                                <div class="col m6 pr0">: {{ $data['product']['delivery_time'] }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(array_key_exists('description', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Description</div>
                                                <div class="col m6 pr0">: {{ $data['product']['description'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('name', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Product Name</div>
                                                <div class="col m6 pr0">: {{ $data['product']['name'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('category', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Category</div>
                                                <div class="col m6 pr0">: {{ $data['product']['category'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('moq', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Min Quantity</div>
                                                <div class="col m6 pr0">: {{ $data['product']['moq'] }} Pcs</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('quantity', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Quantity</div>
                                                <div class="col m6 pr0">: {{ $data['product']['quantity'] }} Pcs</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('price', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list bbdis">
                                                <div class="col m6 plr0">Unit Price</div>
                                                <div class="col m6 pr0">: {{ $data['product']['price'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('destination', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Destination</div>
                                                <div class="col m6 pr0">: {{ $data['product']['destination'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('payment_method', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list bbdis">
                                                <div class="col m6 plr0">Payement Method</div>
                                                <div class="col m6 pr0">: {{ $data['product']['payment_method'] }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col m12 chat_product_message">{{ $data['message'] }}</div>
                                </div>
                                <div class="col m4 chat_sms_right">
                                    @if(array_key_exists('image', $data['product']))
                                        <div class="sms_product_img">
                                            <img src="{{ $data['product']['image'] }}" alt="" />
                                        </div>
                                    @endif
                                    @if(array_key_exists('id', $data['product']))
                                        <div class="row cer-ctxt2">Product ID: {{ $data['product']['id'] }}</div>
                                    @endif
                                    @if(array_key_exists('quote_id', $data['product']))
                                        <div class="row cer-ctxt2">Quotation ID: {{ $data['product']['quote_id'] }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right sms_strtotime">{{ date('d M Y h:i a', strtotime($data['datetime'])) }}</div>
                        </div>
                    </div>
                </div>

			@else

                <div class="chat">
                    <div class="chat-avatar">
                    <a class="avatar">
                        <img src="{{$to_user_image}}" class="circle" alt="avatar">
                    </a>
                    </div>
                    <div class="chat-body left-align">
                    <div class="chat-text chat_sms_box">
                        <p>@php
                            echo html_entity_decode($data['message']);
                            @endphp
                        </p>
                        <div class="byr-pb-ld text-right sms_strtotime">{{ date('d M Y h:i a', strtotime($data['datetime'])) }}</div>
                    </div>
                    </div>
                </div>
			@endif

		@else

			@if($data['product'] != null)

                <div class="chat chat-right">
                    <div class="chat-avatar">
                        <a class="avatar">
                            <img src="{{$from_user_image}}" class="circle" alt="avatar">
                        </a>
                    </div>
                    <div class="chat-body left-align">
                        <div class="chat-text chat_sms_box chat_sms_box_receiver">
                            <div class="chat_sms">
                                <div class="col m8 chat_sms_left">
                                    @if(array_key_exists('rfq_bid_id', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Quotation Id</div>
                                                <div class="col m6 pr0">: {{ $data['product']['rfq_bid_id'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('title', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Quote Title</div>
                                                <div class="col m6 pr0">: {{ $data['product']['title'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('unit_price', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Unit Price</div>
                                                <div class="col m6 pr0">: {{ $data['product']['unit_price'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('total_price', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Total Price</div>
                                                <div class="col m6 pr0">: {{ $data['product']['total_price'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('delivery_time', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Delivery Time</div>
                                                <div class="col m6 pr0">: {{ $data['product']['delivery_time'] }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(array_key_exists('description', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Description</div>
                                                <div class="col m6 pr0">: {{ $data['product']['description'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('name', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Product Name</div>
                                                <div class="col m6 pr0">: {{ $data['product']['name'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('category', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Category</div>
                                                <div class="col m6 pr0">: {{ $data['product']['category'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('moq', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Min Quantity</div>
                                                <div class="col m6 pr0">: {{ $data['product']['moq'] }} Pcs</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('quantity', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Quantity</div>
                                                <div class="col m6 pr0">: {{ $data['product']['quantity'] }} Pcs</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('price', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list bbdis">
                                                <div class="col m6 plr0">Unit Price</div>
                                                <div class="col m6 pr0">: {{ $data['product']['price'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('destination', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list">
                                                <div class="col m6 plr0">Destination</div>
                                                <div class="col m6 pr0">: {{ $data['product']['destination'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(array_key_exists('payment_method', $data['product']))
                                        <div class="col m12">
                                            <div class="row prd-lt-con-list bbdis">
                                                <div class="col m6 plr0">Payement Method</div>
                                                <div class="col m6 pr0">: {{ $data['product']['payment_method'] }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col m12 chat_product_message">{{ $data['message'] }}</div>
                                </div>
                                <div class="col m4 chat_sms_right">
                                    @if(array_key_exists('image', $data['product']))
                                        <div class="sms_product_img">
                                            <img src="{{ $data['product']['image'] }}" alt="" />
                                        </div>
                                    @endif
                                    @if(array_key_exists('id', $data['product']))
                                        <div class="row cer-ctxt2">Product ID: {{ $data['product']['id'] }}</div>
                                    @endif
                                    @if(array_key_exists('quote_id', $data['product']))
                                        <div class="row cer-ctxt2">Quotation ID: {{ $data['product']['quote_id'] }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right sms_strtotime">{{ date('d M Y h:i a', strtotime($data['datetime'])) }}</div>
                        </div>
                    </div>
                </div>

			@else
                <div class="chat chat-right">
                    <div class="chat-avatar">
                    <a class="avatar">
                        <img src="{{$from_user_image}}" class="circle" alt="avatar">
                    </a>
                    </div>
                    <div class="chat-body left-align">
                    <div class="chat-text chat_sms_box">
                        <p>@php
                            echo html_entity_decode($data['message']);
                            @endphp
                        </p>
                        <div class="byr-pb-ld text-right sms_strtotime">{{ date('d M Y h:i a', strtotime($data['datetime'])) }}</div>
                    </div>
                    </div>
                </div>
			@endif

		@endif


	@endforeach



@endif

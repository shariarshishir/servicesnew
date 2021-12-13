@if(count($chatdata) > 0)


	@foreach($chatdata as $data)

		@if($data['from_id'] != $user)

			@if($data['product'] != null)

				<div class="col-md-8 rgt-cb">
					<div class="col-md-4">
						<div class="row- prd-lt-con-gr">
							<img src="{{ $data['product']['image'] }}" class="prd-lt-con-gr-img-bdr">
						</div>
						@if(array_key_exists('id', $data['product']))
							<div class="row cer-ctxt2">Product ID: {{ $data['product']['id'] }}</div>
						@endif
						@if(array_key_exists('quote_id', $data['product']))
							<div class="row cer-ctxt2">Quotation ID: {{ $data['product']['quote_id'] }}</div>
						@endif
					</div>
					<!--/left-->
					<!--Right-->
					<div class="col-md-8" style="border-left:1px solid #ddd;">
						<div class="col-md-12 plr0 prdd-bbg">
							@if(array_key_exists('name', $data['product']))
								<div class="col-md-12">
									<div class="row prd-lt-con-list">
										<div class="col-md-6 plr0">Product Name</div>
										<div class="col-md-6 pr0">: {{ $data['product']['name'] }}</div>
									</div>
								</div>
							@endif
							@if(array_key_exists('title', $data['product']))
								<div class="col-md-12">
									<div class="row prd-lt-con-list">
										<div class="col-md-6 plr0">Quote Title</div>
										<div class="col-md-6 pr0">: {{ $data['product']['title'] }}</div>
									</div>
								</div>
							@endif
							<div class="col-md-12">
								<div class="row prd-lt-con-list">
									<div class="col-md-6 plr0">Category</div>
									<div class="col-md-6 pr0">: {{ $data['product']['category'] }}</div>
								</div>
							</div>
							@if(array_key_exists('moq', $data['product']))
								<div class="col-md-12">
									<div class="row prd-lt-con-list">
										<div class="col-md-6 plr0">Min Quantity</div>
										<div class="col-md-6 pr0">: {{ $data['product']['moq'] }} Pcs</div>
									</div>
								</div>
							@endif
							@if(array_key_exists('quantity', $data['product']))
								<div class="col-md-12">
									<div class="row prd-lt-con-list">
										<div class="col-md-6 plr0">Quantity</div>
										<div class="col-md-6 pr0">: {{ $data['product']['quantity'] }} Pcs</div>
									</div>
								</div>
							@endif
							<div class="col-md-12">
								<div class="row prd-lt-con-list bbdis">
									<div class="col-md-6 plr0">Unit Price</div>
									<div class="col-md-6 pr0">: {{ $data['product']['price'] }}</div>
								</div>
							</div>
							@if(array_key_exists('destination', $data['product']))
								<div class="col-md-12">
									<div class="row prd-lt-con-list">
										<div class="col-md-6 plr0">Destination</div>
										<div class="col-md-6 pr0">: {{ $data['product']['destination'] }}</div>
									</div>
								</div>
							@endif
							@if(array_key_exists('paymentmethod', $data['product']))
								<div class="col-md-12">
									<div class="row prd-lt-con-list bbdis">
										<div class="col-md-6 plr0">Payement Method</div>
										<div class="col-md-6 pr0">: {{ $data['product']['paymentmethod'] }}</div>
									</div>
								</div>
							@endif
						</div>
						<div class="col-md-12 plr0 prd-gr" style="background: #55a860;font-size: 14px;color: #fff;padding: 10px;border-radius: 4px;margin-top: 10px;">Greetings,
							<div class="clear10"></div>
							<p>{{ $data['message'] }}</P>
						</div>
					</div>
					<!--/Right-->
					<div class="col-md-12">
						<div class="byr-pb-ld text-right">{{ date('d M Y h:i a', strtotime($data['datetime'])) }}</div>
					</div>
				</div>

			@else

				<div class="col-md-8 rgt-cb">
					<p class="prd-gr2">
					@php
						echo html_entity_decode($data['message']);
					@endphp
					</P>
					<div class="col-md-12" style="color:#55A860;">
						<div class="byr-pb-ld text-right">{{ date('d M Y h:i a', strtotime($data['datetime'])) }}</div>
					</div>
				</div>

			@endif

		@else

			@if($data['product'] != null)

				<div class="col-md-offset-3 col-md-8 rgt-cbb">
					<div class="col-md-4">
						<div class="row- prd-lt-con-gr">
							<img src="{{ $data['product']['image'] }}" class="prd-lt-con-gr-img-bdr">
						</div>
						@if(array_key_exists('id', $data['product']))
							<div class="row cer-ctxt2">Product ID: {{ $data['product']['id'] }}</div>
						@endif
						@if(array_key_exists('quote_id', $data['product']))
							<div class="row cer-ctxt2">Quotation ID: {{ $data['product']['quote_id'] }}</div>
						@endif
					</div>
					<!--/left-->
					<!--Right-->
					<div class="col-md-8" style="border-left:1px solid #ddd;">
						<div class="col-md-12 plr0 prdd-bbg">
							@if(array_key_exists('name', $data['product']))
								<div class="col-md-12">
									<div class="row prd-lt-con-list">
										<div class="col-md-6 plr0">Product Name</div>
										<div class="col-md-6 pr0">: {{ $data['product']['name'] }}</div>
									</div>
								</div>
							@endif
							@if(array_key_exists('title', $data['product']))
								<div class="col-md-12">
									<div class="row prd-lt-con-list">
										<div class="col-md-6 plr0">Quote Title</div>
										<div class="col-md-6 pr0">: {{ $data['product']['title'] }}</div>
									</div>
								</div>
							@endif
							<div class="col-md-12">
								<div class="row prd-lt-con-list">
									<div class="col-md-6 plr0">Category</div>
									<div class="col-md-6 pr0">: {{ $data['product']['category'] }}</div>
								</div>
							</div>
							@if(array_key_exists('moq', $data['product']))
								<div class="col-md-12">
									<div class="row prd-lt-con-list">
										<div class="col-md-6 plr0">Min Quantity</div>
										<div class="col-md-6 pr0">: {{ $data['product']['moq'] }} Pcs</div>
									</div>
								</div>
							@endif
							@if(array_key_exists('quantity', $data['product']))
								<div class="col-md-12">
									<div class="row prd-lt-con-list">
										<div class="col-md-6 plr0">Quantity</div>
										<div class="col-md-6 pr0">: {{ $data['product']['quantity'] }} Pcs</div>
									</div>
								</div>
							@endif
							<div class="col-md-12">
								<div class="row prd-lt-con-list bbdis">
									<div class="col-md-6 plr0">Unit Price</div>
									<div class="col-md-6 pr0">: {{ $data['product']['price'] }}</div>
								</div>
							</div>
							@if(array_key_exists('destination', $data['product']))
								<div class="col-md-12">
									<div class="row prd-lt-con-list">
										<div class="col-md-6 plr0">Destination</div>
										<div class="col-md-6 pr0">: {{ $data['product']['destination'] }}</div>
									</div>
								</div>
							@endif
							@if(array_key_exists('paymentmethod', $data['product']))
								<div class="col-md-12">
									<div class="row prd-lt-con-list bbdis">
										<div class="col-md-6 plr0">Payement Method</div>
										<div class="col-md-6 pr0">: {{ $data['product']['paymentmethod'] }}</div>
									</div>
								</div>
							@endif
						</div>
						<div class="col-md-12 plr0 prd-gr" style="background: #55a860;font-size: 14px;color: #fff;padding: 10px;border-radius: 4px;margin-top: 10px;">Greetings,
							<div class="clear10"></div>
							<p>{{ $data['message'] }}</P>
						</div>
					</div>
					<!--/Right-->
					<div class="col-md-12">
						<div class="byr-pb-ld text-right">{{ date('d M Y h:i a', strtotime($data['datetime'])) }}</div>
					</div>
				</div>

			@else

				<div class="col-md-offset-3 col-md-8 rgt-cbb">
					<p class="prd-gr2">
					@php
						echo html_entity_decode($data['message']);
					@endphp
					</P>
					<div class="col-md-12" style="color:#55A860;">
						<div class="byr-pb-ld text-right">{{ date('d M Y h:i a', strtotime($data['datetime'])) }}</div>
					</div>
				</div>

			@endif

		@endif


	@endforeach



@endif
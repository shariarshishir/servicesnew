@if(count($orders) > 0)
    <div class="col-md-12">
        <div class="card card-with-padding order-list-block">
            <legend>Orders List</legend>
            @if (auth()->user()->user_type == 'wholesaler')
                <div class="col s12 m12 product-search-block">
                    <div class="row">
                        <div class="col s12 m4">
                            <label for="new_arrival">Order Type</label>
                            <select class="select2 browser-default" name="filter_order_type" id="filter_order_type">
                                <option value="" selected>Choose your option</option>
                                <option value="received_order">Order Received</option>
                                <option value="giving_order">Order Sent</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <div class="no_more_tables">
                <table class="table striped" id="ordertable">
                    <thead class="cf">
                        <tr>
                            <th class="text-center">#Order No.</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Order Status</th>
                            @if(auth()->user()->user_type=='wholesaler')<th class="text-center">Order Type</th> @endif
                            <th class="text-center">Payment Status</th>
                            <th class="text-center">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody class="order-data">
                    @include('user.profile.orders._order_data')
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
    @foreach($orders as $item)
        <div id="order-details-modal_{{$item->id}}" class="order-details-modal modal modal-fixed-footer">
            <div class="modal-content">
                <legend>Order Details</legend>
                <div class="row order-top-block">
                    <div class="order-info-top col s12 m6">
                        <p>Order Number: #{{$item->order_number}}</p>
                        <p>Date: {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('MMMM Do YYYY')}}</p>
                    </div>

                    <div class="order-status-block col s12 m6">
                        <p>Buyer Name: {{ ucfirst($item->user->name)}}</p>
                        {{-- <a href="javascript:void(0);" class="waves-effect waves-green btn green">Shipped</a> --}}
                    </div>
                </div>
                <div class="row order-address-block">

                    {{-- <div class="billing-address-block col s12 m6">
                        <h4><i class="material-icons">description</i> Billing Address</h4>
                        <p>{{$item->billingAddress->company_name}}</p>
                        <p>{{$item->billingAddress->address}}</p>
                        <p>{{$item->billingAddress->email}}</p>
                        <p>{{$item->billingAddress->phone}}</p>
                    </div>
                    <div class="shipping-address-block col s12 m6">
                        <h4><i class="material-icons">card_travel</i> Shipping Address</h4>
                        <p>{{$item->shippingAddress->company_name}}</p>
                        <p>{{$item->shippingAddress->address}}</p>
                        <p>{{$item->shippingAddress->email}}</p>
                        <p>{{$item->shippingAddress->phone}}</p>
                    </div> --}}
                </div>
                {{-- <div class="border-separator"></div> --}}
                {{-- <i class="material-icons">payment</i> {{ $item->payment_name }} --}}
                <div class="border-separator"></div>
                <div class="row product-details-table-block">
                    <div class="col s12">
                        <div class="no_more_tables">
                            <table class="striped">
                                <thead class=""cf>
                                    <tr>
                                        <th data-field="Product Name">Product Name</th>
                                        <th data-field="SKU">SKU</th>
                                        <th data-field="Unit Price">Unit Price</th>
                                        <th data-field="Qty">Qty</th>
                                        <th data-field="Price" style="text-align: right;">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->orderItems as $list )
                                        <tr>
                                            <td data-title="Product Name">
                                                <div>{{$list->product->name ?? ""}}</div>
                                                @if($list->full_stock==1)
                                                <span class="badge badge pill blue accent-2 mr-2 ready-to-ship-label">Full Stock</span>
                                                @elseif(isset($list->order_modification_req_id))
                                                <span class="badge badge pill blue accent-2 mr-2 ready-to-ship-label">Modified</span>
                                                @endif
                                            </td>
                                            <td data-title="SKU">{{$list->product_sku}}</td>
                                            <td data-title="Unit Price">${{$list->unit_price}}</td>
                                            <td data-title="Qty">
                                                {{$list->quantity}}
                                                @if ($list->full_stock == 1)
                                                <span  data-toggle="tooltip" title="Full Stock"><i class="fas fa-question-circle"></i></span>
                                                @endif

                                                @if(isset($list->colors_sizes))
                                                    <a class="waves-effect waves-light modal-trigger colorSizeModal" href="javascript:void();">Show More</a>
                                                    <div id="colorSizeModal" class="modal modal-fixed-footer ">
                                                        <div class="modal-content">
                                                            <h4>Colors and Sizes</h4>
                                                            @if($list->product->product_type == 1 || $list->product->product_type == 2)
                                                                @foreach (json_decode($list->colors_sizes) as $key => $value)
                                                                    @php
                                                                        $xxs = ($value->xxs) ? $value->xxs .' XXS, ':'';
                                                                        $xs = ($value->xs) ? $value->xs .' XS, ':'';
                                                                        $smallCount = ($value->small) ? $value->small .' Small, ':'';
                                                                        $mediumCount = ($value->medium) ? $value->medium .' Medium, ':'';
                                                                        $largeCount = ($value->large) ? $value->large .' Large, ':'';
                                                                        $extra_largeCount = ($value->extra_large) ? $value->extra_large .' Extra Large, ':'';
                                                                        $xxl = ($value->xxl) ? $value->xxl .' XXL, ':'';
                                                                        $xxxl = ($value->xxxl) ? $value->xxxl .' XXXl, ':'';
                                                                        $four_xxl = ($value->four_xxl) ? $value->four_xxl .' 4XXXl, ':'';
                                                                        $one_size = ($value->one_size) ? $value->one_size .' One Size, ':'';
                                                                        echo "<p>".$value->color.": " .$xxs . $xs . $smallCount . $mediumCount . $largeCount . $extra_largeCount. $xxl .  $xxxl . $four_xxl . $one_size."</p>";
                                                                    @endphp
                                                                @endforeach
                                                            @else
                                                                @foreach (json_decode($list->colors_sizes) as $key => $value)
                                                                    @php
                                                                        $quantity = ($value->quantity) ? $value->quantity .' Quantity, ':'';
                                                                        echo "<p>".$value->color.": " .$quantity ."</p>";
                                                                    @endphp
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:void(0);" class="waves-effect waves-green btn-flat hide-color-size-modal-trigger">
                                                                <i class="material-icons green-text text-darken-1">close</i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td data-title="Price" style="text-align: right;">
                                                @if(isset($list->copyright_price))
                                                <span  data-toggle="tooltip" title=" Copyright price is {{ $list->copyright_price }}"><i class="fas fa-question-circle"></i></span>
                                                @endif
                                                @if(isset($list->discount))
                                                <span  data-toggle="tooltip" title="Discount amount {{ $list->discount }}"><i class="fas fa-question-circle"></i></span>
                                                @endif
                                                ${{$list->price}}
                                            </td>

                                        </tr>
                                    @endforeach
                                    {{-- <tr class="sub-total">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>Sub Total</td>
                                        <td style="text-align: right;">${{$item->sub_total}}</td>
                                    </tr> --}}
                                    <tr class="grand-total">
                                        <td class="empty_td">&nbsp;</td>
                                        <td class="empty_td">&nbsp;</td>
                                        <td class="empty_td">&nbsp;</td>
                                        <td>Grand Total</td>
                                        <td style="text-align: right;">${{$item->grand_total}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if(isset($item->shippingCharge) &&$item->shippingCharge->status == config('constants.shipping_charge_status.confirm'))
                    <div class="shipping-charge-div">
                        <legend>Shipping Information</legend>
                        <div class="col s12 m12">
                            <div class="row">
                                @if($item->shippingCharge->forwarder_name)
                                <div class="col s12 m12">
                                    <label>Forwarder Name:</label>
                                    {{$item->shippingCharge->forwarder_name}}
                                </div>
                                @endif
                                @if($item->shippingCharge->forwarder_address)
                                <div class="col s12 m12">
                                    <label>Forwarder Address:</label>
                                    {{$item->shippingCharge->forwarder_address}}
                                </div>
                                @endif
                            </div>
                            <table class="striped">
                                <thead>
                                    <tr>
                                        <th >Shipping Method</th>
                                        <th >Shipment Type</th>
                                        <th >UOM</th>
                                        <th >Unit Price</th>
                                        <th >Qty</th>
                                        <th >total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (json_decode($item->shippingCharge->details) as $list )
                                    <tr>
                                        <td>
                                            {{$list->shipping_method}}
                                        </td>
                                        <td>{{$list->shipment_type}}</td>
                                        <td>{{$list->uom}}</td>
                                        <td>${{$list->unit_price}}</td>
                                        <td>{{$list->qty}}</td>
                                        <td>{{$list->total}}</td>
                                    </tr>
                                    @endforeach
                                    <tr class="grand-total">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><b>Grand Total</b></td>
                                        <td>${{$item->shippingCharge->grand_total}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat">
                    <i class="material-icons green-text text-darken-1">close</i>
                </a>
            </div>
        </div>
    @endforeach
@else
    <div class="col-md-12">
        <div class="card card-with-padding">
            <div class="card-alert card cyan">
                <div class="card-content white-text">
                    <p>INFO : No order available.</p>
                </div>
            </div>
        </div>
    </div>
@endif

@include('user.profile.orders._scripts')

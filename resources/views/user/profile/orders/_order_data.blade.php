@foreach($orders as $orderItem)
            <tr class="newOrderRow">
                <td width="28%" class="order-number" >
                    <a  href="#order-details-modal_{{$orderItem->id}}" class="order-more-details modal-trigger">{{$orderItem->order_number}}
                        @if(isset($countOrderApproved))
                            @foreach ($countOrderApproved as $key => $count)
                                @if($key == $orderItem->id)
                                    <span class="new badge blue newOrder">{{$count}}</span>
                                @endif
                            @endforeach
                        @endif

                    </a>
                </td>
                <td width="28%">$ {{$orderItem->grand_total}}</td>
                <td width="29%">{{ \Carbon\Carbon::parse($orderItem->created_at)->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</td>
                <td width="28%" class="order-status">
                    <span class="chip lighten-5
                    @switch($orderItem->state)
                        @case('pending')
                            red red-text
                            @break
                        @case('approved')
                           green green-text
                            @break
                        @case('delivered')
                            gray gray-text
                            @break
                        @default

                    @endswitch ">{{ucfirst($orderItem->state)}}</span>
                </td>

                @if (auth()->user()->user_type=='wholesaler')
                    <td width="28%" class="order-status">
                        <span class="chip lighten-5 order_status_label {{$orderItem->order_type== 'received_order' ? 'green green-text' : 'blue blue-text' }}">{{$orderItem->order_type== 'received_order' ? 'Order Received' : 'Order Sent' }}</span>
                    </td>
                @endif

                <td width="28%" class="order-status">
                    <span class="chip lighten-5 {{$orderItem->payment_status== 'paid' ? 'green green-text' : 'yellow yellow-text' }}">{{ucfirst($orderItem->payment_status)}}</span>
                </td>

                <td width="15%" style="text-align: center">
                    @if(isset($countOrderApproved))
                    <a id="notification_identifier" data-notification-id="{{$orderItem->id}}" href="#order-details-modal_{{$orderItem->id}}" class="order-more-details btn green waves-effect waves-light modal-trigger"><i class="material-icons">remove_red_eye</i></a>
                    @else
                    <a href="#order-details-modal_{{$orderItem->id}}" class="order-more-details btn green waves-effect waves-light modal-trigger"><i class="material-icons">remove_red_eye</i></a>
                    @endif
                </td>
            </tr>
@endforeach

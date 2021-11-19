@foreach($orders as $orderItem)
            <tr class="newOrderRow">
                <td width="28%" class="order-number" >
                    <a  href="#order-details-modal_{{$orderItem->id}}" class="order-more-details modal-trigger">{{$orderItem->order_number}}</a>
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

                <td width="28%" class="order-status">
                    <span class="chip lighten-5 {{$orderItem->payment_status== 'paid' ? 'green green-text' : 'yellow yellow-text' }}">{{ucfirst($orderItem->payment_status)}}</span>
                </td>

                <td width="15%" style="text-align: center">
                    <a href="#order-details-modal_{{$orderItem->id}}" class="order-more-details btn green waves-effect waves-light modal-trigger"><i class="material-icons">remove_red_eye</i></a>
                </td>
            </tr>
@endforeach

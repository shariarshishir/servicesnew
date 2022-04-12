
    <table class="table table-bordered orders-table data-table">
        <thead class="cf">
            <tr>
                <th width="2%">Sl</th>
                <th width="5%">Date</th>
                <th width="25%">RFQ Title</th>
                <th width="5%">Category</th>
                <th width="5%">Quantity</th>
                <th width="5%">Target price</th>
                <th width="5%">Delivery Date</th>
                <th width="5%" style="text-align: center;">Status</th>
                <th width="5%" style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody class="cf">
            @foreach($rfqs as $key=>$rfq)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ \Carbon\Carbon::parse($rfq['created_at'])->isoFormat('MMMM Do YYYY')}}</td>
                <td><a href="{{route('admin.rfq.show', $rfq['id'])}}">{{$rfq['title']}}</a></td>
                <td>{{$rfq['category'][0]['name']}}</td>
                <td>{{$rfq['quantity']}}</td>
                <td>$ {{$rfq['unit_price']}}</td>
                <td>{{ \Carbon\Carbon::parse($rfq['delivery_time'])->isoFormat('MMMM Do YYYY')}}</td>
                <td style="text-align: center;">
                    <span style="@php echo($rfq['status'] == 'pending')? 'color:red':'color:green'; @endphp">
                    @php echo($rfq['status'] == 'pending')? '<i class="fa fa-times"></i>':'<i class="fa fa-check"></i>'; @endphp
                    </span>
                </td>
                <td style="text-align: center;">
                    <a href="{{route('admin.rfq.show', $rfq['id'])}}" class="show-rfq-details-trigger"><i class="fa fa-eye"></i></a>
                    <a href="javascript:void(0);" class="remove-rfq-trigger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

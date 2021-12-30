<head>
    <style>
    .btn{text-align:center;}
    .loginButton {padding: 7px 15px 8px 20px;}
    * {box-sizing: border-box;}
    </style>
    </head>
    @component('mail::message')
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td style="background:#f7f7f7;width:10%;padding:20px;text-align:center;"><img src="{{ asset('storage/images/mb_mail_logo.png') }}" alt="Mail Template Logo" width="100px" /></td>
                <td style="background:#23b14d;width:90%;padding:20px;text-align:center;">
                    <p style="font-family:verdana;font-size:30px;font-weight:bold;color:#fff;margin:0px;padding-bottom:5px;line-height:normal;text-align:left;">Merchant Bay Limited.</p>
                    <p style="font-family:verdana;font-size:13px;font-weight:normal;color:#fff;margin:0px;padding-bottom:5px;line-height:normal;text-transform:uppercase;text-align:left;">Sourcing Made Easy</p>
                </td>
            </tr>
        </table>
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td style="padding: 30px;">
                <p style="font-family:verdana;font-size:13px;margin:0px;line-height:normal;">Dear {{ $order->user->name}},</p>
                <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:5px;line-height:normal;">Your order {{ $order->order_number }},has been placed to the {{ $order->businessProfile->business_name }}.</p>
                <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:5px;line-height:normal;">Order Details:</p>
                <table border="1px solid black" style="border-collapse: collapse;">
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Price</th>
                    @foreach ($order->orderItems as $list)
                        <tr>
                            <td><img src="{{asset('storage/'.$list->product->images[0]->image)}}" alt="" height="10px" width="10px"></td>
                            <td>{{ $list->product->name }}</td>
                            <td>{{ $list->quantity }}</td>
                            <td>{{ $list->unit_price }}</td>
                            <td>{{ $list->price }}</td>
                        </tr>
                    @endforeach
                </table>
                <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;line-height:normal;">Grand Total:{{ $order->grand_total }}</p>
                <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:15px;line-height:normal;"><a href="{{ route('order.index') }}">To see the order details please click here.</a></p>
                <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;line-height:normal;">Not sure what you see?</p>
                <p style="font-family:verdana;font-size:13px;margin:0px;padding-bottom:15px;line-height:normal;">Contact us: email: <a href="mailto:success@merchantbay.com">success@merchantbay.com</a>. Call: </p>
                <p style="font-family:verdana;font-size:12px;margin:0px;padding-bottom:15px;color:#000;line-height:normal;">Thank you for using Merchant Bay PTE Ltd.</p>
            </td>
        </tr>
    </table>

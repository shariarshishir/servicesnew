
    @component('mail::message')

    <table cellspacing="0" border="0" cellpadding="0" width="100%" style="font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 24px; color: #0A0A0A; padding: 0; margin: 0;"
    >
        <tr>
            <td>
                <table style="background: #fff; max-width:670px; margin:0 auto; padding: 20px; text-align: left;" width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="text-align:center; padding:0; margin: 0;">
                            <a style="margin: 0; padding: 0;" href="https://www.merchantbay.com/global/" title="logo" target="_blank">
                                <img style="padding: 0; margin: 0;" width="100px" src="{{ asset('storage/images/logo.png') }}" title="logo" alt="logo">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 50px 0 0; margin: 0;">
                            <h1 style="font-family: 'Poppins', sans-serif; font-weight: 600; padding: 0px 0px 20px 0px; margin: 0px; font-size:24px; line-height: 35px; color: #0A0A0A; text-align: center;">Thank you for placing an order with Merchant Bay</h1>
                            <p style="margin: 0px; padding: 8px 0 20px; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 24px; color: #0A0A0A;">
                                Your order for the following product is placed and currently under review. Thank you for using Merchant Bay. 
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 0; margin: 0;">
                            <table style="max-width:670px; margin:0 auto; padding: 20px; text-align: left;" width="100%" border="0" cellpadding="0" cellspacing="0">
                                @foreach ($order->orderItems as $item )
                                <tr>
                                    <td style="padding: 20px 0; margin: 0;">
                                        <table style="max-width:670px; margin:0 auto; padding: 20px; text-align: left;" width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="text-align: left; padding: 5px; margin: 0px; width: 30%;">
                                                    <img width="130px" height="auto" src="{{asset('storage').'/'.$item->product->images[0]->image}}" alt="" />
                                                </td>
                                                <td style="text-align: left; padding: 0 0 0 20px; margin: 0px; width: 70%;">
                                                    <h3 style="font-family: 'Poppins', sans-serif; font-weight: 600; padding: 0px 0px 10px 0px; margin: 0px; font-size:24px; line-height: 35px; color: #0A0A0A; text-align: left;">
                                                    {{ $item->product->name }}
                                                    </h3>
                                                    <p style="margin: 0; padding: 2px 0px; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 24px; color: #0A0A0A;">Order volume: {{ $item->product->quantity }} {{ $item->product->product_unit }}</p>
                                                    <p style="margin: 0; padding: 2px 0px; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 24px; color: #0A0A0A;">Order Value: {{ $item->product->price }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endforeach

                                <tr>
                                    <td style="padding: 20px 0; margin: 0;">
                                        <table style="max-width:670px; margin:0 auto; padding: 20px; text-align: left;" width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="text-align: left; padding: 5px; margin: 0px; width: 30%;">&nbsp;</td>
                                                <td style="text-align: left; padding: 0 0 0 20px; margin: 0px; width: 70%;">
                                                    <p style="margin: 0; padding: 2px 0px; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 24px; color: #0A0A0A;"><b>Order Number</b>: {{ $order->order_number }}</p>
                                                    <p style="margin: 0; padding: 2px 0px; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 24px; color: #0A0A0A;"><b>Billing address</b>: {{ $order->billingAddress->address }}</p>
                                                    <p style="margin: 0; padding: 2px 0px; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 24px; color: #0A0A0A;"><b>Shipping address</b>: {{ $order->billingAddress->address }}</p>
                                                    <p style="margin: 0; padding: 2px 0px; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 24px; color: #0A0A0A;"><b>Grand Total:</b> <span style="color: #54A958;"> {{ $order->grand_total }}</span></p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding: 0; margin: 0px; width: 100%;">
                            <a href="javascript:void(0);" target="_blank" style="background: #54A958;width: 92%;padding: 10px 20px;border-radius: 8px;margin: 0 auto;display: block;font-family: 'Poppins', sans-serif;font-size: 16px;color: #fff;line-height: 20px;text-decoration: none; text-align: center;">See your order</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 50px 20px; margin: 0px;">
                            <p style="margin: 0; padding: 2px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 24px; color: #0A0A0A; text-align: center;">Review process may take several hours. In this process a Merchant Bay representative will contact you to verify the order. This process is necessary to ensure buyer and supplier's best experience.</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: center; padding: 0px 0 30px; margin: 0;">
                            <p style="margin: 0; padding: 0px 0 10px; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 24px; color: #0A0A0A;"> If you don't receive an order confirmation email within 24 hours. Please <a href="javascript:void(0);" style="padding: 0; margin: 0; color: #0000FF;" target="_blank">Contact us</a> .</p>
                            <p style="margin: 0; padding: 0px; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 24px; color: #0A0A0A;">Email: success@merchantbay.com, Call: </p>
                        </td>
                    </tr>
                </table>

                <table style="background: #fff; max-width: 670px; margin:0 auto; padding: 0;" width="100%"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="background: #eeeeee; text-align: center; padding: 20px 0; margin: 0;">
                            <h2 style="font-family: 'Poppins', sans-serif; font-size: 22px; line-height: 40px; margin: 0; padding: 0px; color: #0A0A0A; font-weight: 600;">Bring the sourcing in your pocket</h2>
                            <h6 style="font-family: 'Poppins', sans-serif; font-size: 15px; color: #0A0A0A; font-weight: 300; margin: 10px 0 20px; padding: 0px;">Download the App</h6>
                            <span>
                                <a href="https://apps.apple.com/us/app/merchant-bay/id1590720968" target="_blank" style="margin: 0; padding: 0;" ><img width="150" src="{{ asset('storage/images/app_store.png') }}" title="App store" alt="App store"></a>
                                <a href="https://play.google.com/store/apps/details?id=com.sayemgroup.merchantbay" target="_blank" style="margin: 0; padding: 0;"><img width="150" src=" {{ asset('storage/images/google_play.png') }}" title="Google play" alt="Google play"></a>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="background: #54a958; text-align: center; padding: 50px 20px 40px; margin: 0;">
                            <p style="font-family: 'Poppins', sans-serif; color: #fff; font-size: 12px; line-height: 20px; margin: 0px; padding: 0px;">MERCHANT BAY PTE LTD., 160 ROBINSON ROAD #24-09, SINGAPORE, SINGAPORE 068914 <span style="text-decoration: underline; display: block;">Unsubscribe Manage preferences</span></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>







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

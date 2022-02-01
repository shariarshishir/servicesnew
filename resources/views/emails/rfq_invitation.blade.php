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
            @if($data['supplier']=="success@merchantbay.com")
                <p style="font-family:verdana;font-size:13px;margin:0px;padding-bottom:15px;line-height:normal;">Dear Merchant Bay,</p>
            @else
            <p style="font-family:verdana;font-size:13px;margin:0px;padding-bottom:15px;line-height:normal;">Dear {{ $data['supplier']}},</p>
            @endif

            <p style="font-family:verdana;font-size:12px;margin:0px;padding-bottom:25px;line-height:normal;">There is a new business opportunity:</p>
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding-bottom: 25px;">
                <tr>
                    @foreach($data['rfq']->images as $image)
                    <td style="text-align:center;"><img style="" src="{{ asset('storage/'.$image->image) }}" class="img-responsive" width="200px" /></td>
                    @endforeach
                </tr>
            </table>
            <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:5px;line-height:normal;"><b>Industry:</b> {{ $data['rfq']->category->industry }}</p>
            <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:5px;line-height:normal;"><b>Product Category:</b> {{ $data['rfq']->category->name }}</p>
            <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:5px;line-height:normal;"><b>Title:</b> {{ $data['rfq']->title }}</p>
            <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:5px;line-height:normal;"><b>Quantity:</b> {{ $data['rfq']->quantity }}</p>
            <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:5px;line-height:normal;"><b>Unit:</b> {{ $data['rfq']->unit }}</p>
            <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:5px;line-height:normal;"><b>Target price:</b> $ {{ $data['rfq']->unit_price }}</p>
            <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:5px;line-height:normal;"><b>Payment method:</b> {{ $data['rfq']->payment_method }}</p>
            <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:25px;line-height:normal;"><b>Delivery time:</b> {{ $data['rfq']->delivery_time }}</p>
            <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:25px;line-height:normal;">To reply, please login to your MerchantBay account and find the request in your RFQ menu.</p>
            <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:25px;line-height:normal;">You are receiving this email because your profile information matches with the buyer's request for quotation. If you think this request does not fit to your business, please update your company profile.</p>
            <p style="display:block;text-align:center;margin:0px;padding-bottom:25px;line-height:normal;"><a  href="{{URL::to('/rfq')}}" class="button button-green">Login</a></p>
            <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:15px;line-height:normal;">In case of any questions, please contact us: <a href="https://www.merchantbay.com" style="color:#5181ec">www.merchantbay.com</a></p>
            <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:5px;line-height:normal;">Best regards,</p>
            <p style="font-family:verdana;font-size:12px;color:#000;margin:0px;padding-bottom:5px;line-height:normal;">your Merchant Bay team</p>
        </td>
    </tr>
</table>

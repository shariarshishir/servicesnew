@push('js')
    <script>
        var serverURL ="{{ env('CHAT_URL'), 'localhost' }}:4000";
        var socket = io(serverURL, { transports : ['websocket'] });
        socket.on('connect', function(data) {});
        @if(Auth::check())
        function sendmessage(businessid)
        {
        let message = {'message': 'We are Interested your profile and would like to discuss More about the Product', 'product': null, 'user_id' : "{{Auth::user()->id}}", 'business_id' : business_id,'from_user_id': "{{Auth::user()->id}}", 'from_business_id' : null};
        socket.emit('new message', message);
        setTimeout(function(){
            //window.location.href = "/message-center";
            var url = '{{ route("message.center") }}?bid='+businessid;
                // url = url.replace(':slug', sku);
                window.location.href = url;
            // window.location.href = "/message-center?uid="+supplierId;
        }, 1000);
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
        var url= '{{route("message.center.update.user.last.activity")}}';
        jQuery.ajax({
            method: "POST",
            url: url,
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

        function contactSupplierFromProduct(business_id,trigger_from)
        {

        var business_id = business_id;
        var csrftoken = $("[name=_token]").val();
        var buyer_id = "{{Auth::id()}}";
        var trigger_from = trigger_from;
        data_json = {
            "business_id": business_id,
            "buyer_id": buyer_id,
            "trigger_from": trigger_from,
            "csrftoken": csrftoken
        }
        var url='{{route("message.center.contact.supplier.from.product")}}';
        jQuery.ajax({
            method: "POST",
            url:url,
            headers:{
                "X-CSRF-TOKEN": csrftoken
            },
            data: data_json,
            dataType:"json",
            success: function(data){
                console.log(data);
            }
        });

        /*
        let message = {'message': 'Hi I would like to discuss More about your Product', 'product': null, 'from_id' : "{{Auth::user()->id}}", 'to_id' : supplierId};
        socket.emit('new message', message);
        setTimeout(function(){
            window.location.href = "/message-center?uid="+supplierId;
        }, 1000);
        */
        }

        function sendsamplemessage(productId,productTitle,productCategory,moq,qtyUnit,pricePerUnit,priceUnit,productImage,createdBy)
        {
        let message = {'message': 'We are Interested in Your Product ID:mb-'+productId+' and would like to discuss More about the Product', 'product': {'id': "MB-"+productId,'name': productTitle,'category': productCategory,'moq': moq,'price': priceUnit+" "+pricePerUnit, 'image': productImage}, 'from_id' : "{{Auth::user()->id}}", 'to_id' : createdBy};
        socket.emit('new message', message);
        setTimeout(function(){
            window.location.href = "/message-center";
        }, 1000);
        }
        @endif
    </script>
@endpush

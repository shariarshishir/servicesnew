@push('js')

<script>
    // var serverURL = "{{ env('CHAT_URL'), 'localhost' }}:3000";
    // var socket = io.connect(serverURL);
    // socket.on('connect', function(data) {
    //     //alert('connect');
    // });
    var selectedBuyerId = "{{ request()->route()->parameters['id'] }}";
    //alert(selectedBuyerId);
    var allbuyer = @json($buyers);
    var unit = '';
    // var lineitemcontent = '<tr><td></td><td><select class="select-product" style="width: 100%" onchange="changecat(this)"><option value="">Select Products</option>@foreach($products as $product) <option value="{{$product->id}}">{{$product->title}}</option> @endforeach</select><input type="hidden" name="supplier[]" required/><input type="hidden" name="product[]" required/><input type="hidden" name="price_unit[]" required/><span class="supplier_details" style="color: #50AA5B;"></span></td><td style="position:relative;"><div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:8px;"></div><input type="number" class="form-control unit" style="border:1px solid #ccc; margin-bottom:0;" name="unit[]" onkeyup="changeunit(this)" required/></td><td style="position:relative;"><div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:8px;"></div><input type="text" class="form-control unit_price" style="border:1px solid #ccc; margin-bottom:0;" name="unit_price[]" onkeyup="changeunitprice(this)" required/></td><td><input type="text" class="form-control total_price" style="border:1px solid #ccc; margin-bottom:0;" name="total_price[]" readonly/></td><td><select class="form-control taxprice" onchange="changetaxprice(this)" name="tax[]"><option value="0">No Tax (0%)</option><option value="10">VAT (10%)</option></select></td><td><input type="text" class="form-control tax_total_price" style="border:1px solid #ccc; margin-bottom:0;" name="tax_total_price[]" readonly/></td><td><a href="javascript:void(0);" class="ic-btn4" onclick="removelineitem(this)"><i aria-hidden="true" class="fa fa-minus fa-lg"></i></a></td></tr>';
    var lineitemcontent = '<tr><td></td><td><select class="select-product" style="width: 100%" onchange="changecat(this)"><option value="">Select Products</option>@foreach($products as $product) <option value="{{$product->id}}">{{$product->title}}</option> @endforeach</select><input type="hidden" name="supplier[]" required/><input type="hidden" name="product[]" required/><input type="hidden" name="price_unit[]" required/><span class="supplier_details" style="color: #50AA5B;"></span></td><td style="position:relative;"><span class="required_star" style="position: absolute; top:10; right:11px;">*</span><input type="number" class="form-control unit" style="border:1px solid #ccc; margin-bottom:0;" name="unit[]" onkeyup="changeunit(this)" required/></td><td style="position:relative;"><span class="required_star" style="position: absolute; top:10; right:11px;">*</span><input type="text" class="form-control unit_price" style="border:1px solid #ccc; margin-bottom:0;" name="unit_price[]" onkeyup="changeunitprice(this)" required/></td><td><input type="text" class="form-control total_price" style="border:1px solid #ccc; margin-bottom:0;" name="total_price[]" readonly/><input type="hidden" class="taxprice" name="tax[]" value="0" /></td><td><input type="text" class="form-control tax_total_price" style="border:1px solid #ccc; margin-bottom:0;" name="tax_total_price[]" readonly/></td><td><a href="javascript:void(0);" class="ic-btn4" onclick="removelineitem(this)"><i aria-hidden="true" class="fa fa-minus fa-lg"></i></a></td></tr>';
    function getbuyerdetails(id)
    {
        var buyer = {};
        for(var i = 0; i < allbuyer.length; i++)
        {
            if(id == allbuyer[i].id.toString())
            {
                buyer = allbuyer[i];
            }
        }
        if($.isEmptyObject(buyer) != true)
        {
            let html = '<h3>'+buyer.name+'</h3> <address> '+ buyer.street +'<br>'+ buyer.city +', '+ buyer.state +'<br>'+ buyer.country +', '+ buyer.zipcode +' </address>';
            $('#buyerdata').html(html);
        }
    }
    if(selectedBuyerId){
        getbuyerdetails(selectedBuyerId);
    }

    function addlineitem()
    {
        $('#lineitems').append(lineitemcontent);
        $('.select-product').select2();
        for(var i = 0; i < $('#lineitems').children().length; i++)
        {
            $('#lineitems').children().eq(i).children().eq(0).html((i + 1));
        }
    }

    function removelineitem(el)
    {
        $(el).parent().parent().remove();
        for(var i = 0; i < $('#lineitems').children().length; i++)
        {
            $('#lineitems').children().eq(i).children().eq(0).html((i + 1));
        }

        let totalp = 0;
        let totaltax = 0;
        let $j_object = $(".tax_total_price");
        $j_object.each( function(){
            let taxp = $(this).closest("tr").find(".total_price").val() != "" ? parseFloat($(this).closest("tr").find(".total_price").val()) : 0;
            totaltax += parseFloat(parseFloat($(this).val()) - taxp);
              totalp += parseFloat($(this).val());
        });
        $('#total_price_amount').html(unit+' '+totalp.toFixed(2));
        //$('#total_tax_price_amount').html(unit+' '+totaltax.toFixed(2));
    }

    function changeunit(el)
    {
        let unit = $(el).val() != "" ? parseInt($(el).val()) : 0;
        let tax = $(el).closest("tr").find(".taxprice").val() != "" ? parseFloat($(el).closest("tr").find(".taxprice").val()) : 0;
        let unitprice = $(el).closest("tr").find(".unit_price").val() != "" ? parseFloat($(el).closest("tr").find(".unit_price").val()) : 0;
        let total = unit * unitprice;
        let taxtotal = total + (total * (tax / 100));
        $(el).closest("tr").find(".total_price").val(parseFloat(total).toFixed(2));
        $(el).closest("tr").find(".tax_total_price").val(parseFloat(taxtotal).toFixed(2));

        let totalp = 0;
        let totaltax = 0;
        let $j_object = $(".tax_total_price");
        $j_object.each( function(){
            let taxp = $(this).closest("tr").find(".total_price").val() != "" ? parseFloat($(this).closest("tr").find(".total_price").val()) : 0;
            totaltax += parseFloat(parseFloat($(this).val()) - taxp);
              totalp += parseFloat($(this).val());
        });
        $('#total_price_amount').html(unit+' '+totalp.toFixed(2));
        //$('#total_tax_price_amount').html(unit+' '+totaltax.toFixed(2));
    }

    function changetaxprice(el)
    {
        let tax = $(el).val() != "" ? parseInt($(el).val()) : 0;
        let total = $(el).closest("tr").find(".total_price").val() != "" ? parseFloat($(el).closest("tr").find(".total_price").val()) : 0;
        let taxtotal = total + (total * (tax / 100));
        $(el).closest("tr").find(".tax_total_price").val(parseFloat(taxtotal).toFixed(2));

        let totalp = 0;
        let totaltax = 0;
        let $j_object = $(".tax_total_price");
        $j_object.each( function(){
            let taxp = $(this).closest("tr").find(".total_price").val() != "" ? parseFloat($(this).closest("tr").find(".total_price").val()) : 0;
            totaltax += parseFloat(parseFloat($(this).val()) - taxp);
              totalp += parseFloat($(this).val());
        });
        $('#total_price_amount').html(unit+' '+totalp.toFixed(2));
        //$('#total_tax_price_amount').html(unit+' '+totaltax.toFixed(2));
    }

    function changeunitprice(el)
    {
        let unitprice = $(el).val() != "" ? parseFloat($(el).val()) : 0;
        let unit = $(el).closest("tr").find(".unit").val() != "" ? parseInt($(el).closest("tr").find(".unit").val()) : 0;
        let tax = $(el).closest("tr").find(".taxprice").val() != "" ? parseFloat($(el).closest("tr").find(".taxprice").val()) : 0;
        let total = unit * unitprice;
        let taxtotal = total + (total * (tax / 100));
        $(el).closest("tr").find(".total_price").val(parseFloat(total).toFixed(2));
        $(el).closest("tr").find(".tax_total_price").val(parseFloat(taxtotal).toFixed(2));

        let totalp = 0;
        let totaltax = 0;
        let $j_object = $(".tax_total_price");
        $j_object.each( function(){
            let taxp = $(this).closest("tr").find(".total_price").val() != "" ? parseFloat($(this).closest("tr").find(".total_price").val()) : 0;
            totaltax += parseFloat(parseFloat($(this).val()) - taxp);
              totalp += parseFloat($(this).val());
        });
        $('#total_price_amount').html(unit+' '+totalp.toFixed(2));
        //$('#total_tax_price_amount').html(unit+' '+totaltax.toFixed(2));
    }

    var selectedel = null;

    function changecat(el)
    {
        selectedel = el;
        let product = encodeURIComponent(el.value);
        $.get( "{{ env('APP_URL') }}/getsupplierbycat/"+product, function( data ) {
              $( "#modal_body" ).html( data );
        });
        $('#selectcat').modal('open');
    }

    function addsupplier()
    {
        if(typeof $('input[name="exampleRadios"]:checked').val() != "undefined")
        {
            let product_id = $('input[name="exampleRadios"]:checked').val();
            let supplier_id = $('input[name="exampleRadios"]:checked').closest('td').find('input[name=s_id]').val();
            let price = $('input[name="exampleRadios"]:checked').closest('td').find('input[name=p_price]').val();
            let price_unit = $('input[name="exampleRadios"]:checked').closest('td').find('input[name=s_price_unit]').val();
            let moq = $('input[name="exampleRadios"]:checked').closest('td').find('input[name=p_unit]').val();
            let radiohtml = $('input[name="exampleRadios"]:checked').closest('td').find('input[name=s_name]').val();
            // let supplier_id = $('input[name="exampleRadios"]:checked').next().val();
            // let price = $('input[name="exampleRadios"]:checked').next().next().val();
            // let price_unit = $('input[name="exampleRadios"]:checked').next().next().next().next().next().val();
            // let moq = $('input[name="exampleRadios"]:checked').next().next().next().val();
            // let radiohtml = $('input[name="exampleRadios"]:checked').next().next().next().next().val();
            let tax = $(selectedel).closest("tr").find(".taxprice").val() != "" ? parseFloat($(selectedel).closest("tr").find(".taxprice").val()) : 0;
            if(price_unit == unit || unit == '')
            {
                unit = price_unit;
                $(selectedel).closest("tr").find('input[name="supplier[]"]').val(supplier_id);
                $(selectedel).closest("tr").find('input[name="product[]"]').val(product_id);
                $(selectedel).closest("tr").find('input[name="price_unit[]"]').val(price_unit);
                $(selectedel).closest("tr").find('input[name="unit_price[]"]').val(price);
                $(selectedel).closest("tr").find('input[name="unit[]"]').val(moq);
                $(selectedel).closest("tr").find('.supplier_details').html(radiohtml);

                let total = parseInt(moq) * parseFloat(price);
                let taxtotal = total + (total * (tax / 100));
                $(selectedel).closest("tr").find(".total_price").val(parseFloat(total).toFixed(2));
                $(selectedel).closest("tr").find(".tax_total_price").val(parseFloat(taxtotal).toFixed(2));
                $( "#modal_body" ).html('');
                $("#selectcat").modal('close');

                let totalp = 0;
                let totaltax = 0;
                let $j_object = $(".tax_total_price");
                $j_object.each( function(){
                    let taxp = $(this).closest("tr").find(".total_price").val() != "" ? parseFloat($(this).closest("tr").find(".total_price").val()) : 0;
                    totaltax += parseFloat(parseFloat($(this).val()) - taxp);
                      totalp += parseFloat($(this).val());
                });
                $('#total_price_amount').html(unit+' '+totalp.toFixed(2));
                //$('#total_tax_price_amount').html(unit+' '+totaltax.toFixed(2));
            }
            else
            {
                alert('Please select same price unit product.');
            }
        }
        else
        {
            alert('Select a supplier atleast');
        }
    }
    /*
    var selectedBuyerId = 0;
    document.getElementById("buyerOptionsList").addEventListener("change", function() {
        selectedBuyerId = document.getElementById("buyerOptionsList").value;
    });
    */

    // function sendMessageToBuyer()
    // {
    //     let message = {'message': 'Please see the PO at {{ $app->make('url')->to('/') }}/pro-forma-invoices and let me know your comments.','from_id' : "{{Auth::user()->id}}", 'to_id' : selectedBuyerId};
    //     socket.emit('new message', message);
    //     setTimeout(function(){
    //         window.location.href = "/message-center?uid="+selectedBuyerId;
    //     }, 1000);
    // }
</script>

@endpush

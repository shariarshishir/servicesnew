@push('js')
<script>
        //create bid rfq
        function openBidRfqModal(id){
            var rfq_id=id;
            var url = '{{ route("rfq.bid.create", ":slug") }}';
            url = url.replace(':slug', rfq_id);
            $.ajax({
                    method: 'get',
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: url,
                    beforeSend: function() {
                    $('.loading-message').html("Please Wait.");
                    $('#loadingProgressContainer').show();
                    },
                    success:function(data)
                        {
                            //console.log(data);
                            $('.loading-message').html("");
                            $('#loadingProgressContainer').hide();
                            $('#rfq-bid-modal').modal('open');
                            $('#rfq-bid-form')[0].reset();
                            $('#rfq-bid-modal .rfq-replay-submit').prop("disabled", false);

                            $('#rfq-bid-modal input[name=rfq_id]').val(data.data.id);
                            $('#rfq-bid-modal input[name=title]').val(data.data.title);
                            $('#rfq-bid-modal input[name=unit]').val(data.data.unit);
                            $('#rfq-bid-modal input[name=destination]').val(data.data.destination);

                            $('#my_business_list').html('');
                            $.each(data.my_business, function (i, item) {
                                    $('#my_business_list').append($('<option>', {
                                        value: item.id,
                                        text : item.business_name
                                    }));
                            });
                            if(data.hasOwnProperty('bid')){
                                $('#my_business_list').val(data.bid.business_profile_id);
                                $('#my_business_list').trigger('change');
                                $('#rfq-bid-modal input[name=quantity]').val(data.bid.quantity);
                                tinymce.get("product-bidding-desc").setContent(data.bid.description);
                                $('#rfq-bid-modal input[name=unit_price]').val(data.bid.unit_price);
                                $('#rfq-bid-modal input[name=total_price]').val(data.bid.total_price);
                                $('#product-payment-method').val(data.bid.payment_method);
                                $('#product-payment-method').trigger('change');
                                $('#rfq-bid-modal input[name=delivery_time]').val(data.bid.delivery_time);
                                $('#rfq-bid-modal .rfq-replay-submit').prop("disabled", true);

                            }

                        },

                    error: function(xhr, status, error)
                        {
                            $('.loading-message').html("");
                            $('#loadingProgressContainer').hide();
                            $('#errors').empty();
                            $("#errors").append("<li class='alert alert-danger'>"+error+"</li>")
                            $.each(xhr.responseJSON.error, function (key, item)
                            {
                                $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                            });

                        }
                });

        }

        //store bid rfq
        $('#rfq-bid-form').on('submit',function(e){
            e.preventDefault();
            tinyMCE.triggerSave();
            var formData = new FormData(this);
            var url = '{{ route("rfq.bid.store") }}';
            formData.append('_token', "{{ csrf_token() }}");
            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: 'multipart/form-data',
                url: url,
                beforeSend: function() {
                $('.loading-message').html("Please Wait.");
                $('#loadingProgressContainer').show();
                },
                success:function(data)
                    {
                        $('.loading-message').html("");
		                $('#loadingProgressContainer').hide();
                        $('#rfq_bid_store_errors').empty();
                        $('#rfq-bid-modal').modal('close');
                        swal("Done!", data.msg,"success");

                    },
                error: function(xhr, status, error)
                    {
                        $('.loading-message').html("");
		                $('#loadingProgressContainer').hide();
                        $('#rfq_bid_store_errors').empty();
                        $("#rfq_bid_store_errors").append("<div class=''>"+error+"</div>");
                        $.each(xhr.responseJSON.error, function (key, item)
                        {
                            $("#rfq_bid_store_errors").append("<div class=''>"+item+"</div>");

                        });

                    }
            });
        });

</script>
@endpush

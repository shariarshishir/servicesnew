@push('js')
    <script>

    $(document).on('change', '.select-business-type', function(){
        var value =$('.select-business-type option:selected').val();
        if(value == 1){

            $('.number_of_factories').show();
            $('.number_of_outlets').hide();
            $('.business-category-div').show();

        }
        else if(value == 2){
            $('.number_of_factories').hide();
            $('.number_of_outlets').show();
            $('.business-category-div').hide();
        }
        else{
            $('.number_of_factories').hide();
            $('.number_of_outlets').hide();
            $('.business-category-div').hide();
        }
    });


   //store business form data
   $('#business_profile_form').on('submit',function(e){
            e.preventDefault();
            var url = '{{ route("business.profile.store") }}';
            var formData = new FormData(this);
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
                        $('#edit_errors').empty();
                        //console.log(data);
                        swal("Done!", data.msg,"success");
                        window.location.href=data.redirect_url;

                    },
                error: function(xhr, status, error)
                    {
                        $('.loading-message').html("");
		                $('#loadingProgressContainer').hide();
                        $('#edit_errors').empty();
                        //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+error+"</div></div>");
                        $("#edit_errors").append("<div class=''>"+error+"</div>");
                        $.each(xhr.responseJSON.error, function (key, item)
                        {
                            //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+item+"</div></div>");
                            $("#edit_errors").append("<div class=''>"+item+"</div>");

                        });

                    }
            });
        });

    //update company overview
   $('#company-overview-update-form').on('submit',function(e){
            e.preventDefault();
            var id = $('input[name=company_overview_id]').val();
            var url = '{{ route("company.overview.update", ":slug") }}';
                url = url.replace(':slug', id);
            var formData = new FormData(this);
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
                        $('#errors').empty();
                        $.each(data.data, function(key, item){
                           $('.'+item.name+'_value').text(item.value);
                           $('.'+item.name+'_status').text(item.status);
                        });
                        $('#company_overview_modal').modal('close');
                       //console.log(data);
                        swal("Done!", data.msg,"success");
                    },
                error: function(xhr, status, error)
                    {
                        $('.loading-message').html("");
		                $('#loadingProgressContainer').hide();
                        $('#errors').empty();
                        //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+error+"</div></div>");
                        $("#errors").append("<div class=''>"+error+"</div>");
                        $.each(xhr.responseJSON.error, function (key, item)
                        {
                            //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+item+"</div></div>");
                            $("#errors").append("<div class=''>"+item+"</div>");

                        });

                    }
            });
        });
    //add manufacture product modal open
    $(document).ready(function() {
        $('.product-add-modal-trigger').click(function(){
            $("#product-add-modal-block").modal('open');
        });
    });


    //manufacture product upload
    $('#manufacture-product-upload-form').on('submit',function(e){
                e.preventDefault();
                tinyMCE.triggerSave();
                var url = '{{ route("manufacture.product.store") }}';
                var formData = new FormData(this);
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
                            $('#errors').empty();
                            console.log(data);
                            $('#product-add-modal-block').modal('close');
                            $('.manufacture-product-table-data').html('');
                            $('.manufacture-product-table-data').html(data.data);
                            swal("Done!", data.msg,"success");
                        },
                    error: function(xhr, status, error)
                        {
                            $('.loading-message').html("");
                            $('#loadingProgressContainer').hide();
                            $('#manufacture-product-upload-errors').empty();
                            //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+error+"</div></div>");
                            $("#manufacture-product-upload-errors").append("<div class=''>"+error+"</div>");
                            $.each(xhr.responseJSON.error, function (key, item)
                            {
                                //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+item+"</div></div>");
                                $("#manufacture-product-upload-errors").append("<div class=''>"+item+"</div>");

                            });

                        }
                });
            });

        //change categroy by business type
        var categorys = @json($manufacture_product_categories);

        function changecategory(value)
        {
            var cats = '<option disabled selected>Category</option>';
            for(var i = 0; i < categorys.length; i++)
            {
                if(categorys[i].industry == value)
                {
                    cats += '<option value="'+categorys[i].id+'">'+categorys[i].name+'</value>';
                }
            }
            $('#categoryList').html(cats);
        }

        //edit product
        function editproduct(productId)
        {
            var url = '{{ route("manufacture.product.edit", ":slug") }}';
                url = url.replace(':slug', productId);
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
                        $('.loading-message').html("");
		                $('#loadingProgressContainer').hide();
                        $('#manufacture_edit_errors').empty();
                        $('#product-edit-modal-block').modal('open');
                        $('#product-edit-modal-block .modal-content').html('');
                        $('#product-edit-modal-block .modal-content').html(data.data);

                    },
                error: function(xhr, status, error)
                    {
                        $('.loading-message').html("");
		                $('#loadingProgressContainer').hide();
                        $('#manufacture_edit_errors').empty();
                        //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+error+"</div></div>");
                        $("#manufacture_edit_errors").append("<div class=''>"+error+"</div>");
                        $.each(xhr.responseJSON.error, function (key, item)
                        {
                            //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+item+"</div></div>");
                            $("#manufacture_edit_errors").append("<div class=''>"+item+"</div>");

                        });

                    }
            });
        }


        //manufacture product update
        $('#manufacture-product-update-form').on('submit',function(e){
                    e.preventDefault();
                    tinyMCE.triggerSave();
                    var productId=$('input[name=edit_product_id]').val();
                    var url = '{{ route("manufacture.product.update", ":slug") }}';
                        url = url.replace(':slug', productId);
                    var formData = new FormData(this);
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
                                $('#manufacture-update-errors').empty();
                                $('#product-edit-modal-block').modal('close');
                                $('.manufacture-product-table-data').html('');
                                $('.manufacture-product-table-data').html(data.data);
                                swal("Done!", data.msg,"success");
                            },
                        error: function(xhr, status, error)
                            {
                                $('.loading-message').html("");
                                $('#loadingProgressContainer').hide();
                                $('#manufacture-update-errors').empty();
                                //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+error+"</div></div>");
                                $("#manufacture-update-errors").append("<div class=''>"+error+"</div>");
                                $.each(xhr.responseJSON.error, function (key, item)
                                {
                                    //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+item+"</div></div>");
                                    $("#manufacture-update-errors").append("<div class=''>"+item+"</div>");

                                });

                            }
                    });
                });

        //delete product
        function deleteProduct(productId,business_profile_id)
        {
            var url = '{{ route("manufacture.product.delete", [":slug", ":slug2"]) }}';
                url = url.replace(':slug', productId);
                url = url.replace(':slug2', business_profile_id);
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
                        $('.loading-message').html("");
		                $('#loadingProgressContainer').hide();
                        $('#manufacture_edit_errors').empty();
                        $('#product-edit-modal-block .modal-content').html('');
                        $('#product-edit-modal-block .modal-content').html(data.data);
                        swal("Done!", data.msg,"success");

                    },
                error: function(xhr, status, error)
                    {
                        $('.loading-message').html("");
		                $('#loadingProgressContainer').hide();
                        $('#manufacture_edit_errors').empty();
                        //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+error+"</div></div>");
                        $("#manufacture_edit_errors").append("<div class=''>"+error+"</div>");
                        $.each(xhr.responseJSON.error, function (key, item)
                        {
                            //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+item+"</div></div>");
                            $("#manufacture_edit_errors").append("<div class=''>"+item+"</div>");

                        });

                    }
            });
        }


    </script>
@endpush

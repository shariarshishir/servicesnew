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



    //Add and remove row for production and capacity dynamically
    function addProductionCapacity()
    {
    let totalChild = $('.production-capacity-table-block tbody').children().length;
    var html = '<tr>';
    html += '<td><input name="machine_type[]" id="machine_type" type="text" class="form-control  value="" ></td>';
    html += '<td><input name="annual_capacity[]" id="annual_capacity" type="number" class="form-control  value="" ></td>';
    html += '<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeProductionCapacity(this)"><i class="material-icons dp48">remove</i></a></td>';
    html += '</tr>';
    $('.production-capacity-table-block tbody').append(html);
    }
    function removeProductionCapacity(el)
    {
        $(el).parent().parent().remove();
    }

    //Add and remove row for categories produced product dynamically
    function addCategoriesProduced()
    {
        let totalChild = $('.categories-produced-table-block tbody').children().length;
        var html = '<tr>';
        html += '<td><input name="type[]" id="type" type="text" class="form-control  value="" ></td>';
        html += '<td><input name="percentage[]" id="percentage" type="number" class="form-control  value="" ></td>';
        html += '<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeCategoriesProduced(this)"><i class="material-icons dp48">remove</i></a></td>';
        html += '</tr>';
        $('.categories-produced-table-block tbody').append(html);
    }
    function removeCategoriesProduced(el)
    {
        $(el).parent().parent().remove();
    }


    //Add and remove row for categories produced product dynamically
    function addMachinariesDetails()
    {
    let totalChild = $('.machinaries-details-table-block tbody').children().length;
    var html = '<tr>';
    html += '<td><input name="machine_name[]" id="machine_name" type="text" class="form-control  value="" ></td>';
    html += '<td><input name="quantity[]" id="quantity" type="number" class="form-control  value="" ></td>';
    html += '<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeCategoriesProduced(this)"><i class="material-icons dp48">remove</i></a></td>';
    html += '</tr>';
    $('.machinaries-details-table-block tbody').append(html);
    }
    function removeMachinariesDetails(el)
    {
        $(el).parent().parent().remove();
    }

    //submit form  FOR CAPACITY AND MECHINERIES
    $('#capacity-machinaries-form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      url: "/capacity-and-machineries-create-or-update",
      type:"POST",
      data: $('#capacity-machinaries-form').serialize(),
     
      success:function(response){
        var machineriesDetails=response.machineriesDetails;
        var categoriesProduceds=response.categoriesProduceds;
        var productionCapacities=response.productionCapacities;
        var nohtml="";
        if(machineriesDetails.length >0){
            $('.machinaries-details-table-body').html(nohtml);
            for(let i=0;i<machineriesDetails.length ;i++){
                var html = '<tr>';
                html += '<td>'+machineriesDetails[i].machine_name+'</td>';
                html += '<td>'+machineriesDetails[i].quantity+'</td>';
                html += '<td>'+machineriesDetails[i].status+'</td>';
                html += '</tr>';
                $('.machinaries-details-table-body').append(html)
            }
        }

        var nohtml="";
        if(categoriesProduceds.length >0){
            $('.categories-produced-table-body').html(nohtml);
            for(let i=0;i<categoriesProduceds.length ;i++){
                var html = '<tr>';
                html += '<td>'+categoriesProduceds[i].type+'</td>';
                html += '<td>'+categoriesProduceds[i].percentage+'</td>';
                html += '<td>'+categoriesProduceds[i].status+'</td>';
                html += '</tr>';
                $('.categories-produced-table-body').append(html)
            }
        }
        var nohtml="";
        if(productionCapacities.length >0){
            $('.production-capacity-table-body').html(nohtml);
            for(let i=0;i<productionCapacities.length ;i++){
                var html = '<tr>';
                html += '<td>'+productionCapacities[i].machine_type+'</td>';
                html += '<td>'+productionCapacities[i].annual_capacity+'</td>';
                html += '<td>'+productionCapacities[i].status+'</td>';
                html += '</tr>';
                $('.production-capacity-table-body').append(html)
            }
        }

        
        
        $('#capacity-and-machineries-modal').modal('close');
        swal("Done!", response.message,"success");
      },
      error: function(xhr, status, error)
            {
                $('#capacity-machineries-errors').empty();
                $("#capacity-machineries-errors").append("<div class=''>"+error+"</div>");
                $.each(xhr.responseJSON.error, function (key, item)
                {   
                    $("#capacity-machineries-errors").append("<div class='danger'>"+item+"</div>");
                });
            }
      });
    });

    </script>
@endpush

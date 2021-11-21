@push('js')
    <script>

    $(document).ready(function()
    {
        $(".next_to_business_profile_info, .last-step").click(function()
        {
            //alert("I am here");
            var name = $("#business_name").val();
            /*
            var location = $("#location").val();

            var businessType = $("#business_type").val();
            var manufacturerType = $("#manufacturer_type").val();
            var wholesalerType = $("#wholesaler_type").val();

            var number_of_factories = $("#factories_number").val();
            var outlets_number = $("#outlets_number").val();
            var trade_license = $("#trade_license").val();
            var industry_type = $("#industry_type").val();

            var representative_name = $("#representatives_name").val();
            var representatives_email = $("#representatives_email").val();
            var representatives_contact = $("#representatives_contact").val();
            var representative_nidPassport = $("#representative_nidPassport").val();
            */

            $("#review_name").html("<b>Name:</b> "+name);
            /*
            $("#review_location").html("<b>Location:</b> "+location);

            $("#business_type").html("<b>Business Type:</b> "+businessType);
            $("#manufacturer_type").html("<b>Manufacturer Type:</b> "+manufacturerType);
            $("#wholesaler_type").html("<b>Wholesaler Type:</b> "+wholesalerType);

            $("#number_of_factories").html("<b>Number of Factories:</b> "+number_of_factories);
            $("#review_outlets_number").html("<b>Outlets NUmber:</b> "+outlets_number);
            $("#review_trade_license").html("<b>Trade License:</b> "+trade_license);
            $("#review_industry_type").html("<b>Industry Type:</b> "+industry_type);

            $("#review_representative_name").html("<b>Representative Name:</b> "+representative_name);
            $("#review_representatives_email").html("<b>Representative Email:</b> "+representatives_email);
            $("#review_representatives_contact").html("<b>Representative Contact:</b> "+representatives_contact);
            $("#review_representative_nidPassport").html("<b>Representative NID/Passport:</b> "+representative_nidPassport);
            */

            if(!name){
                var alertHtml = '<div class="card-alert card orange lighten-5">';
                alertHtml += '<div class="card-content orange-text">';
                alertHtml += '<p>WARNING : Please fill all the required fields.</p>';
                alertHtml += '</div>';
                alertHtml += '</div>';
                $("#information_message").html(alertHtml);
                $("#review_name").hide();
            } else {
                var infoHtml = '<div class="card-alert card cyan lighten-5">';
                infoHtml += '<div class="card-content cyan-text">';
                infoHtml += '<p>INFO : Please verify your input data and hit submit button to create profile.</p>';
                infoHtml += '</div>';
                infoHtml += '</div>';
                $("#information_message").html(infoHtml);
                $("#review_name").show();
            }
        });
	});

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
                        $('#company-overview-modal').modal('close');
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
            $('#manufacture-product-upload-form')[0].reset();
            $('#category_id').val('');
            $('#category_id').trigger('change');
            $('#colors').val('');
            $('#colors').trigger('change');
            $('#sizes').val('');
            $('#sizes').trigger('change');
            $('.file').val('');
            $('.img-thumbnail').attr('src', 'https://via.placeholder.com/80');
            $('#manufacture-product-upload-errors').empty();
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

            var url = '{{ route("manufacture.product.delete", [":slug" , ":slugs"]) }}';
                url = url.replace(':slug', productId);
                url = url.replace(':slugs', business_profile_id);
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
                        $('.manufacture-product-table-data').html('');
                        $('.manufacture-product-table-data').html(data.data);
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
        $('#production-capacity-table-no-data').hide();
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
        $('#categories-produced-table-no-data').hide();
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
    $('#machinaries-details-table-no-data').hide();
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
        else{

            $('.machinaries-details-table-body').children().empty();
            var html = '<tr><td><span>No Data</span></td></tr>';
            $('.machinaries-details-table-body').append(html);
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
                $('.categories-produced-table-body').append(html);
            }
        }else{
            $('.categories-produced-table-body').children().empty();
            var html = '<tr><td><span>No Data</span></td></tr>';
            $('.categories-produced-table-body').append(html);
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
        }else{

            $('.production-capacity-table-body').children().empty();
            var html = '<tr><td><span>No Data</span></td></tr>';
            $('.production-capacity-table-body').append(html);
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




    //Add and remove row for production-flow-and-manpower dynamically
    function addProductionFlowAndManpower()
    {
    
        let totalChild = $('.production-flow-and-manpower-table-block tbody').children().length;
        var html = '<tr>';
        html +='<td><input name="production_type[]" id="production_type" type="text" class="form-control "  value="" ></td>';
        html +='<td><input name="no_of_jacquard_machines[]" id="no_of_jacquard_machines" type="number" class="form-control "  value="" ></td>';
        html +='<td><input name="manpower[]" id="manpower" type="number" class="form-control "  value="" ></td>';
        html +='<td><input name="daily_capacity[]" id="daily_capacity" type="number" class="form-control "  value="" ></td>';
        html +='<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeProductionFlowAndManpower(this)"><i class="material-icons dp48">remove</i></a></td>';
        html +='</tr>';
        $('.production-flow-and-manpower-table-block tbody').append(html);
    }
    function removeProductionFlowAndManpower(el)
    {
        $(el).parent().parent().remove();
    }



    //submit form for production flow and manpower
    //submit form  FOR CAPACITY AND MECHINERIES
    $('#production-flow-and-manpower-form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      url: "/production-flow-and-manpower-create-or-update",
      type:"POST",
      data: $('#production-flow-and-manpower-form').serialize(),

      success:function(response){
        var productionFlowAndManpowers=response.productionFlowAndManpowers;
        var nohtml="";
        if(productionFlowAndManpowers.length >0){

            $('.production-flow-and-manpower-table-body').html(nohtml);
            for(let i = 0;i < productionFlowAndManpowers.length ;i++){

                var html = '<tr>';
                html += '<th>'+productionFlowAndManpowers[i].production_type+'</th>';
                html += '<td>';
                html += '<table style="width:100%; border: 0px;" border="0" cellpadding="0" cellspacing="0">';
                $.each(JSON.parse(productionFlowAndManpowers[i].flow_and_manpower), function(index) {
                    html += '<tr>';
                    html += '<td>'+this.name+'</td>';
                    html += '<td>'+this.value+'</td>';
                    html += '<td>'+this.status+'</td>';
                    html += '</tr>';
                });
                html += '</table>';
                html += '</td>';
                html += '</tr>';

                $('.production-flow-and-manpower-table-body').append(html);
                
            }
        }
        else{
            
            $('.production-flow-and-manpower-table-body').children().empty();
            var html = '<tr><td><span>No Data</span></td></tr>';
            $('.production-flow-and-manpower-table-body').append(html);
        }

      

        $('#production-flow-and-manpower-modal').modal('close');
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
    //add or remove certification details input row
    function addCertificationDetails()
    {
        $('#certification-details-table-no-data').hide();
        var html = '<tr>';
        html +='<td><input name="title[]" id="certification-title" type="text" class="input-field"  value="" ></td>';
        html +='<td><textarea class="input-field" name="short_description[]" id="certification-short-description" rows="4" cols="50"></textarea></td>';
        html +='<td><input name="image[]" class="input-field"  id="certification-image" type="file"></td>';
        html +='<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeCertificationDetails(this)"><i class="material-icons dp48">remove</i></a></td>';
        html +='</tr>';
        $('.certification-details-table-block tbody').append(html);
    }
    function removeCertificationDetails(el)
    {
        $(el).parent().parent().remove();
    }


    //submit form for certification details
    $('#certification-upload-form').on('submit',function(e){
    e.preventDefault();
    var url = '{{ route("certification.upload") }}';
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

      success:function(response){
        var certifications=response.certifications;
        console.log(certifications);
        var nohtml="";
        if(certifications.length >0){
            $('.certifications-block').html(nohtml);
          
            for(let i = 0;i <certifications.length ;i++){
                var html='';
                var image="{{asset('storage/')}}"+'/'+certifications[i].image;
                html +='<div class="col m3 l3 certificate_img">';
                html +='<a href="javascript:void(0)" data-id="'+certifications[i].id+'" class="remove-certificate"><i class="material-icons dp48">remove_circle_outline</i></a>';
                html +='<img src="'+image+'" alt="">';
                html +='</div>';
                $('.certifications-block').append(html);
            }
          
        }
        $('#certification-upload-form-modal').modal('close');
        swal("Done!", response.message,"success");
      },
      error: function(xhr, status, error)
            {
                $('#certification-upload-errors').empty();
                $("#certification-upload-errors").append("<div class=''>"+error+"</div>");
                $.each(xhr.responseJSON.error, function (key, item)
                {
                    $("#certification-upload-errors").append("<div class='danger'>"+item+"</div>");
                });
            }
      });
    });
    $(document).on('click', '.delete-certification-button',function(e){
        e.preventDefault();
        $('.remove-certificate').show();
    });

    $(document).on('click', '.remove-certificate',function(e)
    {
        e.preventDefault();
        var id=$(this).attr("data-id");
        console.log(id);
        swal({
                title: "Want to delete this certificate ?",
                text: "Please ensure and then confirm!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) 
                {
                    $.ajax({
                        url: '{{ route("certification.delete") }}',
                        type: "GET",
                        data:{id:id},
                        success:function(response)
                            {
                                var certifications=response.certifications;
                                console.log(certifications);
                                var nohtml="";
                                if(certifications.length >0){
                                    $('.certifications-block').html(nohtml);
                                    for(let i = 0;i <certifications.length ;i++){
                                        var html='';
                                        var image="{{asset('storage/')}}"+'/'+certifications[i].image;
                                        html +='<div class="col m3 l3 certificate_img">';
                                        html +='<a style="display: none;" href="javascript:void(0)" data-id="'+certifications[i].id+'" class="remove-certificate"><i class="material-icons dp48">remove_circle_outline</i></a>';
                                        html +='<img src="'+image+'" alt="">';
                                        html +='</div>';
                                        $('.certifications-block').append(html);
                                    }
                                }
                                $('#certification-upload-form-modal').modal('close');
                                swal("Done!", response.message,"success");
                            },
                            error: function(xhr, status, error)
                            {
                                toastr.success(error);
                            }
                        });
                }
                else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
    });

    function addMainBuyersDetails()
    {
        $('#main-buyers-details-table-no-data').hide();
        var html = '<tr>';
        html +='<td><input name="title[]" id="main-buyer-title" type="text" class="input-field"  value="" ></td>';
        html +='<td><textarea class="input-field" name="short_description[]" id="main-buyer-short-description" rows="4" cols="50"></textarea></td>';
        html +='<td><input name="image[]" class="input-field"  id="main-buyer-image" type="file"></td>';
        html +='<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeMainBuyersDetails(this)"><i class="material-icons dp48">remove</i></a></td>';
        html +='</tr>';
        $('.main-buyers-details-table-block tbody').append(html);
    }

    function removeMainBuyersDetails(el)
    {
        $(el).parent().parent().remove();
    }

    //submit form for main buyers details





    $('#main-buyer-upload-form').on('submit',function(e){
    e.preventDefault();
    var url = '{{ route("mainbuyers.upload") }}';
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

      success:function(response){
        var mainBuyers=response.mainBuyers;
        console.log(mainBuyers);
        var nohtml="";
        if(mainBuyers.length >0){
            $('.main-buyers-block').html(nohtml);
          
            for(let i = 0;i < mainBuyers.length ;i++){
                var html='';
                var image="{{asset('storage/')}}"+'/'+mainBuyers[i].image;
                html +='<div class="col m3 l3 main_buyer_img">';
                html +='<a style="display: none;" href="javascript:void(0)" data-id="'+mainBuyers[i].id+'" class="remove-main-buyer"><i class="material-icons dp48">remove_circle_outline</i></a>';
                html +='<img src="'+image+'" alt="">';
                html +='<h5>'+mainBuyers[i].title+'</h5>';
                html +='</div>';
                $('.main-buyers-block').append(html);
            }
        }
        
        $('#main-buyers-upload-form-modal').modal('close');
        swal("Done!", response.message,"success");
      },
      error: function(xhr, status, error)
            {
                $('#main-buyer-upload-errors').empty();
                $("#main-buyer-upload-errors").append("<div class=''>"+error+"</div>");
                $.each(xhr.responseJSON.error, function (key, item)
                {
                    $("#main-buyer-upload-errors").append("<div class='danger'>"+item+"</div>");
                });
            }
      });
    });





    $(document).on('click', '.delete-main-buyer-button',function(e){
        e.preventDefault();
        $('.remove-main-buyer').show();
    });


    $(document).on('click', '.remove-main-buyer',function(e)
    {
        e.preventDefault();
        var id=$(this).attr("data-id");
        console.log(id);
        swal({
                title: "Want to delete this main buyer ?",
                text: "Please ensure and then confirm!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) 
                {
                    $.ajax({
                        url: '{{ route("mainbuyers.delete") }}',
                        type: "GET",
                        data:{id:id},
                        success:function(response)
                            {
                                var mainBuyers=response.mainBuyers;
                                console.log(mainBuyers);
                                var nohtml="";
                                if(mainBuyers.length >0){
                                    $('.main-buyers-block').html(nohtml);
                                    for(let i = 0;i < mainBuyers.length ;i++){
                                        var html='';
                                        var image="{{asset('storage/')}}"+'/'+mainBuyers[i].image;
                                        html +='<div class="col m3 l3 main_buyer_img">';
                                        html +='<a style="display: none;" href="javascript:void(0)" data-id="'+mainBuyers[i].id+'" class="remove-main-buyer"><i class="material-icons dp48">remove_circle_outline</i></a>';
                                        html +='<img src="'+image+'" alt="">';
                                        html +='<h5>'+mainBuyers[i].title+'</h5>';
                                        html +='</div>';
                                        $('.main-buyers-block').append(html);
                                    }
                                }
                                $('#main-buyers-upload-form-modal').modal('close');
                                swal("Done!", response.message,"success");
                            },
                            error: function(xhr, status, error)
                            {
                                toastr.success(error);
                            }
                        });
                }
                else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
    });


//export destination add remove
    function addExportDestinationDetails()
    {
        
        $('#export-destination-details-table-no-data').hide();
        var html = '<tr>';
        html +='<td><input name="title[]" id="export-destination-title" type="text" class="input-field"  value="" ></td>';
        html +='<td><textarea class="input-field" name="short_description[]" id="export-destination-short-description" rows="4" cols="50"></textarea></td>';
        html +='<td><input name="image[]" class="input-field"  id="export-destination-image" type="file"></td>';
        html +='<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeExportDestinationDetails(this)"><i class="material-icons dp48">remove</i></a></td>';
        html +='</tr>';
        $('.export-destination-table-block tbody').append(html);
    }

    function removeExportDestinationDetails(el)
    {
        $(el).parent().parent().remove();
    }
     //submit form for export destination 

     $('#export-destination-upload-form').on('submit',function(e){
    e.preventDefault();
    var url = '{{ route("exportdestinations.upload") }}';
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

      success:function(response){
        var exportDestinations=response.exportDestinations;
        console.log(exportDestinations);
        var nohtml="";
        if(exportDestinations.length >0){
            $('.export-destination-block').html(nohtml);
          
            for(let i = 0;i < exportDestinations.length ;i++){
                var html='';
                var image="{{asset('storage/')}}"+'/'+exportDestinations[i].image;
                html +='<div class="flag_img export-destination-img">';
                html +='<a style="display: none;" href="javascript:void(0)" data-id="'+ exportDestinations[i].id+'" class="remove-export-destination"><i class="material-icons dp48">remove_circle_outline</i></a>';
                html +='<img src="'+image+'" alt="">';
                html +='</div>';
                html +='<h5>'+exportDestinations[i].title+'</h5>';
                $('.export-destination-block').append(html);
            }
        }
        
        $('#export-destination-upload-form-modal').modal('close');
        swal("Done!", response.message,"success");
      },
      error: function(xhr, status, error)
            {
                $('#export-destination-upload-errors').empty();
                $("#export-destination-upload-errors").append("<div class=''>"+error+"</div>");
                $.each(xhr.responseJSON.error, function (key, item)
                {
                    $("#export-destination-upload-errors").append("<div class='danger'>"+item+"</div>");
                });
            }
      });
    });



    $(document).on('click', '.delete-export-destination-button',function(e){
        e.preventDefault();
        $('.remove-export-destination').show();
    });


    $(document).on('click', '.remove-export-destination',function(e)
    {
        e.preventDefault();
        var id=$(this).attr("data-id");
        console.log(id);
        swal({
                title: "Want to delete this export destionation ?",
                text: "Please ensure and then confirm!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) 
                {
                    $.ajax({
                        url: '{{ route("exportdestinations.delete") }}',
                        type: "GET",
                        data:{id:id},
                        success:function(response)
                            {
                                var exportDestinations=response.exportDestinations;
                                console.log(exportDestinations);
                                var nohtml="";
                                if(exportDestinations.length >0){
                                    $('.export-destination-block').html(nohtml);
                                    for(let i = 0;i < exportDestinations.length ;i++){
                                        var html='';
                                        var image="{{asset('storage/')}}"+'/'+exportDestinations[i].image;
                                        html +='<div class="flag_img export-destination-img">';
                                        html +='<a style="display: none;" href="javascript:void(0)" data-id="'+exportDestinations[i].id+'" class="remove-export-destination"><i class="material-icons dp48">remove_circle_outline</i></a>';
                                        html +='<img src="'+image+'" alt="">';
                                        html +='</div>';
                                        html +='<h5>'+exportDestinations[i].title+'</h5>';
                                        $('.export-destination-block').append(html);
                                    }
                                }
                                $('#export-destination-upload-form-modal').modal('close');
                                swal("Done!", response.message,"success");
                            },
                            error: function(xhr, status, error)
                            {
                                toastr.success(error);
                            }
                        });
                }
                else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
    });



     // association membership add or remove 

    function addAssociationMembershipDetails()
    {
        
        $('#association-membership-details-table-no-data').hide();
        var html = '<tr>';
        html +='<td><input name="title[]" id="association-membership-title" type="text" class="input-field"  value="" ></td>';
        html +='<td><textarea class="input-field" name="short_description[]" id="association-membership-short-description" rows="4" cols="50"></textarea></td>';
        html +='<td><input name="image[]" class="input-field"  id="association-membership-image" type="file"></td>';
        html +='<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeAssociationMembershipDetails(this)"><i class="material-icons dp48">remove</i></a></td>';
        html +='</tr>';
        $('.association-membership-details-table-block tbody').append(html);
    }

    function removeAssociationMembershipDetails(el)
    {
        $(el).parent().parent().remove();
    }


    //submit form of association member ship
    $('#association-membership-upload-form').on('submit',function(e){
    e.preventDefault();
    var url = '{{ route("associationmemberships.upload") }}';
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

      success:function(response){
        var associationMemberships=response.associationMemberships;
        console.log(associationMemberships);
        var nohtml="";
        if(associationMemberships.length >0){
            $('.association-membership-block').html(nohtml);
          
            for(let i = 0;i < associationMemberships.length ;i++){
                var html='';
                var image="{{asset('storage/')}}"+'/'+associationMemberships[i].image;
                html +='<div class="col s12 m6 l5 center-align association-membership-img">';
                html +='<a style="display: none;" href="javascript:void(0)" data-id="'+ associationMemberships[i].id+'" class="remove-association-membership"><i class="material-icons dp48">remove_circle_outline</i></a>';
                html +='<img src="'+image+'" alt="">';
                html +='<p>'+associationMemberships[i].title+'</p>';
                html +='</div>';
                
                $('.association-membership-block').append(html);

            }
        }
        
        $('#association-membership-upload-form-modal').modal('close');
        swal("Done!", response.message,"success");
      },
      error: function(xhr, status, error)
            {
                $('#association-membership-upload-errors').empty();
                $("#association-membership-upload-errors").append("<div class=''>"+error+"</div>");
                $.each(xhr.responseJSON.error, function (key, item)
                {
                    $("#association-membership-upload-errors").append("<div class='danger'>"+item+"</div>");
                });
            }
      });
    });


    $(document).on('click', '.delete-association-membership-button',function(e){
        e.preventDefault();
        $('.remove-association-membership').show();
    });


    $(document).on('click', '.remove-association-membership',function(e)
    {
        e.preventDefault();
        var id=$(this).attr("data-id");
        console.log(id);
        swal({
                title: "Want to delete this association membership ?",
                text: "Please ensure and then confirm!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) 
                {
                    $.ajax({
                        url: '{{ route("associationmemberships.delete") }}',
                        type: "GET",
                        data:{id:id},
                        success:function(response)
                            {
                                var associationMemberships=response.associationMemberships;
                                console.log(associationMemberships);
                                var nohtml="";
                                if(associationMemberships.length >0){
                                    $('.association-membership-block').html(nohtml);
                                    for(let i = 0;i < associationMemberships.length ;i++){
                                        var html='';
                                        var image="{{asset('storage/')}}"+'/'+associationMemberships[i].image;
                                        html +='<div class="col s12 m6 l5 center-align association-membership-img">';
                                        html +='<a style="display: none;" href="javascript:void(0)" data-id="'+ associationMemberships[i].id+'" class="remove-association-membership"><i class="material-icons dp48">remove_circle_outline</i></a>';
                                        html +='<img src="'+image+'" alt="">';
                                        html +='<p>'+associationMemberships[i].title+'</p>';
                                        html +='</div>';
                                        $('.association-membership-block').append(html);
                                    }
                                }
                                $('#association-membership-upload-form-modal').modal('close');
                                swal("Done!", response.message,"success");
                            },
                            error: function(xhr, status, error)
                            {
                                toastr.success(error);
                            }
                        });
                }
                else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
    });
    

    //submit form of PR highlight
    function addPressHighlightDetails()
    {
        
        $('#press-highlight-details-table-no-data').hide();
        var html = '<tr>';
        html +='<td><input name="title[]" id="press-highlight-title" type="text" class="input-field"  value="" ></td>';
        html +='<td><textarea class="input-field" name="short_description[]" id="press-highlight-short-description" rows="4" cols="50"></textarea></td>';
        html +='<td><input name="image[]" class="input-field"  id="press-highlight-image" type="file"></td>';
        html +='<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removePressHighlightDetails(this)"><i class="material-icons dp48">remove</i></a></td>';
        html +='</tr>';
        $('.press-highlight-details-table-block tbody').append(html);
    }

    function removePressHighlightDetails(el)
    {
        $(el).parent().parent().remove();
    }

    $('#press-highlight-upload-form').on('submit',function(e){
    e.preventDefault();
    var url = '{{ route("presshighlights.upload") }}';
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

      success:function(response){
        var pressHighlights=response.pressHighlights;
        console.log(pressHighlights);
        var nohtml="";
        if(pressHighlights.length >0){
            $('.press-highlight-block').html(nohtml);
          
            for(let i = 0;i < pressHighlights.length ;i++){
                var html='';
                var image="{{asset('storage/')}}"+'/'+pressHighlights[i].image;
                html +='<div class="col s6 m4 l2 paper_img press-highlight-img">';
                html +='<a style="display: none;" href="javascript:void(0)" data-id="'+pressHighlights[i].id+'" class="remove-press-highlight"><i class="material-icons dp48">remove_circle_outline</i></a>';
                html +='<img src="'+image+'" alt="">';
                html +='</div>';
                
                $('.press-highlight-block').append(html);

            }
        }
        
        $('#press-highlight-upload-form-modal').modal('close');
        swal("Done!", response.message,"success");
      },
      error: function(xhr, status, error)
            {
                $('#press-highlight-upload-errors').empty();
                $("#press-highlight-upload-errors").append("<div class=''>"+error+"</div>");
                $.each(xhr.responseJSON.error, function (key, item)
                {
                    $("#press-highlight-upload-errors").append("<div class='danger'>"+item+"</div>");
                });
            }
      });
    });


    $(document).on('click', '.delete-press-highlight-button',function(e){
        e.preventDefault();
        $('.remove-press-highlight').show();
    });


    $(document).on('click', '.remove-press-highlight',function(e)
    {
        e.preventDefault();
        var id=$(this).attr("data-id");
        console.log(id);
        swal({
                title: "Want to delete this PR highlight ?",
                text: "Please ensure and then confirm!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) 
                {
                    $.ajax({
                        url: '{{ route("presshighlights.delete") }}',
                        type: "GET",
                        data:{id:id},
                        success:function(response)
                            {
                                var pressHighlights=response.pressHighlights;
                                console.log(pressHighlights);
                                var nohtml="";
                                if(pressHighlights.length >0){
                                    $('.press-highlight-block').html(nohtml);
                                    for(let i = 0;i < pressHighlights.length ;i++){
                                        var html='';
                                        var image="{{asset('storage/')}}"+'/'+pressHighlights[i].image;
                                        html +='<div class="col s6 m4 l2 paper_img press-highlight-img">';
                                        html +='<a style="display: none;" href="javascript:void(0)" data-id="'+pressHighlights[i].id+'" class="remove-press-highlight"><i class="material-icons dp48">remove_circle_outline</i></a>';
                                        html +='<img src="'+image+'" alt="">';
                                        html +='</div>';
                                        $('.press-highlight-block').append(html);
                                    }
                                }
                                $('#press-highlight-upload-form-modal').modal('close');
                                swal("Done!", response.message,"success");
                            },
                            error: function(xhr, status, error)
                            {
                                toastr.success(error);
                            }
                        });
                }
                else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
    });



    //Add or remove business terms
    function addBusinessTermDetails()
    {

        $('#business-term-details-table-no-data').hide();
        var html = '<tr>';
        html += '<td><input name="business_term_title[]" id="business-term-title" type="text" class="input-field"  value="" ></td>';
        html += '<td><input name="business_term_quantity[]" id="business-term-quantity" type="number" class="input-field"  value="" ></td>';
        html += '<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeBusinessTermDetails(this)"><i class="material-icons dp48">remove</i></a></td>';
        html += '</tr>';
        $('.business-term-table-block tbody').append(html);
    }
    function removeBusinessTermDetails(el)
    {
        $(el).parent().parent().remove();
    }




    //submit form for business terms
   
    $('#business-term-form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      url: "/business-term-create-or-update",
      type:"POST",
      data: $('#business-term-form').serialize(),

      success:function(response){
        var businessTerms=response.businessTerms;
        var nohtml="";
        if(businessTerms.length >0){
            $('.business-term-table-body').html(nohtml);
            for(let i=0;i<businessTerms.length ;i++){
                var html = '<tr>';
                html += '<td>'+businessTerms[i].title+'</td>';
                html += '<td>'+businessTerms[i].quantity+'</td>';
                html += '<td>'+businessTerms[i].status+'</td>';
                html += '</tr>';
                $('.business-term-table-body').append(html)
            }
        }
        else{

            $('.business-term-table-body').children().empty();
            var html = '<tr><td><span>No Data</span></td></tr>';
            $('.business-term-table-body').append(html);
        }

        $('#business-term-modal').modal('close');
        swal("Done!", response.message,"success");
      },
      error: function(xhr, status, error)
            {
                $('#business-term-errors').empty();
                $("#business-term-errors").append("<div class=''>"+error+"</div>");
                $.each(xhr.responseJSON.error, function (key, item)
                {
                    $("#business-term-errors").append("<div class='danger'>"+item+"</div>");
                });
            }
      });
    });


     //Add or remove sampling
     function addSamplingDetails()
    {

        $('#sampling-details-table-no-data').hide();
        var html = '<tr>';
        html += '<td><input name="sampling_title[]" id="sampling-title" type="text" class="input-field"  value="" ></td>';
        html += '<td><input name="sampling_quantity[]" id="sampling-quantity" type="number" class="input-field"  value="" ></td>';
        html += '<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeSamplingDetails(this)"><i class="material-icons dp48">remove</i></a></td>';
        html += '</tr>';
        $('.sampling-table-block  tbody').append(html);
    }
    function removeSamplingDetails(el)
    {
        $(el).parent().parent().remove();
    }




    //submit form for sampling
   
    $('#sampling-form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      url: "/sampling-create-or-update",
      type:"POST",
      data: $('#sampling-form').serialize(),

      success:function(response){
        var samplings=response.samplings;
        var nohtml="";
        if(samplings.length >0){
            $('.sampling-table-body').html(nohtml);
            for(let i=0;i<samplings.length ;i++){
                var html = '<tr>';
                html += '<td>'+samplings[i].title+'</td>';
                html += '<td>'+samplings[i].quantity+'</td>';
                html += '<td>'+samplings[i].status+'</td>';
                html += '</tr>';
                $('.sampling-table-body').append(html)
            }
        }
        else{

            $('.sampling-table-body').children().empty();
            var html = '<tr><td><span>No Data</span></td></tr>';
            $('.sampling-table-body').append(html);
        }

        $('#sampling-modal').modal('close');
        swal("Done!", response.message,"success");
      },
      error: function(xhr, status, error)
            {
                $('#sampling-errors').empty();
                $("#sampling-errors").append("<div class=''>"+error+"</div>");
                $.each(xhr.responseJSON.error, function (key, item)
                {
                    $("#sampling-errors").append("<div class='danger'>"+item+"</div>");
                });
            }
      });
    });



      //Add or remove special customization
    function addSpecialCustomizationsDetails()
    {

        $('#special-customization-table-no-data').hide();
        var html = '<tr>';
        html += '<td><input name="special_customization_title[]" id="sampling-title" type="text" class="input-field"  value="" ></td>';
        html += '<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeSpecialCustomizationDetails(this)"><i class="material-icons dp48">remove</i></a></td>';
        html += '</tr>';
        $('.special-customization-table-block  tbody').append(html);
    }
    function removeSpecialCustomizationDetails(el)
    {
        $(el).parent().parent().remove();
    }


    

    //submit form for special customization
   
    $('#special-customization-form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      url: "/special-customization-create-or-update",
      type:"POST",
      data: $('#special-customization-form').serialize(),

      success:function(response){
        var specialCustomizations=response.specialCustomizations;
        var nohtml="";
        if(specialCustomizations.length >0){
            $('.special-customization-table-body').html(nohtml);
            for(let i=0;i<specialCustomizations.length ;i++){
                var html = '<tr>';
                html += '<td>'+specialCustomizations[i].title+'</td>';
                html += '<td>'+specialCustomizations[i].status+'</td>';
                html += '</tr>';
                $('.special-customization-table-body').append(html)
            }
        }
        else{

            $('.special-customization-table-body').children().empty();
            var html = '<tr><td><span>No Data</span></td></tr>';
            $('.special-customization-table-body').append(html);
        }

        $('#special-customization-modal').modal('close');
        swal("Done!", response.message,"success");
      },
      error: function(xhr, status, error)
            {
                $('#special-customization-errors').empty();
                $("#special-customization-errors").append("<div class=''>"+error+"</div>");
                $.each(xhr.responseJSON.error, function (key, item)
                {
                    $("#special-customization-errors").append("<div class='danger'>"+item+"</div>");
                });
            }
      });
    });




     //Add or remove Sustainability Commitment
     function addSustainabilityCommitmentDetails()
    {

        $('#sustainability-commitment-table-no-data').hide();
        var html = '<tr>';
        html += '<td><input name="sustainability_commitment_title[]" id="sustainability-commitment-title" type="text" class="input-field"  value="" ></td>';
        html += '<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeSustainabilityCommitmentDetails(this)"><i class="material-icons dp48">remove</i></a></td>';
        html += '</tr>';
        $('.sustainability-commitment-table-block  tbody').append(html);
    }
    function removeSustainabilityCommitmentDetails(el)
    {
        $(el).parent().parent().remove();
    }



    
    //submit form for sustainability-commitment
   
    $('#sustainability-commitment-form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      url: "/sustainability-commitment-create-or-update",
      type:"POST",
      data: $('#sustainability-commitment-form').serialize(),

      success:function(response){
        var sustainabilityCommitments=response.sustainabilityCommitments;
        var nohtml="";
        if(sustainabilityCommitments.length >0){
            $('.sustainability-commitment-table-body').html(nohtml);
            for(let i=0;i<sustainabilityCommitments.length ;i++){
                var html = '<tr>';
                html += '<td>'+sustainabilityCommitments[i].title+'</td>';
                html += '<td>'+sustainabilityCommitments[i].status+'</td>';
                html += '</tr>';
                $('.sustainability-commitment-table-body').append(html)
            }
        }
        else{

            $('.sustainability-commitment-table-body').children().empty();
            var html = '<tr><td><span>No Data</span></td></tr>';
            $('.sustainability-commitment-table-body').append(html);
        }

        $('#sustainability-commitment-modal').modal('close');
        swal("Done!", response.message,"success");
      },
      error: function(xhr, status, error)
            {
                $('#sustainability-commitment-errors').empty();
                $("#sustainability-commitment-errors").append("<div class=''>"+error+"</div>");
                $.each(xhr.responseJSON.error, function (key, item)
                {
                    $("#sustainability-commitment-errors").append("<div class='danger'>"+item+"</div>");
                });
            }
      });
    });




    //submit form for worker walfare and csr
   
    $('#worker-walfare-form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      url: "/worker-walfare-form-create-or-update",
      type:"POST",
      data: $('#worker-walfare-form').serialize(),

      success:function(response){
        var walfare=response.walfare;
        $.each(JSON.parse(walfare.walfare_and_csr), function(index) {
                 
                    if(this.value == 1 && this.name == 'healthcare_facility'){
                            //$('#health-care').attr('checked', 'checked');
                            $('input[name=healthcare_facility][value=1]').attr('checked', true); 
                    }else if(this.value == 1 && this.name == 'doctor'){
                        //    $('#doctor').attr('checked', 'checked');
                        $('input[name=doctor][value=1]').attr('checked', true);
                    }else if(this.value == 1 && this.name == 'day_care'){
                           //$('#day-care').attr('checked', 'checked');
                           $('input[name=day_care][value=1]').attr('checked', true);
                    }else if(this.value == 1 && this.name == 'playground'){
                           //$('#play-ground').attr('checked', 'checked');
                           $('input[name=playground][value=1]').attr('checked', true);
                    }else if(this.value == 1 && this.name == 'maternity_leave'){
                        //    $('#maternity-leave-form').attr('checked', 'checked');
                        $('input[name=maternity_leave][value=1]').attr('checked', true);
                    }else if(this.value == 1 && this.name == 'social_work'){
                           //$('#health-care').attr('checked', 'checked');
                           $('input[name=social_work][value=1]').attr('checked', true);
                    }
                    
                });
        

        $('#worker-walfare-modal').modal('close');
        swal("Done!", response.message,"success");
      },
      error: function(xhr, status, error)
            {
                $('#walfare-errors').empty();
                $("#walfare-errors").append("<div class=''>"+error+"</div>");
                $.each(xhr.responseJSON.error, function (key, item)
                {
                    $("#walfare-errors").append("<div class='danger'>"+item+"</div>");
                });
            }
      });
    });


     //submit form for worker walfare and csr
   
     $('#security-form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      url: "/securtiy-create-or-update",
      type:"POST",
      data: $('#security-form').serialize(),

      success:function(response){
        var security=response.security;
        $.each(JSON.parse(security.security_and_others), function(index) {
                 
                    if(this.value == 1 && this.name == 'fire_exit'){
                            $('input[name=fire_exit][value=1]').attr('checked', true); 
                    }
                    else if(this.value == 0 && this.name == 'fire_exit'){
                        $('.fire-exit-unchecked').attr('checked','checked');
                    }
                    else if(this.value == 1 && this.name == 'fire_hydrant'){
                        $('input[name=fire_hydrant][value=1]').attr('checked', true);
                    
                    }
                    else if(this.value == 0 && this.name == 'fire_hydrant'){
                        $('.fire-hydrant-unchecked').attr('checked','checked');
                    }
                    else if(this.value == 1 && this.name == 'water_source'){
                           $('input[name=water_source][value=1]').attr('checked', true);
                    }
                    else if(this.value == 0 && this.name == 'water_source'){
                        $('.water-source-unchecked').attr('checked','checked');
                    }
                    else if(this.value == 1 && this.name == 'protocols'){
                           $('input[name=protocols][value=1]').attr('checked', true);
                    }
                    else if(this.value == 0 && this.name == 'protocols'){
                        $('.protocols-unchecked').attr('checked','checked');
                    }
                    
                });
        

        $('#security-modal').modal('close');
        swal("Done!", response.message,"success");
      },
      error: function(xhr, status, error)
            {
                $('#security-errors').empty();
                $("#security-errors").append("<div class=''>"+error+"</div>");
                $.each(xhr.responseJSON.error, function (key, item)
                {
                    $("#security-errors").append("<div class='danger'>"+item+"</div>");
                });
            }
      });
    });







    
     
    </script>
@endpush

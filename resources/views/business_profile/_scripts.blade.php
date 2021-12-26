@push('js')
    <script>

    $(document).ready(function()
    {
        selectRefresh();

        $(".next_to_business_profile_info, .last-step").click(function()
        {
            //alert("I am here");
            //collecting values
            var name = $("#business_name").val();
            var location = $("#location").val();
            var businessType = $('select[name="business_type"]').val();
            var numberOfFactories = $("#number_of_factories").val();
            var numberOfOutlets = $("#number_of_outlets").val();
            var tradeLicense = $("#trade_license").val();
            var industryType = $('select[name="industry_type"]').val();
            var businessCategoryId = $('select[name="business_category_id"]').val();
            var representiveName = $("#representive_name").val();
            var representiveEmail = $("#email").val();
            var representivePhone = $("#phone").val();
            var representiveNidPassport = $("#nid_passport").val();

            //setting values
            $("#review_name").html("<b>Name:</b> "+name);
            $("#review_location").html("<b>Location:</b> "+location);
            $("#review_business_type").html("<b>Business Type:</b> "+businessType);
            $("#review_number_of_factories").html("<b>Number of Factories:</b> "+numberOfFactories);
            $("#review_number_of_outlets").html("<b>Number of Outlets:</b> "+numberOfOutlets);
            $("#review_trade_license").html("<b>Trade License:</b> "+tradeLicense);
            $("#review_industry_type").html("<b>Industry Type:</b> "+industryType);
            $("#review_business_category_id").html("<b>Business Category:</b> "+businessCategoryId);

            $("#review_representative_name").html("<b>Representative Name:</b> "+representiveName);
            $("#review_representatives_email").html("<b>Representative Email:</b> "+representiveEmail);
            $("#review_representatives_contact").html("<b>Representative Phone:</b> "+representivePhone);
            $("#review_representative_nidPassport").html("<b>Representative NID/Passport:</b> "+representiveNidPassport);


            if(!name){
                var alertHtml = '<div class="card-alert card orange lighten-5">';
                alertHtml += '<div class="card-content orange-text">';
                alertHtml += '<p>WARNING : Please fill all the required fields.</p>';
                alertHtml += '</div>';
                alertHtml += '</div>';
                $("#information_message").html(alertHtml);
                $("#review_name, #review_location, #review_business_type, #review_number_of_factories, #review_number_of_outlets, #review_trade_license, #review_industry_type, #review_business_category_id, #review_representative_name, #review_representatives_email, #review_representatives_contact, #review_representative_nidPassport").hide();
            } else {
                var infoHtml = '<div class="card-alert card cyan lighten-5">';
                infoHtml += '<div class="card-content cyan-text">';
                infoHtml += '<p>INFO : Please verify your input data and hit submit button to create profile.</p>';
                infoHtml += '</div>';
                infoHtml += '</div>';
                $("#information_message").html(infoHtml);
                $("#review_name, #review_location, #review_business_type, #review_number_of_factories, #review_number_of_outlets, #review_trade_license, #review_industry_type, #review_business_category_id, #review_representative_name, #review_representatives_email, #review_representatives_contact, #review_representative_nidPassport").show();
            }
        });
	});

    $(document).on('change', 'input[name="has_representative"]', function(){
        if($(this).val()==1) {
            $(".representive_info").hide();
        } else {
            $(".representive_info").show();
        }
    })

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
            var words = $('.about-company').val().split(' ');
            if(words.length > 250) {
                alert('The about company words length limit is not more than 250, your given words length is '+words.length);
                return false;
            }
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
                        console.log(data.about_company);
                        $('.loading-message').html("");
		                $('#loadingProgressContainer').hide();
                        $('#errors').empty();
                        $.each(data.data, function(key, item){
                            $('.'+item.name+'_value').text(item.value);
                            if(item.status == true){
                                $('.'+item.name+'_status').css("color", "green");
                            }else{
                                $('.'+item.name+'_status').css("color", "gray");
                            }
                            if(item.name=="main_products"){
                                if(item.value==null){
                                    $('#main-products').empty();
                                    var html ='<div class="card-alert card cyan lighten-5">';
                                    html+='<div class="card-content cyan-text">';
                                    html+='INFO : No data found.';
                                    html+='</div>';
                                    html+='</div>';
                                    $('#main-products').append(html);
                                } else {
                                    $('#main-products').empty();
                                    var html ='<p>'+item.value+'</p>';
                                    $('#main-products').append(html);

                                }
                            }
                        });

                        $('#about-company-information').text(data.about_company);
                        var nohtml="";
                        if(data.address == null) {
                            $('#head-office').empty();
                            var html ='<div class="card-alert card cyan lighten-5">';
                            html+='<div class="card-content cyan-text">';
                            html+='INFO : No data found.';
                            html+='</div>';
                            html+='</div>';
                            $('#head-office').append(html);

                        } else {
                            $('#head-office').empty();
                            var html ='<p>'+data.address+'</p>';
                            $('#head-office').append(html);

                        }

                        if(data.factory_address == null) {
                            $('#factory-address').empty();
                            var html ='<div class="card-alert card cyan lighten-5">';
                            html+='<div class="card-content cyan-text">';
                            html+='INFO : No data found.';
                            html+='</div>';
                            html+='</div>';
                            $('#factory-address').append(html);

                        } else {
                            $('#factory-address').empty();
                            var html ='<p>'+data.factory_address+'</p>';
                            $('#factory-address').append(html);

                        }


                        //$('#address').text(data.address);
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
                        console.log(data);
                        $('.loading-message').html("");
		                $('#loadingProgressContainer').hide();
                        $('#manufacture_edit_errors').empty();
                        $('#product-edit-modal-block').modal('open');
                        $('#product-edit-modal-block .modal-content').html('');
                        $('input[name=remove_video_id]').val('');
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

        let totalChild = $('.production-capacity-table-block tbody').children().length;
        var html = '<tr>';
        html += '<td><input name="machine_type[]" id="machine_type" type="text" class="form-control  value="" ></td>';
        html += '<td><input name="annual_capacity[]" id="annual_capacity" type="number" class="form-control  value="" ></td>';
        html += '<td><a href="javascript:void(0);" class="btn_delete" onclick="removeProductionCapacity(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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
        html += '<td><a href="javascript:void(0);" class="btn_delete" onclick="removeCategoriesProduced(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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
    html += '<td><a href="javascript:void(0);" class="btn_delete" onclick="removeCategoriesProduced(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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
      url: '{{ route("capacity-and-machineries.create-or-update")}}' ,
      type:"POST",
      data: $('#capacity-machinaries-form').serialize(),
      beforeSend: function() {
        $('.loading-message').html("Please Wait.");
        $('#loadingProgressContainer').show();
      },
      success:function(response){
        $('.loading-message').html("");
        $('#loadingProgressContainer').hide();
        var machineriesDetails=response.machineriesDetails;
        var categoriesProduceds=response.categoriesProduceds;
        var productionCapacities=response.productionCapacities;

        var nohtml="";
        if(machineriesDetails.length >0){
            $('.machinery_table_inner_wrap').html(nohtml);
            var  html ='<div class="overview_table box_shadow">';
            html +='<table>';
            html +='<thead>';
            html +='<tr>';
            html +='<th>Machine Name</th>';
            html +='<th>Quantity</th>';
            html +='<th>&nbsp;</th>';
            html +='</tr>';
            html +='</thead>';
            html +='<tbody class="machinaries-details-table-body">';

            for(let i=0;i<machineriesDetails.length ;i++){
                html += '<tr>';
                html += '<td>'+machineriesDetails[i].machine_name+'</td>';
                html += '<td>'+machineriesDetails[i].quantity+'</td>';
                if(machineriesDetails[i].status==1)
                html += '<td><i class="material-icons" style="color:green">check_circle</i></td>';
                else{
                html += '<td><i class="material-icons "style="color:gray">check_circle</i></td>';
                }
                html += '</tr>';

            }
            html+='</tbody>';
            html +='</table>';
            html +='</div>';
            $('.machinery_table_inner_wrap').append(html);
        }
        else{
            //append in table
            $('.machinery_table_inner_wrap').html(nohtml);
            var html='';
            html +='<div class="card-alert card cyan lighten-5">';
            html +='<div class="card-content cyan-text">';
            html +='<p>INFO : No data found.</p>';
            html +='</div>';
            $('.machinery_table_inner_wrap').append(html);

            //append in form
            $('.machinaries-details-table-block tbody').children().empty();
            var html='<tr id="production-capacity-table-no-data">';
                html +='<td><input name="machine_name[]" id="machine_name" type="text" class="form-control "  value="" ></td>';
                html +='<td><input name="quantity[]" id="quantity" type="number" class="form-control "  value="" ></td>';
                html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeMachinariesDetails(this)"><i class="material-icons dp48">delete_outline</i><span>Delete</span></a></td>';
                html +='</tr>';
                $('.machinaries-details-table-block tbody').append(html);
        }

        var nohtml="";
        if(categoriesProduceds.length >0){
            $('.categories_produced_wrapper').html(nohtml);
            var  html ='<div class="overview_table box_shadow">';
            html +='<table>';
            html +='<thead>';
            html +='<tr>';
            html +='<th>Type</th>';
            html +='<th>Percentage</th>';
            html +='<th>&nbsp;</th>';
            html +='</tr>';
            html +='</thead>';
            html +='<tbody class="categories-produced-table-body">';

            for(let i=0;i<categoriesProduceds.length ;i++){
                html += '<tr>';
                html += '<td>'+categoriesProduceds[i].type+'</td>';
                html += '<td>'+categoriesProduceds[i].percentage+'</td>';
                if(categoriesProduceds[i].status==1)
                html += '<td><i class="material-icons" style="color:green">check_circle</i></td>';
                else{
                html += '<td><i class="material-icons "style="color:gray">check_circle</i></td>';
                }
                html += '</tr>';
            }

            html+='</tbody>';
            html +='</table>';
            html +='</div>';
            $('.categories_produced_wrapper').append(html);

        }else{

            $('.categories_produced_wrapper').html(nohtml);
            var html='';
            html +='<div class="card-alert card cyan lighten-5">';
            html +='<div class="card-content cyan-text">';
            html +='<p>INFO : No data found.</p>';
            html +='</div>';
            $('.categories_produced_wrapper').append(html);

            //append in form
            $('.categories-produced-table-block tbody').children().empty();
            var html='  <tr id="categories-produced-table-no-data">';
                html +='<td><input name="type[]" id="type" type="text" class="form-control "  value="" ></td>';
                html +='<td><input name="percentage[]" id="percentage" type="number" class="form-control "  value="" ></td>';
                html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeCategoriesProduced(this)"><i class="material-icons dp48">delete_outline</i><span>Delete</span></a></td>';
                html +='</tr>';
                $('.categories-produced-table-block tbody').append(html);
        }


        // var nohtml="";
        // if(productionCapacities.length >0){
        //     $('.production-capacity-wrapper').html(nohtml);
        //     var  html ='<div class="overview_table box_shadow">';
        //     html +='<table>';
        //     html +='<thead>';
        //     html +='<tr>';
        //     html +='<th>Machine Type</th>';
        //     html +='<th>Annual Capacity</th>';
        //     html +='<th>&nbsp;</th>';
        //     html +='</tr>';
        //     html +='</thead>';
        //     html +='<tbody class="production-capacity-table-body">';

        //     for(let i=0;i<productionCapacities.length ;i++){
        //         html += '<tr>';
        //         html += '<td>'+productionCapacities[i].machine_type+'</td>';
        //         html += '<td>'+productionCapacities[i].annual_capacity+'</td>';
        //         if(productionCapacities[i].status==1)
        //         html += '<td><i class="material-icons" style="color:green">check_circle</i></td>';
        //         else{
        //         html += '<td><i class="material-icons "style="color:gray">check_circle</i></td>';
        //         }
        //         html += '</tr>';

        //     }
        //     html+='</tbody>';
        //     html +='</table>';
		// 	html +='</div>';
        //     $('.production-capacity-wrapper').append(html);
        // }else{
        //     //append in table
        //     // $('.production-capacity-table-body').children().empty();
        //     // var html = '<div class="card-alert card cyan lighten-5 no_data_box ">No Data</div>';
        //     // $('.production-capacity-table-body').append(html);

        //     $('.production-capacity-wrapper').html(nohtml);
        //     var html='';
        //     html +='<div class="card-alert card cyan lighten-5">';
        //     html +='<div class="card-content cyan-text">';
        //     html +='<p>INFO : No data found.</p>';
        //     html +='</div>';
        //     $('.production-capacity-wrapper').append(html);

        //     //append in form
        //     $('.production-capacity-table-block tbody').children().empty();
        //     var html='  <tr id="production-capacity-table-no-data">';
        //         html +='<td><input name="machine_type[]" id="machine_type" type="text" class="form-control "  value="" ></td>';
        //         html +='<td><input name="annual_capacity[]" id="annual_capacity" type="number" class="form-control "  value="" ></td>';
        //         html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeProductionCapacity(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
        //         html +='</tr>';
        //         $('.production-capacity-table-block tbody').append(html);
        // }



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
        html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeProductionFlowAndManpower(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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

      url: '{{ route("production-flow-and-manpower.create-or-update")}}',
      type:"POST",
      data: $('#production-flow-and-manpower-form').serialize(),
      beforeSend: function() {
        $('.loading-message').html("Please Wait.");
        $('#loadingProgressContainer').show();
      },
      success:function(response){
        $('.loading-message').html("");
        $('#loadingProgressContainer').hide();
        var productionFlowAndManpowers=response.productionFlowAndManpowers;
        var nohtml="";
        if(productionFlowAndManpowers.length >0){

            $('.manpower_table_wrapper').html(nohtml);
            var  html ='<div class="production-flow-and-manpower-table-wrapper box_shadow overview_table">';
            html +='<table class="production-flow-and-manpower-table">';
            html +='<tbody class="production-flow-and-manpower-table-body">';

            for(let i = 0;i < productionFlowAndManpowers.length ;i++){
                html += '<tr>';
                html += '<th>'+productionFlowAndManpowers[i].production_type+'</th>';
                html += '<td>';
                html += '<table style="width:100%; border: 0px;" border="0" cellpadding="0" cellspacing="0">';
                $.each(JSON.parse(productionFlowAndManpowers[i].flow_and_manpower), function(index) {
                    html += '<tr>';
                    html += '<td>'+this.name+'</td>';
                    html += '<td>'+this.value+'</td>';
                    if(this.status==1){
                        html += '<td><i class="material-icons" style="color:green">check_circle</i></td>';
                    }
                    else{
                        html += '<td><i class="material-icons "style="color:gray">check_circle</i></td>';
                    }
                    html += '</tr>';
                });
                html += '</table>';
                html += '</td>';
                html += '</tr>';
            }
            html += '</tbody>';
            html += '</table>';

            $('.manpower_table_wrapper').append(html);
        }
        else{

            $('.manpower_table_wrapper').html(nohtml);
            var html='';
            html +='<div class="card-alert card cyan lighten-5">';
            html +='<div class="card-content cyan-text">';
            html +='<p>INFO : No data found.</p>';
            html +='</div>';
            $('.manpower_table_wrapper').append(html);



            //append in form
            $('.production-flow-and-manpower-table-block  tbody').children().empty();
            var html='<tr id="production-flow-and-manpower-table-no-data">';
                html+='<td><input name="production_type[]" id="production_type" type="text" class="form-control "  value="" ></td>';
                html+='<td><input name="no_of_jacquard_machines[]" id="no_of_jacquard_machines" type="number" class="form-control "  value=""></td>';
                html+='<td><input name="manpower[]" id="manpower" type="number" class="form-control " value=""></td>';
                html+='<td><input name="daily_capacity[]" id="daily_capacity" type="number" class="form-control "  value=""></td>';
                html+='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeProductionFlowAndManpower(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
                html+='</tr>';
                $('.production-flow-and-manpower-table-block tbody').append(html);
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
    function selectRefresh() {
    $('.certificate-select2').select2({
        tags: true,
        placeholder: "Select an Option",
        allowClear: true,
        width: '100%'
    });
    }
    function addCertificationDetails()
    {
        $('#certification-details-table-no-data').hide();
        var html = '<tr>';
        html +='<td><select class="certificate-select2"  name="certification_id[]"><option value="" disabled selected>Choose your option</option>@foreach ($default_certification as $list)<option value="{{$list->id}}">{{$list->certification_programs}}</option>@endforeach</select></td>';
        html +='<td><input type="date" name="issue_date[]"></td>';
        html +='<td><input type="date" name="expiry_date[]"></td>';
        html +='<td><textarea class="input-field" name="short_description[]" id="certification-short-description" rows="4" cols="50"></textarea></td>';
        html +='<td><input name="image[]" class="input-field file_upload"  id="certification-image" type="file"></td>';
        html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeCertificationDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
        html +='</tr>';
        $('.certification-details-table-block tbody').append(html);
        selectRefresh();

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
        $('.loading-message').html("");
		$('#loadingProgressContainer').hide();
        $('#certification-upload-form')[0].reset();
        $(".certification-details-table-block").find("tr:gt(1)").remove();
        $('.certificate-select2').val('');
        $('.certificate-select2').trigger('change');
        var certifications=response.certifications;
        var nohtml="";
        if(certifications.length >0){
            $('.certifications-block').html(nohtml);

            for(let i = 0;i <certifications.length ;i++){
                var html='';
                var image="{{asset('storage/')}}"+'/'+certifications[i].image;
                // var strArray = image.slice(-3);
                var strArray = image.split(".");
                var file_extension = strArray[strArray.length - 1];

                if(file_extension == 'pdf' || file_extension == 'PDF'){

                    html +='<div class="certificate_img_wrap">';
                    html +='<a href="javascript:void(0)" style="display: none;" data-id="'+certifications[i].id+'" class="remove-certificate" ><i class="material-icons dp48">remove_circle_outline</i></a>';
                    html +='<div class="certificate_files">';
                    html +='<a href="'+image+'" data-id="'+certifications[i].id+'" class="certification_pdf_down"> &nbsp; </a>';
                    html +='</div>';
                    html +='<span class="certificate_title">'+certifications[i].title+'</span>';
                    html +='</div>';
                }
                else if(file_extension == 'DOC' || file_extension == 'DOCX' || file_extension == 'docx' || file_extension == 'doc'){

                    html +='<div class="certificate_img_wrap">';
                    html +='<a href="javascript:void(0)" style="display: none;" data-id="'+certifications[i].id+'" class="remove-certificate" ><i class="material-icons dp48">remove_circle_outline</i></a>';
                    html +='<div class="certificate_img">';
                    html +='<a href="'+image+'" data-id="'+certifications[i].id+'" class="doc_icon"> &nbsp; </a>';
                    html +='</div>';
                    html +='<span class="certificate_title">'+certifications[i].title+'</span>';
                    html +='</div>';
                }
                else {
                    html +='<div class="certificate_img_wrap">';
                    html +='<a href="javascript:void(0)"  style="display: none;" data-id="'+certifications[i].id+'" class="remove-certificate"><i class="material-icons dp48">remove_circle_outline</i></a>';
                    html +='<div class="certificate_img">';
                    html +='<img src="'+image+'" alt="">';
                    html +='</div>';
                    html +='<span class="certificate_title">'+certifications[i].title+'</span>';
                    html +='</div>';
                }
                $('.certifications-block').append(html);
            }

        }
        else{
                $('.certifications-block').html(nohtml);
                var html='';
                html +='<div class="card-alert card cyan lighten-5">';
                html +='<div class="card-content cyan-text">';
                html +='<p>INFO : No data found.</p>';
                html +='</div>';
                $('.certifications-block').append(html);
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


    //delete certification
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
                        beforeSend: function() {
                        $('.loading-message').html("Please Wait.");
                        $('#loadingProgressContainer').show();
                        },
                        success:function(response)
                            {
                                $('.loading-message').html("");
                                $('#loadingProgressContainer').hide();
                                var certifications=response.certifications;
                                console.log(certifications);
                                var nohtml="";
                                if(certifications.length >0){
                                    $('.certifications-block').html(nohtml);
                                    for(let i = 0;i <certifications.length ;i++){
                                        var html='';
                                        var image="{{asset('storage/')}}"+'/'+certifications[i].image;
                                        var strArray = image.split(".");
                                        var file_extension = strArray[strArray.length - 1];

                                        if(file_extension == 'pdf' || file_extension == 'PDF'){

                                            html +='<div class="certificate_img_wrap">';
                                            html +='<a href="javascript:void(0)" style="display: none;" data-id="'+certifications[i].id+'" class="remove-certificate" ><i class="material-icons dp48">remove_circle_outline</i></a>';
                                            html +='<div class="certificate_files">';
                                            html +='<a href="'+image+'" data-id="'+certifications[i].id+'" class="certification_pdf_down"> &nbsp; </a>';
                                            html +='</div>';
                                            html +='<span class="certificate_title">'+certifications[i].title+'</span>';
                                            html +='</div>';
                                        }
                                        else if(file_extension == 'DOC' || file_extension == 'DOCX' || file_extension == 'docx' || file_extension == 'doc'){

                                            html +='<div class="certificate_img_wrap">';
                                            html +='<a href="javascript:void(0)" style="display: none;" data-id="'+certifications[i].id+'" class="remove-certificate" ><i class="material-icons dp48">remove_circle_outline</i></a>';
                                            html +='<div class="certificate_img">';
                                            html +='<a href="'+image+'" data-id="'+certifications[i].id+'" class="doc_icon"> &nbsp; </a>';
                                            html +='</div>';
                                            html +='<span class="certificate_title">'+certifications[i].title+'</span>';
                                            html +='</div>';
                                        }
                                        else {
                                            html +='<div class="certificate_img_wrap">';
                                            html +='<a href="javascript:void(0)" style="display: none;" data-id="'+certifications[i].id+'" class="remove-certificate"><i class="material-icons dp48">remove_circle_outline</i></a>';
                                            html +='<div class="certificate_img">';
                                            html +='<img src="'+image+'" alt="">';
                                            html +='</div>';
                                            html +='<span class="certificate_title">'+certifications[i].title+'</span>';
                                            html +='</div>';
                                        }
                                        $('.certifications-block').append(html);
                                    }
                                }
                                else{
                                    $('.certifications-block').html(nohtml);
                                    var html='';
                                    html +='<div class="card-alert card cyan lighten-5">';
                                    html +='<div class="card-content cyan-text">';
                                    html +='<p>INFO : No data found.</p>';
                                    html +='</div>';
                                    $('.certifications-block').append(html);
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
        html +='<td><input name="image[]" class="input-field file_upload"  id="main-buyer-image" type="file"></td>';
        html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeMainBuyersDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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
        $('.loading-message').html("");
		$('#loadingProgressContainer').hide();
        $('#main-buyer-upload-form')[0].reset();
        var mainBuyers=response.mainBuyers;
        console.log(mainBuyers);
        var nohtml="";
        if(mainBuyers.length >0){
            $('.main-buyers-block').html(nohtml);

            for(let i = 0;i < mainBuyers.length ;i++){
                var html='';
                var image="{{asset('storage/')}}"+'/'+mainBuyers[i].image;
                html +='<div class="col m3 l3 main_buyer_box">';
                html +='<a style="display: none;" href="javascript:void(0)" data-id="'+mainBuyers[i].id+'" class="remove-main-buyer"><i class="material-icons dp48">remove_circle_outline</i></a>';
                html +='<div class="main_buyer_img">';
                html +='<img src="'+image+'" alt="">';
                html +='</div>';
                html +='<h5>'+mainBuyers[i].title+'</h5>';
                html +='</div>';
                $('.main-buyers-block').append(html);
            }

             //append in form
             $('.main-buyers-details-table-block tbody').children().empty();
                var html='<tr>';
                html +='<td><input class="input-field" name="title[]" id="main-buyer-title" type="text"  ></td>';
                html +='<td><textarea class="input-field" name="short_description[]" id="main-buyer-short-description" rows="4" cols="50"></textarea></td>';
                html +='<td><input class="input-field file_upload" name="image[]" id="main-buyer-image" type="file"></td>';
                html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeMainBuyersDetails(this)"><i class="material-icons dp48">delete_outline</i><span>Delete</span> </a></td>';
                html +='<tr>';
                $('.main-buyers-details-table-block  tbody').append(html);
        }
        else{
                //append in block
                $('.main-buyers-block').html(nohtml);
                var html='';
                html +='<div class="card-alert card cyan lighten-5">';
                html +='<div class="card-content cyan-text">';
                html +='<p>INFO : No data found.</p>';
                html +='</div>';
                $('.main-buyers-block').append(html);


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

     //delete main buyer from list
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
                        beforeSend: function() {
                        $('.loading-message').html("Please Wait.");
                        $('#loadingProgressContainer').show();
                        },
                        success:function(response)
                            {
                                $('.loading-message').html("");
                                $('#loadingProgressContainer').hide();
                                var mainBuyers=response.mainBuyers;
                                console.log(mainBuyers);
                                var nohtml="";
                                if(mainBuyers.length >0){
                                    $('.main-buyers-block').html(nohtml);
                                    for(let i = 0;i < mainBuyers.length ;i++){
                                        var html='';
                                        var image="{{asset('storage/')}}"+'/'+mainBuyers[i].image;
                                        html +='<div class="col m3 l3 main_buyer_box">';
                                        html +='<a style="display: none;" href="javascript:void(0)" data-id="'+mainBuyers[i].id+'" class="remove-main-buyer"><i class="material-icons dp48">remove_circle_outline</i></a>';
                                        html +='<div class="main_buyer_img">';
                                        html +='<img src="'+image+'" alt="">';
                                        html +='</div>';
                                        html +='<h5>'+mainBuyers[i].title+'</h5>';
                                        html +='</div>';
                                        $('.main-buyers-block').append(html);
                                    }
                                }
                                else{
                                    $('.main-buyers-block').html(nohtml);
                                    var html='';
                                    html +='<div class="card-alert card cyan lighten-5">';
                                    html +='<div class="card-content cyan-text">';
                                    html +='<p>INFO : No data found.</p>';
                                    html +='</div>';
                                    $('.main-buyers-block').append(html);
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
        html +='<td><input name="image[]" class="input-field file_upload"  id="export-destination-image" type="file"></td>';
        html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeExportDestinationDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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
        $('.loading-message').html("");
		$('#loadingProgressContainer').hide();
        $('#export-destination-upload-form')[0].reset();
        var exportDestinations=response.exportDestinations;
        console.log(exportDestinations);
        var nohtml="";
        if(exportDestinations.length >0){
            $('.export-destination-block').html(nohtml);

            for(let i = 0;i < exportDestinations.length ;i++){
                var html='';
                var image="{{asset('storage/')}}"+'/'+exportDestinations[i].image;
                html +='<div class="col s6 m4 l2">';
                html +='<div class="flag_img export-destination-img">';
                html +='<a style="display: none;" href="javascript:void(0)" data-id="'+ exportDestinations[i].id+'" class="remove-export-destination"><i class="material-icons dp48">remove_circle_outline</i></a>';
                html +='<img src="'+image+'" alt="">';
                html +='</div>';
                html +='<h5>'+exportDestinations[i].title+'</h5>';
                html +='</div>';
                $('.export-destination-block').append(html);
            }

            //append in form
            $('.export-destination-table-block tbody').children().empty();
                var html='<tr>';
                html +='<td><input class="input-field" name="title[]" id="main-buyer-title" type="text"  ></td>';
                html +='<td><textarea class="input-field" name="short_description[]" id="main-buyer-short-description" rows="4" cols="50"></textarea></td>';
                html +='<td><input class="input-field file_upload" name="image[]" id="main-buyer-image" type="file"></td>';
                html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeMainBuyersDetails(this)"><i class="material-icons dp48">delete_outline</i><span>Delete</span> </a></td>';
                html +='<tr>';
                $('.export-destination-table-block  tbody').append(html);
        }
        else{
                $('.export-destination-block').html(nohtml);
                var html='';
                html +='<div class="card-alert card cyan lighten-5">';
                html +='<div class="card-content cyan-text">';
                html +='<p>INFO : No data found.</p>';
                html +='</div>';
                $('.export-destination-block').append(html);
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
                        beforeSend: function() {
                        $('.loading-message').html("Please Wait.");
                        $('#loadingProgressContainer').show();
                        },
                        success:function(response)
                            {
                                $('.loading-message').html("");
                                $('#loadingProgressContainer').hide();
                                var exportDestinations=response.exportDestinations;
                                console.log(exportDestinations);
                                var nohtml="";
                                if(exportDestinations.length >0){
                                    $('.export-destination-block').html(nohtml);
                                    for(let i = 0;i < exportDestinations.length ;i++){
                                        var html='';
                                        var image="{{asset('storage/')}}"+'/'+exportDestinations[i].image;
                                        html +='<div class="col s6 m4 l2">';
                                        html +='<div class="flag_img export-destination-img">';
                                        html +='<a style="display: none;" href="javascript:void(0)" data-id="'+exportDestinations[i].id+'" class="remove-export-destination"><i class="material-icons dp48">remove_circle_outline</i></a>';
                                        html +='<img src="'+image+'" alt="">';
                                        html +='</div>';
                                        html +='<h5>'+exportDestinations[i].title+'</h5>';
                                        html +='</div>';
                                        $('.export-destination-block').append(html);
                                    }
                                }
                                else{
                                    $('.export-destination-block').html(nohtml);
                                    var html='';
                                    html +='<div class="card-alert card cyan lighten-5">';
                                    html +='<div class="card-content cyan-text">';
                                    html +='<p>INFO : No data found.</p>';
                                    html +='</div>';
                                    $('.export-destination-block').append(html);
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
        html +='<td><input name="image[]" class="input-field file_upload"  id="association-membership-image" type="file"></td>';
        html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeAssociationMembershipDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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
        $('.loading-message').html("");
		$('#loadingProgressContainer').hide();
        $('#association-membership-upload-form')[0].reset();
        var associationMemberships=response.associationMemberships;
        console.log(associationMemberships);
        var nohtml="";
        if(associationMemberships.length >0){
            $('.association-membership-block').html(nohtml);

            for(let i = 0;i < associationMemberships.length ;i++){
                var html='';
                var image="{{asset('storage/')}}"+'/'+associationMemberships[i].image;
                html +='<div class="center-align association-membership-img">';
                html +='<a style="display: none;" href="javascript:void(0)" data-id="'+ associationMemberships[i].id+'" class="remove-association-membership"><i class="material-icons dp48">remove_circle_outline</i></a>';
                html +='<div class="imgbox">';
                html +='<img src="'+image+'" alt="">';
                html +='</div>';
                html +='<p>'+associationMemberships[i].title+'</p>';
                html +='</div>';

                $('.association-membership-block').append(html);

            }
             //append in form
             $('.association-membership-details-table-block tbody').children().empty();
                var html='<tr>';
                html +='<td><input class="input-field" name="title[]" id="main-buyer-title" type="text"  ></td>';
                html +='<td><textarea class="input-field" name="short_description[]" id="main-buyer-short-description" rows="4" cols="50"></textarea></td>';
                html +='<td><input class="input-field file_upload" name="image[]" id="main-buyer-image" type="file"></td>';
                html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeMainBuyersDetails(this)"><i class="material-icons dp48">delete_outline</i><span>Delete</span> </a></td>';
                html +='<tr>';
                $('.association-membership-details-table-block  tbody').append(html);
        }
        else{
                $('.association-membership-block').html(nohtml);
                var html='';
                html +='<div class="card-alert card cyan lighten-5">';
                html +='<div class="card-content cyan-text">';
                html +='<p>INFO : No data found.</p>';
                html +='</div>';
                $('.association-membership-block').append(html);
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

    //delete association membership
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
                        beforeSend: function() {
                        $('.loading-message').html("Please Wait.");
                        $('#loadingProgressContainer').show();
                        },
                        success:function(response)
                            {
                                $('.loading-message').html("");
                                $('#loadingProgressContainer').hide();

                                var associationMemberships=response.associationMemberships;
                                console.log(associationMemberships);
                                var nohtml="";
                                if(associationMemberships.length >0){
                                    $('.association-membership-block').html(nohtml);
                                    for(let i = 0;i < associationMemberships.length ;i++){
                                        var html='';
                                        var image="{{asset('storage/')}}"+'/'+associationMemberships[i].image;
                                        html +='<div class="center-align association-membership-img">';
                                        html +='<a style="display: none;" href="javascript:void(0)" data-id="'+ associationMemberships[i].id+'" class="remove-association-membership"><i class="material-icons dp48">remove_circle_outline</i></a>';
                                        html +='<div class="imgbox">';
                                        html +='<img src="'+image+'" alt="">';
                                        html +='</div>';
                                        html +='<p>'+associationMemberships[i].title+'</p>';
                                        html +='</div>';
                                        $('.association-membership-block').append(html);
                                    }
                                }
                                else{
                                    $('.association-membership-block').html(nohtml);
                                    var html='';
                                    html +='<div class="card-alert card cyan lighten-5">';
									html +='<div class="card-content cyan-text">';
									html +='<p>INFO : No data found.</p>';
									html +='</div>';
                                    $('.association-membership-block').append(html);
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
        html +='<td><input name="image[]" class="input-field file_upload"  id="press-highlight-image" type="file"></td>';
        html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removePressHighlightDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
        html +='</tr>';
        $('.press-highlight-details-table-block tbody').append(html);
    }

    function removePressHighlightDetails(el)
    {
        $(el).parent().parent().remove();
    }

    //remove press highlight
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
        $('.loading-message').html("");
		$('#loadingProgressContainer').hide();
        $('#press-highlight-upload-form')[0].reset();
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
                html +='<div class="press_img">';
                html +='<img src="'+image+'" alt="">';
                html +='</div>';
                html +='</div>';

                $('.press-highlight-block').append(html);

            }
            $('.press-highlight-details-table-block tbody').children().empty();
                var html='<tr>';
                html +='<td><input class="input-field" name="title[]" id="main-buyer-title" type="text"  ></td>';
                html +='<td><textarea class="input-field" name="short_description[]" id="main-buyer-short-description" rows="4" cols="50"></textarea></td>';
                html +='<td><input class="input-field file_upload" name="image[]" id="main-buyer-image" type="file"></td>';
                html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeMainBuyersDetails(this)"><i class="material-icons dp48">delete_outline</i><span>Delete</span> </a></td>';
                html +='<tr>';
                $('.press-highlight-details-table-block  tbody').append(html);

        }
        else{
                $('.press-highlight-block').html(nohtml);
                var html='';
                html +='<div class="card-alert card cyan lighten-5">';
                html +='<div class="card-content cyan-text">';
                html +='<p>INFO : No data found.</p>';
                html +='</div>';
                $('.press-highlight-block').append(html);
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
                        beforeSend: function() {
                        $('.loading-message').html("Please Wait.");
                        $('#loadingProgressContainer').show();
                        },
                        success:function(response)
                            {
                                $('.loading-message').html("");
                                $('#loadingProgressContainer').hide();
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
                                        html +='<div class="press_img">';
                                        html +='<img src="'+image+'" alt="">';
                                        html +='</div>';
                                        html +='</div>';
                                        $('.press-highlight-block').append(html);
                                    }
                                }
                                else{
                                    $('.press-highlight-block').html(nohtml);
                                    var html='';
                                    html +='<div class="card-alert card cyan lighten-5">';
									html +='<div class="card-content cyan-text">';
									html +='<p>INFO : No data found.</p>';
									html +='</div>';
                                    $('.press-highlight-block').append(html);
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

        var html = '<tr>';
        html += '<td><input name="business_term_title[]" id="business-term-title" type="text" class="input-field"  value="" ></td>';
        html += '<td><input name="business_term_quantity[]" id="business-term-quantity" type="number" class="input-field"  value="" ></td>';
        html += '<td><a href="javascript:void(0);" class="btn_delete" onclick="removeBusinessTermDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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
      url: '{{route("business-terms.create-or-update")}}',
      type:"POST",
      data: $('#business-term-form').serialize(),
      beforeSend: function() {
        $('.loading-message').html("Please Wait.");
        $('#loadingProgressContainer').show();
        },
      success:function(response){
        $('.loading-message').html("");
        $('#loadingProgressContainer').hide();
        var businessTerms=response.businessTerms;
        var nohtml="";
        if(businessTerms.length >0){

            $('.business_terms_table_wrap').html(nohtml);
            var html ='<div class="overview_table box_shadow">';
            html +='<table>';
            html +='<tbody class="business-term-table-body">';

            for(let i=0;i<businessTerms.length ;i++){
                html += '<tr>';
                html += '<td>'+businessTerms[i].title+'</td>';
                html += '<td>'+businessTerms[i].quantity+'</td>';
                if(businessTerms[i].status==1)
                html += '<td><i class="material-icons" style="color:green">check_circle</i></td>';
                else{
                html += '<td><i class="material-icons "style="color:gray">check_circle</i></td>';
                }
                html += '</tr>';
            }
            $('.business_terms_table_wrap').append(html)
        }
        else{

            //append in table
            $('.business_terms_table_wrap').html(nohtml);
            var html='';
            html +='<div class="card-alert card cyan lighten-5">';
            html +='<div class="card-content cyan-text">';
            html +='<p>INFO : No data found.</p>';
            html +='</div>';
            $('.business_terms_table_wrap').append(html);


            //append in form
            $('.business-term-table-block tbody').children().html(nohtml);
            var html='<tr id="business-term-details-table-no-data">';
            html += '<td><input name="business_term_title[]" id="business-term-title" type="text" class="input-field" value="" ></td>';
            html +='<td><input name="business_term_quantity[]" id="business-term-quantity" type="number" class="input-field"  value="" ></td>';
            html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeBusinessTermDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
            html +='</tr>';
            $('.business-term-table-block tbody').append(html);
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

        //$('#sampling-details-table-no-data').hide();
        var html = '<tr>';
        html += '<td><input name="sampling_title[]" id="sampling-title" type="text" class="input-field"  value="" ></td>';
        html += '<td><input name="sampling_quantity[]" id="sampling-quantity" type="number" class="input-field"  value="" ></td>';
        html += '<td><a href="javascript:void(0);" class="btn_delete" onclick="removeSamplingDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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
      url: '{{route("sampling.create-or-update")}}',
      type:"POST",
      data: $('#sampling-form').serialize(),
      beforeSend: function() {
        $('.loading-message').html("Please Wait.");
        $('#loadingProgressContainer').show();
        },
      success:function(response){
        $('.loading-message').html("");
        $('#loadingProgressContainer').hide();
        var samplings=response.samplings;
        var nohtml="";
        if(samplings.length >0){

            $('.sampling_table_wrapper').html(nohtml);
            var  html ='<div class="overview_table box_shadow">';
            html +='<table>';
            html +='<tbody class="sampling-table-body">';

            for(let i=0;i<samplings.length ;i++){
                html += '<tr>';
                html += '<td>'+samplings[i].title+'</td>';
                html += '<td>'+samplings[i].quantity+'</td>';
                if(samplings[i].status==1)
                html += '<td><i class="material-icons" style="color:green">check_circle</i></td>';
                else{
                html += '<td><i class="material-icons "style="color:gray">check_circle</i></td>';
                }
                html += '</tr>';
            }
            $('.sampling_table_wrapper').append(html)
        }
        else{

            $('.sampling_table_wrapper').html(nohtml);
            var html='';
            html +='<div class="card-alert card cyan lighten-5">';
            html +='<div class="card-content cyan-text">';
            html +='<p>INFO : No data found.</p>';
            html +='</div>';
            $('.sampling_table_wrapper').append(html);

            //append in form
            $('.sampling-table-block tbody').children().html(nohtml);
            var html='<tr id="sampling-details-table-no-data">';
            html += '<td><input name="sampling_title[]" id="sampling-title" type="text" class="input-field" value="" ></td>';
            html +='<td><input name="sampling_quantity[]" id="sampling-quantity" type="number" class="input-field"  value="" ></td>';
            html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeSamplingDetails(this)"><i class="material-icons dp48">delete_outline</i><span>Delete</span></a></td>';
            html +='</tr>';
            $('.sampling-table-block tbody').append(html);
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

        //$('#special-customization-table-no-data').hide();
        var html = '<tr>';
        html += '<td><input name="special_customization_title[]" id="sampling-title" type="text" class="input-field"  value="" ></td>';
        html += '<td><a href="javascript:void(0);" class="btn_delete" onclick="removeSpecialCustomizationDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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
      url: '{{route("specialcustomizations.create-or-update")}}',
      type:"POST",
      data: $('#special-customization-form').serialize(),
      beforeSend: function() {
        $('.loading-message').html("Please Wait.");
        $('#loadingProgressContainer').show();
        },
      success:function(response){
        $('.loading-message').html("");
        $('#loadingProgressContainer').hide();
        var specialCustomizations=response.specialCustomizations;
        var nohtml="";
        if(specialCustomizations.length >0){

            $('.special_customization_table_wrap').html(nohtml);
            var  html ='<div class="overview_table box_shadow">';
            html +='<table>';
            html +='<tbody class="special-customization-table-body">';

            for(let i=0;i<specialCustomizations.length ;i++){
                html += '<tr>';
                html += '<td>'+specialCustomizations[i].title+'</td>';
                if(specialCustomizations[i].status==1)
                html += '<td><i class="material-icons" style="color:green">check_circle</i></td>';
                else{
                html += '<td><i class="material-icons "style="color:gray">check_circle</i></td>';
                }
                html += '</tr>';
            }
            $('.special_customization_table_wrap').append(html)
        }
        else{

            //append in form
            $('.special_customization_table_wrap').html(nohtml);
            var html='';
            html +='<div class="card-alert card cyan lighten-5">';
            html +='<div class="card-content cyan-text">';
            html +='<p>INFO : No data found.</p>';
            html +='</div>';
            $('.special_customization_table_wrap').append(html);

            //append in table
            $('.special-customization-table-block tbody').children().html(nohtml);
            var html='<tr class="special-customization-table-no-data">';
            html +='<td><input name="special_customization_title[]" id="special-customizations-title" type="text" class="input-field" value="" ></td>';
            html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeSpecialCustomizationDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
            html +='</tr>';
            $('.special-customization-table-block tbody').append(html);
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

        var html = '<tr>';
        html += '<td><input name="sustainability_commitment_title[]" id="sustainability-commitment-title" type="text" class="input-field"  value="" ></td>';
        html += '<td><a href="javascript:void(0);" class="btn_delete" onclick="removeSustainabilityCommitmentDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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
      url: '{{route("sustainabilitycommitments.create-or-update")}}',
      type:"POST",
      data: $('#sustainability-commitment-form').serialize(),
      beforeSend: function() {
        $('.loading-message').html("Please Wait.");
        $('#loadingProgressContainer').show();
        },
      success:function(response){
        $('.loading-message').html("");
        $('#loadingProgressContainer').hide();
        // $('#sustainability-commitment-form')[0].reset();
        var sustainabilityCommitments=response.sustainabilityCommitments;
        var nohtml="";
        if(sustainabilityCommitments.length >0){

            $('.sustainability_commitment_table_wrap').html(nohtml);
            var  html ='<div class="overview_table box_shadow">';
            html +='<table>';
            html +='<tbody class="sustainability-commitment-table-body">';

            for(let i=0;i<sustainabilityCommitments.length ;i++){
                html += '<tr>';
                html += '<td>'+sustainabilityCommitments[i].title+'</td>';
                if(sustainabilityCommitments[i].status==1){
                    html += '<td><i class="material-icons" style="color:green">check_circle</i></td>';
                }
                else{
                    html += '<td><i class="material-icons "style="color:gray">check_circle</i></td>';
                }
                html += '</tr>';
            }

            $('.sustainability_commitment_table_wrap').append(html)
        }

        else{

            //append in table
            $('.sustainability_commitment_table_wrap').html(nohtml);
            var html='';
            html +='<div class="card-alert card cyan lighten-5">';
            html +='<div class="card-content cyan-text">';
            html +='<p>INFO : No data found.</p>';
            html +='</div>';
            $('.sustainability_commitment_table_wrap').append(html);

            //append in form
            $('.sustainability-commitment-table-block tbody').children().html(nohtml);
            var html = '<tr id="sustainability-commitment-table-no-data">';
            html += '<td><input name="sustainability_commitment_title[]" id="sustainability-Commitment-title" type="text" class="input-field" value="" ></td>';
            html += '<td><a href="javascript:void(0);" class="btn_delete" onclick="removeSustainabilityCommitmentDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
            html += '</tr>';
            $('.sustainability-commitment-table-block tbody').append(html);
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
      url: '{{route("walfare.create-or-update")}}',
      type:"POST",
      data: $('#worker-walfare-form').serialize(),
      beforeSend: function() {
        $('.loading-message').html("Please Wait.");
        $('#loadingProgressContainer').show();
        },
      success:function(response){
        $('.loading-message').html("");
        $('#loadingProgressContainer').hide();
        var walfare=response.walfare;
        $.each(JSON.parse(walfare.walfare_and_csr), function(index) {

                    if(this.value == 1 && this.name == 'healthcare_facility'){
                            $('.health-care-checked').attr('checked', true);
                            $('input[name=healthcare_facility][value=1]').attr('checked', true);
                            $('input[name=healthcare_facility_disable][value=1]').attr('checked', true);

                    }
                    else if(this.value == 1 && this.name == 'doctor'){
                          $('.doctor-checked').attr('checked', true);
                          $('input[name=doctor][value=1]').attr('checked', true);
                          $('input[name=doctor_disable][value=1]').attr('checked', true);
                    }else if(this.value == 1 && this.name == 'day_care'){
                           $('.day-care-checked').attr('checked', true);
                           $('input[name=day_care][value=1]').attr('checked', true);
                           $('input[name=day_care_disable][value=1]').attr('checked', true);
                    }else if(this.value == 1 && this.name == 'playground'){
                           $('.play-ground-checked').attr('checked', true);
                           $('input[name=playground][value=1]').attr('checked', true);
                           $('input[name=playground_disable][value=1]').attr('checked', true);
                    }else if(this.value == 1 && this.name == 'maternity_leave'){
                          $('.maternity-leave-checked').attr('checked', true);
                          $('input[name=maternity_leave][value=1]').attr('checked', true);
                          $('input[name=maternity_leave_disable][value=1]').attr('checked', true);
                    }else if(this.value == 1 && this.name == 'social_work'){
                           $('.health-care-checked').attr('checked', true);
                           $('input[name=social_work][value=1]').attr('checked', true);
                           $('input[name=social_work_disable][value=1]').attr('checked', true);
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
      url: '{{route("security.create-or-update")}}',
      type:"POST",
      data: $('#security-form').serialize(),
      beforeSend: function() {
        $('.loading-message').html("Please Wait.");
        $('#loadingProgressContainer').show();
        },
      success:function(response){
        $('.loading-message').html("");
        $('#loadingProgressContainer').hide();
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




    function addFactoryImageBlock()
    {

        var html ='<div class="upload_img_box_wrap col s6 m3 l2">';
        html +='<a href="javascript:void(0);" class="btn_close" onclick="removeFactoryImage(this)"><i class="material-icons dp48">close</i></a>';
        html +='<div class="upload_imgage_box">';
        html +='<img id="preview-large-image-before-upload" src="https://via.placeholder.com/80" alt="preview image" style="max-height: 80px;min-height:80px">';
        html +='</div>';
        html +='<div class="form-group">';
        html +='<input type="file" name="factory_images[]" placeholder="Choose image" id="factory-large-image">';
        html +='</div>';
        html +='</div>';
        $('.factory-image-block.row').append(html);
    }

    function removeFactoryImage(el)
    {
        $(el).parent().remove();
    }


    function addFactoryLargeImageBlock()
    {

        var html ='<div class="upload_img_box_wrap col s6 m3 l2">';
        html +='<a href="javascript:void(0);" class="btn_close" onclick="removeFactoryLargeImage(this)"><i class="material-icons dp48">close</i></a>';
        html +='<img id="preview-image-before-upload" src="https://via.placeholder.com/80" alt="preview image" style="max-height: 80px;min-height:80px">';
        html +='<div class="form-group">';
        html +='<input type="file" name="factory_large_images[]" placeholder="Choose image" id="factory-image">';
        html +='</div>';

        $('.factory-large-image-block').append(html);
    }
    function removeFactoryLargeImage(el)
    {
        $(el).parent().remove();
    }

    $(document).ready(function (e) {

        $('#factory-image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image-before-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

    });


    $('#factory-tour-form').on('submit',function(e){
    e.preventDefault();
    var url = '{{ route("factory-tour.upload") }}';
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
        $('.loading-message').html("");
		$('#loadingProgressContainer').hide();
        $('#factory-tour-form')[0].reset();
        var factoryTours=response.factoryTours;
        console.log(factoryTours);
        $('#factory-tour-add-modal-block').modal('close');
        swal("Done!", response.message,"success");
        setTimeout(function(){
           location.reload();
        }, 1000)
      },
      error: function(xhr, status, error)
            {
                $('#factory-tour-form-errors').empty();
                $("#factory-tour-form-errors").append("<div class=''>"+error+"</div>");
                $.each(xhr.responseJSON.error, function (key, item)
                {
                    $("#factory-tour-form-errors").append("<div class='danger'>"+item+"</div>");
                });
            }
        });
    });

    var imageIds= new Array();
    $(document).on('click', '.delete-factory-image',function(e){
        e.preventDefault();
        var id=$(this).attr("data-imageId");
        imageIds.push(id);
        console.log(imageIds);
        $('input:hidden[name=company_factory_tour_image_ids]').val(JSON.stringify(imageIds));
        $(this).parent().remove();
    });

    var largeImageIds= new Array();
    $(document).on('click', '.delete-factory-large-image',function(e){
        e.preventDefault();
        var id=$(this).attr("data-largeImageId");
        largeImageIds.push(id);
        console.log(largeImageIds);
        $('input:hidden[name=company_factory_tour_large_image_ids]').val(JSON.stringify(largeImageIds));
        $(this).parent().remove();

    });

    $('#factory-tour-edit-form').on('submit',function(e){
    e.preventDefault();
    var url = '{{ route("factory-tour.edit") }}';
    var formData = new FormData(this);
    console.log(formData);

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
        $('.loading-message').html("");
        $('#loadingProgressContainer').hide();
        $('#factory-tour-edit-form')[0].reset();
        var factoryTours=response.factoryTours;
        console.log(factoryTours);
        $('#factory-tour-edit-modal-block').modal('close');
        swal("Done!", response.message,"success");
        setTimeout(function(){
           location.reload();
        }, 1000)
      },
      error: function(xhr, status, error)
            {
                $('#factory-tour-edit-form-errors').empty();
                $("#factory-tour-edit-form-errors").append("<div class=''>"+error+"</div>");
                $.each(xhr.responseJSON.error, function (key, item)
                {
                    $("#factory-tour-edit-form-errors").append("<div class='danger'>"+item+"</div>");
                });
            }
      });
    });

    $(document).ready(function(){
        $(".manufacturer_profile_info_details .btn_edit, .manufacturer_profile_info_details .btn_upload, .manufacturer_profile_info_details .btn_delete").hide();
        $(".edit_profile_trigger").click(function() {
            $(".tabs li a").removeClass("active");
            $(".profile-tab a").addClass("active");
            $('.tabs').tabs().find('a[href="#profile-tab"]').trigger('click');
            $(".manufacturer_profile_info_details .btn_edit, .manufacturer_profile_info_details .btn_upload, .manufacturer_profile_info_details .btn_delete").toggle();
        });
    });
    //video

    function manufactureRemoveEditVideoEl(el)
    {
        var remove_video_id=[];
        $(el).prev('video').remove();
        $(el).remove();
        remove_video_id.push($(el).attr('data-id'));
        $('#product-edit-modal-block input[name=remove_video_id]').val(JSON.stringify(remove_video_id));
        $('.manufacture-product-upload-block').show();

    }

    //limit word about the company
    $(".about-company").keypress(function() {
            var words = $(this).val().split(' ');
            if(words.length > 250) {
                alert('The about company words length limit is not more than 250')
            }
    });


    </script>
@endpush

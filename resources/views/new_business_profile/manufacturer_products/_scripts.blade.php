@push('js')
    <script>
//add manufacture product modal open
    $('.product-add-modal-trigger').click(function(){
        $("#product-add-modal-block").modal('open');
        $('#manufacture-product-upload-form')[0].reset();
        $('#product_tag').val('');
        $('#product_tag').trigger('change');
        $('#colors').val('');
        $('#colors').trigger('change');
        $('#sizes').val('');
        $('#sizes').trigger('change');
        $('.file').val('');
        $('.overlay-image').val('');
        $('.img-thumbnail').attr('src', 'https://via.placeholder.com/80');
        $('#manufacture-product-upload-errors').empty();
        $('.rm-error').html('');
        $('.select2').val('');
        $('.select2').trigger('change');
        $('.studio').hide();
        $('.raw-materials').hide();
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
                    $('.rm-error').html('');
                    $('#product-add-modal-block').modal('close');
                    // $('.manufacture-product-table-data').html('');
                    // $('.manufacture-product-table-data').html(data.data);
                    html= '<div class="col s6 m4 l3 product_item_box">';
                    html+='<div class="productBox">';
                    html+='<div class="inner_productBox">';
                    html+='<a href="javascript:void(0);" onclick="editproduct('+data.data.id+')">';
                    html+='<div class="imgBox">';
                    html+='<img src="'+data.image+'">';
                    html+= '</div>';
                    html+= '<div class="products_inner_textbox">';
                    html+='<h4><span>'+data.data.title+'</span></h4>';
                    html+='<div class="row">';
                    html+='<div class="col s12 m6">';
                    html+='<div class="product_moq">';
                    html+='MOQ: <br> <span>'+data.data.moq+'</span>';
                    html+='</div>';
                    html+='</div>';
                    html+='<div class="col s12 m6">';
                    html+='<div class="pro_leadtime">';
                    html+='Lead Time <br> <span>'+data.data.lead_time+'</span> days';
                    html+='</div>';
                    html+='</div>';
                    html+='</div>';
                    html+='</div>';
                    html+='</a>';
                    html+='</div>';
                    html+='</div>';
                    html+='</div>';
                    console.log(data);
                    $('.product-list').prepend(html);
                    swal("Done!", data.msg,"success");
                },
            error: function(xhr, status, error)
                {

                    $('.loading-message').html("");
                    $('#loadingProgressContainer').hide();
                    $('#manufacture-product-upload-errors').empty();
                    $('#manufacture-product-upload-errors').show();
                    //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+error+"</div></div>");
                    $("#manufacture-product-upload-errors").append("<div class=''>"+error+"</div>");
                    $('.rm-error').html('');
                    $.each(xhr.responseJSON.error, function (key, item)
                    {
                        $('.'+key+'_error').html('required');
                        //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+item+"</div></div>");
                        $("#manufacture-product-upload-errors").append("<div class=''>"+item+"</div>");

                    });

                }
        });
    });

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
                    $('.select2').select2();

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

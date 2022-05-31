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
                    $('.loading-message').html("");
                    $('#loadingProgressContainer').hide();
                    $('#manufacture-update-errors').empty();
                    $('.rm-error').html('');
                    $('#product-edit-modal-block input[name=edit_product_id]').val(productId);
                    $("#product-edit-modal-block").modal('open');
                    $('#product-edit-modal-block .overlay-image-preview').attr("src", 'https://www.riobeauty.co.uk/images/product_image_not_found.gif');
                    $('#product-edit-modal-block .overlay-image').val('');
                    if(data.product.overlay_image){
                        var src='{{Storage::disk('s3')->url('public')}}'+'/'+data.product.overlay_image;
                        $('#product-edit-modal-block .overlay-image-preview').attr("src", src);
                    }
                     // video
                     $('#product-edit-modal-block input[name=remove_video_id]').val('');
                    $('#product-edit-modal-block .edit-video-show-block').empty();
                    $('#product-edit-modal-block .edit-video-upload-block').show();
                    $('#product-edit-modal-block .edit-video-show-div').hide();
                    $('#product-edit-modal-block .uplodad_video_box').val('');

                    if(data.product.product_video){
                        $('#product-edit-modal-block .edit-video-upload-block').hide();
                        $('#product-edit-modal-block .edit-video-show-div').show();
                        var asset='{{Storage::disk('s3')->url('public')}}'+'/'+data.product.product_video.video;
                        var html='<video controls autoplay width="320" height="240">';
                            html+='<source src="'+asset+'" />';
                            html+='</video>';
                            html+='<a class="btn_delete" onclick="removeEditVideoEl(this);" data-id="'+data.product.product_video.id+'"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a>';

                        $('#product-edit-modal-block .edit-video-show-block').append(html);
                    }
                    //product type mapping
                    if(data.product.product_type_mapping_id != null){
                        $("input[name=product_type_mapping][value=" + data.product.product_type_mapping_id + "]").prop('checked', true);
                        if(data.product.product_type_mapping_id ==1){
                            $('#product-edit-modal-block .studio').show();
                            $('#product-edit-modal-block .raw-materials').hide();
                            $('.studio-id').val(data.product.product_type_mapping_child_id).trigger('change');
                        }else{
                            $('#product-edit-modal-block .studio').hide();
                            $('#product-edit-modal-block .raw-materials').show();
                            $('#product-edit-modal-block .raw-materials-id').val(data.product.product_type_mapping_child_id).trigger('change');
                        }
                    }else{
                        $('#product-edit-modal-block .studio').hide();
                        $('#product-edit-modal-block .raw-materials').hide();
                        $('#product-edit-modal-block input[name=product_type_mapping]').prop('checked', false);
                    }
                    $('#product-edit-modal-block #edit_product_tag').val(data.product.product_tag ?? '').trigger('change');
                    $('#product-edit-modal-block input[name=title]').val(data.product.title);
                    $('#product-edit-modal-block input[name=price_per_unit]').val(data.product.price_per_unit);
                    $('#product-edit-modal-block .price_unit').val(data.product.price_unit).change();
                    $('#product-edit-modal-block input[name=moq]').val(data.product.moq);
                    $('#product-edit-modal-block .qty_unit').val(data.product.qty_unit).trigger('change');
                    $('#product-edit-modal-block .product-colors').val(data.product.colors).trigger('change');
                    $('#product-edit-modal-block .product-sizes').val(data.product.sizes).trigger('change');
                    tinymce.get("edit-description").setContent(data.product.product_details);
                    tinymce.get("edit_full_specification").setContent(data.product.product_specification);
                    $('#product-edit-modal-block input[name=lead_time]').val(data.product.lead_time);
                    $("#product-edit-modal-block input[name=gender][value=" + data.product.gender + "]").prop('checked', true);
                    $("#product-edit-modal-block input[name=sample_availability][value=" + data.product.sample_availability + "]").prop('checked', true);
                    $('.media-list').empty();
                    $.each(data.product.product_images,function(key, item){
                        var html='<div class="col s6 m2 l2 center-align">';
                            html+='<div class="media_img">';
                        var img_src='{{Storage::disk('s3')->url('public')}}'+'/'+item.product_image;
                            html+='<img src="'+img_src+'" id="img'+item.id+'" class="img-thumbnail">';
                            html+='</div>';
                            html+='<div class="clear10"></div>';
                            html+='<div class="col s12">';
                            html+='<div id="msg"></div>';
                        var img_id= "'img" + item.id + "'";
                            html+='<input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'+img_id+')" />';
                            html+='<div class="input-group my-3" style="display:block;">';
                            html+='<input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;" />';
                            html+='<div class="input-group-append">';
                            html+='<a href="javascript:void(0);" dataid="'+item.id+'" onclick="removeManufactureImage(this);">remove</a>';
                            html+='<button type="button" class="browse btn btn-search btn-default btn-upload-wholesaler-img" style="background:#55A860; color:#fff; display:none;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>';
                            html+=' </div></div></div></div>';
                             if(key == 4){return false;}
                            $('.media-list').append(html);
                    });
                    if(data.product.product_images.length < 5){
                        for (var i = 1; i <= (5-data.product.product_images.length); i++) {
                            var x = Math.floor(Math.random() * 10)+10;
                            var html='<div class="col s6 m2 l2 center-align">';
                                html+='<div class="media_img">';
                                html+='<img src="https://via.placeholder.com/80" id="img'+x+'" class="img-thumbnai';
                                html+='</div>';
                                html+='<div class="clear10"></div>';
                                html+='<div class="col s12">';
                                html+='<div id="msg"></div>';
                            var img_id= "'img" + x + "'";
                                html+='<input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'+img_id+')" />';
                                html+='<div class="input-group my-3" style="display:block;">';
                                html+='<input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;" />';
                                html+='<div class="input-group-append">';
                                html+='<button type="button" class="browse btn btn-search btn-default" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>';
                                html+='</div></div></div></div>';
                                $('.media-list').append(html);
                        }
                    }




                },
            error: function(xhr, status, error)
                {
                    $('.loading-message').html("");
                    $('#loadingProgressContainer').hide();
                    swal("Error!", status,"error");

                }
        });
    }


    function removeManufactureImage(obj){
            var check= confirm('are you sure?');
            if(check != true){
                return false;
            }
            var single_image_id= $(obj).attr('dataid');
            var url = '{{ route("remove.manufacture.single.image", ":slug") }}';
                url = url.replace(':slug', single_image_id);
            var obj=obj;
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

                        $(obj).parent().parent().parent().parent().find('.img-thumbnail').attr('src', 'https://via.placeholder.com/380');
                        var html='<button type="button" class="btn_upload" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>';
                        $(obj).parent().parent().find('.btn-upload-wholesaler-img').show();
                        $(obj).remove();
                    },
                error: function(xhr, status, error)
                    {
                        $('.loading-message').html("");
		                $('#loadingProgressContainer').hide();
                        alert(error);

                    }
            });
        }

        function readURL(input,id)
        {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                $('#'+id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $('.overlay-image').change(function(){
        var dom = $(this).parent().parent().parent().find('.overlay-image-preview');
            var obj = $(this);
            const file = this.files[0];
            if (file){
            let reader = new FileReader();
            reader.onload = function(event){

                dom.attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
            }
        });

        function removeEditVideoEl(el)
        {
            var check=confirm('are you sure?');
            if(check == false){
                return false;
            }
            var remove_video_id=[];
            $(el).prev('video').remove();
            $(el).remove();
            remove_video_id.push($(el).attr('data-id'));
            $('#product-edit-modal-block input[name=remove_video_id]').val(JSON.stringify(remove_video_id));
            $('#product-edit-modal-block .edit-video-upload-block').show();
            $('#product-edit-modal-block .edit-video-show-div').hide();

        }

        $('#manufacture-product-update-form').on('submit',function(e){
                e.preventDefault();
                tinyMCE.triggerSave();
                var productId=$('#product-edit-modal-block input[name=edit_product_id]').val();
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
                            $('.rm-error').html('');
                            $('#product-edit-modal-block').modal('close');
                            swal("Done!", data.msg,"success");
                            location.reload();
                        },
                    error: function(xhr, status, error)
                        {
                            $('.loading-message').html("");
                            $('#loadingProgressContainer').hide();
                            $('#manufacture-update-errors').empty();
                            $('#manufacture-update-errors').show();
                            //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+error+"</div></div>");
                            $("#manufacture-update-errors").append("<div class=''>"+error+"</div>");
                            $('.rm-error').html('');
                            $.each(xhr.responseJSON.error, function (key, item)
                            {
                                $('.'+key+'_error').html('required');
                                //$("#edit_errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+item+"</div></div>");
                                $("#manufacture-update-errors").append("<div class=''>"+item+"</div>");

                            });

                        }
                });
            });


    </script>
@endpush

<div id="rfq-bid-modal" class="modal">
    <div class="modal-content">
        <form action="" method="post" enctype="multipart/form-data" id="rfq-bid-form">
            <div class="rfq_detail_from">
                @csrf
                <div id="rfq_bid_store_errors"></div>
                <input type="hidden" name="rfq_id" value="">

                <div class="row input-field input-wrapper">
                    <div class="col s12 m4 l3">
                        <label for="producut-title">Select Business</label>
                    </div>
                    <div class=" col s12 m8 l9">
                        <select class="select2" name="business_profile_id" id="my_business_list" required>
                        </select>
                    </div>
                </div>
                <div class="row input-field input-wrapper">
                    <div class="col s12 m4 l3">
                        <label for="producut-title">Title</label>
                    </div>
                    <div class=" col s12 m8 l9">
                        <input type="text" id="producut-title" name="title" class="form-control" placeholder="What you want to buy..." value="" disabled>
                    </div>
                </div>
                <div class="row input-field input-wrapper">
                    <div class="col s12 m4 l3">
                        <label for="product-bidding-desc">Short description</label>
                    </div>
                    <div class=" col s12 m8 l9">
                        <textarea name="description" id="product-bidding-desc" for="product-bidding-desc" class="editor product-bidding-desc" cols="30" rows="10"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m6 l6">
                        <div class="input-field row input-wrapper">
                            <div class="col s12 m6 l6">
                                <label for="producut-quality">Quantity</label>
                            </div>
                            <div class="col s12 m6 l6">
                                <input type="number" id="producut-quality" name="quantity" class="form-control" placeholder="Quantity">
                            </div>
                        </div>
                    </div>
                    <div class=" col s12 m6 l6">
                        <div class="input-field row input-wrapper">
                            <div class="col s12 m6 l6">
                                <label for="product-unit">Unit</label>
                            </div>
                            <div class="col s12 m6 l6">
                                <input type="text" id="product-unit" name="unit" class="form-control" placeholder="Unit" value="" disabled="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m6 l6">
                        <div class="input-field row input-wrapper">
                            <div class="col s12 m6 l6">
                                <label for="product-unit-price">Unit price</label>
                            </div>
                            <div class="col s12 m6 l6">
                                <input type="number" id="product-unit-price" class="form-control" name="unit_price" placeholder="Unit Price">
                            </div>
                        </div>
                    </div>
                    <div class=" col s12 m6 l6">
                        <div class="input-field row input-wrapper">
                            <div class="col s12 m6 l6">
                                <label for="product-total-price">Total price</label>
                            </div>
                            <div class="col s12 m6 l6">
                                <input type="number" id="product-total-price" class="form-control" name="total_price" placeholder="Total Price">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m6 l6">
                        <div class="input-field row input-wrapper">
                            <div class="col s12 m6 l6">
                                <label for="product-payment-method" class="select-icon">Payment method</label>
                            </div>
                            <div class="col s12 m6 l6">
                                <select name="payment_method" class="select2" id="product-payment-method">
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" col s12 m6 l6">
                        <div class="input-field row input-wrapper">
                            <div class="col s12 m6 l6">
                                <label for="product-destination" class="select-icon">Destination</label>
                            </div>
                            <div class="col s12 m6 l6">
                                <input type="text" name="destination" class="form-control appearance-none" id="product-destination" value="" disabled="">
                            </div>
                        </div>
                    </div>
                    <div class=" col s12 m6 l6">
                        <div class="input-field row input-wrapper">
                            <div class="col s12 m6 l6">
                                <label for="delivery-time" class="select-icon">Delivery Time</label>
                            </div>
                            <div class="col s12 m6 l6">
                                <input type="date" name="delivery_time" class="form-control appearance-none" id="delivery-time">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- rfq_detail_from end -->






            <div class="row rfq_img_upload_wrap">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="">
                        <label for="product-upload">Media</label>
                        <div class="box-body product-images">
                            <div class="fileinput fileinput-new product-image ic-thumb-item" data-provides="fileinput" >
                                <div class="fileinput-new thumbnail" style="max-width: 150px; max-height: 150px;">
                                    <img src="https://via.placeholder.com/200" width="100%" alt="media">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
                                <div class="text-center">
                                    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                        <input type="file" name="rfq_images[]">
                                    </span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                        <button id="add-image" type="button" class="btn btn-green" style="margin: 10px 0px">Add</button>
                    </div>
                </div>
            </div>

            <div class="previous-image-show"></div>

            <div class="submit_btn_wrap">
                <div class="row">
                    <div class="col s12 m6 l6 left-align"><a href="#!" class="modal-close btn_grBorder">Cancel</a></div>
                    <div class="col s12 m6 l6 right-align">
                        <button type="submit" class="btn_green rfq-replay-submit right">Submit</button>
                    </div>
                </div>
            </div>


            <!-- <div class="row">
                <div class="col-xs-12">
                    <div class="ic-form-btn ic-buying-req-btn">
                        <button type="submit" class="btn btn-default rfq-replay-submit">Submit</button>
                    </div>
                </div>
            </div> -->
        </form>
    </div>
    <!-- <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
    </div> -->
</div>

@push('js')
<script type="text/javascript">
    function deletePhoto(e) {
        $('#product_'+e).remove();
    };

    function preview_image(input)
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var previewID = $(input).attr("name");
            reader.onload = function (e) {
                $('#'+previewID).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {

        //    Add Image
        $('#add-image').click(function () {
            var product_images_length=$('.product-image').length;
            if (product_images_length>=5){
                alert('You exceed maximum image upload limit');
                return false;
            }

            var data='<div class="fileinput fileinput-new product-image ic-thumb-item" data-provides="fileinput" style="margin-left: 10px">\n' +
                '                                        <div class="fileinput-new thumbnail" style="max-width: 150px; max-height: 150px;">\n' +
                '                                            <img src="https://via.placeholder.com/200" width="100%" alt="header image">\n' +
                '                                        </div>\n' +
                '                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>\n' +
                '                                        <div class="text-center">\n' +
                '                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>\n' +
                '                                                <input type="file" name="rfq_images[]" required>\n' +
                '                                            </span>\n' +
                '                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>\n' +
                '                                        </div>\n' +
                '                                        <span class="ic-remove-btn remove-product" onclick="if (confirm(\'Are You Sure ?\')){ $(this).parent().remove();}" ></span>\n' +
                                                        '<a href="#" onclick="if (confirm(\'Are You Sure ?\')){ $(this).parent().remove();}" class="btn-small">remove</a>'
                '                                    </div>';

            $('.product-images').append(data);
        });

    })
</script>

@endpush

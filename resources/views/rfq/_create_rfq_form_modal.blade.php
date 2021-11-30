<div id="create-rfq-form" class="modal">
    <div class="modal-content">
        <section class="ic-buying-req">
            <div class="container">
                <div class="col-md-12 my-prd-hd-cont">
                    <div class="row">
                        <div class="col-md-12 plr0">
                            <h5 class="my-prd-hd">Request For Quote</h5>
                            <p>Submit Your Request for Quotation and let Merchant Bay source the best Supplier for you</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <span style="font-size: 12px; color: rgb(255, 0, 0);">* Indicates Mandatory field</span>
                    </div>
                </div>
                <!--Add Product Form-->
                <form action="{{route('rfq.store')}}" class="createRfqForm" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="col-md-12" style="margin-top: 20px;">
                        <!--3-->
                        <div class="row">
                            <div class="col-md-6 pr0 mb15 input-wrapper">
                                <label>Select Product Category <span style="color:red;font-weight:bold;">*</span></label>
                                <div class="ig-new">
                                    <i class="ig-new-lft3"><img src="images/category16.png"></i>
                                    <div class="ig-new-rgt3">
                                        <select class="select2" name="category_id" required>
                                            <option>Select an option</option>
                                            @foreach($manufacture_product_categories as $product_category)
                                                <option value="{{ $product_category->id }}">{{ $product_category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--/3-->

                        <!--4-->
                        <div class="row">

                            <div class="col-md-6 pl0 mb15 input-wrapper">
                                <label>Title <span style="color:red;font-weight:bold;">*</span></label>
                                <div class="ig-new">
                                    <i class="ig-new-lft3"><img src="images/category16.png"></i>
                                    <div class="ig-new-rgt3"><input type="text" class="form-control- ig-new-rgt" name="title" required/></div>
                                </div>
                            </div>

                            <div class="col-md-6 pr0 mb15 input-wrapper">
                                <!--left-->
                                <div class="col-md-6 pl0 mb15">
                                    <label>Quantity <span style="color:red;font-weight:bold;">*</span></label>
                                    <div class="ig-new">
                                        <i class="ig-new-lft2"><img src="images/quantity.png"></i>
                                        <div class="ig-new-rgt2"><input type="number" class="form-control- ig-new-rgt" name="quantity" required/></div>
                                    </div>
                                </div>
                                <!--left-->

                                <!--right-->
                                <div class="col-md-6 pr0 mb15 input-wrapper">
                                    <label>Select Unit <span style="color:red;font-weight:bold;">*</span></label>
                                    <div class="ig-new">
                                        <i class="ig-new-lft2"><img src="images/t-shirt.png"></i>
                                        <div class="ig-new-rgt2">
                                            <select class="select2" name="unit">
                                                <option value="">Select an option</option>
                                                @php $units = units(); @endphp
                                                @foreach($units as $unit=>$value)
                                                    <option value="{{$unit}}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--/right-->

                            </div>

                        </div>
                        <!--/4-->

                        <!--5-->
                        <div class="row">
                            <div class="col-md-6 pl0 mb15 input-wrapper">
                                <label>Short Description</label>
                                <div class="ig-new100">
                                    <i class="ig-new-lft3"><img src="images/category16.png"></i>
                                    <div class="ig-new-rgt3">
                                        <textarea class="ig-new-rgt prd-txta" style="height:88px;" name="short_description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pr0 mb15 input-wrapper">
                                <label>Full Description</label>
                                <div class="ig-new100">
                                    <i class="ig-new-lft3"><img src="images/category16.png"></i>
                                    <div class="ig-new-rgt3">
                                        <textarea class="ig-new-rgt prd-txta" style="height:88px;" name="full_specification"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/5-->

                        <!--6-->
                        <div class="row">
                            <div class="col-md-6 pl0 mb15 input-wrapper">
                                <label>Target Price <span style="color:red;font-weight:bold;">*</span></label>
                                <div class="ig-new">
                                    <i class="ig-new-lft3"><img src="images/dollar.png"></i>
                                    <div class="ig-new-rgt3"><input type="text" class="form-control- ig-new-rgt" id="target_price" name="unit_price" required onchange="allowTwoDecimal()" /></div>
                                </div>
                            </div>

                            <div class="col-md-6 pr0 mb15 input-wrapper">
                                <label>Destination <span style="color:red;font-weight:bold;">*</span></label>
                                <div class="ig-new">
                                    <i class="ig-new-lft3"><img src="images/Map16.png"></i>
                                    <div class="ig-new-rgt3"><input type="text" class="form-control- ig-new-rgt" name="destination" required/></div>
                                </div>
                            </div>
                        </div>
                        <!--/6-->

                        <!--7-->
                        <div class="row">
                            <div class="col-md-6 pl0 mb15 input-wrapper">
                                <label>Select Payment Method <span style="color:red;font-weight:bold;">*</span></label>
                                <div class="ig-new">
                                    <i class="ig-new-lft3"><img src="images/dollar.png"></i>
                                    <div class="ig-new-rgt3">
                                        <select class="select2" name="payment_method" required>
                                            <option>Select an option</option>
                                            <option value="cash">Cash</option>
                                            <option value="card">Card</option>
                                            <option value="Letter of Credit ( LC )">Letter of Credit ( LC )</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 pr0 mb15 input-wrapper">
                                <label>Expected Delivery Time <span style="color:red;font-weight:bold;">*</span></label>
                                <div class="ig-new">
                                    <i class="ig-new-lft3"><img src="images/clock16.png"></i>
                                    <div class="ig-new-rgt3"><input type="date" class="form-control- ig-new-rgt" name="delivery_time" required/></div>
                                </div>
                            </div>
                        </div>
                        <!--/7-->

                        <div class="clear30"></div>

                        <!--8-->
                        <div class="row">

                            <!--1-->
                            <div class="col-md-3" style="width:20%; text-align:center;">
                                <div class="col-md-12">
                                  <img src="https://via.placeholder.com/380" class="img-thumbnail" id="img1">
                                </div>
                                <div class="clear10"></div>
                                <div class="col-md-12" style="text-align:center;">
                                    <div id="msg"></div>
                                    <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img1')">
                                    <div class="input-group my-3" style="display:block;">
                                      <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                      <div class="input-group-append">
                                        <button type="button" class="browse btn btn-search btn-default" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <!--/1-->

                            <!--2-->
                            <div class="col-md-3" style="width:20%; text-align:center;">
                                <div class="col-md-12">
                                  <img src="https://via.placeholder.com/380" class="img-thumbnail" id="img2">
                                </div>
                                <div class="clear10"></div>
                                <div class="col-md-12" style="text-align:center;">
                                    <div id="msg"></div>
                                    <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img2')">
                                    <div class="input-group my-3" style="display:block;">
                                      <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                      <div class="input-group-append">
                                        <button type="button" class="browse btn btn-search btn-default" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <!--/2-->

                            <!--3-->
                            <div class="col-md-3" style="width:20%; text-align:center;">
                                <div class="col-md-12">
                                  <img src="https://via.placeholder.com/380" class="img-thumbnail" id="img3">
                                </div>
                                <div class="clear10"></div>
                                <div class="col-md-12" style="text-align:center;">
                                    <div id="msg"></div>
                                    <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img3')">
                                    <div class="input-group my-3" style="display:block;">
                                      <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                      <div class="input-group-append">
                                        <button type="button" class="browse btn btn-search btn-default" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <!--/3-->

                            <!--4-->
                            <div class="col-md-3" style="width:20%; text-align:center;">
                                <div class="col-md-12">
                                  <img src="https://via.placeholder.com/380" class="img-thumbnail" id="img4">
                                </div>
                                <div class="clear10"></div>
                                <div class="col-md-12" style="text-align:center;">
                                    <div id="msg"></div>
                                    <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img4')">
                                    <div class="input-group my-3" style="display:block;">
                                      <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                      <div class="input-group-append">
                                        <button type="button" class="browse btn btn-search btn-default" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <!--/4-->

                            <!--5-->
                            <div class="col-md-3" style="width:20%; text-align:center;">
                                <div class="col-md-12">
                                  <img src="https://via.placeholder.com/380" class="img-thumbnail" id="img5">
                                </div>
                                <div class="clear10"></div>
                                <div class="col-md-12" style="text-align:center;">
                                    <div id="msg"></div>
                                    <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img5')">
                                    <div class="input-group my-3" style="display:block;">
                                      <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                      <div class="input-group-append">
                                        <button type="button" class="browse btn btn-search btn-default" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <!--/5-->

                            <div class="clear10"></div>

                        </div>

                        <input type="hidden" name="captcha_token" id="captcha_token" value="">
                        <div class="clear30"></div>
                        <div class="ic-form-btn ic-buying-req-btn text-center" style="margin-top: 0px; margin-bottom: 14px;">
        {{--
                            <div class="captchaContent" style="margin-bottom: 15px;">
                                <div class="g-recaptcha" data-sitekey="6Lf_azEaAAAAAK4yET6sP7UU4X3T67delHoZ-T9G" data-callback="getCaptchaResponse"></div>
                                <div class="messageContent" style="color: red; text-align: left;"></div>
                            </div> --}}

                            {{-- <button type="button" class="btn-red mr15" onclick="location.reload();">
                                <i aria-hidden="true" class="fa fa-times-circle fa-lg"></i>&nbsp;&nbsp;Cancel
                            </button> --}}
                            <button type="button" class="btn-green" onclick="onSubmit()">
                                <i aria-hidden="true" class="fa fa-check-circle fa-lg" style="padding-right: 6px; line-height: 18px;"></i>Submit
                            </button>
                            <button type="submit" id="page_button" style="display: none;"></button>


                        </div>

                        <div class="clear20"></div>
                        <!--/8-->


                    </div>
                </form>
            </div>
        </section>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
    </div>
</div>


@push('js')
     <script type="text/javascript">

        function allowTwoDecimal() {
            var num = $("#target_price").val();
            value = parseFloat(num).toFixed(2);
            $("#target_price").val(value);
            //console.log(value);
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

        function onSubmit()
        {
            var errCount = 0;
            var errorClass = 'error';

            // if ($('input[name="name"]').val()=="" || $('input[name="name"]').val()=="undefined")
            // {
            //     errCount++;
            //     $('input[name="name"]').closest('.input-wrapper').addClass(errorClass);
            //     $('input[name="name"]').addClass('invalid');
            // }
            // else
            // {
            //     $('input[name="name"]').closest('.input-wrapper').removeClass(errorClass);
            //     $('input[name="name"]').removeClass('invalid');
            // }

            // if ($('input[name="email"]').val()=="" || $('input[name="email"]').val()=="undefined")
            // {
            //     errCount++;
            //     $('input[name="email"]').closest('.input-wrapper').addClass(errorClass);
            //     $('input[name="email"]').addClass('invalid');
            // }
            // else
            // {
            //     $('input[name="email"]').closest('.input-wrapper').removeClass(errorClass);
            //     $('input[name="email"]').removeClass('invalid');
            // }

            // if ($('input[name="mobile"]').val()=="" || $('input[name="mobile"]').val()=="undefined")
            // {
            //     errCount++;
            //     $('input[name="mobile"]').closest('.input-wrapper').addClass(errorClass);
            //     $('input[name="mobile"]').addClass('invalid');
            // }
            // else
            // {
            //     $('input[name="mobile"]').closest('.input-wrapper').removeClass(errorClass);
            //     $('input[name="mobile"]').removeClass('invalid');
            // }

            // if ($('select[name="industry"]').val()==null || $('select[name="industry"]').val()=="Select an option")
            // {
            //     errCount++;
            //     $('select[name="industry"]').closest('.input-wrapper').addClass(errorClass);
            //     $('select[name="industry"]').addClass('invalid');
            // }
            // else
            // {
            //     $('select[name="industry"]').closest('.input-wrapper').removeClass(errorClass);
            //     $('select[name="industry"]').removeClass('invalid');
            // }

            if ($('select[name="category_id"]').val()==null || $('select[name="category_id"]').val()=="Select an option")
            {
                errCount++;
                $('select[name="category_id"]').closest('.input-wrapper').addClass(errorClass);
                $('select[name="category_id"]').addClass('invalid');
            }
            else
            {
                $('select[name="category_id"]').closest('.input-wrapper').removeClass(errorClass);
                $('select[name="category_id"]').removeClass('invalid');
            }

            if ($('input[name="title"]').val()=="" || $('input[name="title"]').val()=="undefined")
            {
                errCount++;
                $('input[name="title"]').closest('.input-wrapper').addClass(errorClass);
                $('input[name="title"]').addClass('invalid');
            }
            else
            {
                $('input[name="title"]').closest('.input-wrapper').removeClass(errorClass);
                $('input[name="title"]').removeClass('invalid');
            }

            if ($('input[name="quantity"]').val()=="" || $('input[name="quantity"]').val()=="undefined")
            {
                errCount++;
                $('input[name="quantity"]').closest('.input-wrapper').addClass(errorClass);
                $('input[name="quantity"]').addClass('invalid');
            }
            else
            {
                $('input[name="quantity"]').closest('.input-wrapper').removeClass(errorClass);
                $('input[name="quantity"]').removeClass('invalid');
            }

            if ($('input[name="unit_price"]').val()=="" || $('input[name="unit_price"]').val()=="undefined")
            {
                errCount++;
                $('input[name="unit_price"]').closest('.input-wrapper').addClass(errorClass);
                $('input[name="unit_price"]').addClass('invalid');
            }
            else
            {
                $('input[name="unit_price"]').closest('.input-wrapper').removeClass(errorClass);
                $('input[name="unit_price"]').removeClass('invalid');
            }

            if ($('input[name="destination"]').val()=="" || $('input[name="destination"]').val()=="undefined")
            {
                errCount++;
                $('input[name="destination"]').closest('.input-wrapper').addClass(errorClass);
                $('input[name="destination"]').addClass('invalid');
            }
            else
            {
                $('input[name="destination"]').closest('.input-wrapper').removeClass(errorClass);
                $('input[name="destination"]').removeClass('invalid');
            }

            if ($('select[name="payment_method"]').val()==null || $('select[name="payment_method"]').val()=="Select an option")
            {
                errCount++;
                $('select[name="payment_method"]').closest('.input-wrapper').addClass(errorClass);
                $('select[name="payment_method"]').addClass('invalid');
            }
            else
            {
                $('select[name="payment_method"]').closest('.input-wrapper').removeClass(errorClass);
                $('select[name="payment_method"]').removeClass('invalid');
            }

            if ($('input[name="delivery_time"]').val()=="" || $('input[name="delivery_time"]').val()=="undefined" || $('input[name="delivery_time"]').val()=="mm/dd/yyyy")
            {
                errCount++;
                $('input[name="delivery_time"]').closest('.input-wrapper').addClass(errorClass);
                $('input[name="delivery_time"]').addClass('invalid');
            }
            else
            {
                $('input[name="delivery_time"]').closest('.input-wrapper').removeClass(errorClass);
                $('input[name="delivery_time"]').removeClass('invalid');
            }

            if(errCount==0)
            {
                // if (grecaptcha.getResponse()==""){
                //     jQuery('.messageContent').html('Captcha Required');
                // } else {
                    $("#page_button").click();
                // }
            }
            else
            {
                alert('Please fill all the required fields.');
                //$("html, body").animate({ scrollTop: 0 }, "slow");
                return false;
            }

        }

</script>
@endpush

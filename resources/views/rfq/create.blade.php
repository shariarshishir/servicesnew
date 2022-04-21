@extends('layouts.app')

@section('content')
<div id="create-rfq-form" class="rfq_detail_from_wrap">
    <div class="modal-content">
        <section class="ic-buying-req rfq_create_wrap">
            <div class="product_add_wrap_modal">

                <div class="card">
                    <legend style="text-align: center" >Create RFQ </legend>
                    <div id=errors></div>
                    <div class="col-md-12">
                        <div class="row">
                            <span style="font-size: 12px; color: rgb(255, 0, 0); padding-bottom: 15px; display:block;">* Indicates Mandatory field</span>
                        </div>
                    </div>
                    <!--Add Product Form-->
                    <form action="{{route('rfq.store.with.login')}}" class="createRfqForm " method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="rfq_detail_from">
                            <!--3-->
                            <div class="row input-field input-wrapper">
                                <div class="col s12 m6">
                                    <label>Title <span>*</span></label>
                                    <input type="text" class="form-control- ig-new-rgt" name="title" required/>
                                </div>
                                <div class="col s12 m6">
                                    <label class="category_title">Select Product Category <span >*</span></label>
                                    <select class="select2" id="category_id" name="category[]" multiple required >
                                        <option>Select an option</option>
                                        @foreach($manufacture_product_categories as $product_category)
                                            <option value="{{ $product_category->id }}">{{ $product_category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row input-field input-wrapper">
                                <div class="col s12 m6">
                                    <label>Short Description<span>*</span></label>
                                    <textarea class="ig-new-rgt prd-txta short_description add_short_description" style="height:88px;" name="short_description"></textarea>
                                </div>
                                <div class=" col s12 m6">
                                    <label>Full Description<span>*</span></label>
                                    <textarea class="ig-new-rgt prd-txta" style="height:88px;" name="full_specification"></textarea>
                                </div>
                            </div>


                            <div class="inpuboxt_group_wrap">
                                <div class="row">
                                    <div class="col s12 m12 l6">
                                        <div class="input-field row input-wrapper">
                                            <div class="col s12 m4 l5">
                                                <label>Quantity <span>*</span></label>
                                            </div>
                                            <div class="col s12 m8 l7">
                                                <input type="number" class="form-control- ig-new-rgt" name="quantity" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col s12 m12 l6">
                                        <div class="input-field row input-wrapper">
                                            <div class="col s12 m4 l5">
                                                <label>Select Unit <span>*</span></label>
                                            </div>
                                            <div class="col s12 m8 l7">
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
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l6">
                                        <div class="input-field row input-wrapper">
                                            <div class="col s12 m4 l5">
                                                <label>Target Price <span>*</span></label>
                                            </div>
                                            <div class="col s12 m8 l7">
                                                <input type="text" class="form-control- ig-new-rgt" id="target_price" name="unit_price" required onchange="allowTwoDecimal()" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col s12 m12 l6">
                                        <div class="input-field row input-wrapper">
                                            <div class="col s12 m4 l5">
                                                <label>Destination <span>*</span></label>
                                            </div>
                                            <div class="col s12 m8 l7">
                                                <input type="text" class="form-control- ig-new-rgt" name="destination" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m12 l6">
                                        <div class="input-field row input-wrapper">
                                            <div class="col s12 m4 l5">
                                                <label>Select Payment Method <span>*</span></label>
                                            </div>
                                            <div class="col s12 m8 l7">
                                                <select class="select2" name="payment_method" required>
                                                    <option>Select an option</option>
                                                    <option value="cash">Cash</option>
                                                    <option value="card">Card</option>
                                                    <option value="Letter of Credit ( LC )">Letter of Credit ( LC )</option>
                                                    <option value="pay order">Pay Order</option>
                                                    <option value="cheque">Cheque</option>
                                                    <option value="tt">TT</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col s12 m12 l6">
                                        <div class="input-field row input-wrapper">
                                            <div class="col s12 m4 l5">
                                                <label>Expected Delivery Time <span>*</span></label>
                                            </div>
                                            <div class="col s12 m8 l7">
                                                <input type="date" class="form-control- ig-new-rgt" name="delivery_time" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row rfq_img_upload_wrap">
                                <div class="thumbnail_img_box">
                                    <div class="thumbnail_img">
                                        <img src="https://via.placeholder.com/380" class="img-thumbnail" id="img1">
                                    </div>
                                    <div class="upload_img_box center-align">
                                        <div id="msg"></div>
                                        <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img1')">
                                        <div class="input-group my-3" style="display:block;">
                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                        <div class="input-group-append">
                                            <button type="button" class="btn_upload" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/1-->

                                <!--2-->
                                <div class="thumbnail_img_box">
                                    <div class="thumbnail_img">
                                        <img src="https://via.placeholder.com/380" class="img-thumbnail" id="img2">
                                    </div>
                                    <div class="upload_img_box center-align">
                                        <div id="msg"></div>
                                        <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img2')">
                                        <div class="input-group my-3" style="display:block;">
                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                        <div class="input-group-append">
                                            <button type="button" class="btn_upload" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/2-->

                                <!--3-->
                                <div class="thumbnail_img_box">
                                    <div class="thumbnail_img">
                                        <img src="https://via.placeholder.com/380" class="img-thumbnail" id="img3">
                                    </div>
                                    <div class="upload_img_box center-align">
                                        <div id="msg"></div>
                                        <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img3')">
                                        <div class="input-group my-3" style="display:block;">
                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                        <div class="input-group-append">
                                            <button type="button" class="btn_upload" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/3-->

                                <!--4-->
                                <div class="thumbnail_img_box">
                                    <div class="thumbnail_img">
                                        <img src="https://via.placeholder.com/380" class="img-thumbnail" id="img4">
                                    </div>
                                    <div class="upload_img_box center-align">
                                        <div id="msg"></div>
                                        <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img4')">
                                        <div class="input-group my-3" style="display:block;">
                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                        <div class="input-group-append">
                                            <button type="button" class="btn_upload" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/4-->

                                <!--5-->
                                <div class="thumbnail_img_box">
                                    <div class="thumbnail_img">
                                        <img src="https://via.placeholder.com/380" class="img-thumbnail" id="img5">
                                    </div>
                                    <div class="upload_img_box center-align">
                                        <div id="msg"></div>
                                        <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img5')">
                                        <div class="input-group my-3" style="display:block;">
                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                        <div class="input-group-append">
                                            <button type="button" class="btn_upload" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/5-->



                            </div>

                            <input type="hidden" name="captcha_token" id="captcha_token" value="">
                            <div class="clear30"></div>

                            <legend>User Information</legend>
                            <div class="user_login_info">
                                <div class=" col s12 m12 l12">
                                    <div class="input-field row input-wrapper">
                                        <div class="col s12 m4 l5">
                                            <label>Email Address</label>
                                        </div>
                                        <div class="col s12 m8 l7">
                                            <input type="email" class="form-control- ig-new-rgt" name="email" />
                                        </div>
                                    </div>
                                </div>
                                <div class=" col s12 m12 l12">
                                    <div class="input-field row input-wrapper">
                                        <div class="col s12 m4 l5">
                                            <label>Password</label>
                                        </div>
                                        <div class="col s12 m8 l7">
                                            <input type="password" class="form-control- ig-new-rgt" name="password" />
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" class="trigger_rfq_register">Click here to Register</a>
                            </div>
                            <div class="user_registration_info" style="display: none;">
                                <div class=" col s12 m12 l12">
                                    <div class="input-field row input-wrapper">
                                        <div class="col s12 m4 l5">
                                            <label>Name</label>
                                        </div>
                                        <div class="col s12 m8 l7">
                                            <input type="text" class="form-control- ig-new-rgt" name="name" />
                                        </div>
                                    </div>
                                </div>
                                <div class=" col s12 m12 l12">
                                    <div class="input-field row input-wrapper">
                                        <div class="col s12 m4 l5">
                                            <label>Email Address</label>
                                        </div>
                                        <div class="col s12 m8 l7">
                                            <input type="email" class="form-control- ig-new-rgt" name="r_email" />
                                        </div>
                                    </div>
                                </div>
                                <div class=" col s12 m12 l12">
                                    <div class="input-field row input-wrapper">
                                        <div class="col s12 m4 l5">
                                            <label>Password</label>
                                        </div>
                                        <div class="col s12 m8 l7">
                                            <input type="password" class="form-control- ig-new-rgt" name="r_password" />
                                        </div>
                                    </div>
                                </div>
                                {{-- <input type="hidden" name="company" value="No Company" /> --}}
                                <a href="javascript:void(0)" class="trigger_rfq_login">Already register. Click here to login</a>
                            </div>


                            <div class="ic-form-btn ic-buying-req-btn text-center" style="margin-top: 0px; margin-bottom: 14px;">

                                <button type="submit" id="page_button" style="display: none;"></button>

                                <div class="submit_btn_wrap">
                                    <div class="row">
                                        <div class="col s12 m6 right-align">
                                            <button type="button" class="btn_green btn_rfq_post btn-green right" onclick="onSubmit();">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="clear20"></div>
                            <!--/8-->


                        </div>
                    </form>
                </div>



            </div>




        </section>
    </div>
    <!-- <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
    </div> -->
</div>


@push('js')
     <script type="text/javascript">
         $(document).ready(function(){
             $(".trigger_rfq_register").click(function(){
                $(this).closest(".user_login_info").hide();
                $(".user_registration_info").show();
             })
             $(".trigger_rfq_login").click(function(){
                $(this).closest(".user_registration_info").hide();
                $(".user_login_info").show();
             })
         })

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


            if ($('#category_id').val()==null || $('#category_id').val()=="Select an option")
            {
                errCount++;
                $('#category_id').closest('.input-wrapper').addClass(errorClass);
                $('#category_id').addClass('invalid');
            }
            else
            {
                $('#category_id').closest('.input-wrapper').removeClass(errorClass);
                $('#category_id').removeClass('invalid');
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

            if ($('input[name="short_description"]').val()=="" || $('input[name="short_description"]').val()=="undefined")
            {
                errCount++;
                $('input[name="short_description"]').closest('.input-wrapper').addClass(errorClass);
                $('input[name="short_description"]').addClass('invalid');
            }
            else
            {
                $('input[name="short_description"]').closest('.input-wrapper').removeClass(errorClass);
                $('input[name="short_description"]').removeClass('invalid');
            }

            if ($('input[name="full_specification"]').val()=="" || $('input[name="full_specification"]').val()=="undefined")
            {
                errCount++;
                $('input[name="full_specification"]').closest('.input-wrapper').addClass(errorClass);
                $('input[name="full_specification"]').addClass('invalid');
            }
            else
            {
                $('input[name="full_specification"]').closest('.input-wrapper').removeClass(errorClass);
                $('input[name="full_specification"]').removeClass('invalid');
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

            if ($('input[name="unit_price"]').val()=="" || $('input[name="unit_price"]').val()=="undefined" )
            {
                errCount++;
                $('input[name="unit_price"]').closest('.input-wrapper').addClass(errorClass);
                $('input[name="unit_price"]').addClass('invalid');
            }
            else if($.isNumeric($('input[name="unit_price"]').val()) == false)
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

            if ($('input[name="email"]').val()=="" && $('input[name="r_email"]').val()=="")
            {
                errCount++;
                $('input[name="email"]').closest('.input-wrapper').addClass(errorClass);
                $('input[name="email"]').addClass('invalid');
            }
            else
            {
                $('input[name="email"]').closest('.input-wrapper').removeClass(errorClass);
                $('input[name="email"]').removeClass('invalid');
            }

            if ($('input[name="password"]').val()=="" && $('input[name="r_password"]').val()=="")
            {
                errCount++;
                $('input[name="password"]').closest('.input-wrapper').addClass(errorClass);
                $('input[name="password"]').addClass('invalid');
            }
            else
            {
                $('input[name="password"]').closest('.input-wrapper').removeClass(errorClass);
                $('input[name="password"]').removeClass('invalid');
            }

            if ($('input[name="email"]').val()=="" && $('input[name="name"]').val()=="")
            {
                errCount++;
                $('input[name="name"]').closest('.input-wrapper').addClass(errorClass);
                $('input[name="name"]').addClass('invalid');
            }
            else
            {
                $('input[name="name"]').closest('.input-wrapper').removeClass(errorClass);
                $('input[name="name"]').removeClass('invalid');
            }



            if(errCount==0)
            {
               var short_description= $('#create-rfq-form .add_short_description').val().length;
                if($('#create-rfq-form .add_short_description').val().length > 512){
                    alert('The short description character length limit is not more than 512, your given character length is '+short_description);
                    return false;
                }
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


        $("#create-rfq-form .add_short_description").keypress(function() {
            if($(this).val().length > 512) {
                alert('The short description character length limit is not more than 512')
            } else {
                // Disable submit button
            }
        });


        $('.createRfqForm').on('submit',function(e){
            e.preventDefault();


            var formData = new FormData(this);
            formData.append('_token', "{{ csrf_token() }}");

            const rfq_login_check_url = "{{route('rfq.store.with.login')}}";
            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                url: rfq_login_check_url,
                beforeSend: function() {
                    $('.loading-message').html("Please Wait.");
                    $('#loadingProgressContainer').show();
                },

                success:function(response){

                    console.log(response);
                    const rfq_app_url = "{{env('RFQ_APP_URL')}}";
                    var url = rfq_app_url+'/api/quotation';
                    const sso_token = "Bearer " +response.access_token;
                    var formData = new FormData();
                    var file_data = $('input[type="file"]')[0].files; // for multiple files
                    var files = [];
                    for (let i = 0; i < $('input[type="file"]').length; i++) {
                        formData.append("files", $('input[type="file"]')[i].files[0]);
                    }
                    formData.append("rfq_from", 'service');


                    var other_data = $('.createRfqForm').serializeArray();
                    var category_id=[];
                    $("#category_id :selected").each(function() {
                        category_id.push(this.value);
                    });
                    var stringCatId=category_id.toString();

                    $.each(other_data,function(key,input){
                        if(input.name != 'category[]'){
                            formData.append(input.name,input.value);
                        }
                    });

                    formData.append('category_id', stringCatId);
                    formData.append('_token', "{{ csrf_token() }}");

                    $.ajax({
                        method: 'post',
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: formData,
                        enctype: 'multipart/form-data',
                        url: url,
                        headers: { 'Authorization': sso_token },

                        success:function(response){
                            $('.loading-message').html("");
                            $('#loadingProgressContainer').hide();
                            const msg = "Your RFQ was posted successfully.<br><br>Soon you will receive quotation from <br>Merchant Bay verified relevant suppliers.";
                            swal("Done!", msg,"success");
                            window.location.href = "{{ route('rfq.my')}}";
                        },
                        error: function(xhr, status, error)
                            {
                            $('.loading-message').html("");
                            $('#loadingProgressContainer').hide();
                            swal("Error!", error,"error");
                            }
                    });

                },
                error: function(xhr, status, error)
                    {
                        $('.loading-message').html("");
                        $('#loadingProgressContainer').hide();
                        $("#errors").empty();
                        if(xhr.responseJSON.status == 400){
                            $.each(xhr.responseJSON.error, function (key, item)
                            {
                                $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                            });
                        }else{
                            swal("Error!", xhr.responseJSON.error,"error");
                        }


                    }
            });

        });

</script>
@endpush





@endsection

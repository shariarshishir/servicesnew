<div class="footer-outer-wrapper">
    <div class="row bottom-block-outer-wrapper">
        <div class="container">
            <div class="row">
                <div class="col l6 m12 s12 newsletter-info-block">
                    <p>Get Trade Notification & Promotional Event Invitation - Receiving the latest deal, offer and trade news to your inbox</p>
                </div>
                <div class="col l6 m12 s12 newsletter-block">
                    <form  action="#" method="post">
                        <div class="input-field col s8">
                            <input id="newsletter_email_address" type="text" class="validate" name="newsletter_email_address">
                            <label for="newsletter_email_address">Email Address</label>
                            <span>We’ll never disclose your email address with a third-party</span>
                        </div>
                        <div class="col m4">
                            <button class="btn waves-effect waves-light green"  id="newsletter_signup" type="button">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="row top-footer">
            <div class="container">
                <div class="col m9 offset-m2 s12 offset-s0">
                    <div class="col l4 m12 s12 footer-det">
                        <span class="footer-det-hd">Merchant Bay Shop</span>
                        <span class="footer-det-mhd">&copy; 2021 All rights reserved</span>
                        <span class="footer-det-nhd">Developed By: <a href="javascript:void(0);" style="color: #ffffff;">Merchantbay.com</a></span>
                    </div>
                    <div class="col l8 m12 s12">
                        <h5 class="follow-us">Follow Us</h5>
                        <ul>
                            <li><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fab fa-pinterest-p"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bottom-footer">
            <div class="container">
                &nbsp;
            </div>
        </div>
    </footer>
</div>

<div id="login-register-modal" class="modal modal-fixed-footer" tabindex="0">
    <div class="modal-content">
        <div class="row">
            <div class="col m6 registration-block">
                <div class="company-logo">
                    <img src="{{asset('images/frontendimages/merchantbay_logoX200.png')}}" alt="Merchant Bay Logo" />
                </div>
                <div class="registration-content">
                    <p>Not Yet Registered ?</p>
                    {{-- Want to be a <a href="{{route('user.register', 'buyer')}}">Buyer</a> or <a href="{{route('user.register', 'wholesaler')}}">Wholesaler</a> --}}
                    <a href="{{env('SSO_REGISTRATION_URL').'/?flag=shop'}}" > Click here to Register</a>
                </div>
            </div>
            <div class="col m6 login-block">
                <span class="text-danger error-text error-msg login-error-msg" style="display: none;"></span>
                <form method="POST" action="#">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input id="email_login" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="email" class="">{{ __('E-Mail Address') }}</label>
                            <span class="text-danger error-text email_err"></span>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 password-block-wrap">
                            <i class="material-icons prefix">lock_outline</i>
                            <input id="password_login" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <label for="password" class="">{{ __('Password') }}</label>
                            <span class="text-danger error-text password_err"></span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <a href="javascript:void(0);" id="show-password"><i class="material-icons">visibility</i></a>
                            <a href="javascript:void(0);" id="hide-password" style="display: none;"><i class="material-icons">visibility_off</i></a>
                        </div>
                    </div>

                    <div class="row remember-me-block">
                        <div class="input-field col s12">
                            <label>
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked="checked"' : '' }} />
                                <span>{{ __('Remember Me') }}</span>
                            </label>
                        </div>
                    </div>

                    <button class="btn green waves-effect waves-light right signin" type="submit" name="log-in">
                        {{ __('Sign In') }} <i class="material-icons right">send</i>
                    </button>
                    @if (Route::has('password.request'))
                        <a class="btn green right btn-forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot Password?') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat "><i class="material-icons green-text text-darken-1">close</i></a>
    </div>
</div>

{{-- tinymc editor file upload modal --}}
<div id="tiny-mc-file-upload-modal" class="modal modal-fixed-footer" tabindex="0">
    <div class="modal-content">
        <div class="row">
            <div class="col m6 login-block">
                <span class="text-danger error-text error-msg login-error-msg" style="display: none;"></span>
                <form method="POST" action="#" enctype="multipart/form-data" id="tiny-mc-file-upload-form">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="tiny_mc_file" type="file" name="tiny_mc_file" required />
                        </div>
                        <button class="btn green waves-effect waves-light tiny-mc-file-upload" type="button" >
                            {{ __('Upload') }} <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat "><i class="material-icons green-text text-darken-1">close</i></a>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>

<!-- Material JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" integrity="sha512-NiWqa2rceHnN3Z5j6mSAvbwwg3tiwVNxiAQaaSMSXnRRDh5C2mk/+sKQRw8qjV1vN4nf8iK2a0b048PnHbyx+Q==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js" integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.2.0/wNumb.min.js" integrity="sha512-igVQ7hyQVijOUlfg3OmcTZLwYJIBXU63xL9RC12xBHNpmGJAktDnzl9Iw0J4yrSaQtDxTTVlwhY730vphoVqJQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.material.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.material.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/jquery.raty.min.js" integrity="sha512-82+rXsrLf7WAylMdkaH5lWdNXWC0xHUKB41bmUCMICDHy/qpMZqpo4fQlBRJ5h1oSCqFOwKTWC4u2+vR2fblFw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/jquery.raty.min.css" integrity="sha512-XsO5ywONBZOjW5xo5zqAd0YgshSlNF+YlX39QltzJWIjtA4KXfkAYGbYpllbX2t5WW2tTGS7bmR0uWgAIQ8JLQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('upload-js/vendor/jquery.ui.widget.js')}}"></script>
<script src="{{asset('upload-js/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('upload-js/jquery.fileupload.js')}}"></script>
<script src="{{asset('js/image-uploader.min.js')}}"></script>
{{-- jquery ui --}}
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}


<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
{{-- croper js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

@stack('js')
<script>
    // Prevent jQuery UI dialog from blocking focusin
    $(document).on('focusin', function(e) {
        if ($(e.target).closest('input[aria-controls="select2-vendor_country-results"]').length) {
            e.stopImmediatePropagation();
        }
    });
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll >= 180) {
            $(".top-header").addClass("hide-on-scroll");
            $(".middle-header").addClass("hide-on-scroll");
            $(".main-header").addClass("fixed");
        } else {
            $(".top-header").removeClass("hide-on-scroll");
            $(".middle-header").removeClass("hide-on-scroll");
            $(".main-header").removeClass("fixed");
        }
    });
    $('#newsletter_signup').on('click',function(event){
        event.preventDefault();
        let newsletter_email_address = $('#newsletter_email_address').val();
        $.ajax({
          url: "{{route('newsletter.subscribe')}}",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            newsletter_email_address:newsletter_email_address,
          },
            success:function(response) {
                swal(response.success,'successs');
                $('form :input').val('');


            },
            error:function (response) {
                var error = response.responseJSON.errors.newsletter_email_address;
                console.log();

                swal(error[0],"Please try again", "error");

            }
         });
        });

</script>

<script>
    $(document).on('change', '.price-value', function(){
        var num = $(this).val();
        value = parseFloat(num).toFixed(2);
        $(this).val(value);
    })

    $(document).on('change', '.price-range-value', function(){
        var num = $(this).val();
        if($.isNumeric(num) == true){
            value = parseFloat(num).toFixed(2);
        }
        else{
            value = 'Negotiable';
        }
        $(this).val(value);
    })

    $(document).on('change', '.check-price-range-value', function(){
        var num = $(this).val();
        if($.isNumeric(num) == false){
           alert('Please Provide a Numeric Value');
        }
    })

    $(document).ready(function () {
        //$(".ready_attr_data:last-child .price-range-block").children(".price-range-separator").html("&le;");
        $(".ready_attr_data:last-child .price-range-block").children(".max-price").append(" (+ More)");
        $("#show-password").click(function(){
            $(this).hide();
            $("#hide-password").show();
            $("#password_login").prop("type", "text");
        });
        $("#hide-password").click(function(){
            $(this).hide();
            $("#show-password").show();
            $("#password_login").prop("type", "password")
        });
        var currentflow = 1;
        $('#horizontalmarque').children().eq(0).css('display', 'table-row');
        setInterval(function() {
            if(currentflow == $('#horizontalmarque').children().length)
            {
                currentflow = 1;
            }
            else
            {
                for(var i = 0; i < $('#horizontalmarque').children().length; i++)
                {
                    if((i + 1) == currentflow)
                    {
                        $('#horizontalmarque').children().eq(i).css('display', 'table-row');
                    }
                    else
                    {
                        $('#horizontalmarque').children().eq(i).css('display', 'none');
                    }
                }
                currentflow += 1;
            }
        }, 5000);
    });
    $('.product-large-image-block').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.product-list-images-block'
    });
    $('.product-list-images-block').slick({
        dots: false,
        speed: 500,
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.product-large-image-block',
        focusOnSelect: true
    });
    $('.related-products-block').slick({
        dots: false,
        infinite: false,
        speed: 500,
        slidesToShow: 4,
        slidesToScroll: 1
    });
    $('.modal-product-images').slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    $('.recommendation-products').slick({
        dots: false,
        infinite: false,
        speed: 500,
        slidesToShow: 4,
        slidesToScroll: 1
    });
    $(function () {
        $('#fileupload').fileupload({
            dataType: 'json',
            add: function (e, data) {
                $('#loading').text('Uploading...');
                data.submit();
            },
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    $('<p/>').html(file.name + ' (' + file.size + ' KB)').appendTo($('#files_list'));
                    if ($('#file_ids').val() != '') {
                        $('#file_ids').val($('#file_ids').val() + ',');
                    }
                    $('#file_ids').val($('#file_ids').val() + file.fileID);
                });
                $('#loading').text('');
            }
        });
    });
</script>

<script>
    $('.signin').click(function (e) {
        e.preventDefault();
        var email = $('#email_login').val();
        var password=$('#password_login').val();
        var remember =$(this).closest('#login-register-modal').find('input[name="remember"]').prop('checked');
        $.ajax({
            url: "{{route('users.login')}}",
            type: "POST",
            data: {"email": email, "password": password , "remember": remember, "_token": "{{ csrf_token() }}"},
            success: function (data) {
                    if($.isEmptyObject(data.error)){
                       if(data.msg){
                        //$('.error-msg').show().text(data.msg);
                        // alert(data.msg);
                        $('#email_login').addClass('invalid');
                        $('#password_login').addClass('invalid');
                       }
                       else{
                          //console.log(data);
                        var url = '{{ route("users.profile") }}';
                        window.location.href=url;
                       }

                    }
                    else{
                        printErrorMsg(data.error);
                    }
            }
        });
    });
    function printErrorMsg (msg) {
        $.each( msg, function( key, value ) {
          $('.'+key+'_err').text(value);
        });
    }
</script>
<script>
    @if(Session::has('success'))
        //toastr.success("{{Session::get('success')}}");
        var toastHTML= "{{Session::get('success')}}";
        M.toast({html: toastHTML, classes:'toast-success'});
    @endif

    @if(Session::has('error'))
        //toastr.error("{{Session::get('error')}}");
        var toastHTML= "{{Session::get('error')}}";
        M.toast({html: toastHTML, classes:'toast-error'});
    @endif

    @if(Session::has('info'))
        //toastr.info("{{ Session::get('info') }}");
        var toastHTML= "{{Session::get('info')}}";
        M.toast({html: toastHTML, classes:'toast-info'});
    @endif

    @if(Session::has('warning'))
       // toastr.warning("{{ Session::get('warning') }}");
       var toastHTML= "{{Session::get('warning')}}";
        M.toast({html: toastHTML, classes:'toast-warning'});
    @endif
  </script>
  <script>
    function addProductColorSize()
    {
    let totalChild = $('.color-size-table-block tbody').children().length;
    var html = '<tr>';
    html += '<td><input type="text" value="" class="form-control" name="color_size[color][]" /></td>';
    html += '<td><input type="text" value="0" class="form-control " name="color_size[xxs][]" /></td>';
    html += '<td><input type="text" value="0" class="form-control " name="color_size[xs][]" /></td>';
    html += '<td><input type="text" value="0" class="form-control " name="color_size[small][]" /></td>';
    html += '<td><input type="text" value="0" class="form-control " name="color_size[medium][]" /></td>';
    html += '<td><input type="text" value="0" class="form-control " name="color_size[large][]" /></td>';
    html += '<td><input type="text" value="0" class="form-control " name="color_size[extra_large][]" /></td>';
    html += '<td><input type="text" value="0" class="form-control " name="color_size[xxl][]" /></td>';
    html += '<td><input type="text" value="0" class="form-control " name="color_size[xxxl][]" /></td>';
    html += '<td><input type="text" value="0" class="form-control " name="color_size[four_xxl][]" /></td>';
    html += '<td><input type="text" value="0" class="form-control " name="color_size[one_size][]" /></td>';
    html += '<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeProductColorSize(this)"><i class="material-icons dp48">remove</i></a></td>';
    html += '</tr>';
    $('.color-size-table-block tbody').append(html);
    }
    function removeProductColorSize(el)
    {
        $(el).parent().parent().remove();
    }

    function addFreshOrderAttribute()
    {
    let totalChild = $('.color-size-table-block tbody').children().length;
    var html = '<tr>';
    html += '<td><input name="quantity_min[]" id="quantity_min" type="text" class="form-control check-price-range-value @error('quantity') is-invalid @enderror"  value="" placeholder="Min. Value"></td>';
    html += '<td><input name="quantity_max[]" id="quantity_max" type="text" class="form-control check-price-range-value @error('quantity') is-invalid @enderror"  value="" placeholder="Max. Value"></td>';
    html += '<td><input name="price[]" id="price" type="text" class="form-control price-range-value @error('price') is-invalid @enderror"  value="" placeholder="$"></td>';
    html += '<td><input name="lead_time[]" id="lead_time" type="text" class="form-control @error('lead_time') is-invalid @enderror"  value="" placeholder="Days"></td>';
    html += '<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeFreshOrderAttribute(this)"><i class="material-icons dp48">remove</i></a></td>';
    html += '</tr>';
    $('.fresh-order-attribute-table-block tbody').append(html);
    }
    function removeFreshOrderAttribute(el)
    {
        $(el).parent().parent().remove();
    }

    function addReadyOrderAttribute()
    {
    let totalChild = $('.color-size-table-block tbody').children().length;
    var html = '<tr>';
    html += '<td><input name="ready_quantity_min[]" id="ready_quantity_min" type="text" class="form-control check-price-range-value @error('quantity') is-invalid @enderror"  value="" placeholder="Min. Value"></td>';
    html += '<td><input name="ready_quantity_max[]" id="ready_quantity_max" type="text" class="form-control check-price-range-value @error('quantity') is-invalid @enderror"  value="" placeholder="Max. Value"></td>';
    html += '<td><input name="ready_price[]" id="ready_price" type="text" class="form-control price-range-value @error('price') is-invalid @enderror"  value="" placeholder="$"></td>';
    html += '<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeFreshOrderAttribute(this)"><i class="material-icons dp48">remove</i></a></td>';
    html += '</tr>';
    $('.ready-order-attribute-table-block tbody').append(html);
    }
    function removeReadyOrderAttribute(el)
    {
        $(el).parent().parent().remove();
    }

    // non clothing item
    function addNonClothingAttr()
    {
    let totalChild = $('.non-clothing-color-quantity-table-block tbody').children().length;
    var html = '<tr>';
    html += '<td><input type="text" value="" class="form-control" name="non_clothing_attr[color][]" /></td>';
    html += '<td><input type="text" value="0" class="form-control check-price-range-value" name="non_clothing_attr[quantity][]" /></td>';
    html += '<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeNonClothingAttr(this)"><i class="material-icons dp48">remove</i></a></td>';
    html += '</tr>';
    $('.non-clothing-color-quantity-table-block tbody').append(html);
    }
    function removeNonClothingAttr(el)
    {
        $(el).parent().parent().remove();
    }


    function addNonClothingPriceBreakDown()
    {
    let totalChild = $('.non-clothing-prices-breakdown-block tbody').children().length;
    var html = '<tr>';
    html += '<td><input  name="non_clothing_min[]"  type="text" class="form-control check-price-range-value @error('quantity') is-invalid @enderror"  value="" placeholder="Min. Value"></td>';
    html += '<td><input  name="non_clothing_max[]"  type="text" class="form-control check-price-range-value @error('quantity') is-invalid @enderror"  value="" placeholder="Max. Value"></td>';
    html += '<td><input  name="non_clothing_price[]" type="text" class="form-control price-range-value @error('price') is-invalid @enderror"  value="" placeholder="$"></td>';
    html += '<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeNonClothingPriceBreakDown(this)"><i class="material-icons dp48">remove</i></a></td>';
    html += '</tr>';
    $('.non-clothing-prices-breakdown-block tbody').append(html);
    }
    function removeNonClothingPriceBreakDown(el)
    {
        $(el).parent().parent().remove();
    }

    //end non clothing item

  </script>

  <script>

       $(document).ready(function() {
            var editor_config = {
                path_absolute : "/",
                selector: 'textarea.editor',
                relative_urls : 0,
                remove_script_host : 0,
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar: "insertfile undo redo | styleselect | myCustomToolbarButton bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                setup: function (editor) {
                    editor.ui.registry.addButton('myCustomToolbarButton', {
                    text: '<div class="pdf-upload-icon">pdf</div>',
                    onAction: function (_) {
                       $('#tiny-mc-file-upload-modal').modal('open');
                       $('#tiny-mc-file-upload-form')[0].reset();
                       $(document).one('click', '.tiny-mc-file-upload', function (e) {
                            e.preventDefault();
                            var formData= new FormData(document.getElementById('tiny-mc-file-upload-form'));
                            formData.append('_token', "{{ csrf_token() }}");

                            $.ajax({
                                url: "{{route('tinymc.file.upload')}}",
                                type: "POST",
                                processData: false,
                                contentType: false,
                                cache: false,
                                data: formData,
                                beforeSend: function() {
                                    $('.loading-message').html("Please Wait.");
                                    $('#loadingProgressContainer').show();
                                },
                                success: function (data) {
                                    var html='<a href="'+data.fileName+'" target="_blank" class="tinymc-uploaded-file">'+data.originalFileName+'</a>';
                                    editor.insertContent(html);
                                    $('#tiny-mc-file-upload-modal').modal('close');
                                    $('.loading-message').html("");
		                            $('#loadingProgressContainer').hide();
                                }
                            });
                       });

                    }
                    });
                },
                /* enable title field in the Image dialog*/
                image_title: true,
                /* enable automatic uploads of images represented by blob or data URIs*/
                automatic_uploads: true,
                /*
                    URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
                    images_upload_url: 'postAcceptor.php',
                    here we add custom filepicker only to Image dialog
                */
                file_picker_types: 'image',
                /* and here's our custom image picker*/
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');

                    /*
                    Note: In modern browsers input[type="file"] is functional without
                    even adding it to the DOM, but that might not be the case in some older
                    or quirky browsers like IE, so you might want to add it to the DOM
                    just in case, and visually hide it. And do not forget do remove it
                    once you do not need it anymore.
                    */

                    input.onchange = function () {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function () {
                        /*
                        Note: Now we need to register the blob in TinyMCEs image blob
                        registry. In the next release this part hopefully won't be
                        necessary, as we are looking to handle it internally.
                        */
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                    };

                    input.click();
                },
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            };

            function applyMCE() {
                tinymce.init(editor_config);
            }

            applyMCE();
        });
  </script>

  <script>
  //sorting
    $(document).on('change','.sorting', function(){
        var value= $(this).val();
        // var pageUrl = $(location).attr("href");
        // var segments = pageUrl.split( '/' );
        // var action = segments[4];
        var slug =$('input[name=slug]').val();
        if($('.sorting_category_id').val()){
            var cat_id=$('.sorting_category_id').val();
        }
        else{
            var cat_id= null;
        }
        var url = '{{ route("sorting", [":value" , ":slug" , ":cat_id"] )}}';
            url = url.replace(':value', value);
            url = url.replace(':slug', slug);
            url = url.replace(':cat_id', cat_id);
        $.ajax({
            method: 'get',
            processData: false,
            contentType: false,
            cache: false,
            url: url,
            beforeSend: function() {
                $("body").addClass("loading");
            },
            complete: function(){
                $("body").removeClass("loading");
            },
            success:function(data)
                {

                    $('.prodcuts-list').html('');
                    $('.prodcuts-list').html(data.data);
                },
            error: function(xhr, status, error)
                {
                    $('#errors').empty();
                    $("#errors").append("<li class='alert alert-danger'>"+error+"</li>")
                    $.each(xhr.responseJSON.error, function (key, item)
                    {
                        $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                    });
                }
        });

    });
  </script>

  <script>
//live search by product name or vendor name
$(document).on("keyup",".search_input",function(){

var searchInput = $(this).val();
var selectedSearchOption = $("#searchOption").children("option:selected").val();
$("#system_search .search_type").val(selectedSearchOption);
$.ajax({
    type:'GET',
    url: '/liveSearch',
    dataType:'json',
    data:{ searchInput:searchInput,selectedSearchOption:selectedSearchOption},
    beforeSend: function() {
        $('.loading-message').html("Searching please Wait.");
        $('#loadingProgressContainer').show();
    },
    success: function(response)
    {
        console.log(response.averageRatings);
        $('.loading-message').html("");
		$('#loadingProgressContainer').hide();
        var html="";
        var nohtml = "";
        var url  = window.location.origin;
        if(response.resultCount > 0)
        {
            console.log(response.data);
            if(response.searchType=='product' && response.data.length > 0)
            {
                $('.product-item').html(nohtml);
                html+='<a href="javascript:void(0)" class="close-search-modal-trigger"><i class="material-icons dp48">close</i></a>';
                for(var i=0; i<response.data.length; i++)
                {
                    html+='<div class="product-item">';
                    html+= '<a href="'+url+'/product/'+response.data[i].sku+'/details" class="overlay_hover">&nbsp;</a>';
                    $.each(response.data[i].images,function(key,item){
                        if(key==0){
                            var url  = window.location.origin;
                            // var image=url+'/storage/'+item.image;
                            var image="{{asset('storage/')}}"+'/'+item.image;
                            html+='<div class="product-img"><img src="'+image+'"></div>';
                        }
                    })
                    html+= '<div class="product-short-intro">';
                    html+= '<h4>'+response.data[i].name+'</h4>';
                    html+= '<div class="details"><p><i class="material-icons pink-text"> star </i>' +response.averageRatings[i]+'</p></div>';
                    html+='<h5>$ ';

                    var last1=JSON.parse(response.data[i].attribute).length;
                    $.each(JSON.parse(response.data[i].attribute),function(key,item){

                                        if(key == (last1 -1)){
                                            html+= item[2];
                                        }
                                    })

                    html+='</h5>';
                    html+= '</div>';
                    html+= '</div>';
                }
                $('#search-results').html(html);
                $('#search-results').show();
            }
            else if(response.searchType=='vendor' && response.data.length > 0)
            {
                console.log(response.data);
                $('.vendor-info').html(nohtml);
                for(var i=0;i<response.data.length;i++){
                    html+='<div class="vendor-info">';
                    html+= '<a href="'+url+'/store/'+response.data[i].vendor_uid+'" class="overlay_hover">&nbsp;</a>';
                    html+= '<h4>'+response.data[i].vendor_name+'</h4>';
                    html+= '<div class="details"><p>'+response.data[i].vendor_address+'</p></div>';
                    html+= '</div>';
                    }
                $('#search-results').html(html);
                $('#search-results').show();
            }
        }
        else
        {
            if(response.searchType=='product')
            {
                $('#search-results').html("No Product found").show();
            }
            else if(response.searchType=='vendor')
            {
                $('#search-results').html("No Store found").show();
            }
            //$('#search-results').html(nohtml).hide();
        }
    }

});
});

//filter search
    // $( "#price_range" ).slider({
    // 		range: true,
    // 		min: 1,
    // 		max: 70000,
    // 		slide:function(event, ui){
    // 			$("#minimum_range").val(ui.values[0]);
    // 			$("#maximum_range").val(ui.values[1]);

    // 		}
    // 	});
    // $('.filter-search-form').on('submit',function(e){
        $('.filter-search-price-range').on('change',function(){
             $('.btn-filter-search-price-range').show();
            //  if(!$(this).val() != "" )
            //  {
            //     $('.btn-filter-search-price-range').hide();
            //  }else{
            //     $('.btn-filter-search-price-range').show();
            //  }

        });
        $('.filter-search-check-price-range').on('click',function(e){
            e.preventDefault();
            var product_type=$('input[name=filter_search_product_type').val();
            var minimum_value=$('input[name=minimum_range]').val();
            var maximum_value=$('input[name=maximum_range]').val();
            var search_category_id=$('input[name=filter_search_category_id]').val();
            var product_type_category_id=$('input[name=filter_search_product_type_cat_id]').val();

            var color = [];
            $.each($("input[name='color']:checked"), function(){
                // $(this).prop('checked', true);
                color.push($(this).val());
            });
            var size = [];
            $.each($("input[name='size']:checked"), function(){
                size.push($(this).val());
            });
            var rating = [];
            $.each($("input[name='rating']:checked"), function(){
                rating.push($(this).val());
            });
            var url = '{{ route("filter.search") }}';
            $.ajax({
                method: 'get',
                data: {color: color,size: size,rating: rating, product_type:product_type, minimum_value: minimum_value, maximum_value: maximum_value, search_category_id:search_category_id, product_type_category_id:product_type_category_id},
                url: url,
                beforeSend: function() {
                    $("body").addClass("loading");
                },
                complete: function(){
                    $("body").removeClass("loading");
                },
                success:function(data)
                    {
                     $('.prodcuts-list').html('');
                     $('.prodcuts-list').html(data.data);
                    },
                error: function(xhr, status, error)
                    {
                        $('#errors').empty();
                        $("#errors").append("<li class='alert alert-danger'>"+error+"</li>")
                        $.each(xhr.responseJSON.error, function (key, item)
                        {
                            $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                        });
                    }

            });
        });
        $('.filter-search-check').on('change',function(e){
            e.preventDefault();
            var product_type=$('input[name=filter_search_product_type').val();
            var minimum_value=$('input[name=minimum_range]').val();
            var maximum_value=$('input[name=maximum_range]').val();
            var search_category_id=$('input[name=filter_search_category_id]').val();
            var product_type_category_id=$('input[name=filter_search_product_type_cat_id]').val();

            var color = [];
            $.each($("input[name='color']:checked"), function(){
                // $(this).prop('checked', true);
                color.push($(this).val());
            });
            var size = [];
            $.each($("input[name='size']:checked"), function(){
                size.push($(this).val());
            });
            var rating = [];
            $.each($("input[name='rating']:checked"), function(){
                rating.push($(this).val());
            });
            var url = '{{ route("filter.search") }}';
            $.ajax({
                method: 'get',
                data: {color: color,size: size,rating: rating, product_type:product_type, minimum_value: minimum_value, maximum_value: maximum_value, search_category_id:search_category_id, product_type_category_id:product_type_category_id},
                url: url,
                beforeSend: function() {
                    $("body").addClass("loading");
                },
                complete: function(){
                    $("body").removeClass("loading");
                },
                success:function(data)
                    {
                     $('.prodcuts-list').html('');
                     $('.prodcuts-list').html(data.data);
                    },
                error: function(xhr, status, error)
                    {
                        $('#errors').empty();
                        $("#errors").append("<li class='alert alert-danger'>"+error+"</li>")
                        $.each(xhr.responseJSON.error, function (key, item)
                        {
                            $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                        });
                    }

            });
    });

    $(document).on("click",".close-search-modal-trigger",function(){
        $(this).closest("#search-results").hide();
    });

    //switch to manufacturers
    $(document).on('click', '.submit-to-manufacturers', function (e) {
        e.preventDefault();
        $('.loading-message').html("Please Wait.");
        $('#loadingProgressContainer').show();
        $('#submit-to-manufacturers-form').submit();
    });



  </script>

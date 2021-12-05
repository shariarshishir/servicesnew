<!-- Footer section start -->
<footer class="footer_wrap">
	<div class="footer_topWrap">
		<div class="container">
			<div class="row">
				<div class="col s12 m6 l5 left">
					<div class="center-align thumb_box"><img src="{{asset('images/frontendimages/new_layout_images/thumb.png')}}" alt=""></div>
					<p>Your apparel will be ready <br /> on time or we work for free!</p>
				</div>
				<div class="col s12 m6 l5 right">
					<p>Merchandising have never seemed so easy before.</p>
					<div class="btn_talk ">
						<a class="btn_white" href="javascript:void(0);">Talk to us</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer_bottomWrap">
		<div class="container">
			<div class="row">
				<div class="col m6 l6 footer_left_bottom">
					<div class="addressWrap">
						<div class="copyright_text">
							<h3>Merchant Bay</h3>
							<p>&copy 2019-2020 <br /> <span>All rights reserved.</span></p>
						</div>
						<div class="addressBox">
							<h4>Office Address:</h4>
							<p>Meem Tower, <br/ >
								Floor: 8, House: 18, <br />
								Road: 12, Sector: 6, <br />
								Uttara, Dhaka.
							</p>
						</div>
						<a href="javascript:void(0);" class="btn_direct btn_grBorder">Get Direction</a>
						<a href="javascript:void(0);" class="btn_tour btn_lightgr">Virtual Tour</a>
					</div>
				</div>
				<div class="col m6 l6 footer_right_bottom">
					<div class="footer_buttonWrap right-align">
						<input type="text" class="industry_textbox" placeholder="Get the latest Industry Insights" />
						<button type="submit" class="btn_lightgr btn_email"> <img src="{{asset('images/frontendimages/new_layout_images/email.png')}}" alt="" />Email</button>
					</div>
					<div class="row">
						<div class="col s12 m6 l4 help_menu">
							<ul>
								<li><a href="javascript:void(0);">Tools</a></li>
								<li><a href="javascript:void(0);">Suppliers</a></li>
								<li><a href="javascript:void(0);">Quick Query</a></li>
								<li><a href="blog.html">Blogs/Insights</a></li>
								<li><a href="javascript:void(0);">Policies</a></li>
								<li><a href="helps.html">Helps</a></li>
							</ul>
						</div>
						<div class="col s12 m6 l4 product_menu">
							<h4>Products</h4>
							<ul>
								<li><a href="javascript:void(0);">New Designs</a></li>
								<li><a href="javascript:void(0);">New Arrivals</a></li>
								<li><a href="javascript:void(0);">Ready Stock</a></li>
								<li><a href="javascript:void(0);">Low MOQ</a></li>
								<li><a href="javascript:void(0);">Customizable</a></li>
								<li><a href="javascript:void(0);">Shortest Lead Time</a></li>
							</ul>
						</div>
						<div class="col s12 m6 l4 info_menu">
							<ul>
								<li><a href="javascript:void(0);">About us</a></li>
								<li><a href="javascript:void(0);">Contact us</a></li>
								<li><a href="javascript:void(0);">Tutorials</a></li>
								<li><a href="javascript:void(0);">Submit a dispute</a></li>
							</ul>
							<div class="socialWrap">
								<h4>Follow us on</h4>
								<a href="javascript:void(0);"> <img src="{{asset('images/frontendimages/new_layout_images/facebook.png')}}" alt="" /></a>
								<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/twitter.png')}}" alt="" /></a>
								<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/linkedin.png')}}" alt="" /></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- Footer section end -->

<div id="login-register-modal" class="modal modal-fixed-footer" tabindex="0">
    <div class="modal-content">
        <div class="row">
            <div class="col s12 m4 l5 registration-block">
                <div class="company-logo">
                    <img src="{{asset('images/frontendimages/merchantbay_logoX200.png')}}" alt="Merchant Bay Logo" />
                </div>
                <div class="registration-content">
                    <p>Not Yet Registered ?</p>
                    {{-- Want to be a <a href="{{route('user.register', 'buyer')}}">Buyer</a> or <a href="{{route('user.register', 'wholesaler')}}">Wholesaler</a> --}}
                    <a href="{{env('SSO_REGISTRATION_URL').'/?flag=service'}}" > Click here to Register</a>
                </div>
            </div>
            <div class="col s12 m8 l7 login-block">
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
                    {{-- @if (Route::has('password.request'))
                        <a class="btn green right btn-forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot Password?') }}
                        </a>
                    @endif --}}
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
{{-- pagination js --}}
{{--<script  src="{{asset('js/pagination.js')}}" ></script> --}}
{{-- twbs pagination --}}
<script src="{{asset('js/twbsPagination.js')}}"></script>
{{-- jquery ui --}}
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}


<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
{{-- croper js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
{{-- jasny-bootstrap --}}
<script src="{{asset('js/jasny-bootstrap.js')}}"></script>

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

    // slick slider
    $('.product_slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 1000,

        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
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
    html += '<td><a href="javascript:void(0);" class="btn_delete" onclick="removeProductColorSize(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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
    html += '<td><a href="javascript:void(0);" class="btn_delete" onclick="removeFreshOrderAttribute(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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
    html += '<td><a href="javascript:void(0);" class="btn_delete" onclick="removeFreshOrderAttribute(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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
    html += '<td><a href="javascript:void(0);" class="btn_delete" onclick="removeNonClothingAttr(this)"><i class="material-icons dp48">delete_outline</i><span>Delete</span></a></td>';
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
    html += '<td><a href="javascript:void(0);" class="btn_delete" onclick="removeNonClothingPriceBreakDown(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
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
var url = '{{ route("live.search") }}';
$.ajax({
    type:'GET',
    url: url,
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


    function addToCart($sku)
{
    var sku=$sku;
    var unit_price=  $('input[name=unit_price]').val();
    var quantity =  $('input[name=quantity]').val();
    var total_price=  $('input[name=total_price]').val();
    var full_stock= $('input[name=full_stock]').val();
    var product_type =$('input[name=product_type]').val();
    var color_attr= [];
    //var check_value=$('input[name="color"]').val();
    if(product_type== 1 || product_type == 2)
    {
        $('.tr').each(function(idx,ele){
            color_attr.push({'color' :$('input[name="color"]').eq(idx).val(),
                            'xxs' : Number($('input[name="xxs"]').eq(idx).val()) || 0,
                            'xs' : Number($('input[name="xs"]').eq(idx).val()) || 0,
                            'small' :Number($('input[name="small"]').eq(idx).val())  || 0,
                            'medium' : Number($('input[name="medium"]').eq(idx).val()) || 0,
                            'large' : Number($('input[name="large"]').eq(idx).val()) ||0,
                            'extra_large' : Number($('input[name="extra_large"]').eq(idx).val()) || 0,
                            'xxl' : Number($('input[name="xxl"]').eq(idx).val()) || 0,
                            'xxxl' : Number($('input[name="xxxl"]').eq(idx).val()) || 0,
                            'four_xxl' : Number($('input[name="four_xxl"]').eq(idx).val()) || 0,
                            'one_size' : Number($('input[name="one_size"]').eq(idx).val()) || 0,
                            });
            });
    }
    if(product_type == 3)
    {
        $('.tr').each(function(idx,ele){
            color_attr.push({'color' :$('input[name="color"]').eq(idx).val(),
                            'quantity' : Number($('input[name="non_clothing_quantity"]').eq(idx).val()) || 0,
                            });
            });
    }


    var url = '{{ route("add.cart") }}';
    swal({
        title: "Want to add this product into cart?",
        text: "Please ensure and then confirm!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, add it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: !0
    }).then(function (e) {
        if (e.value === true) {

                // if(check_value){
                //     $('.tr').each(function(idx,ele){
                //     color_attr.push({'color' : $('input[name="color"]').eq(idx).val(),
                //                     'small' : $('input[name="small"]').eq(idx).val(),
                //                     'medium' : $('input[name="medium"]').eq(idx).val(),
                //                     'large' : $('input[name="large"]').eq(idx).val(),
                //                     'extra_large' : $('input[name="extra_large"]').eq(idx).val(),
                //                     });
                //     });
                // }

                $.ajax({
                    type:'GET',
                    url: url,
                    dataType:'json',
                    data:{ sku :sku ,unit_price:unit_price,total_price:total_price,quantity:quantity,color_attr:color_attr,full_stock: full_stock},
                    success: function(data){
                        //console.log(data.cartItems);
                        swal(data.message, data.success,data.type);
                        $('#cartItems').html('');
                        $("#cartItems").html(data.cartItems);
                        $('#product-details-modal').hide();
                    }
                });
            }
            // else {
            //     e.dismiss;
            // }
    }, function (dismiss) {
        return false;
    })
}

//askforprice
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function askForPrice($sku)
{
    var sku=$sku;
    var business_profile_id=  $('input[name=business_profile_id]').val();
    var product_id=  $('input[name=product_id]').val();
    var product_type =$('input[name=product_type]').val();
    var type = 1;
    var color_attr= [];

    if(product_type == 1 || product_type == 2)
    {
        $('.tr').each(function(idx,ele){
            color_attr.push({'color' :$('input[name="color"]').eq(idx).val(),
                            'xxs' : Number($('input[name="xxs"]').eq(idx).val()) || 0,
                            'xs' : Number($('input[name="xs"]').eq(idx).val()) || 0,
                            'small' :Number($('input[name="small"]').eq(idx).val())  || 0,
                            'medium' : Number($('input[name="medium"]').eq(idx).val()) || 0,
                            'large' : Number($('input[name="large"]').eq(idx).val()) ||0,
                            'extra_large' : Number($('input[name="extra_large"]').eq(idx).val()) || 0,
                            'xxl' : Number($('input[name="xxl"]').eq(idx).val()) || 0,
                            'xxxl' : Number($('input[name="xxxl"]').eq(idx).val()) || 0,
                            'four_xxl' : Number($('input[name="four_xxl"]').eq(idx).val()) || 0,
                            'one_size' : Number($('input[name="one_size"]').eq(idx).val()) || 0,
                            });
        });
    }
    if(product_type == 3)
    {
        $('.tr').each(function(idx,ele){
            color_attr.push({'color' :$('input[name="color"]').eq(idx).val(),
                            'quantity' : Number($('input[name="non_clothing_quantity"]').eq(idx).val()) || 0,
                            });
        });
    }

    var url = '{{ route("user.order.query.store") }}';
    swal({
        title: "Want to query about this product?",
        text: "Please ensure and then confirm!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, add it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: !0
    }).then(function (e) {
        if (e.value === true) {

                $.ajax({
                    type:'POST',
                    url: url,
                    dataType:'json',
                    data:{ sku :sku ,business_profile_id:business_profile_id,product_id:product_id,color_attr:color_attr,type:type},
                    success: function(data){
                        console.log(data.cartItems);
                        swal("Done!", data.msg,"success");
                        $('#product-details-modal').hide();
                    }
                });
        }

    }, function (dismiss) {
        return false;
    })
}
// $(window).on('load', function() {
//     var selectedSearchOption = $("#searchOption").children("option:selected").val();
//     $("#system_search .search_type").val(selectedSearchOption);
// })

//on change input field set
$("#searchOption").change(function(){
    var nohtml = "";
    $('#search-results').html(nohtml).hide();
    var selectedSearchOption = $("#searchOption").children("option:selected").val();
    $("#system_search .search_type").val(selectedSearchOption);

    if($(this).val() == "product"){
        $(".search_input").attr("placeholder", "Type products name");
    }
    else if($(this).val() == "vendor"){
        $(".search_input").attr("placeholder", "Type vendors name");
    }

    var searchInput = $("#system_search .search_input").val();
    console.log(searchInput);
    var url = '{{ route("live.search") }}';
    $.ajax({
        type:'GET',
        url: url,
        dataType:'json',
        data:{ searchInput:searchInput,selectedSearchOption:selectedSearchOption},
        success: function(response)
        {
            var html="";
            var nohtml = "";
            if(response.resultCount > 0)
            {
                if(response.searchType=='product' && response.data.length > 0)
                {
                    $('.product-item').html(nohtml);
                    for(var i=0; i<response.data.length; i++)
                    {
                        html+='<div class="product-item">';
                        $.each(response.data[i].images,function(key,item){
                            if(key==0){
                                var url  = window.location.origin;
                                var image=url+'/storage/'+item.image;
                                html+='<div class="product-img"><img src="'+image+'"></div>';
                            }
                        })
                        html+= '<div class="product-short-intro">';
                        html+= '<h4>'+response.data[i].name+'</h4>';
                        html+= '<div class="details"><p><i class="material-icons pink-text"> star </i>' +response.averageRatings[i]+'</p></div>';
                        html+='<h5>Tk (';

                        var last1=JSON.parse(response.data[i].attribute).length;
                        $.each(JSON.parse(response.data[i].attribute),function(key,item){

                                            if(key == (last1 -1)){
                                                html+= item[2];
                                            }
                                        })

                        html+='<span>/ lot '+response.data[i].moq+' pieces / lot)</span></h5>';

                        var url  = window.location.origin;
                        html+= '<a href="'+url+'/product/'+response.data[i].sku+'/details">See details</a>';
                        html+= '</div><br>';
                        html+= '</div>';
                    }
                    $('#search-results').append(html);
                    $('#search-results').show();
                }
                else if(response.searchType=='vendor' && response.data.length > 0)
                {
                    $('.vendor-info').html(nohtml);
                    for(var i=0;i<response.data.length;i++){
                        html+='<div class="vendor-info">';
                        console.log('hi');
                        html+= '<h4>'+response.data[i].vendor_name+'</h4>';
                        html+= '<div class="details"><p>'+response.data[i].vendor_address+'</p></div>';
                        html+= '<a href="#">'+response.data[i].vendor_name+'</a>';
                        html+= '</div>';
                        }
                    $('#search-results').append(html);
                    $('#search-results').show();
                }
            }
            else
            {
                $('#search-results').html(nohtml).hide();
            }
        }

    });
});


  </script>

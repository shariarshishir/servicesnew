<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Merchant Bay | Fashion Sourcing Solution | Tech Enabled B2B Platform</title>
{{-- csrf token --}}
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Material CSS -->

<meta name="title" property="og:title" content="@yield('title')" />
<meta name="description" property="og:description" content="@yield('description')" />
<meta name="image" property="og:image" content="@yield('image')" />
<meta name="keywords" content="@yield('keywords')">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" integrity="sha512-UJfAaOlIRtdR+0P6C3KUoTDAxVTuy3lnSXLyLKlHYJlcSU8Juge/mjeaxDNMlw9LgeIotgz5FP8eUQPhX1q10A==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.css" integrity="sha512-KRrxEp/6rgIme11XXeYvYRYY/x6XPGwk0RsIC6PyMRc072vj2tcjBzFmn939xzjeDhj0aDO7TDMd7Rbz3OEuBQ==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/17f501da3d.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
{{-- Sweet alert for add to cart --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<link href="{{asset('css/media.css')}}" rel="stylesheet">
<link href="{{asset('css/app-chat.min.css')}}" rel="stylesheet">
<link href="{{asset('css/icon.css')}}" rel="stylesheet">
<link href="{{asset('css/image-uploader.min.css')}}" rel="stylesheet">
{{-- jasny-bootstrap.min --}}
<link href="{{asset('css/jasny-bootstrap.min.css')}}" rel="stylesheet">
{{-- <link rel="stylesheet" href="http://demo.discoverprograming.com/plugin/bootstrap-3.min.css">
<script src="http://demo.discoverprograming.com/plugin/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.4.0/socket.io.js" integrity="sha512-nYuHvSAhY5lFZ4ixSViOwsEKFvlxHMU2NHts1ILuJgOS6ptUmAGt/0i5czIgMOahKZ6JN84YFDA+mCdky7dD8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js" integrity="sha512-v8ng/uGxkge3d1IJuEo6dJP8JViyvms0cly9pnbfRxT6/31c3dRWxIiwGnMSWwZjHKOuY3EVmijs7k1jz/9bLA==" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdn.socket.io/4.4.0/socket.io.min.js" integrity="sha384-1fOn6VtTq3PWwfsOrk45LnYcGosJwzMHv+Xh/Jx5303FVOXzEnw0EpLv30mtjmlj" crossorigin="anonymous"></script> --}}
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
{{-- cropper css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
<!-- Calendly link widget begin -->
<link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
<script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript"></script>
<!-- Calendly link widget end -->
<link rel="shortcut icon" href="{{ asset('images/frontendimages/favicon/favicon.png') }}" type="image/x-icon">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-141181864-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-141181864-1');
</script>

@yield('css')
{{-- jquery ui --}}
{{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> --}}
<script type="text/javascript">
    function allowTwoDecimal(input) {
        var num = $(input).val();
        value = parseFloat(num).toFixed(2);
        $(input).val(value);
        //console.log(value);
    }

    function openSideNavFromLeft() {
        document.getElementById("SideNavFromLeft").style.width = "250px";
        //document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        document.body.style.backgroundColor = "rgba(255,255,255,1)";
    }
    function closeSideNavFromLeft() {
        document.getElementById("SideNavFromLeft").style.width = "0";
        document.body.style.backgroundColor = "rgba(255,255,255,1)";
    }

    function openSideNavFromRight() {
        document.getElementById("SideNavFromRight").style.width = "250px";
        //document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        document.body.style.backgroundColor = "rgba(255,255,255,1)";
    }
    function closeSideNavFromRight() {
        document.getElementById("SideNavFromRight").style.width = "0";
        document.body.style.backgroundColor = "rgba(255,255,255,1)";
    }

    function openSideNavFromLeftFilterResult() {
        document.getElementById("SideNavFromLeftFilterResult").style.width = "250px";
        document.getElementById("SideNavFromLeftFilterResult").style.padding = "60px 30px 60px 30px";
        //document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        document.body.style.backgroundColor = "rgba(255,255,255,1)";
    }
    function closeSideNavFromLeftFilterResult() {
        document.getElementById("SideNavFromLeftFilterResult").style.width = "0";
        document.getElementById("SideNavFromLeftFilterResult").style.padding = "0px";
        document.body.style.backgroundColor = "rgba(255,255,255,1)";
    }

    //validate email
    function validateEmail(email) {
        //var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        //return re.test(email);
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    };
    function validatePhone(value) {
        //var regex=/^(NA|[0-9+-]+)$/;
        var regex = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        return regex.test(value);
    }
</script>

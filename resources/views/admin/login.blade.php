<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Merchantbay Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin-assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('admin-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin-assets/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style type="text/css">
  .login-page, .register-page {
    background: #6ccd79;
  }
  .login-logo a, .register-logo a {
    color: #fff;
  }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="javascript.void()"><b>Merchant Bay</b>Shop</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      @include('include.admin._message')

      <form action="{{route('admin.login')}}" id="admin-login-form" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="hidden"  name="fcm_token" id="fcm_token" value="" />
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button" class="btn btn-success btn-block admin-signin">Sign In</button>
            <button type="submit" class="btn btn-success btn-block admin-signin-trigger" style="display: none;">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>

<script>
$(document).ready(function(){
    $('.admin-signin').click(function (e) 
    {
        //e.preventDefault();
        //alert('hi');
        var messaging;
        var firebaseConfig = {
            apiKey: "AIzaSyD7rRW59FfaNdzjOAdF93gEhnOzCynFKrc",
            authDomain: "shopmerchantbay-5fe20.firebaseapp.com",
            projectId: "shopmerchantbay-5fe20",
            storageBucket: "shopmerchantbay-5fe20.appspot.com",
            messagingSenderId: "455810425517",
            appId: "1:455810425517:web:7617959ac0122da5badc24",
            measurementId: "G-E1FD0F7EDG"
        };

        if (!firebase.apps.length) {
            firebase.initializeApp(firebaseConfig);
        }else {
            firebase.app(); // if already initialized, use that one
        }
        
        messaging = firebase.messaging();
     
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (fcm_token) {
                
                $("#fcm_token").val(fcm_token);
                $(".admin-signin-trigger").click();

            }).catch(function (error) {
                alert(error);
            });
    })

    messaging.onMessage(function (payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });

});
</script>

</body>
</html>

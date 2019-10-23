<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Forget Password | aplikasiKasir</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/icon.jpg">
</head>

<body>
<!-- WRAPPER -->
<div id="wrapper">
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle">
            <div class="auth-box ">
                <div class="left">
                    <div class="content">
                        <div class="header">
                            <div class="logo text-center"><img src="assets/img/logo-word.jpg" alt="TimeLate Logo" style="width:56%"></div>
                            <p class="lead">Reset Password</p>
                        </div>
                        <form class="form-auth-small" action="#">
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="recovery-email" class="control-label sr-only">Email</label>
                                <input type="email" class="form-control" id="email" Placeholder="Email" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="rec-password" class="control-label sr-only">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="rec-password" class="control-label sr-only">Confirm Password</label>
                                <input type="password" class="form-control" id="password-confirm" placeholder="Confirm Password" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">RESET PASSWORD</button>
                            <div class="bottom">
                                <span class="helper-text"><i class="fa fa-lock"></i> &nbsp<a href="{{route('login')}}">Back To Login Form</a></span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="right">
                    <div class="content text">
                        <h1 class="heading" style="color: black;">The application trains your responsibilities</h1>
                        <p>by The Developer</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!-- END WRAPPER -->
</body>

</html>

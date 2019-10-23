<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Login | Aplikasikasir</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link href="{{asset('assets/metronic/assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/metronic/assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/extends/main.css')}}" rel="stylesheet" type="text/css"/>
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
                            <p class="lead" style="font-size: medium;">Login to your account
                            </div>
                        <form class="form-auth-small" action="#" id="form-login">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email">
							</div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password">
							</div>
                            <div class="form-group clearfix">
                                <label class="fancy-checkbox element-left">
                                    <input type="checkbox">
                                    <span {{ old( 'remember') ? 'checked' : '' }}>Remember me</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                        </form>
                    </div>
                </div>
                <div class="right">
                    <div class="content text">
                        <h1 class="heading" style="color: black;">Application that makes your problem easier</h1>
                        <p>by The Developer</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!-- END WRAPPER -->
	<script src="{{asset('assets/metronic/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/metronic/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/metronic/assets/snippets/pages/user/login.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
		var email, password, btn_loader;
			toastr.options = {
				"closeButton": false,
				"debug": false,
				"newestOnTop": true,
				"progressBar": false,
				"positionClass": "toast-bottom-right",
				"preventDuplicates": true,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			};

			$("#form-login").submit(function(event){
				$.ajax({
			  		headers: {
				    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url:"{{url('login/auth')}}",
					data:$("#form-login").serializeArray(),
					type:"POST",
					success:function(res){
						if(res.code == 200){
							toastr.success(res.msg, 'Sukses');
							document.location.href='{{ url("dashboard") }}';
						} else {
							toastr.error(res.msg, 'Gagal');
						}
					},
					error:function(response){
						swal("Peringatan", response.responseJSON.message,"error");
					}
				});
				event.preventDefault();
			});

		</script>
    </body>
</html>

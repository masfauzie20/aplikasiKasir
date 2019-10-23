<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Register | TimeLate</title>
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
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favico.png">
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
                            <div class="logo text-center"><img src="assets/img/logo-time-late.png" alt="TimeLate Logo"></div>
                            <p class="lead" style="font-size: medium;">Register your account
                                <br> Already Have an Account?&nbsp
                                <a href="{{route('login')}}">Sign in</a></p>
                        </div>
                        <form class="form-auth-small" action="" id="form-register">
                            <div class="form-group">
                                <input type="username" class="form-control" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group clearfix">
                                <label class="fancy-checkbox element-left">
                                    <input type="checkbox">
                                    <span {{ old( 'remember') ? 'checked' : '' }}>I Agree Terms and Conditions</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">REGISTER</button>
                        </form>
                    </div>
                </div>
                <div class="right">
                    <div class="content text">
                        <h1 class="heading" style="color: black;">The application trains your responsibilities</h1>
                        <p>by The Develovers</p>
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
		var username ,email, password, btn_loader;
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
			$("#form-register").submit(function(event){
				$.ajax({
			  		headers: {
				    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url:"{{url('register/auth')}}",
					data:$("#form-register").serializeArray(),
					type:"POST",
					success:function(res){
						if(res.code == 200){
							toastr.success(res.msg, 'Sukses');
							document.location.href='{{ url("/") }}';
						} else {
							toastr.error(res.msg, 'Gagal');
						}
					},
					error:function(response){	
						swal("Peringatan", response.responseJSON.message,"error");
						// btn_loader.stop();
						// var title = 'Terjadi Kesalahan!', message = 'Koneksi Error!!!', type = 'error';

						// if(!$.isEmptyObject(response.responseJSON.message)){
						// 	title = 'Pemberitahuan!';
						// 	message = response.responseJSON.message;
						// 	type = 'warning';
						// }
					}
				});
				event.preventDefault();
			});
		</script>
    </body>
</html>

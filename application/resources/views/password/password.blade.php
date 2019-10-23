@extends('layouts.app') 
@section('content')
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box lockscreen clearfix">
					<div class="content">
						<h1 class="sr-only">Time-Late</h1>
						<div class="logo text-center"><img src="assets/img/logo-time-late.png" alt="Timelate Logo"></div>
						<div class="user text-center">
							<img src="assets/img/user-medium.png" class="img-circle" alt="Avatar">
							<h2 class="name">Admin</h2>
						</div>
						<center>
						<form action="" id="ubah_password">
							<div class="input-group">
								<input type="password" class="form-control" placeholder="Masukkan Password Lama Anda" id="password_lama" name="password_lama"><hr>
								<input type="hidden" class="form-control" id="id_user">
								<input type="password" class="form-control" placeholder="Masukkan Password Baru Anda" id="password_baru" name="password_baru">
								<input type="password" class="form-control" placeholder="Masukkan Kembali Password Baru Anda"id="retype_password" name="retype_password">
							</div><br>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>

<script type="text/javascript">
	$("#ubah_password").on('submit', () => {
		$.ajax({
			headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: baseUrl+"/password/simpan_password",
			method:"post",
			data:$("#ubah_password").serialize(),
			success:(data)=>{
				swal(data).then(() => {
					location.reload();
				});
			},
			error:()=>{

			}
		});
	});
</script>
@endsection
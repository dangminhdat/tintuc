<?php if(!defined("DAT_DANG")) die("Page Not Found"); ?>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-push-3" style="border: 1px solid #ccc; padding-top: 20px">
			<p class="lead">Vui lòng đăng nhập để tiếp tuc </p>
			<form method="POST" onsubmit="return false;" id="formDangNhap">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" placeholder="Tên đăng nhập" class="form-control" id="username">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<input type="password" placeholder="Mật khẩu" class="form-control" id="password">
					</div>
				</div>
				<div class="form-group" id="signin_submit">
					<button type="submit" class="btn btn-primary">Đăng nhập</button>
				</div>
				<div class="alert alert-danger hidden"></div>	
			</form>	
		</div>
	</div>
</div>
<p class="text-center">Copyright &#169 2017</p>
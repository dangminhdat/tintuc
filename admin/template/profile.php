<?php if(!defined("DAT_DANG")) die("Page Not Found"); ?>
<?php
	// Xử lý database
	require_once 'core/init.php';

	if($user)
	{
		if(isset($_GET['ac']))
		{
			$ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
		}
		else
		{
			$ac = '';
		}

		if($ac != '')
		{
			if($ac == 'avatar')
			{
				echo "<h3>Upload ảnh đại diện</h3>";	
				echo 
				'
					<a href="'.$_DOMAIN.'profile" class="btn btn-default">
						<span class="fa fa-arrow-left"></span> Trở về
					</a>
				';
				if($data_user['url_avatar'] == '')
				{
					$data_user['url_avatar'] = $_DOMAIN.'img/user.gif';
				}
				else
				{
					$data_user['url_avatar'] = str_replace('admin/','',$_DOMAIN).$data_user['url_avatar'];
				}
				//Upload avatar
				echo 
				'	
					<p class="form-upload-avatar">
						<div class="panel panel-default">
							<div class="panel-heading">Upload ảnh đại diện</div>	
							<div class="panel-body">
								<form action="'.$_DOMAIN.'profile.php" method="POST" id="formUploadAvatar" enctype="multipart/form-data" onsubmit="return false">
									<div class="form-group">
										<p><strong>Ảnh đại diện</strong></p>
										<img src="'.$data_user['url_avatar'].'" alt="Ảnh đại diện của '.$data_user['ten_hien_thi'].'" width="80" height="80">	
									</div>
									<div class="alert alert-info">Vui lòng chọn file ảnh có đuôi .jpg, .png, .gif và có dung lượng dưới 5MB.</div>
									<div class="form-group">
										<label>Chọn hình ảnh</label>
										<input type="file" name="avatar_img" class="form-control" id="avatar_img"  onchange="pre_avatar()">
									</div>
									<div class="form-group box_pre_img hidden">
										<p><label>Ảnh xem trước</label></p>
									</div>
									<div class="form-group box_progress hidden">
										<div class="progress">
											<div class="progress-bar"></div>
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary pull-left">Upload</button>
										<a id="del_avatar" class="btn btn-danger pull-right">
											<span class="fa fa-trash"></span> Xóa
										</a>				
									</div>
									<div class="clearfix"></div><br>
									<div class="alert alert-danger hidden"></div>		
								</form>
							</div>
						</div>
					</p>
				';
			}			
			else if($ac == 'password')
			{
				echo "<h3>Đổi mật khẩu</h3>";
				echo 
				'
					<a href="'.$_DOMAIN.'profile" class="btn btn-default">
						<span class="fa fa-arrow-left"></span> Trở về
					</a>	
				';
				echo 
				'
					<p class="form-password">
						<div class="panel panel-default">
							<div class="panel-heading">Đổi mật khẩu</div>
							<div class="panel-body">
								<form action="'.$_DOMAIN.'profile.php" method="POST" id="formPass" onsubmit="return false;">
									<div class="form-group">
										<label>Mật khẩu cũ</label>
										<input type="password" class="form-control" id="pass_old">
									</div>
									<div class="form-group">
										<label>Mật khẩu mới</label>
										<input type="password" class="form-control" id="pass_new">
									</div>
									<div class="form-group">
										<label>Nhập lại mật khẩu mới</label>
										<input type="password" class="form-control" id="re_pass_new">
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Lưu thay đổi
									</div>
									<div class="alert alert-danger hidden"></div>
								</form>
							</div>
						</div>
					</p>
				'
				;
			}
		}
		else
		{
			echo "<h3>Thông tin tài khoản</h3>";	
			echo 
			'
				<a href="'.$_DOMAIN.'profile/avatar" class="btn btn-info">
					<span class="fa fa-upload"></span> Avatar
				</a>
				<a href="'.$_DOMAIN.'profile/password" class="btn btn-danger">
					<span class="fa fa-key"></span> Đổi mật khẩu
				</a>	
			';
			echo 
				'	
					<p class="form-user">
						<div class="panel panel-default">
							<div class="panel-heading">Cập nhật thông tin</div>
							<div class="panel-body">
								<form action="'.$_DOMAIN.'profile.php" method="POST" id="formUser" onsubmit="return false;">
									<div class="form-group">
										<label>Tên hiển thị (*)</label>
										<input type="text" id="name_display" class="form-control" value="'.$data_user['ten_hien_thi'].'">
									</div>
									<div class="form-group">
										<label>Email (*)</label>
										<input type="text" id="email_display" class="form-control" value="'.$data_user['email'].'">
									</div>
									<div class="form-group">
										<label>URL Facebook</label>
										<input type="text" id="facebook" class="form-control" value="'.$data_user['facebook'].'">
									</div>
									<div class="form-group">
										<label>URL Google</label>
										<input type="text" id="google" class="form-control" value="'.$data_user['google'].'">
									</div>
									<div class="form-group">
										<label>URL Twitter</label>
										<input type="text" id="twitter" class="form-control" value="'.$data_user['twitter'].'">
									</div>
									<div class="form-group">
										<label>Số điện thoại</label>
										<input type="text" id="phone" class="form-control" value="'.$data_user['phone'].'">
									</div>
									<div class="form-group">
										<label>Giới thiệu</label>
										<textarea id="introduce" class="form-control">'.$data_user['mieu_ta'].'</textarea>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
									</div>
									<div class="alert alert-danger hidden"></div>
								</form>
							</div>
						</div>
					</p>
				';
		}
	}
	else
	{
		new Redirect($_DOMAIN);
	}
?>
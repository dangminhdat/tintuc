<?php if(!defined("DAT_DANG")) die("Page Not Found"); ?>
<?php
	//Xử lý database
	require_once 'core/init.php';

	if($user)
	{
		if($data_user['quyen'] == 0)
		{
			echo "<div class='alert alert-danger'>Bạn không có đủ quyền để vào trang này.</div>";
		}
		else
		{
			echo "<h3>Tài khoản</h3>";
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
				// Thêm tài khoản
				if($ac == 'add')
				{
					echo 
					'<a href="'.$_DOMAIN.'account" class="btn btn-default">
						<span class="fa fa-arrow-left"></span> Trở về
					</a>';
				}

				// ADD
				echo 
				'
					<p class="form-add-acc">
						<form method="POST" onsubmit="return false" id="formTaiKhoan">
							<div class="form-group">
								<label>Tên đăng nhập</label>
								<input type="text" id="user-add-acc" class="form-control">
							</div>
							<div class="form-group">
								<label>Mật khẩu</label>
								<input type="password" id="pass-add-acc" class="form-control">
							</div>
							<div class="form-group">
								<label>Nhập lại mật khẩu</label>
								<input type="password" id="re-pass-add-acc" class="form-control">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Thêm</button>
							</div>
							<div class="alert alert-danger hidden"></div>
						</form>
					</p>
				';	
			}
			else
			{
				// Hiển thị danh sách tài khoản
				echo 
				'
					<a href="'.$_DOMAIN.'account/add" class="btn btn-default">
						<span class="fa fa-plus"></span> Thêm
					</a>
					<a href="'.$_DOMAIN.'account" class="btn btn-default">
						<span class="fa fa-repeat"></span> Reload
					</a>
					<a id="lock_list_acc" class="btn btn-warning" style="color: #fff">
						<span class="fa fa-lock"></span> Khóa
					</a>
					<a id="unlock_list_acc" class="btn btn-success" style="color: #fff">
						<span class="fa fa-lock"></span> Mở khóa
					</a>
					<a id="del_list_acc" class="btn btn-danger" style="color: #fff">
						<span class="fa fa-trash"></span> Xóa
					</a>	
				';
				//Danh sách
				$sql_list_acc = "SELECT * FROM taikhoan ORDER BY id_tk DESC";
				if($db->num_rows($sql_list_acc))
				{
					echo 
					'
						<br><br>
						<div class="table-responsive">
							<table class="table table-striped list" id="list_acc">
								<tr>
									<td><input type="checkbox"></td>
									<td><strong>ID</strong></td>
									<td><strong>Tên đăng nhập</strong></td>
									<td><strong>Quyền</strong></td>
									<td><strong>Trạng thái</strong></td>
									<td><strong>Tools</strong></td>
								</tr>	
					';
					foreach ($db->fetch_assoc($sql_list_acc,0) as $key => $list_acc) {
						if($list_acc['quyen'] == 1)
						{
							$quyen = '<div class="label label-primary">ADMIN</div>';
						}
						else
						{
							$quyen = '<div class="label label-success">Tác giả</div>';
						}
						if($list_acc['trang_thai'] == 0)
						{
							$status = '<div class="label label-success">Hoạt động</div>';
						}
						else
						{
							$status = '<div class="label label-warning">Khóa</div>';							
						}
						echo 
						'
						<tr>
							<td><input type="checkbox" value="'.$list_acc['id_tk'].'"></td>
							<td>'.$list_acc['id_tk'].'</td>
							<td>'.$list_acc['username'].'</td>
							<td>'.$quyen.'</td>
							<td>'.$status.'</td>
							<td>
								<a class="btn btn-warning lock_acc" data-id="'.$list_acc['id_tk'].'">
									<span class="fa fa-lock"></span>
								</a>
								<a class="btn btn-success unlock_acc" data-id="'.$list_acc['id_tk'].'">
									<span class="fa fa-lock"></span>
								</a>
								<a class="btn btn-danger del_acc" data-id="'.$list_acc['id_tk'].'">
									<span class="fa fa-trash"></span>
								</a>	
							</td>
						</tr>';
					}
				}
				else
				{
					echo "<br><br><div class='alert alert-info'>Hiện tại chưa có tài khoản nào</div>";
				}
			}	
		}	
	}	
?>

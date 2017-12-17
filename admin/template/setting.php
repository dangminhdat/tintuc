<?php if(!defined("DAT_DANG")) die("Page Not Found"); ?>
<?php
	// Xử lý database
	require_once 'core/init.php';

	if($user)
	{
		if($data_user['quyen'] == 0)
		{
			echo "<div class='alert alert-danger'>Bạn không có đủ quyền để vào trang này.</div>";
		}
		else
		{
			echo "<h3>Cài đặt chung</h3>";

			echo 
			'
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Trạng thái hoạt động</h3>
					</div>
					<div class="panel-body">
						<form method="POST" id="formCaiDat"	onsubmit="return false">';
			$sql = "SELECT * FROM website";
			if($db->num_rows($sql))
			{
				$web = $db->fetch_assoc($sql,1);
				if($web['trang_thai'] == 1)
				{
					echo '
						<div class="radio">
							<label>
								<input type="radio" name="status" value="1" checked> Mở
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="status" value="0"> Đóng
							</label>
						</div>';
				}
				else if($web['trang_thai'] == 0)
				{
					echo '
						<div class="radio">
							<label>
								<input type="radio" name="status" value="1"> Mở
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="status" value="0" checked> Đóng
							</label>
						</div>';
				}
			}
			echo '		<button type="submit" class="btn btn-primary">Lưu</button><br><br>
						<div class="alert alert-danger hidden"></div>
					</form>
				</div>
			</div>				
						';

			echo 
			'
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Chỉnh sửa thông tin</h3>
					</div>
					<div class="panel-body">
						<form method="POST" id="formThongTin"	onsubmit="return false">';
			$sql_web = "SELECT * FROM website";
			if($db->num_rows($sql))
			{
				$web = $db->fetch_assoc($sql_web,1);
				echo '
							<div class="form-group">
								<label>Tiêu đề website</label>
								<input type="text" id="title_web" class="form-control" value="'.$web['tieu_de'].'">
							</div>
							<div class="form-group">
								<label>Mô tả website</label>
								<textarea id="decrip_web" class="form-control">'.$web['mieu_ta'].'</textarea>
							</div>
							<div class="form-group">
								<label>Tiêu đề websitr</label>
								<input type="text" id="keywords_web" class="form-control" value="'.$web['tu_khoa'].'">
							</div>

					';
			}
			echo '		<button type="submit" class="btn btn-primary">Lưu</button><br><br>
						<div class="alert alert-danger hidden"></div>
					</form>
				</div>
			</div>				
						';
		}
	}
	else
	{
		new Redirect($_DOMAIN);
	}
?>
<?php if(!defined("DAT_DANG")) die("Page Not Found"); ?>
<?php if($user){ ?> 
<!-- Dashboard bài viết -->
<h3>Bài viết</h3>
	<div class="row">
	<?php
		echo 
			'<div class="col-md-4">
				<div class="alert alert-info">';
		if($data_user['quyen'] == 1)
		{
			$sql_baiviet_tong = "SELECT * FROM baiviet";
		}
		else
		{
			$sql_baiviet_tong = "SELECT * FROM baiviet WHERE tac_gia = '$data_user[id_tk]'";
		}
		$count_baiviet_tong = $db->num_rows($sql_baiviet_tong);
		echo   '	<h1>'.$count_baiviet_tong.'</h1>
					<p>Tổng bài viết</p>
				</div>
			</div>';
			// -------------
		echo 
			'<div class="col-md-4">
				<div class="alert alert-success">';
		if($data_user['quyen'] == 1)
		{
			$sql_baiviet_xuatban = "SELECT * FROM baiviet WHERE trang_thai = '1'";
		}
		else
		{
			$sql_baiviet_xuatban = "SELECT * FROM baiviet WHERE tac_gia = '$data_user[id_tk]' AND trang_thai = '1'";
		}
		$count_baiviet_xuatban = $db->num_rows($sql_baiviet_xuatban);
		echo   '	<h1>'.$count_baiviet_xuatban.'</h1>
					<p>Bài viết xuất bản</p>
				</div>
			</div>';
			// -------------
		echo 
			'<div class="col-md-4">
				<div class="alert alert-warning">';
		if($data_user['quyen'] == 1)
		{
			$sql_baiviet_an = "SELECT * FROM baiviet WHERE trang_thai = '0'";
		}
		else
		{
			$sql_baiviet_an = "SELECT * FROM baiviet WHERE tac_gia = '$data_user[id_tk]' AND trang_thai = '0'";
		}
		$count_baiviet_an = $db->num_rows($sql_baiviet_an);
		echo   '	<h1>'.$count_baiviet_an.'</h1>
					<p>Bài viết ẩn</p>
				</div>
			</div>';		
	?>
	</div>

<!-- Dashboard hình ảnh -->
<h3>Hình ảnh</h3>
	<div class="row">
	<?php
		echo 
			'<div class="col-md-4">
				<div class="alert alert-info">';
		if($data_user['quyen'] == 1)
		{
			$sql_hinhanh_tong = "SELECT * FROM hinhanh";
		}
		else
		{
			$sql_hinhanh_tong = "SELECT * FROM hinhanh WHERE tac_gia = '$data_user[id_tk]'";
		}
		$count_hinhanh_tong = $db->num_rows($sql_hinhanh_tong);
		echo   '	<h1>'.$count_hinhanh_tong.'</h1>
					<p>Tổng hình ảnh</p>
				</div>
			</div>';
			// -------------
		echo 
			'<div class="col-md-4">
				<div class="alert alert-success">';
		if($data_user['quyen'] == 1)
		{
			$sql_hinhanh_size = "SELECT * FROM hinhanh";
		}
		else
		{
			$sql_hinhanh_size = "SELECT * FROM hinhanh WHERE tac_gia = '$data_user[id_tk]'";
		}
		
		if($db->num_rows($sql_hinhanh_size))
		{
			$size_tong = 0;
			foreach ($db->fetch_assoc($sql_hinhanh_size,0) as $key => $size) {
				$size_tong += $size['size'];
			}
		}
		else
		{
			$size_tong = 0;
		}

		if($size_tong < 1024)
		{
			$size_tong = round($size_tong).' B';
		}
		else if($size_tong < (1024*1024))
		{
			$size_tong = round($size_tong/1024).' KB';
		}
		else if($size_tong < (1024*1024*1024))
		{
			$size_tong = round($size_tong/1024/1024).' MB';
		}
		else if($size_tong < (1024*1024*1024*1024))
		{
			$size_tong = round($size_tong/1024/1024/1024).' GB';
		}

		echo   '	<h1>'.$size_tong.'</h1>
					<p>Tổng dung lượng</p>
				</div>
			</div>';
			// -------------
		echo 
			'<div class="col-md-4">
				<div class="alert alert-warning">';
		if($data_user['quyen'] == 1)
		{
			$sql_hinhanh_error = "SELECT * FROM hinhanh";
		}
		else
		{
			$sql_hinhanh_error = "SELECT * FROM hinhanh WHERE tac_gia = '$data_user[id_tk]'";
		}
		if($db->num_rows($sql_hinhanh_error))
		{
			$count_hinhanh_error = 0;
			foreach ($db->fetch_assoc($sql_hinhanh_error,0) as $key => $value) {
				if(!file_exists('../'.$value['url']))
				{
					$count_hinhanh_error += 1;
				}
			}
		}
		else
		{
			$count_hinhanh_error = 0;
		}
		echo   '	<h1>'.$count_hinhanh_error.'</h1>
					<p>Hình ảnh lỗi</p>
				</div>
			</div>';		
	?>
	</div>
<?php
	if($data_user['quyen'] == 1)
	{
?>

<!-- Dashboard chuyên mục -->
<h3>Chuyên mục</h3>
	<div class="row">
	<?php
		echo 
			'<div class="col-md-3">
				<div class="alert alert-info">';
		$sql_chuyenmuc_tong = "SELECT * FROM chuyenmuc";
		$count_chuyenmuc_tong = $db->num_rows($sql_chuyenmuc_tong);
		echo   '	<h1>'.$count_chuyenmuc_tong.'</h1>
					<p>Tổng chuyên mục</p>
				</div>
			</div>';
			// -------------
		echo 
			'<div class="col-md-3">
				<div class="alert alert-success">';
		$sql_chuyenmuclon_tong = "SELECT * FROM chuyenmuc WHERE type = '1'";
		$count_chuyenmuclon_tong = $db->num_rows($sql_chuyenmuclon_tong);
		echo   '	<h1>'.$count_chuyenmuclon_tong.'</h1>
					<p>Chuyên mục lớn</p>
				</div>
			</div>';
			// -------------
		echo 
			'<div class="col-md-3">
				<div class="alert alert-warning">';
		$sql_chuyenmucvua_tong = "SELECT * FROM chuyenmuc WHERE type = '2'";
		$count_chuyenmucvua_tong = $db->num_rows($sql_chuyenmucvua_tong);
		echo   '	<h1>'.$count_chuyenmucvua_tong.'</h1>
					<p>Chuyên mục vừa</p>
				</div>
			</div>';
			// -------------	
		echo 
			'<div class="col-md-3">
				<div class="alert alert-danger">';
		$sql_chuyenmucnho_tong = "SELECT * FROM chuyenmuc WHERE type = '3'";
		$count_chuyenmucnho_tong = $db->num_rows($sql_chuyenmucnho_tong);
		echo   '	<h1>'.$count_chuyenmucnho_tong.'</h1>
					<p>Chuyên mục nhỏ</p>
				</div>
			</div>';		
	?>
	</div>

<!-- Dashboard tài khoản -->
<h3>Tài khoản</h3>
	<div class="row">
	<?php
		echo 
			'<div class="col-md-4">
				<div class="alert alert-info">';
		$sql_taikhoan_tong = "SELECT * FROM taikhoan";
		$count_taikhoan_tong = $db->num_rows($sql_taikhoan_tong);
		echo   '	<h1>'.$count_taikhoan_tong.'</h1>
					<p>Tổng tài khoản</p>
				</div>
			</div>';
			// -------------
		echo 
			'<div class="col-md-4">
				<div class="alert alert-success">';
		$sql_taikhoan_hoatdong = "SELECT * FROM taikhoan WHERE trang_thai = '0'";
		$count_taikhoan_hoatdong = $db->num_rows($sql_taikhoan_hoatdong);
		echo   '	<h1>'.$count_taikhoan_hoatdong.'</h1>
					<p>Tài khoản hoạt động</p>
				</div>
			</div>';
			// -------------
		echo 
			'<div class="col-md-4">
				<div class="alert alert-success">';
		$sql_taikhoan_khoa = "SELECT * FROM taikhoan WHERE trang_thai = '1'";
		$count_taikhoan_khoa = $db->num_rows($sql_taikhoan_khoa);
		echo   '	<h1>'.$count_taikhoan_khoa.'</h1>
					<p>Tài khoản bị khóa</p>
				</div>
			</div>';		
	?>
	</div>
<?php
	}
}
?>
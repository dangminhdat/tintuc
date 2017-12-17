<?php
	// Lấy database để kiểm tra
	require_once 'core/init.php';

	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$username = trim(addslashes(htmlspecialchars($_POST['username'])));
		$password = trim(addslashes(htmlspecialchars($_POST['password'])));

		// Thông báo kết quả
		$show_alert = '<script>$("#formDangNhap .alert").removeClass("hidden");</script>';
		$hide_alert = '<script>$("#formDangNhap .alert").addClass("hidden");</script>';
		$success_alert = '<script>$("#formDangNhap .alert").attr("class","alert alert-success");</script>';

		// Nếu giá trị rỗng
		if($username == '' || $password == '')
		{
			echo $show_alert.'Error: Vui lòng điền đầy đủ thông tin.';
		}
		else
		{	
			// Kiểm tra username
			$sql = "SELECT * FROM taikhoan WHERE username = '$username'";
			if($db->num_rows($sql))
			{
				$password = md5($password);	
				// Kiểm tra username, password và tài khoản có bị khóa không
				$sql = "SELECT * FROM taikhoan WHERE username = '$username' AND password = '$password' AND trang_thai = '0'";
				if($db->num_rows($sql))
				{
					// Bố trị session
					$session->set_session('dangminhdat.com',$username);
					$db->disconnect();

					echo $success_alert.'Đăng nhập thành công';
					new Redirect($_DOMAIN);
				}
				else
				{
					echo $show_alert."Error: Mật khẩu không chính xác";
				}	
			}
			else
			{
				echo $show_alert."Error: Tên đăng nhập không tồn tại";
			}	
		}	
	}
	else
	{
		new Redirect($_DOMAIN);
	}	

?>
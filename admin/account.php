<?php
	// Xử lý database
	require_once 'core/init.php';

	if($user)
	{
		if(isset($_POST['action']))
		{
			$action = trim(addslashes(htmlspecialchars($_POST['action'])));
		}

		if($action == 'add_acc')
		{
			$user_add_acc = trim(addslashes(htmlspecialchars($_POST['user_add_acc'])));
			$pass_add_acc = trim(addslashes(htmlspecialchars($_POST['pass_add_acc'])));
			$re_pass_add_acc = trim(addslashes(htmlspecialchars($_POST['re_pass_add_acc'])));

			$show_alert = '<script>$("#formTaiKhoan .alert").removeClass("hidden");</script>';						
			$hide_alert = '<script>$("#formTaiKhoan .alert").addClass("hidden");</script>';
			$success_alert = '<script>$("#formTaiKhoan .alert").attr("class","alert alert-success");</script>';

			if($user_add_acc == '' || $pass_add_acc == '' || $re_pass_add_acc == '')
			{
				echo $show_alert."Error: Vui lòng điền đầy đủ thông tin";
			}
			else
			{
				$sql_user = "SELECT * FROM taikhoan WHERE username = '$user_add_acc'";
				if(strlen($user_add_acc) < 6 || strlen($user_add_acc) > 32)
				{
					echo $show_alert."Error: Tên đăng nhập nằm trong khoảng 6-32 ký tự.";
				}
				else if(preg_match('#\W#',$user_add_acc))
				{
					echo $show_alert.'Error: Tên đăng nhập không chứa kí tự đậc biệt và khoảng trắng.';
				}
				else if($db->num_rows($sql_user))
				{
					echo $show_alert."Error: Tên đăng nhập đã tồn tại";
				}
				else if(strlen($pass_add_acc) < 6)
				{
					echo $show_alert."Error: Mật khẩu không nhỏ hơn 6 ký tự";
				}
				else if($pass_add_acc != $re_pass_add_acc)
				{
					echo $show_alert."Error: Mật khẩu nhập lại không khớp";
				}
				else
				{
					$pass_add_acc = md5($pass_add_acc);
					$sql_insert_user = "INSERT INTO taikhoan VALUES(
						'',
						'$user_add_acc',
						'$pass_add_acc',
						'',
						'',
						'0',
						'0',
						'$date_current',
						'',
						'',
						'',
						'',
						'',
						'')";
					$db->query($sql_insert_user);
					echo $success_alert."Success: Thêm tài khoản thành công";
					$db->disconnect();
					new Redirect($_DOMAIN.'account');	
				}
			}
		}
		else if($action == "lock_list_acc")
		{
			foreach ($_POST['id_acc'] as $key => $value) {
				$sql_lock = "SELECT * FROM taikhoan WHERE id_tk = '$value'";
				if($db->num_rows($sql_lock))
				{
					$sql_lock = "UPDATE taikhoan SET trang_thai = '1' WHERE id_tk = '$value'";
					$db->query($sql_lock);
				}
			}
			$db->disconnect();
		}
		else if($action == "unlock_list_acc")
		{
			foreach ($_POST['id_acc'] as $key => $value) {
				$sql_unlock = "SELECT * FROM taikhoan WHERE id_tk = '$value'";
				if($db->num_rows($sql_unlock))
				{
					$sql_unlock = "UPDATE taikhoan SET trang_thai = '0' WHERE id_tk = '$value'";
					$db->query($sql_unlock);
				}
			}
			$db->disconnect();
		}
		else if($action == "del_list_acc")
		{
			foreach ($_POST['id_acc'] as $key => $value) {
				$sql_del = "SELECT * FROM taikhoan WHERE id_tk = '$value' AND username != 'admin'";
				if($db->num_rows($sql_del))
				{
					$sql_del = "DELETE FROM taikhoan WHERE id_tk = '$value' AND username != 'admin'";
					$db->query($sql_del);
				}
			}
			$db->disconnect();
		}
		else if($action == "lock_acc")
		{
			$id_acc = trim(addslashes(htmlspecialchars($_POST['id_acc'])));
			$sql_lock = "SELECT * FROM taikhoan WHERE id_tk = '$id_acc'";
			if($db->num_rows($sql_lock))
			{
				$sql_lock = "UPDATE taikhoan SET trang_thai = '1' WHERE id_tk = '$id_acc'";
				$db->query($sql_lock);
			}
			$db->disconnect();

		}
		else if($action == "unlock_acc")
		{
			$id_acc = trim(addslashes(htmlspecialchars($_POST['id_acc'])));
			$sql_unlock = "SELECT * FROM taikhoan WHERE id_tk = '$id_acc'";
			if($db->num_rows($sql_unlock))
			{
				$sql_unlock = "UPDATE taikhoan SET trang_thai = '0' WHERE id_tk = '$id_acc'";
				$db->query($sql_unlock);				
			}
			$db->disconnect();
		}
		else if($action == "del_acc")
		{
			$id_acc = trim(addslashes(htmlspecialchars($_POST['id_acc'])));
			$sql_del = "SELECT * FROM taikhoan WHERE id_tk = '$id_acc' AND username != 'admin'";
			if($db->num_rows($sql_del))
			{
				$sql_del = "DELETE FORM taikhoan WHERE id_tk = '$id_acc' AND username != 'admin'";
				$db->query($sql_del);
			}
			$db->disconnect();
		}
		else
		{
			new Redirect($_DOMAIN.'account');
		}
	}
	else
	{
		new Redirect($_DOMAIN.'account');
	}
?>
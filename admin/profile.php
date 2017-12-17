<?php
	// Xử lý database
	require_once 'core/init.php';

	if($user)
	{
		if(isset($_FILES['avatar_img']))
		{
			$folder = '../upload';
			$name_file = $_FILES['avatar_img']['name'];
			$tmp_file = $_FILES['avatar_img']['tmp_name'];

			$day = substr($date_current,8,2);
			$month = substr($date_current,5,2);
			$year = substr($date_current,0,4);

			if(!is_dir($folder.'/'.$year))
			{
				mkdir($folder.'/'.$year.'/');
			}
			if(!is_dir($folder.'/'.$year.'/'.$month))
			{
				mkdir($folder.'/'.$year.'/'.$month.'/');
			}
			if(!is_dir($folder.'/'.$year.'/'.$month.'/'.$day))
			{
				mkdir($folder.'/'.$year.'/'.$month.'/'.$day.'/');
			}

			$path = $folder.'/'.$year.'/'.$month.'/'.$day.'/'.$name_file;

			move_uploaded_file($tmp_file,$path);

			$url = substr($path,3);

			$sql_update = "UPDATE taikhoan SET url_avatar = '$url' WHERE id_tk = '$data_user[id_tk]'";
			$db->query($sql_update);
			echo "Upload ảnh đại diện thành công";
			$db->disconnect();
			new Redirect($_DOMAIN.'profile');	
		}

		if(isset($_POST['action']))
		{
			$action = trim(addslashes(htmlspecialchars($_POST['action'])));
		}
		else
		{
			$action = '';
		}

		if($action != '')
		{
			if($action == 'del_avatar')
			{
				if(file_exists('../'.$data_user['url_avatar']))
				{
					unlink('../'.$data_user['url_avatar']);
				}
				$sql_update = "UPDATE taikhoan SET url_avatar = '' WHERE id_tk = '$data_user[id_tk]'";
				$db->query($sql_update);
				$db->disconnect;
			}
			else if($action == 'update_user')
			{
				$name_display = trim(addslashes(htmlspecialchars($_POST['name_display'])));
				$email_display = trim(addslashes(htmlspecialchars($_POST['email_display'])));
				$facebook = trim(addslashes(htmlspecialchars($_POST['facebook'])));
				$google = trim(addslashes(htmlspecialchars($_POST['google'])));
				$twitter = trim(addslashes(htmlspecialchars($_POST['twitter'])));
				$phone = trim(addslashes(htmlspecialchars($_POST['phone'])));
				$mieu_ta = trim(addslashes(htmlspecialchars($_POST['mieu_ta'])));

				$show_alert = '<script>$("#formUser .alert").removeClass("hidden");</script>';
				$hide_alert = '<script>$("#formUser .alert").addClass("hidden");</script>';
				$success_alert = '<script>$("#formUser .alert").attr("class","alert alert-success");</script>';

				if($name_display == '' || $email_display == '')
				{
					echo $show_alert."Vui lòng điền đầy đủ thông tin";
				}
				else
				{
					if(filter_var($email_display,FILTER_VALIDATE_EMAIL) === false)
					{
						echo $show_alert."Vui lòng điền email hợp lệ";;
					}
					else if($phone && (strlen($phone) < 10 || strlen($phone) > 11 || preg_match('#^[0-9]+$#',$phone) === false))
					{
						echo $show_alert."Vui lòng điền số điện thoại hợp lệ hợp lệ";;
					}
					else
					{
						$sql = "UPDATE taikhoan SET 
							ten_hien_thi = '$name_display',
							email = '$email_display',
							facebook = '$facebook',
							google = '$google',
							twitter = '$twitter',
							phone = '$phone',
							mieu_ta = '$mieu_ta' WHERE id_tk = '$data_user[id_tk]'";

						$db->query($sql);
						echo $success_alert."Cập nhật thông tin thành công";
						$db->disconnect();
						new Redirect($_DOMAIN.'profile');
					}
				}								
			}
			else if($action == 'change_pass')
			{
				$pass_old = trim(addslashes(htmlspecialchars($_POST['pass_old'])));
				$pass_new = trim(addslashes(htmlspecialchars($_POST['pass_new'])));
				$re_pass_new = trim(addslashes(htmlspecialchars($_POST['re_pass_new'])));

				$show_alert = '<script>$("#formPass .alert").removeClass("hidden");</script>';
				$hide_alert = '<script>$("#formPass .alert").addClass("hidden");</script>';
				$success_alert = '<script>$("#formPass .alert").attr("class","alert alert-success");</script>';

				if($pass_old == '' || $pass_new == '' || $re_pass_new == '')
				{
					echo $show_alert."Vui lòng điền đầy đủ thông tin";
				}
				else
				{
					if(md5($pass_old) != $data_user['password'])
					{
						echo $show_alert."Mật khẩu cũ không chính xác";
					}
					else if(strlen($pass_new) < 6)
					{
						echo $show_alert."Mật khẩu mới quá ngắn";
					}
					else if(md5($pass_old) == md5($pass_new))
					{
						echo $show_alert."Mật khẩu mới phải khác mật khẩu cũ";
					}
					else if($pass_new != $re_pass_new)
					{
						echo $show_alert."Mật khẩu nhập lại không khớp";
					}
					else
					{
						$pass_new = md5($pass_new);
						$sql_update = "UPDATE taikhoan SET password = '$pass_new' WHERE id_tk = '$data_user[id_tk]'";
						$db->query($sql_update);
						echo $success_alert."Thay đổi thành công";
						$db->disconnect();
						new Redirect($_DOMAIN.'profile');
					}
				}
			}
		}
		else
		{
			new Redirect($_DOMAIN.'profile');
		}
	}
	else
	{
		new Redirect($_DOMAIN);
	}
?>

<?php
	// Xử lý database
	require_once 'core/init.php';

	// Đăng nhập
	if($user)
	{
		// Lấy POST action từ ajax	
		if(isset($_POST['action']))
		{
			// Xử lý action
			$action = trim(addslashes(htmlspecialchars($_POST['action'])));
		}
		else
		{
			$action = '';
		}

		if($action != '')
		{
			// Load parent chuyên mục
			if($action == 'load_parent_add_cate')
			{
				$type_add_cate = trim(addslashes(htmlspecialchars($_POST['type_add_cate'])));
				// type kiểu số 
				if(preg_match('#\d#',$type_add_cate))
				{
					$type_parent_add_cate = $type_add_cate - 1;
					$sql_cate = "SELECT * FROM chuyenmuc WHERE type = '$type_parent_add_cate'";
					if($db->num_rows($sql_cate))
					{
						// in danh sách chuyên mục cha
						foreach ($db->fetch_assoc($sql_cate,0) as $key => $value) 
						{
							echo '<option value="'.$value['id_cate'].'">'.$value['ten_chuyen_muc'].'</option>';
						}
					}
					else
					{
						echo "<option value='0'>Hiện chưa có chuyên mục cha nào.</option>";
					}	
				}	
			}
			// Thêm chuyên mục
			else if($action == 'add_cate')
			{
				$label_add_cate = trim(addslashes(htmlspecialchars($_POST['label_add_cate'])));
				$url_add_cate = trim(addslashes(htmlspecialchars($_POST['url_add_cate'])));
				$type_add_cate = trim(addslashes(htmlspecialchars($_POST['type_add_cate'])));
				$parent_add_cate = trim(addslashes(htmlspecialchars($_POST['parent_add_cate'])));
				$sort_add_cate = trim(addslashes(htmlspecialchars($_POST['sort_add_cate'])));

				$show_alert = '<script>$("#formChuyenMuc .alert").removeClass("hidden");</script>';
				$hide_alert = '<script>$("#formChuyenMuc .alert").addClass("hidden");</script>';
				$success_alert = '<script>$("#formChuyenMuc .alert").attr("class","alert alert-success");</script>';


				if($label_add_cate == '' || $url_add_cate == '' || $type_add_cate == '' || $sort_add_cate == '')
				{
					echo $show_alert.'Error: Vui lòng điền đầy đủ thông tin';
				}
				else 
				{
					if(preg_match('#\D#',$type_add_cate))
					{
						echo $show_alert."Error: Đã có lỗi xảy ra, hãy thử lại sau.";
					}else if(preg_match('#\D#',$parent_add_cate))
					{
						echo $show_alert."Error: Đã có lỗi xảy ra, hãy thử lại sau.";
					}else if(preg_match('#\D#',$sort_add_cate) && $sort_add_cate < 1)
					{
						echo $show_alert."Error: Sort chuyên mục phải là số nguyên dương";
					}
					else
					{
						$sql_insert = "INSERT INTO chuyenmuc VALUES('','$label_add_cate','$url_add_cate','$type_add_cate','$sort_add_cate','$parent_add_cate','$date_current')";
						$db->query($sql_insert);
						echo $success_alert."Thêm chuyên mục thành công";
						$db->disconnect();
						new Redirect($_DOMAIN.'catogories');
					}	
				}	
			}
			// Load edit chuyên mục
			else if($action == 'load_parent_edit_cate')
			{
				// Xử lý giá trị
				$type_edit_cate = trim(addslashes(htmlspecialchars($_POST['type_edit_cate'])));
				$id_edit_cate = trim(addslashes(htmlspecialchars($_POST['id_edit_cate'])));
				if(preg_match('#\d#',$type_edit_cate))
				{
					$type_parent_edit_cate = $type_edit_cate - 1;
					$sql_edit = "SELECT * FROM chuyenmuc WHERE type = '$type_parent_edit_cate' AND id_cate != '$id_edit_cate'";
					if($db->num_rows($sql_edit))
					{
						foreach ($db->fetch_assoc($sql_edit) as $key => $edit_cate) {
							if($edit_cate['id_cate'] != $id_edit_cate)
							{
								echo '<option value="'.$edit_cate['id_cate'].'">'.$edit_cate['ten_chuyen_muc'].'</option>';
							}	
						}
					}
					else
					{
						echo "<option value='0'>Hiện tại chưa có chuyên mục cha nào.</option>";
					}	
				}
			}
			// Edit chuyên mục
			else if($action == 'edit_cate')
			{
				$label_edit_cate = trim(addslashes(htmlspecialchars($_POST['label_edit_cate'])));
				$url_edit_cate = trim(addslashes(htmlspecialchars($_POST['url_edit_cate'])));
				$type_edit_cate = trim(addslashes(htmlspecialchars($_POST['type_edit_cate'])));
				$parent_edit_cate = trim(addslashes(htmlspecialchars($_POST['parent_edit_cate'])));
				$sort_edit_cate = trim(addslashes(htmlspecialchars($_POST['sort_edit_cate'])));
				$id_edit_cate = trim(addslashes(htmlspecialchars($_POST['id_edit_cate'])));

				$show_alert = '<script>$("#formSuaChuyenMuc .alert").removeClass("hidden")</script>';
				$hide_alert = '<script>$("#formSuaChuyenMuc .alert").addClass("hidden")</script>';
				$success_alert = '<script>$("#formSuaChuyenMuc .alert").attr("class","alert alert-success")</script>';								

				if($label_edit_cate == '' || $url_edit_cate == '' || $type_edit_cate == '' || $sort_edit_cate == '')
				{
					echo $show_alert."Error: Vui lòng điền đầy đủ thông tin";
				}
				else
				{
					if(preg_match('#\D#',$type_edit_cate))
					{
						echo $show_alert.'Error: Đã có lỗi xảy ra, hãy thử lại sau.';
					}
					else if(preg_match('#\D#',$parent_edit_cate))
					{	
						echo $show_alert.'Error: Đã có lỗi xảy ra, hãy thử lại sau.';
					}
					else if(preg_match('#\D#',$sort_edit_cate) && $sort_edit_cate < 1)
					{
						echo $show_alert.'Error: Sort chuyên mục phải là số nguyên dương';
					}
					else
					{
						$sql_update = "UPDATE chuyenmuc SET 
							ten_chuyen_muc = '$label_edit_cate',
							url = '$url_edit_cate',
							type = '$type_edit_cate',
							id_parent = '$parent_edit_cate',
							sort = '$sort_edit_cate'
							WHERE id_cate = '$id_edit_cate'";
						$db->query($sql_update);	
						echo $success_alert."Cập nhật chuyên mục thành công";
						$db->disconnect();
						new Redirect($_DOMAIN.'/catogories');	
					}	
				}	

			}	
			else if($action == 'del_list_cate')
			{
				foreach ($_POST['id_cate'] as $key => $value) {
					$sql_del_list_cate = "SELECT * FROM chuyenmuc WHERE id_cate = '$value'";
					if($db->num_rows($sql_del_list_cate))
					{
						$sql_del = "DELETE FROM chuyenmuc WHERE id_cate = '$value'";
						$db->query($sql_del);
					}	
				}
				$db->disconnect();
			}
			else if($action == 'del_cate')
			{
				$value_id = $_POST['id_cate'];
				$sql_del_cate = "SELECT * FROM chuyenmuc WHERE id_cate = '$value_id'";
				if($db->num_rows($sql_del_cate))
				{
					$sql_del = "DELETE FROM chuyenmuc WHERE id_cate = '$value_id'";
					$db->query($sql_del);
					$db->disconnect();
				}	
			}	
		}
		else
		{
			new Redirect($_DOMAIN);
		}	
	}
	else
	{
		new Redirect($_DOMAIN);
	}	
?>
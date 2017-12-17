<?php
	// Xử lý database
	require_once 'core/init.php';

	if($user)
	{
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
			if($action == 'add_post')
			{
				$title_add_post = trim(addslashes(htmlspecialchars($_POST['title_add_post'])));
				$slug_add_post = trim(addslashes(htmlspecialchars($_POST['slug_add_post'])));

				$show_alert = '<script>$("#formBaiViet .alert").removeClass("hidden");</script>';
				$hide_alert = '<script>$("#formBaiViet .alert").addClass("hidden");</script>';
				$success_alert = '<script>$("#formBaiViet .alert").attr("class","alert alert-success");</script>';	

				if($title_add_post == '' || $slug_add_post == '')
				{
					echo $show_alert."Error: Vui lòng điền đầy đủ thông tin";
				}
				else
				{
					$sql = "SELECT * FROM baiviet WHERE tieu_de = '$title_add_post' OR slug = '$slug_add_post'";
					if($db->num_rows($sql))
					{
						echo $show_alert."Error: Bài viết đã tồn tại";
					}
					else
					{
						$sql_insert_post = "INSERT INTO baiviet VALUES(
							'',
							'$title_add_post',
							'',
							'',
							'$slug_add_post',
							'',
							'',
							'',
							'',
							'',
							'$data_user[id_tk]',
							'0',
							'0',
							'$date_current')";
						$db->query($sql_insert_post);
						echo $success_alert."Thêm bài viết thành công";
						$db->disconnect();
						new Redirect($_DOMAIN.'post');
					}
				}											
			}
			else if($action == "search_post")
			{
				$search_post = trim(addslashes(htmlspecialchars($_POST['search_post'])));

				if($search_post != '')
				{
					$sql = "SELECT * FROM baiviet WHERE
						id_post LIKE '%$search_post%' OR 
						tieu_de LIKE '%$search_post%' OR 
						slug LIKE '%$search_post%' ORDER BY id_post DESC";
					if($db->num_rows($sql))
					{
						//Danh sách
						echo 
						'
								<table class="table table-striped list" id="list_post">
									<tr>
										<td><input type="checkbox"></td>
										<td><strong>ID</strong></td>
										<td><strong>Tiêu đề</strong></td>
										<td><strong>Chuyên mục</strong></td>
										<td><strong>Trạng thái</strong></td>
										<td><strong>Lượt xem</strong></td>';

						if($data_user['quyen'] == 1)
						{
							echo 		'<td><strong>Tác giả</strong></td>';
						}
							echo		'<td><strong>Tools</strong></td>
									<tr>';
						foreach ($db->fetch_assoc($sql,0) as $key => $list_search) {				
				
								// Chuyên mục
								$cate = '';
								$sql_cate_1 = "SELECT * FROM chuyenmuc WHERE id_cate = '$list_search[cate_1_id]' AND type = '1'";
								if($db->num_rows($sql_cate_1))
								{
									$data_cate_1 = $db->fetch_assoc($sql_cate_1,1);
									$cate .= $data_cate_1['ten_chuyen_muc'].', ';
								}
								else
								{
									$cate .= '<span class="text-danger">Lỗi</span>, ';
								}
								$sql_cate_2 = "SELECT * FROM chuyenmuc WHERE id_cate = '$list_search[cate_2_id]' AND type = '2'";
								if($db->num_rows($sql_cate_1))
								{
									$data_cate_2 = $db->fetch_assoc($sql_cate_2,1);
									$cate .= $data_cate_2['ten_chuyen_muc'].', ';
								}
								else
								{
									$cate .= '<span class="text-danger">Lỗi</span>, ';
								}
								$sql_cate_3 = "SELECT * FROM chuyenmuc WHERE id_cate = '$list_search[cate_3_id]' AND type = '3'";
								if($db->num_rows($sql_cate_3))
								{
									$data_cate_3 = $db->fetch_assoc($sql_cate_3,1);
									$cate .= $data_cate_3['ten_chuyen_muc'];
								}
								else
								{
									$cate .= '<span class="text-danger">Lỗi</span>';
								}
								// Trạng thái
								if($list_search['trang_thai'] == 0)
								{
									$status = '<div class="label label-warning">Ẩn</div>';
								}
								else
								{
									$status = '<div class="label label-warning">Xuất bản</div>';
								}
								//Tác giả
								$sql_author = "SELECT * FROM taikhoan WHERE id_tk = '$list_search[tac_gia]'";
								if($db->num_rows($sql_author))
								{
									$data_author = $db->fetch_assoc($sql_author,1);
									$tac_gia = $data_author['ten_hien_thi'];
								}
								else
								{
									$tac_gia = 'No Name';
								}

								echo 
								'
									<tr>
										<td><input type="checkbox" name="id_post[]" value="'.$list_search['id_post'].'"</td>
										<td>'.$list_search['id_post'].'</td>
										<td>'.$list_search['tieu_de'].'</td>
										<td>'.$cate.'</td>
										<td>'.$status.'</td>
										<td>'.$list_search['luot_xem'].'</td>';
								if($data_user['quyen'] == 1)
								{
									echo '<td>'.$list_search['tac_gia'].'</td>';
								}
								echo 
									'<td>
										<a href="'.$_DOMAIN.'post/edit/'.$list_search['id_post'].'" class="btn btn-primary btn-sm">
											<span class="fa fa-edit"></span>
										</a>
										<a class="btn btn-danger btn-sm del_post" data-id="'.$list_search['id_post'].'" >
											<span class="fa fa-trash"></span>
										</a>		
									</td>';	
							}
							echo "</table>";
								}	
							}
			}
			else if($action == 'load_cate_2')
			{
				$parent_id = trim(addslashes(htmlspecialchars($_POST['parent_id'])));
				$sql = "SELECT * FROM chuyenmuc WHERE type = '2' AND id_parent = '$parent_id'";
				if($db->num_rows($sql))
				{
					foreach ($db->fetch_assoc($sql,0) as $key => $value) {
						echo '<option value="'.$value['id_cate'].'">'.$value['ten_chuyen_muc'].'</option>';
					}	
				}
				echo '<option value="0">Hiện tại không có chuyên mục nào cả.</option>';
			}
			else if($action == 'edit_post')
			{
				$id_edit_post = trim(addslashes(htmlspecialchars($_POST['id_edit_post'])));
				$title_edit_post = trim(addslashes(htmlspecialchars($_POST['title_edit_post'])));
				$slug_edit_post = trim(addslashes(htmlspecialchars($_POST['slug_edit_post'])));
				$url_edit_post = trim(addslashes(htmlspecialchars($_POST['url_edit_post'])));
				$mieu_ta_post = trim(addslashes(htmlspecialchars($_POST['mieu_ta_post'])));
				$tu_khoa_post = trim(addslashes(htmlspecialchars($_POST['tu_khoa_post'])));
				$edit_cate_post_1 = trim(addslashes(htmlspecialchars($_POST['edit_cate_post_1'])));
				$edit_cate_post_2 = trim(addslashes(htmlspecialchars($_POST['edit_cate_post_2'])));
				$edit_cate_post_3 = trim(addslashes(htmlspecialchars($_POST['edit_cate_post_3'])));
				$status_edit_post = trim(addslashes(htmlspecialchars($_POST['status_edit_post'])));
				$body_edit_post = trim(addslashes(htmlspecialchars($_POST['body_edit_post'])));

				$show_alert = '<script>$("#formEditPost .alert").removeClass("hidden");</script>';
				$hide_alert = '<script>$("#formEditPost .alert").addClass("hidden");</script>';
				$success_alert = '<script>$("#formEditPost .alert").attr("class","alert alert-success");</script>';

				if($title_edit_post == '' || $slug_edit_post == '' || $url_edit_post == '' || $mieu_ta_post == '' || $body_edit_post == '')
				{
					echo $show_alert."Error: Vui lòng điền đầy đủ thông tin";
				}
				else
				{
					$sql = "SELECT * FROM baiviet WHERE id_post = '$id_edit_post'";
					if(!$db->num_rows($sql))
					{
						echo $show_alert."Error: Đã xảy ra lỗi, hãy thử lại sau";
					}
					else if($url_edit_post != '' && filter_var($url_edit_post,FILTER_VALIDATE_URL) === false)
					{
						echo $show_alert."Error: Vui lòng nhập url thumbnail hợp lệ.";
					}
					else
					{
						$sql_update = "UPDATE baiviet SET 
							tieu_de = '$title_edit_post',
							slug = '$slug_edit_post',
							url = '$url_edit_post',
							mieu_ta = '$mieu_ta_post',
							tu_khoa = '$tu_khoa_post',
							cate_1_id = '$edit_cate_post_1',
							cate_2_id = '$edit_cate_post_2',
							cate_3_id = '$edit_cate_post_3',
							trang_thai = '$status_edit_post',
							noi_dung = '$body_edit_post' WHERE id_post = '$id_edit_post'
							";
						$db->query($sql_update);
						echo $success_alert.'Cập nhật bài viết thành công';
						$db->disconnect();
						new Redirect($_DOMAIN.'post');	
					}
				} 	
			}
			else if($action == "del_list_post")
			{
				foreach ($_POST['id_post'] as $key => $value) {
					$sql = "SELECT * FROM baiviet WHERE id_post = '$value'";
					if($db->num_rows($sql))
					{
						$sql_del_post = "DELETE FROM baiviet WHERE id_post = '$value'";
						$db->query($sql_del_post);
					}
				}
				$db->disconnect();
			}
			else if($action == "del_post")
			{
				$value = trim(addslashes(htmlspecialchars($_POST['id_post'])));
				$sql = "SELECT * FROM baiviet WHERE id_post = '$value'";
				if($db->num_rows($sql))
				{
					$sql = "DELETE FROM baiviet WHERE id_post = '$value'";
					$db->query($sql);
					$db->disconnect();
				}
			}
			else if($action == "del_edit_post")
			{
				$value = trim(addslashes(htmlspecialchars($_POST['id_post'])));
				$sql = "SELECT * FROM baiviet WHERE id_post = '$value'";
				if($db->num_rows($sql))
				{
					$sql = "DELETE FROM baiviet WHERE id_post = '$value'";
					$db->query($sql);
					$db->disconnect();
				}
			}
		}
	}
	else
	{
		new Redirect($_DOMAIN.'post');
	}
?>
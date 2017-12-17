<?php if(!defined("DAT_DANG")) die("Page Not Found"); ?>
<?php
	require_once 'core/init.php';

	if($user)
	{
		echo "<h3>Bài viết</h3>";
		if(isset($_GET['ac']))
		{
			$ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
		}
		else
		{
			$ac = '';
		}

		if(isset($_GET['id']))
		{
			$id = trim(addslashes(htmlspecialchars($_GET['id'])));
		}
		else
		{
			$id = '';
		}

		if($ac != '')
		{
			if($ac == 'add')
			{
				echo 
				'
					<a href="'.$_DOMAIN.'post" class="btn btn-default">
						<span class="fa fa-arrow-left"></span> Trở về
					</a>	
				';
				echo 
				'
					<p class="form-add-post">
						<form method="POST" onsubmit="return false" id="formBaiViet">
							<div class="form-group">
								<label>Tiêu đề bài viết</label>
								<input type="text" id="title-add-post" class="form-control title">
							</div>
							<div class="form-group">
								<label>Slug bài viết</label>
								<input type="text" id="slug-add-post" placeholder="Nhấn vào để tự tạo" class="form-control slug">
							</div>
							<div class="form-group">
								<button class="btn btn-primary">Tạo</button>
							</div>
							<div class="alert alert-danger hidden"></div>
						</form>
					</p>
				';
			}
			else if($ac == 'edit')
			{

				$sql_edit = "SELECT * FROM baiviet WHERE id_post = '$id'";

				if($db->num_rows($sql_edit))
				{
					$data_edit = $db->fetch_assoc($sql_edit,1);
					if($data_edit['tac_gia'] == $data_user['id_tk'] || $data_user['quyen'] == 1)
					{
						echo 
						'
							<a href="'.$_DOMAIN.'post" class="btn btn-default">
								<span class="fa fa-arrow-left"></span> Trở về
							</a>
							<a class="btn btn-danger" id="del_edit_post" data-id="'.$id.'">
								<span class="fa fa-trash"></span> Xóa
							</a>		
						';

						echo '
							<p class="form-edit-post">
								<form method="POST" onsubmit="return false;" id="formEditPost" data-id="'.$id.'">
									<div class="form-group">
										<label>Trạng thái bài viết</label>
							';

						if($data_edit['trang_thai'] == 0)
						{
							echo 
							'
								<div class="radio">
									<label>
										<input type="radio" name="status" value="1"> Xuất bản
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="status" value="0" checked> Ẩn
									</label>
								</div>
							</div>			
							';
						}
						else if($data_edit['trang_thai'] == 1)
						{
							echo 
							'
								<div class="radio">
									<label>
										<input type="radio" name="status" value="1" checked> Xuất bản
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="status" value="0"> Ẩn
									</label>
								</div>
							</div>			
							';
						}

						echo 
						'
							<div class="form-group">
								<label>Tiêu đề bài viết</label>
								<input type="text" id="title_edit_post" value="'.$data_edit['tieu_de'].'" class="form-control title">
							</div>
							<div class="form-group">
								<label>Slug bài viết</label>
								<input type="text" id="slug_edit_post" value="'.$data_edit['slug'].'" class="form-control slug">
							</div>
							<div class="form-group">
								<label>Url thumbnail</label>
								<input type="text" id="url_edit_post" value="'.$data_edit['url'].'" class="form-control">
							</div>
							<div class="form-group">
								<label>Mô tả bài viết</label>
								<textarea id="mieu_ta_post" class="form-control">'.$data_edit['mieu_ta'].'</textarea>
							</div>
							<div class="form-group">
								<label>Từ khóa bài viết</label>
								<input type="text" id="tu_khoa_post" value="'.$data_edit['tu_khoa'].'" class="form-control">
							</div>
							<div class="form-group">
								<label>Chuyên mục lớn của bài viết</label>
								<select id="edit_cate_post_1" class="form-control">	
						';
						//Chuyên mục lớn
						$sql_cate_1 = "SELECT * FROM chuyenmuc WHERE type = '1'";
						if($db->num_rows($sql_cate_1))
						{
							if($data_edit['cate_1_id'] == 0)
							{
								echo '<option value="0">Vui lòng chọn chuyên mục.</option>';
							}
							foreach ($db->fetch_assoc($sql_cate_1,0) as $key => $value) {
								if($data_edit['cate_1_id'] == $value['id_cate'])
								{
									echo '<option value="'.$value['id_cate'].'" selected>'.$value['ten_chuyen_muc'].'</option>';
								}
								else
								{
									echo '<option value="'.$value['id_cate'].'">'.$value['ten_chuyen_muc'].'</option>';
								}
							}
						}	
						else
						{
							echo '<option value="0">Hiện tại chưa có chuyên mục nào cả.</option>';
						}
						echo 	'</select>
							</div>
							<div class="form-group">
								<label>Chuyên mục vừa của bài viết</label>
								<select id="edit_cate_post_2" class="form-control">';

						//Chuyên mục vừa
						$sql_cate_2 = "SELECT * FROM chuyenmuc WHERE type = '2'";
						if($db->num_rows($sql_cate_2))
						{
							if($data_edit['cate_2_id'] == 0)
							{
								echo '<option value="0">Vui lòng chọn chuyên mục.</option>';
							}
							foreach ($db->fetch_assoc($sql_cate_2,0) as $key => $value) {
								if($data_edit['cate_2_id'] == $value['id_cate'])
								{
									echo '<option value="'.$value['id_cate'].'" selected>'.$value['ten_chuyen_muc'].'</option>';
								}
								else
								{
									echo '<option value="'.$value['id_cate'].'">'.$value['ten_chuyen_muc'].'</option>';
								}
							}
						}	
						else
						{
							echo '<option value="0">Hiện tại chưa có chuyên mục nào cả.</option>';
						}
						echo 	'</select>
							</div>
							<div class="form-group">
								<label>Chuyên mục nhỏ của bài viết</label>
								<select id="edit_cate_post_3" class="form-control">';	

						//Chuyên mục lớn
						$sql_cate_3 = "SELECT * FROM chuyenmuc WHERE type = '3'";
						if($db->num_rows($sql_cate_3))
						{
							if($data_edit['cate_3_id'] == 0)
							{
								echo '<option value="0">Vui lòng chọn chuyên mục.</option>';
							}
							foreach ($db->fetch_assoc($sql_cate_3,0) as $key => $value) {
								if($data_edit['cate_3_id'] == $value['id_cate'])
								{
									echo '<option value="'.$value['id_cate'].'" selected>'.$value['ten_chuyen_muc'].'</option>';
								}
								else
								{
									echo '<option value="'.$value['id_cate'].'">'.$value['ten_chuyen_muc'].'</option>';
								}
							}
						}	
						else
						{
							echo '<option value="0">Hiện tại chưa có chuyên mục nào cả.</option>';
						}
						echo '</select></div>
							<div class="form-group">
								<label>Nội dung bài viết</label>
								<textarea class="form-control" id="body_edit_post">'.$data_edit['noi_dung'].'</textarea>
							</div>
							<div class="form-group">
								<button class="btn btn-primary">Lưu thay đổi</button>
							</div>
							<div class="alert alert-danger hidden"></div>
							</form>';		
					}
					else
					{
						echo "<div class='alert alert-danger'>ID bài viết đã bị xoá hoặc không tồn tại.</div>";
					}
				}
				else
				{
					echo "<div class='alert alert-danger'>ID bài viết không thuộc quyền sở hữu của bạn.</div>";
				}	
			}
		}
		else
		{
			echo 
			'	
				<a href="'.$_DOMAIN.'post/add" class="btn btn-default">
					<span class="fa fa-plus"></span> Thêm
				</a>
				<a href="'.$_DOMAIN.'post" class="btn btn-default">
					<span class="fa fa-repeat"></span> Reload
				</a>
				<a id="del_list_post" class="btn btn-danger" style="color: #fff">
					<span class="fa fa-trash"></span> Xóa
				</a>	
			';
			if($data_user['quyen'] == 1)
			{
				$sql = "SELECT * FROM baiviet ORDER BY id_post DESC";
			}
			else
			{
				$sql = "SELECT * FROM baiviet WHERE tac_gia = '$data_user[id_tk]' ORDER BY id_post DESC";
			}

			//Tìm kiếm
			echo 
			'
				<p class="form-tim-kiem">
					<form method="POST" id="formTimKiem" onsubmit="return false;">
						<div class="input-group">
							<input type="text" class="form-control" id="search_post" placeholder="Nhập tiêu đề, slug, từ khóa ...">
							<span class="input-group-btn">
								<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
								</button>
							</span>
						</div>
					</form>
				</p>
			';

			//Danh sách
			echo 
			'
				<div class="table-responsive">
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

			if($db->num_rows($sql))
			{
				if(isset($_GET['page']))
				{
					$current_page = trim(addslashes(htmlspecialchars($_GET['page'])));
				}
				else
				{
					$current_page = '';
				}

				$limit = 10;
				$total_page = ceil($db->num_rows($sql) / $limit);
				$start = ($current_page - 1) * 10;

				if($current_page < 1)
				{
					new Redirect($_DOMAIN.'post&page=1');
				}
				else if($current_page > $total_page)
				{
					new Redirect($_DOMAIN.'post&page='.$total_page);
				}

				if($data_user['quyen'] == 1)
				{
					$sql_list_post = "SELECT * FROM baiviet ORDER BY id_post DESC LIMIT $start,$limit";
				}
				else
				{
					$sql_list_post = "SELECT * FROM baiviet WHERE tac_gia = '$data_user[id_tk]' ORDER BY id_post DESC LIMIT $start,$limit";	
				}

				foreach ($db->fetch_assoc($sql_list_post,0) as $key => $list_post) {
					// Chuyên mục
					$cate = '';
					$sql_cate_1 = "SELECT * FROM chuyenmuc WHERE id_cate = '$list_post[cate_1_id]' AND type = '1'";
					if($db->num_rows($sql_cate_1))
					{
						$data_cate_1 = $db->fetch_assoc($sql_cate_1,1);
						$cate .= $data_cate_1['ten_chuyen_muc'].', ';
					}
					else
					{
						$cate .= '<span class="text-danger">Lỗi</span>, ';
					}
					$sql_cate_2 = "SELECT * FROM chuyenmuc WHERE id_cate = '$list_post[cate_2_id]' AND type = '2'";
					if($db->num_rows($sql_cate_2))
					{
						$data_cate_2 = $db->fetch_assoc($sql_cate_2,1);
						$cate .= $data_cate_2['ten_chuyen_muc'].', ';
					}
					else
					{
						$cate .= '<span class="text-danger">Lỗi</span>, ';
					}
					$sql_cate_3 = "SELECT * FROM chuyenmuc WHERE id_cate = '$list_post[cate_3_id]' AND type = '3'";
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
					if($list_post['trang_thai'] == 0)
					{
						$status = '<div class="label label-warning">Ẩn</div>';
					}
					else
					{
						$status = '<div class="label label-success">Xuất bản</div>';
					}
					//Tác giả
					$sql_author = "SELECT * FROM taikhoan WHERE id_tk = '$list_post[tac_gia]'";
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
							<td><input type="checkbox" name="id_post[]" value="'.$list_post['id_post'].'"</td>
							<td>'.$list_post['id_post'].'</td>
							<td style="width: 30%">
								<a href="'.$_DOMAIN.'post/edit/'.$list_post['id_post'].'">'.$list_post['tieu_de'].'
								</a>
							</td>
							<td style="width: 20%">'.$cate.'</td>
							<td>'.$status.'</td>
							<td>'.$list_post['luot_xem'].'</td>';
					if($data_user['quyen'] == 1)
					{
						echo '<td>'.$tac_gia.'</td>';
					}
					echo 
						'<td>
							<a href="'.$_DOMAIN.'post/edit/'.$list_post['id_post'].'" class="btn btn-info btn-sm">
								<span class="fa fa-edit"></span>
							</a>
							<a class="btn btn-danger btn-sm del_post" data-id="'.$list_post['id_post'].'" >
								<span class="fa fa-trash"></span>
							</a>		
						</td>';	
				}
				echo "</table>";

				// Phân trang
				echo '<div class="btn-group" id="pagination">';
				if($current_page > 1 && $total_page > 1)
				{
					echo 	'<a href="'.$_DOMAIN.'post&page='.($current_page - 1).'" class="btn btn-default">
								<span class="fa fa-chevron-left>"> Prev
							</a>' ;
				}
				for ($i=1; $i <= $total_page; $i++) { 
					if($current_page == $i)
					{
						echo '<a class="btn btn-default active">'.$current_page.'</a>';
					}
					else
					{
						echo '<a href="'.$_DOMAIN.'post&page='.$i.'" class="btn btn-default">'.$i.'</a>';
					}
				}
				if($current_page <$total_page && $total_page > 1)
				{
					echo 	'<a href="'.$_DOMAIN.'post&page='.($current_page + 1).'" class="btn btn-default">
								<span class="fa fa-chevron-right>"> Next
							</a>' ;
				}
				echo "</div>";
			}
		}	
	}
	else
	{
		new Redirect($_DOMAIN);
	}
?>
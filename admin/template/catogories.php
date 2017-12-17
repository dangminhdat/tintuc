
<?php

// Nếu đăng nhập
if($user)
{
	// Nếu là tác giả
	if($data_user['quyen'] == 0)
	{
		echo 
		'
		<div class="alert alert-danger">
		    <strong>Error!</strong> Bạn không có đủ quyền để vào trang này.
		</div>
		';
	}
	else
	{
		echo "<h3>Chuyên mục</h3>";
		// Lấy tham số ac
		if(isset($_GET['ac']))
		{
			$ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
		}
		else
		{
			$ac = '';
		}
		//Lấy tham số id
		if(isset($_GET['id']))
		{
			$id = trim(addslashes(htmlspecialchars($_GET['id'])));
		}	
		else
		{
			$id = '';
		}
		// kiểm tra ac
		if($ac != '')
		{
			// Nếu thêm chuyên mục
			if($ac == 'add')
			{
				// Nút trở về
				echo 
				'
				<a class="btn btn-default" href="'.$_DOMAIN.'catogories">
					<span class="fa fa-arrow-left"></span> Trở về
				</a>	
				';
				// Thêm chuyên mục
				echo 
				'
				<p class="form-add-cate">
					<form method="POST" onsubmit="return false" id="formChuyenMuc">
						<div class="form-group">
							<label>Tên chuyên mục</label>
							<input type="text" class="form-control title" id="label-add-cate">
						</div>
						<div class="form-group">
							<label>URL chuyên mục</label>
							<input type="text" class="form-control slug" placeholder="Nhấp vào để tự tạo" id="url-add-cate">
						</div>
						<div class="form-group">
							<label>Loại chuyên mục</label>
							<div class="radio">
								<label>
									<input type="radio" name="type-add-cate" class="type-add-cate-1" value="1"> Lớn
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="type-add-cate" class="type-add-cate-2" value="2"> Vừa
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="type-add-cate" class="type-add-cate-3" value="3"> Nhỏ
								</label>
							</div>
						</div>
						<div class="form-group hidden parent-add-cate">
							<label>Parent chuyên mục</label>
							<select id="parent-add-cate" class="form-control">
							</select>
						</div>
						<div class="form-group">
							<label>Sort chuyên mục</label>
							<input type="text" class="form-control" id="sort-add-cate">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Tạo</button>
						</div>
						<div class="alert alert-danger hidden"></div>
					</form>
				</p>
				';		
			}
			else if($ac == 'edit')
			{
				// Sửa chuyên mục
				$sql_edit_cate = "SELECT * FROM chuyenmuc WHERE id_cate = '$id'";
				if($db->num_rows($sql_edit_cate))
				{
					// Nút
					echo 
					'
						<a href="'.$_DOMAIN.'catogories" class="btn btn-default">
							<span class="fa fa-arrow-left"></span> Trở về
						</a>
						<a class="btn btn-danger" style="color: #fff" id="del_cate" data-id="'.$id.'">
							<span class="fa fa-trash"></span> Xóa
						</a>		
					';
					$value = $db->fetch_assoc($sql_edit_cate,1);
					$type_checked_1 = '';
					$type_checked_2 = '';
					$type_checked_3 = '';
					if($value['type'] == 1)
					{
						$type_checked_1 = 'checked';
						$parent_edit = 
							'<div class="form-group hidden parent-edit-cate">
								<label>Parent chuyên mục</label>
								<select id="parent-edit-cate" class="form-control">
								</select>
							</div>	
							';
					}
					else if($value['type'] == 2)
					{
						$type_checked_2 = 'checked';
						$parent_edit =
							'<div class="form-group parent-edit-cate">
								<label>Parent chuyên mục</label>
								<select id="parent-edit-cate" class="form-control">';
							$sql_edit_cate_2 = "SELECT * FROM chuyenmuc WHERE type = '1'";
							if($db->num_rows($sql_edit_cate_2))
							{
								foreach ($db->fetch_assoc($sql_edit_cate_2,0) as $key => $edit_cate) {
									if($value['id_parent'] == $edit_cate['id_cate'])
									{
										$parent_edit .= '<option value="'.$edit_cate['id_cate'].'" selected>'.$edit_cate['ten_chuyen_muc'].'</option>';
									}
									else
									{
										$parent_edit .= '<option value="'.$edit_cate['id_cate'].'">'.$edit_cate['ten_chuyen_muc'].'</option>';
									}	
								}
							}
							else{
								$parent_edit .= '<option value="0">Hiện tại chưa có chuyên mục cha nào</option>';
							}		

						$parent_edit .= '</select>
								</div>';
					}
					else if($value['type'] == 3)
					{
						$type_checked_3 = 'checked';
						$parent_edit = 
							'<div class="form-group hidden parent-edit-cate">
								<label>Parent chuyên mục</label>
								<select id="parent-edit-cate" class="form-control">
								</select>
							</div>	
							';
					}

						echo 
							'<p class="form-edit-cate">
								<form method="POST" onsubmit="return false" id="formSuaChuyenMuc" data-id="'.$value['id_cate'].'">
									<div class="form-group">
										<label>Tên chuyên mục</label>
										<input type="text" class="form-control title" value="'.$value['ten_chuyen_muc'].'" id="label-edit-cate">
									</div>
									<div class="form-group">
										<label>URL chuyên mục</label>
										<input type="text" class="form-control slug" value="'.$value['url'].'" placeholder="Nhấp vào để tự tạo" id="url-edit-cate">
									</div>
									<div class="form-group">
										<label>Loại chuyên mục</label>
										<div class="radio">
											<label>
												<input type="radio" name="type-edit-cate" class="type-edit-cate-1" '.$type_checked_1.' value="1"> Lớn
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="type-edit-cate" class="type-edit-cate-2" '.$type_checked_2.' value="2"> Vừa
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="type-edit-cate" class="type-edit-cate-3" '.$type_checked_3.' value="3"> Nhỏ
											</label>
										</div>
									</div>
										'.$parent_edit.'
									<div class="form-group">
										<label>Sort chuyên mục</label>
										<input type="text" class="form-control" value="'.$value['sort'].'" id="sort-edit-cate">
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
									</div>
									<div class="alert alert-danger hidden"></div>
								</form>
							</p>';
					

				}
				else
				{
					echo "<div class='alert alert-danger'>ID chuyên mục đã bị xóa hoặc không tồn tại</div>";
				}	
			}
			else
			{
				new Redirect($_DOMAIN.'catogories');
			}	
		}
		else
		{
			echo 
			'
				<a class="btn btn-default" href="'.$_DOMAIN.'catogories/add">
					<span class="fa fa-plus"></span> Thêm
				</a>
				<a class="btn btn-default" href="'.$_DOMAIN.'catogories">
					<span class="fa fa-repeat"></span> Reload
				</a>
				<a class="btn btn-danger" id="del_list_cate" style="color: #fff">
					<span class="fa fa-trash"></span> Xóa
				</a>
			';
			$sql_list = "SELECT * FROM chuyenmuc ORDER BY id_cate DESC";
			if($db->num_rows($sql_list))
			{
				echo 
				'
					<br><br>
					<div class="table-responsive">
						<table class="table table-striped list" id="list_cate">
							<tr>
								<td><input type="checkbox"></td>
								<td><strong>ID</strong></td>
								<td><strong>Tên chuyên mục</strong></td>
								<td><strong>Loại</strong></td>
								<td><strong>Chuyên mục cha</strong></td>
								<td><strong>Sort</strong></td>
								<td><strong>Tools</strong></td>
							</tr>	
				';
				foreach ($db->fetch_assoc($sql_list,0) as $key => $value) {
					
					$sql_parent = "SELECT * FROM chuyenmuc WHERE id_cate = '$value[id_parent]'";
					if($db->num_rows($sql_parent))
					{
						$data = $db->fetch_assoc($sql_parent,1);
						if($data['type'] == 1 && $value['type'] == 3)
						{
							$parent = '<p class="text-danger">Lỗi</p>';
						}
						else if($data['type'] == 3 && $value['type'] == 2)
						{
							$parent = '<p class="text-danger">Lỗi</p>';
						}
						else if($data['type'] == 3 && $value['type'] == 1)
						{
							$parent = '<p class="text-danger">Lỗi</p>';
						}
						else if($data['type'] == $value['type'])
						{
							$parent = '<p class="text-danger">Lỗi</p>';
						}
						else
						{
							$parent = $data['ten_chuyen_muc'];
						}	
					}
					else
					{
						$parent = "";
					}

					// Lọai
					if($value['type'] == 1)
					{
						$value['type'] = 'Lớn';
					}
					else if($value['type'] == 2)
					{
						$value['type'] = 'Vừa';
					}
					else if($value['type'] == 3)
					{
						$value['type'] = 'Nhỏ';
					}

					echo 
							'<tr>
								<td><input type="checkbox" name="id_cate[]" value="'.$value['id_cate'].'"></td>
								<td>'.$value['id_cate'].'</td>
								<td>
									<a href="'.$_DOMAIN.'catogories/edit/'.$value['id_cate'].'">
										'.$value['ten_chuyen_muc'].'
									</a>
								</td>
								<td>'.$value['type'].'</td>
								<td>'.$parent.'</td>
								<td>'.$value['sort'].'</td>
								<td>
									<a href="'.$_DOMAIN.'catogories/edit/'.$value['id_cate'].'" class="btn btn-info btn-sm">
										<span class="fa fa-edit"></span>
									</a>	
									<a class="btn btn-danger btn-sm del_cate" data-id="'.$value['id_cate'].'">
										<span class="fa fa-trash"></span>
									</a>	
								</td>
							</tr>';	
				}
			}
			else
			{
				echo '<br><br><div class="alert alert-info">Hiện tại chưa có chuyên mục nào</div>';
			}	
		}	
	}	
}
?>
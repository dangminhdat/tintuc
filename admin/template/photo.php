<?php if(!defined("DAT_DANG")) die("Page Not Found"); ?>
<?php
	// Xử lý database
	require_once 'core/init.php';

	if($user)
	{
		echo "<h3>Hình ảnh</h3>";

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
			if($ac == 'add')
			{
				echo 
				'
					<a href="'.$_DOMAIN.'photo"	class="btn btn-default">
						<span class="fa fa-arrow-left"></span> Trở về
					</a>	
				';
				//Upload ảnh
				echo 
				'
					<p class="form-upload-anh">
						<div class="alert alert-info">Mỗi lần upload tối đa 20 file ảnh. Mỗi file có dung lượng không vượt quá 5MB và có đuôi định dạng là .jpg, .png.gif.,</div>
						<form action="'.$_DOMAIN.'photo.php" method="POST" onsubmit="return false;" id="formUpload" enctype="multipart/form-data">
							<div class="form-group">
								<label>Chọn hình ảnh</label>
								<input type="file" accept="image/*" name="img_up[]" id="img_up" 
							onchange="pre_img()" class="form-control" multiple="true">
							</div>
							<div class="form-group box_pre_img hidden">
								<label>Ảnh xem trước</label>
							</div>
							<div class="form-group box_progress hidden">
								<div class="progress">
									<div class="progress-bar"></div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Upload</button>
								<button type="reset" class="btn btn-default">Chọn lại</button>
							</div>
							<div class="alert alert-danger hidden"></div>				
						</form>
					</p>
				';
			}
		}
		else
		{
			echo 
			'
				<a href="'.$_DOMAIN.'photo/add" class="btn btn-default">
					<span class="fa fa-plus"></span> Thêm
				</a>
				<a href="'.$_DOMAIN.'photo" class="btn btn-default">
					<span class="fa fa-repeat"></span> Reload
				</a>
				<a id="del_list_img" class="btn btn-danger">
					<span class="fa fa-trash"></span> Xóa
				</a>	
			';

			$sql = "SELECT * FROM hinhanh WHERE tac_gia = '$data_user[id_tk]' ORDER BY id_img DESC";
			if($db->num_rows($sql))
			{
				echo '<div class="row list" id="list_img">
						<div class="col-xs-12">
							<div class="checkbox">
								<label>
									<input type="checkbox"> Chọn/Bỏ chọn tất cả
								</label>
							</div>
						</div>';
				foreach ($db->fetch_assoc($sql,0) as $key => $value) {
						//Trạng thái
						if(file_exists('../'.$value['url']))
						{
							$status = '<span class="label label-success">Tồn tại</span>';
						}
						else
						{
							$status = '<span class="label label-danger">Hỏng</span>';
						}

						if($value['size'] < 1024)
						{
							$size = $value['size']."B";
						}
						else if($value['size'] < (1024*1024))
						{
							$size = round($value['size']/1024)."KB";
						}
						else if($value['size'] < (1024*1024*1024))
						{
							$size = round($value['size']/1024/1024)."MB";
						}

						$type = strtoupper($value['type']);

						echo 
						'
							<div class="col-md-3">
								<div class="thumbnail">
									<a href="'.str_replace('admin/','',$_DOMAIN).$value['url'].'">
										<img src="'.str_replace('admin/','',$_DOMAIN).$value['url'].'" class="img-responsive" style="height: 120px">
									</a>
									<div class="caption">
										<div class="input-group">
											<div class="input-group-addon">
												<input type="checkbox" value="'.$value['id_img'].'">
											</div>
											<input type="text" value="'.str_replace('admin/','',$_DOMAIN).$value['url'].'" class="form-control" disabled>
											<div class="input-group-btn">
												<button class="btn btn-danger del_img" data-id="'.$value['id_img'].'">
													<span class="fa fa-trash"></span>	
												</button>				
											</div>	
										</div>
										<p> Trạng thái: '.$status.'</p>
										<p> Kích thước: '.$size.'</p>
										<p> Định dạng: '.$type.'</p>
									</div>
								</div>	
							</div>		
						';
					}
				echo "</div>";		
			}
			else
			{
				echo '<br><br><div class="alert alert-info"">Hiện tại chưa có hình ảnh nào.</div>';
			}
		}
	}
	else
	{
		new Redirect($_DOMAIN);
	}
?>
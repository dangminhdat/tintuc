<?php if(!defined("DAT_DANG")) die("Page Not Found"); ?>
<div class="col-md-3 sidebar">
	<ul class="list-group">
		<li class="list-group-item">
			<div class="media">
				<a class="media-left" href="#">
					<img class="media-object" src="
					<?php
						if(!isset($data_user['url_avatar']) || $data_user['url_avatar'] == '') 
						{
							echo $_DOMAIN."img/user.gif";
						} 
						else 
						{
							echo str_replace('admin/','',$_DOMAIN).$data_user['url_avatar'];
						}
					?>
					" alt="" width="64" height="64">
				</a>
				<div class="media-body">
					<h4 class="media-heading"><?php echo isset($data_user['ten_hien_thi']) ? $data_user['ten_hien_thi']:'Khách'; ?></h4>
					<?php
						if(isset($data_user['quyen']) && $data_user['quyen'] == 1) 
						{
							echo '<span class="label label-primary">Quản trị viên</span>';
						} 
						else 
						{
							echo '<span class="label label-success">Tác giả</span>';
						}
					?>
				</div>
			</div>	
		</li>
		<a class="list-group-item active" href="<?php echo $_DOMAIN; ?>">
			<span class="fa fa-dashboard"></span> Bảng điều khiên
		</a>
		<a class="list-group-item" href="<?php echo $_DOMAIN; ?>profile">
			<span class="fa fa-user"></span> Hồ sơ cá nhân
		</a>
		<a class="list-group-item" href="<?php echo $_DOMAIN; ?>post">
			<span class="fa fa-edit"></span> Bài viết
		</a>
		<a class="list-group-item" href="<?php echo $_DOMAIN; ?>photo">
			<span class="fa fa-picture-o"></span> Hình ảnh
		</a>
		<?php
			if(isset($data_user['quyen']) && $data_user['quyen'] == 1) 
			{
				echo
				'
				<a class="list-group-item" href="'.$_DOMAIN.'catogories">
					<span class="fa fa-tag"></span> Chuyên mục
				</a>
				<a class="list-group-item" href="'.$_DOMAIN.'account">
					<span class="fa fa-lock"></span> Tài khoản
				</a>
				<a class="list-group-item" href="'.$_DOMAIN.'setting">
					<span class="fa fa-cog"></span> Cài đặt chung 
				</a>
				';
			}
		?>		
		<a class="list-group-item" href="<?php echo $_DOMAIN; ?>signout.php">
			<span class="fa fa-sign-out"></span> Đăng xuất
		</a>
	</ul>
</div>
<?php if(!defined("DAT_DANG")) die("Page Not Found"); ?>
	<!-- liên kết jquery.form.min.js -->
	<script src="<?php echo $_DOMAIN; ?>js/jquery.form.min.js"></script>
	<!-- liên kết ckeditor -->
	<script src="<?php echo $_DOMAIN; ?>ckeditor/ckeditor.js"></script>
	
	<!-- liên kết các file js -->
	<script src="<?php echo $_DOMAIN; ?>js/signin.js"></script>
	<script src="<?php echo $_DOMAIN; ?>js/catogories.js"></script>
	<script src="<?php echo $_DOMAIN; ?>js/account.js"></script>	
	<script src="<?php echo $_DOMAIN; ?>js/setting.js"></script>
	<script src="<?php echo $_DOMAIN; ?>js/post.js"></script>
	<script src="<?php echo $_DOMAIN; ?>js/photo.js"></script>	
	<script src="<?php echo $_DOMAIN; ?>js/profile.js"></script>		
<?php
	if (isset($_GET['tab'])) 
	{
		$tab = trim(addslashes(htmlspecialchars($_GET['tab'])));
	} 
	else 
	{
		$tab = '';
	}

	if ($tab != '') 
	{
		echo "<script>$('.sidebar ul a:eq(1)').removeClass('active');</script>";
		if ($tab == 'profile') 
		{
			echo "<script>$('.sidebar ul a:eq(2)').addClass('active');</script>";
		} 
		else if ($tab == 'post') 
		{
			echo "<script>$('.sidebar ul a:eq(3)').addClass('active');</script>";
			if(isset($ac) && $ac == 'edit')
			{
				if($id)
				{
					$sql = "SELECT * FROM baiviet WHERE id_post = '$id'";
					if($db->num_rows($sql))
					{
						echo 
						'
							<script>
				                config = {};
				                config.entities_latin = false;
				                config.language = "vi";
				                CKEDITOR.replace("body_edit_post", config);
				            </script>
						';
					}
				}
			}
		} 
		else if ($tab == 'photo') 
		{
			echo "<script>$('.sidebar ul a:eq(4)').addClass('active');</script>";
		} 
		else if ($tab == 'catogories') 
		{
			echo "<script>$('.sidebar ul a:eq(5)').addClass('active');</script>";
		} 
		else if ($tab == 'account') 
		{
			echo "<script>$('.sidebar ul a:eq(6)').addClass('active');</script>";
		} 
		else if ($tab == 'setting') 
		{
			echo "<script>$('.sidebar ul a:eq(7)').addClass('active');</script>";
		}
	}
?>	

</body>
</html>
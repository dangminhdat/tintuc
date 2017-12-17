<?php if(!defined("DAT_DANG")) die("Page Not Found"); ?>
<div class="col-md-9 content">
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
		if ($tab == 'profile') 
		{
			require_once 'template/profile.php';
		} 
		else if ($tab == 'post') 
		{
			require_once 'template/post.php';
		} 
		else if ($tab == 'photo') 
		{
			require_once 'template/photo.php';
		}
		else if ($tab == 'catogories') 
		{
			require_once 'template/catogories.php';
		} 
		else if ($tab == 'account') 
		{
			require_once 'template/account.php';
		} 
		else if ($tab == 'setting') 
		{
			require_once 'template/setting.php';
		}
		else
		{
			require_once 'template/404.php';
		}	
	} 
	else 
	{
		require_once 'template/dashboard.php';
	}
?>
</div>

<?php
	// Xử lý database
	require_once 'core/init.php';

	if($user)
	{
		if(isset($_POST['action']))
		{
			$action = trim(addslashes(htmlspecialchars($_POST['action'])));
		}

		if($action == 'status_web')
		{
			$status_web = trim(addslashes(htmlspecialchars($_POST['status_web'])));
			if(preg_match('#\d#',$status_web))
			{
				$sql = "UPDATE website SET trang_thai = '$status_web'";
				$db->query($sql);
				$db->disconnect();
			}
		}
		else if($action == 'edit_web')
		{
			$title = trim(addslashes(htmlspecialchars($_POST['title'])));
			$decrip = trim(addslashes(htmlspecialchars($_POST['decrip'])));
			$keywords = trim(addslashes(htmlspecialchars($_POST['keywords'])));
			$sql_update = "UPDATE website SET tieu_de = '$title',mieu_ta = '$decrip',tu_khoa = '$keywords'";
			$db->query($sql_update);
			$db->disconnect();
		}
	}
	else
	{
		new Redirect($_DOMAIN);
	}
?>
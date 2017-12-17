<?php
	// Xử lý database
	require_once 'core/init.php';

	if($user)
	{
		if(isset($_FILES['img_up']))
		{
			foreach ($_FILES['img_up']['name'] as $key => $value) {
				$folder = '../upload';
				$name_file = stripslashes($_FILES['img_up']['name'][$key]);
				$tmp_file = $_FILES['img_up']['tmp_name'][$key];

				$day = substr($date_current,8,2);
				$month = substr($date_current,5,2);
				$year = substr($date_current,0,4);

				if(!is_dir($folder.$year))
				{
					mkdir($folder.$year.'/');
				}
				if(!is_dir($folder.$year.'/'.$month))
				{
					mkdir($folder.$year.'/'.$month.'/');
				}
				if(!is_dir($folder.'/'.$year.'/'.$month.'/'.$day))
				{
					mkdir($folder.'/'.$year.'/'.$month.'/'.$day.'/');
				}
				$path = $folder.'/'.$year.'/'.$month.'/'.$day.'/'.$name_file;

				move_uploaded_file($tmp_file,$path);

				$type = substr($name_file,-3);
				$size = $_FILES['img_up']['size'][$key];
				$url = substr($path,3);

				$sql_insert = "INSERT INTO hinhanh VALUES(
					'',
					'$url',
					'$type',
					'$size',
					'$data_user[id_tk]',
					'$date_current')";
				$db->query($sql_insert);
			}
			echo "Thêm hình ảnh thành công";
			$db->disconnect();
			new Redirect($_DOMAIN.'photo');
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
			if($action == 'del_list_img')
			{
				foreach ($_POST['id_img'] as $key => $value) {
					$sql = "SELECT * FROM hinhanh WHERE id_img = '$value'";
					if($db->num_rows($sql))
					{
						$data = $db->fetch_assoc($sql,1);
						if(file_exists('../newspaper/'.$data['url']))
						{
							unlink('../newspaper/'.$data['url']);
						}
						$sql_del_list = "DELETE FROM hinhanh WHERE id_img = '$value'";
						$db->query($sql_del_list);
					}
				}
				$db->disconnect();
				echo "Xóa thành công";				
			}
			else if($action == "del_img")
			{
				$value = trim(addslashes(htmlspecialchars($_POST['id_img'])));
				$sql = "SELECT * FROM hinhanh WHERE id_img = '$value'";
				if($db->num_rows($sql))
				{
					$data = $db->fetch_assoc($sql,1);
					$sql_del = "DELETE FROM hinhanh WHERE id_img = '$value'";
					if(file_exists('../newspaper/'.$data['url']))
					{
						unlink('../newspaper/'.$data['url']);
					}
					$db->query($sql_del);
					$db->disconnect();
					echo "Xóa thành công";
				}
			}
		}
		else
		{
			new Redirect($_DOMAIN."photo");
		}

	}
	else
	{
		new Redirect($_DOMAIN);
	}
?>
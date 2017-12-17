<?php // Định nghĩa một hằng số bảo vệ project ?>
<?php define("DAT_DANG", true); ?>
<?php
	// Require các thư viện PHP
	require_once 'classes/database.php';
	require_once 'classes/session.php';
	require_once 'classes/function.php';

	$db = new database();
	$db->connect();
	$db->set_charset('utf8');

	$_DOMAIN = 'http://datdangtin.byethost17.com/admin/';

	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$date_current = '';
	$date_current = date('Y-m-d h:i:sa');
	
	$session = new session();
	$session->start();

	if($session->get_session('dangminhdat.com') != NULL) 
	{
		$user = $session->get_session('dangminhdat.com');
	} 
	else 
	{
		$user = NULL;
	}

	if ($user) 
	{
		$sql_user = "SELECT * FROM taikhoan WHERE username = '$user'";
		if($db->num_rows($sql_user)) 
		{
			$data_user = $db->fetch_assoc($sql_user,1);
		}
	}
	
?>

<?php
	session_start();
	require_once 'core/init.php';
	// error_reporting(0);

	if($trang_thai_web['trang_thai'] == 1 || isset($_SESSION['dangminhdat.com']))
	{
		require_once 'includes/header.php';

		require_once 'includes/sidebar.php';

		require_once 'includes/tinxemnhieu.php';

		require_once 'includes/footer.php';
	}
	else
	{
		echo "<p style='font-size: 50px; text-align: center'>Web đang trong thời gian bảo trì và update!</p>";
	}	
?>	
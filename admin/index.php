<?php
	
	require_once 'core/init.php';

	require_once 'includes/header.php';

	if ($user) 
	{
		require_once 'template/sidebar.php';

		require_once 'template/content.php';
	}
	else
	{
		require_once 'template/signin.php';
	}	

	require_once 'includes/footer.php';
?>
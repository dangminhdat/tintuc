<?php if(!defined("DAT_DANG")) die("Page Not Found"); ?>
<?php
/**
* 	session
*/
class session
{
	// hàm start session
	public function start()
	{
		session_start();
	}

	// hàm gán session
	public function set_session($key,$value)
	{
		$_SESSION[$key] = $value;
	}

	// hàm lấy dữ liệu session
	public function get_session($key)
	{
		if (isset($_SESSION[$key])) {
			$user = $_SESSION[$key];
		}else {
			$user = NULL;
		}
		return $user;
	}
	
	// hàm hủy
	public function destroy()
	{
		session_destroy();
	}
}
?>
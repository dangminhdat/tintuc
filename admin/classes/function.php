<?php if(!defined("DAT_DANG")) die("Page Not Found"); ?>
<?php
/**
* 	function
*/
class redirect
{
	
	function __construct($url = NULL)
	{
		if($url)
		{
			echo "<script> location.href = '".$url."'</script>";
		}
	}
}
?>
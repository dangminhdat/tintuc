<?php
	require_once '../model/m_tin_tuc.php';
	
	$user_id = $_POST['user'];
	$m_tin_tuc = new M_tin_tuc();
	$messenger = $m_tin_tuc->messenger_list();
	if(@$user_id != '')
	{
	foreach ($messenger as $key => $value) {
		$date = $value['ngay_tao'];
		$hour = substr($date,11,2);
		$minute = substr($date,14,2);
		$day = substr($date,8,2);
		$month = substr($date,5,2);
		$year = substr($date,0,4);
		if($value['user_id'] == $user_id)
		{
?>	
	<div class="msg-user">
		<p><?=$value['noi_dung']?></p>
		<span>Bạn - <?=$day.'/'.$month.'/'.$year?> lúc <?=$hour.':'.$minute?></span>
	</div>
<?php	
		}
		else
		{
?>
	<div class="msg">
		<p><?=$value['noi_dung']?></p>
		<span><?=$value['user_id']?> - <?=$day.'/'.$month.'/'.$year?> lúc <?=$hour.':'.$minute?></span>
	</div>
<?php			
		}
	}
	}
	else
	{
		echo "<p align='center'>Vui lòng đăng nhập</p>";
	}	
?>		
<?php

	if(isset($_GET['id_cate1']) && isset($_GET['id_post']))
	{
		$luot_xem = $c_tin_tuc->luot_xem();
		$tin_chi_tiet = $c_tin_tuc->tin_chi_tiet();
		$tieu_de_chuyenmuc = $c_tin_tuc->tieu_de_chuyenmuc();
		$tin = $tin_chi_tiet['tin_chi_tiet'];
		$comment = $tin_chi_tiet['comment'];
		$active = $tin_chi_tiet['active'];
		$tin_lien_quan = $tin_chi_tiet['tin_lien_quan'];
		$sum_comment = $tin_chi_tiet['sum_comment'];
		if($tieu_de_chuyenmuc['cate_2']['ten_chuyen_muc'] == '' && $tieu_de_chuyenmuc['cate_1']['ten_chuyen_muc'] != '' || $tieu_de_chuyenmuc['cate_1']['ten_chuyen_muc'] != '')
		{	
			require_once 'tinchitiet.php';
		}
		else
		{
			require_once 'error.php';
		}	
?>
	</div> <!-- hết noidungchinh -->

<div class="noidungphu col-lg-4 float-lg-right">
<?php		
		require_once 'tinlienquan.php';
	}
	else if(isset($_GET['id_cate1']))
	{
		$tieu_de_chuyenmuc = $c_tin_tuc->tieu_de_chuyenmuc();
		$noidungtop = $c_tin_tuc->noidungtop();
		$tin_theo_loai = $c_tin_tuc->tin_theo_loai();
		$tin = $tin_theo_loai['tin'];
		$trang = $tin_theo_loai['trang'];
		if($tin || $noidungtop)
		{
			require_once 'tintheoloai.php';
		}
		else
		{
			require_once 'error.php';
		}
?>
</div> <!-- hết noidungchinh -->

<div class="noidungphu col-lg-4 float-lg-right">
<?php		
	}
	else
	{
		$tin_hot = $c_tin_tuc->tin_hot();
		$tin_xa_hoi = $c_tin_tuc->tin_xa_hoi();

		require_once 'tinhot.php';
		require_once 'tinxahoi.php';
?>
</div> <!-- hết noidungchinh -->

<div class="noidungphu col-lg-4 float-lg-right">
<?php		
	}
?>
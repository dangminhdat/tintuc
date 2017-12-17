<?php
require_once 'model/m_tin_tuc.php';
require_once 'model/pager.php';
/**
* 
*/
class C_tin_tuc
{
	
	public function menu1()
	{
		$m_tin_tuc = new M_tin_tuc();
		$menu1 = $m_tin_tuc->get_menu_type1();
		return $menu1;
	}
	public function menu2($id_cate)
	{
		$m_tin_tuc = new M_tin_tuc();
		$menu2 = $m_tin_tuc->get_menu_type2($id_cate);
		return $menu2;
	}
	public function menutop()
	{
		$m_tin_tuc = new M_tin_tuc();
		$menutop = $m_tin_tuc->menutop();
		return $menutop;
	}
	public function noidungtop()
	{
		$id_cate = isset($_GET['id_cate1'])?$_GET['id_cate1']:false;
		$m_tin_tuc = new M_tin_tuc();
		$noidungtop = $m_tin_tuc->noidungtop($id_cate);
		return $noidungtop;
	}
	public function tin_hot()
	{
		$m_tin_tuc = new M_tin_tuc();
		$tin_hot = $m_tin_tuc->tin_hot();
		return $tin_hot;
	}
	public function tin_xa_hoi()
	{
		$m_tin_tuc = new M_tin_tuc();
		$menu1 = $m_tin_tuc->get_menu_type1();
		for ($i=1; $i <= count($menu1); $i++) { 
			$tin_xa_hoi = $m_tin_tuc->tin_xa_hoi($i);
			$data[] = $tin_xa_hoi;
		}
		return $data;
	}
	
	public function tin_coi_nhieu()
	{
		$m_tin_tuc = new M_tin_tuc();
		$tin_coi_nhieu = $m_tin_tuc->tin_coi_nhieu();
		return $tin_coi_nhieu;
	}
	public function tin_the_loai($id_cate)
	{
		$m_tin_tuc = new M_tin_tuc();
		$tin_the_loai = $m_tin_tuc->tin_the_loai($id_cate);
		return $tin_the_loai;
	}
	public function tieu_de_chuyenmuc()
	{
		$id_cate = isset($_GET['id_cate1'])?$_GET['id_cate1']:false;
		$id_cate_con = isset($_GET['id_cate2'])?$_GET['id_cate2']:false;
		$m_tin_tuc = new M_tin_tuc();
		$tin_the_loai = $m_tin_tuc->tin_the_loai($id_cate);
		$tin_loai_tin = $m_tin_tuc->tin_loai_tin($id_cate_con);
		return array('cate_1'=>$tin_the_loai,'cate_2'=>$tin_loai_tin);
	}
	public function tin_loai_tin($id_cate_con)
	{
		$m_tin_tuc = new M_tin_tuc();
		$tin_loai_tin = $m_tin_tuc->tin_loai_tin($id_cate_con);
		$tin_the_loai = $m_tin_tuc->tin_the_loai($tin_loai_tin['id_parent']);
		return array('cate_1'=>$tin_the_loai['ten_chuyen_muc'],'cate_2'=>$tin_loai_tin['ten_chuyen_muc']);
	}
	public function tin_theo_loai()
	{
		$id_cate = isset($_GET['id_cate1'])?$_GET['id_cate1']:-1;
		$id_cate_con = isset($_GET['id_cate2'])?$_GET['id_cate2']:NULL;
		$page = isset($_GET['page'])?$_GET['page']:'1';

		$m_tin_tuc = new M_tin_tuc();
		$tin_theo_loai = $m_tin_tuc->tin_theo_loai($id_cate,$id_cate_con);
		$pager = new Pagination(count($tin_theo_loai),$page,2,4);
		$limit = $pager->limit;
		$vitri = ($page - 1)*$limit;
		$html_trang = $pager->show_html();
		$tin_theo_loai = $m_tin_tuc->tin_theo_loai($id_cate,$id_cate_con,$vitri,$limit);
		return array('tin'=>$tin_theo_loai,'trang'=>$html_trang);
	}
	public function tin_chi_tiet()
	{
		$id_post = (int)$_GET['id_post'];
		$id_cate = isset($_GET['id_cate1'])?$_GET['id_cate1']:-1;
		$id_cate_con = isset($_GET['id_cate2'])?$_GET['id_cate2']:NULL;
		$m_tin_tuc = new M_tin_tuc();
		$tin_chi_tiet = $m_tin_tuc->tin_chi_tiet($id_post);
		if($tin_chi_tiet['cate_2_id'] == 0)
		{
			$tin = $m_tin_tuc->tin_the_loai($tin_chi_tiet['cate_1_id']);
		}
		else
		{
			$tin = $m_tin_tuc->tin_loai_tin($tin_chi_tiet['cate_2_id']);
		}
		$tin_lien_quan = $m_tin_tuc->tin_lien_quan($id_post,$id_cate,$id_cate_con);
		$comment = $m_tin_tuc->comment($id_post);
		$sumComment = $m_tin_tuc->sumComment($id_post);
		if(count($comment) > 10)
		{
			$comment = $m_tin_tuc->comment($id_post,0,10);
		}
		return array('tin_chi_tiet'=>$tin_chi_tiet,'comment'=>$comment,'active'=>$tin,'tin_lien_quan'=>$tin_lien_quan,'sum_comment'=>$sumComment);
	}
	public function sumComment($id_post)
	{
		$m_tin_tuc = new M_tin_tuc();
		$sumComment = $m_tin_tuc->sumComment($id_post);
		return $sumComment;
	}
	public function luot_xem()
	{
		$id_post = (int)$_GET['id_post'];
		$m_tin_tuc = new M_tin_tuc();
		if(!isset($_SESSION[$id_post]))
		{
			$_SESSION[$id_post] = 1;
			$m_tin_tuc->luot_xem($id_post);
			return true;
		}
		return false;
	}
	public function trang_thai_web()
	{
		$m_tin_tuc = new M_tin_tuc();
		$trang_thai_web = $m_tin_tuc->trang_thai_web();
		return $trang_thai_web;
	}
}
?>
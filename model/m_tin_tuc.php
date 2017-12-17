<?php
require_once 'database.php';
/**
* 
*/
class M_tin_tuc extends database
{
	
	public function get_menu_type1()
	{
		$sql = "SELECT * FROM chuyenmuc WHERE type = 1";
		if($this->num_rows($sql))
		{
			return $this->fetch_assoc($sql,0);
		}
		return false;
	}
	public function get_menu_type2($id_cate)
	{
		$sql = "SELECT * FROM chuyenmuc WHERE type = 2 AND id_parent = '$id_cate'";
		if($this->num_rows($sql))
		{
			return $this->fetch_assoc($sql,0);
		}
		return false;
	}
	public function menutop()
	{
		$sql = "SELECT * FROM chuyenmuc WHERE type = 3";
		if($this->num_rows($sql))
		{
			return $this->fetch_assoc($sql,0);
		}
		return false;
	}
	public function noidungtop($id_cate)
	{
		$sql = "SELECT bv.*,cm.url AS url_cate,cm.ten_chuyen_muc FROM baiviet bv INNER JOIN chuyenmuc cm ON cm.id_cate = bv.cate_3_id WHERE cm.url = '$id_cate' AND bv.trang_thai = 1";
		if($this->num_rows($sql))
		{
			return $this->fetch_assoc($sql,1);
		}
		return false;
	}
	public function tin_hot()
	{
		$sql = "SELECT * FROM baiviet WHERE cate_3_id = 0 AND trang_thai = 1 ORDER BY id_post DESC LIMIT 1";
		$cate = $this->fetch_assoc($sql,1);
		if($cate['cate_2_id'] != 0)
		{	
			$sql2 = "SELECT DISTINCT bv.*,GROUP_CONCAT(cm.url) AS cmuc FROM chuyenmuc cm INNER JOIN baiviet bv ON cm.id_cate = bv.cate_1_id OR cm.id_cate = bv.cate_2_id WHERE bv.cate_2_id = '$cate[cate_2_id]' OR bv.cate_1_id = '$cate[cate_1_id]' AND bv.trang_thai = 1 GROUP BY bv.id_post ORDER BY bv.id_post DESC LIMIT 6";
		}
		else
		{
			$sql2 = "SELECT DISTINCT bv.*,GROUP_CONCAT(cm.url,',') AS cmuc FROM chuyenmuc cm INNER JOIN baiviet bv ON cm.id_cate = bv.cate_1_id OR cm.id_cate = bv.cate_2_id WHERE bv.cate_2_id = 0 AND bv.cate_1_id = '$cate[cate_1_id]' AND bv.trang_thai = 1 GROUP BY bv.id_post ORDER BY bv.id_post DESC LIMIT 6";
		}
		
		if($this->num_rows($sql2))
		{
			return $this->fetch_assoc($sql2,0);
		}
		return false;
	}

	public function tin_xa_hoi($id_cate)	
	{
		$sql = "SELECT DISTINCT bv.*,cm.ten_chuyen_muc,GROUP_CONCAT(cm.url) AS cmuc FROM chuyenmuc cm INNER JOIN baiviet bv ON cm.id_cate = bv.cate_1_id OR cm.id_cate = bv.cate_2_id WHERE bv.cate_1_id = '$id_cate' AND bv.trang_thai = 1 GROUP BY bv.id_post ORDER BY bv.id_post DESC LIMIT 6";
		if($this->num_rows($sql))
		{
			return $this->fetch_assoc($sql,0);
		}
		return false;
	}
	public function tin_coi_nhieu()
	{
		$sql = "SELECT bv.*,cm.ten_chuyen_muc,GROUP_CONCAT(cm.url) AS cmuc FROM baiviet bv INNER JOIN chuyenmuc cm ON cm.id_cate = bv.cate_1_id OR cm.id_cate = bv.cate_2_id WHERE bv.trang_thai = 1 GROUP BY bv.id_post ORDER BY bv.luot_xem DESC LIMIT 5";
		if($this->num_rows($sql))
		{
			return $this->fetch_assoc($sql,0);
		}
		return false;
	}
	public function tin_the_loai($id_cate)
	{
		$sql = "SELECT * FROM chuyenmuc WHERE url = '$id_cate' AND type = 1";
		if($this->num_rows($sql))
		{
			return $this->fetch_assoc($sql,1);
		}
		return false;
	}
	public function tin_loai_tin($id_cate)
	{
		$sql = "SELECT * FROM chuyenmuc WHERE type = 2 AND url = '$id_cate'";
		if($this->num_rows($sql))
		{
			return $this->fetch_assoc($sql,1);
		}
		return false;
	}
	public function tin_theo_loai($id_cate=-1,$id_cate_con=NULL,$vitri=-1,$limit=-1)
	{
		$sql = "SELECT bv.*,cm.ten_chuyen_muc,GROUP_CONCAT(cm.url) AS cmuc FROM baiviet bv INNER JOIN chuyenmuc cm ON bv.cate_1_id = cm.id_cate OR bv.cate_2_id = cm.id_cate WHERE bv.cate_1_id IN (SELECT id_cate FROM chuyenmuc WHERE url = '$id_cate') AND bv.trang_thai = 1 GROUP BY bv.id_post ORDER BY id_post DESC";
		if($id_cate_con != NULL)
		{
			$sql = "SELECT bv.*,cm.ten_chuyen_muc,GROUP_CONCAT(cm.url) AS cmuc FROM baiviet bv INNER JOIN chuyenmuc cm ON bv.cate_1_id = cm.id_cate OR bv.cate_2_id = cm.id_cate WHERE bv.cate_1_id IN (SELECT id_cate FROM chuyenmuc WHERE url = '$id_cate') AND bv.cate_2_id IN (SELECT id_cate FROM chuyenmuc WHERE url = '$id_cate_con') AND bv.trang_thai = 1 GROUP BY bv.id_post ORDER BY id_post DESC";
		}
		if($vitri > -1 && $limit > 0)
		{
			$sql .= " LIMIT $vitri,$limit";
		}
		if($this->num_rows($sql))
		{
			return $this->fetch_assoc($sql,0);
		}
		return false;
	}
	public function tin_chi_tiet($id_post)
	{
		$sql = "SELECT * FROM baiviet WHERE id_post = '$id_post' AND trang_thai = 1";
		return $this->fetch_assoc($sql,1);
	}
	public function tin_lien_quan($id_post,$id_cate=-1,$id_cate_con=-1)
	{
		$sql = "SELECT bv.*,cm.ten_chuyen_muc,GROUP_CONCAT(cm.url) AS cmuc FROM baiviet bv INNER JOIN chuyenmuc cm ON bv.cate_1_id = cm.id_cate OR bv.cate_2_id = cm.id_cate WHERE bv.cate_1_id IN (SELECT id_cate FROM chuyenmuc WHERE url = '$id_cate') AND bv.id_post != '$id_post' AND bv.trang_thai = 1 GROUP BY bv.id_post ORDER BY rand() LIMIT 5";
		if($id_cate_con != '')
		{
			$sql = "SELECT bv.*,cm.ten_chuyen_muc,GROUP_CONCAT(cm.url) AS cmuc FROM baiviet bv INNER JOIN chuyenmuc cm ON bv.cate_1_id = cm.id_cate OR bv.cate_2_id = cm.id_cate WHERE bv.cate_1_id IN (SELECT id_cate FROM chuyenmuc WHERE url = '$id_cate') AND bv.cate_2_id IN (SELECT id_cate FROM chuyenmuc WHERE url = '$id_cate_con') AND bv.id_post != '$id_post' AND bv.trang_thai = 1 GROUP BY bv.id_post ORDER BY rand() LIMIT 5";
		}
		if($this->num_rows($sql))
		{
			return $this->fetch_assoc($sql,0);	
		}
		return false;
	}
	public function sumComment($id_post)
	{
		$sql = "SELECT * FROM comment WHERE id_post = '$id_post'";
		return $this->num_rows($sql);
	}
	public function comment($id_post,$vitri = -1,$limit = -1)
	{
		$sql = "SELECT * FROM comment WHERE id_post = '$id_post' ORDER BY id_cm DESC";
		if($vitri > -1 && $limit > 0)
		{
			$sql .= " LIMIT $vitri,$limit";
		}
		if($this->num_rows($sql))
		{
			return $this->fetch_assoc($sql,0);
 		}
		return false;
	}
	public function addComment($id_post,$name,$email,$noidung,$url)
	{
		$sql = "INSERT INTO comment VALUES('','$name','$email','$noidung','$url','$id_post',now())";
		$this->query($sql);
	}
	public function timkiem($search)
	{
		$sql = "SELECT bv.*,cm.ten_chuyen_muc,GROUP_CONCAT(cm.url) AS cmuc FROM baiviet bv INNER JOIN chuyenmuc cm ON bv.cate_1_id = cm.id_cate OR bv.cate_2_id = cm.id_cate WHERE bv.tieu_de LIKE '%$search%' AND bv.trang_thai = 1 OR bv.mieu_ta LIKE '%$search%' AND bv.trang_thai = 1 OR bv.noi_dung LIKE '%$search%' AND bv.trang_thai = 1 OR bv.tu_khoa LIKE '%$search%' AND bv.trang_thai = 1 GROUP BY bv.id_post ORDER BY id_post DESC";
		if($this->num_rows($sql))
		{
			return $this->fetch_assoc($sql,0);
		}
		return false;	
	}
	public function luot_xem($id_post)
	{
		$sql = "UPDATE baiviet SET luot_xem = luot_xem + 1 WHERE id_post = '$id_post'";
		return $this->query($sql);
	}

	public function trang_thai_web()
	{
		$sql = "SELECT * FROM website";
		if($this->num_rows($sql))
		{
			return $this->fetch_assoc($sql,1);
		}
		return false;
	}
        public function messenger($mes,$user)
	{
		$sql = "INSERT INTO  messenger VALUES('','$mes','$user',now())";
		return $this->query($sql);
	}
	public function messenger_list()
	{
		$sql = "SELECT * FROM messenger";
		return $this->fetch_assoc($sql,0);
	}
}
?>
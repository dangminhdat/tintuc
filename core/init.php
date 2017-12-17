<?php
error_reporting(0);
require_once 'controller/c_tin_tuc.php';
$c_tin_tuc = new C_tin_tuc();
if(isset($_SESSION['dangminhdat.com']))
	$user = $_SESSION['dangminhdat.com'];
else $user = '';
$menutop = $c_tin_tuc->menutop();
$menu1 = $c_tin_tuc->menu1();
$tin_coi_nhieu = $c_tin_tuc->tin_coi_nhieu();
$trang_thai_web = $c_tin_tuc->trang_thai_web();
?>
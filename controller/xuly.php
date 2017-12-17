<?php
        session_start();
	require_once '../model/database.php';
	require_once '../model/m_tin_tuc.php';
	if(isset($_POST['action']))
	{
		$action = trim(addslashes(htmlspecialchars($_POST['action'])));

		if($action == 'comment')
		{
			$noidung = isset($_POST['noidung'])?trim(addslashes($_POST['noidung'])):false;
			$name = isset($_POST['name'])?trim(addslashes($_POST['name'])):false;
			$email = isset($_POST['email'])?trim(addslashes($_POST['email'])):false;
			$id_post = isset($_POST['id_post'])?trim(addslashes($_POST['id_post'])):false;
			$url = rand(1,10);
			$url .= '.png';
			if(!filter_var($email,FILTER_VALIDATE_EMAIL))
			{
				echo "<script>$('#AddComment .alert:eq(3)').removeClass('hidden-xs-up');</script>"."Email không hợp lệ";
			}
			else if(preg_match('#dm|cc|cl|ddm|loz|chó#',$noidung))
			{
				echo "<script>$('#AddComment .alert:eq(3)').removeClass('hidden-xs-up');</script>"."Từ ngữ không hợp lệ";
			}
			else
			{
			$m_tin_tuc = new M_tin_tuc();
			$m_tin_tuc->addComment($id_post,$name,$email,$noidung,$url);
			echo "<script>$('#AddComment .alert:eq(3)').attr('class','alert alert-success');</script>"."Gửi thành công";
			echo "<script>location.href = '".$_SERVER['HTTP_REFERER']."'</script>";
			}
		}
		else if($action == 'add_comment')
		{
			$id_post = isset($_POST['id_post'])?trim(addslashes($_POST['id_post'])):false;
			$m_tin_tuc = new M_tin_tuc();
			$comment = $m_tin_tuc->comment($id_post,10,100);
			// print_r($comment);
			foreach ($comment as $key => $value) {
				echo 
				'
					<div class="media">
						<a class="media-left media-top" href="#">
							<img class="media-object" src="public/img/logo11.png" width="120" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">'.$value['name'].'<small>'.$value['ngay_tao'].'</small></h4>
							<p>'.$value['noi_dung'].'</p>
							
						</div>
					</div>
				';
			}
		}
		else if($action == 'search')
		{
			$search = trim(addslashes(htmlspecialchars($_POST['search'])));
			$m_tin_tuc = new M_tin_tuc();
			$tintuc_timkiem = $m_tin_tuc->timkiem($search);
?>
			<ol class="breadcrumb hide">
				<li class="breadcrumb-item">Tìm được: <?php if($tintuc_timkiem) echo count($tintuc_timkiem);else echo "0"; ?> kết quả cho '<?=$search?>'</li>
			</ol>
			<div class="nd3">
<?php
			if($tintuc_timkiem)
			{
			foreach ($tintuc_timkiem as $key => $value) {
				if(preg_match('#\,#',$value['cmuc']))
				{
					list($cate1,$cate2) = explode(',',$value['cmuc']);
				}
				else
				{
					$cate1 = $value['cmuc'];
					$cate2 = '';
				}
?>
			<div class="col-xs-12 noidung3">
				<div class="media">	
					<a class="media-left" href="chitiet.php?id_post=<?=$value['id_post'].'&id_cate1='.$cate1.'&id_cate2='.$cate2?>">
						<img src="<?=$value['url']?>" class="media object img-fluid" alt="">
					</a>
					<div class="media-body">
						<p class="lead"><a href="chitiet.php?id_post=<?=$value['id_post'].'&id_cate1='.$cate1.'&id_cate2='.$cate2?>"><?=$value['tieu_de']?></a></p>
						<small><span class="fa fa-calendar"></span> JANUARY 29, 2017</small>
						<small><span class="fa fa-comments"></span> 11 COMMENTS</small>
						<p class="title"><?=html_entity_decode(substr($value['mieu_ta'],0,117).'..')?></p>
					</div>
				</div>
			</div>
<?php
				}
			}
?>
			</div>
<?php	
		}
                else if($action == 'send_mes')
		{
			$mes = trim(addslashes(htmlspecialchars($_POST['mes'])));
			$user_id = trim(addslashes(htmlspecialchars($_POST['user_id'])));
			$m_tin_tuc = new M_tin_tuc();
			if($user_id != '')
			{
				$m_tin_tuc->messenger($mes,$user_id);
			}
			else
			{
				echo "Vui lòng đăng nhập";
			}
		}
                else if($action == 'signin')
		{
			$username = trim(addslashes(htmlspecialchars($_POST['username'])));
			$password = trim(addslashes(htmlspecialchars($_POST['password'])));

			// Thông báo kết quả
			$show_alert = '<script>$("#DangNhap .alert").removeClass("hidden-xs-up");</script>';
			$hide_alert = '<script>$("#DangNhap .alert").addClass("hidden-xs-up");</script>';
			$success_alert = '<script>$("#DangNhap .alert").attr("class","alert alert-success");</script>';
			$db = new database();
			// Nếu giá trị rỗng
			if($username == '' || $password == '')
			{
				echo $show_alert.'Error: Vui lòng điền đầy đủ thông tin.';
			}
			else
			{	
				// Kiểm tra username
				$sql = "SELECT * FROM taikhoan WHERE username = '$username'";
				if($db->num_rows($sql))
				{
					$password = md5($password);	
					// Kiểm tra username, password và tài khoản có bị khóa không
					$sql = "SELECT * FROM taikhoan WHERE username = '$username' AND password = '$password' AND trang_thai = '0'";
					if($db->num_rows($sql))
					{
						// Bố trị session
						$_SESSION['dangminhdat.com'] = $username;
						$db->disconnect();

						echo $success_alert.'Đăng nhập thành công';
						echo "<script>location.reload();</script>";
					}
					else
					{
						echo $show_alert."Error: Mật khẩu không chính xác";
					}	
				}
				else
				{
					echo $show_alert."Error: Tên đăng nhập không tồn tại";
				}	
			}
		}
	}
?>	
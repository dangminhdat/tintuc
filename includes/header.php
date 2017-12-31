<?php

if(isset($_GET['id_cate1']) && isset($_GET['id_post']))
	{
		$tin_chi_tiet = $c_tin_tuc->tin_chi_tiet();
		$tin = $tin_chi_tiet['tin_chi_tiet'];
		$title = $tin['tieu_de'];
	}
	else if(isset($_GET['id_cate2']))
	{
		$tieu_de_chuyenmuc = $c_tin_tuc->tieu_de_chuyenmuc();
		if($tieu_de_chuyenmuc['cate_2']['ten_chuyen_muc'] != '')
		{
			$title = $tieu_de_chuyenmuc['cate_2']['ten_chuyen_muc'];
		}
		else
		{
			$title = "Không tìm thấy trang";
		}
	}
	else if(isset($_GET['id_cate1']))
	{
		$tieu_de_chuyenmuc = $c_tin_tuc->tieu_de_chuyenmuc();
		$noidungtop = $c_tin_tuc->noidungtop();
		if($tieu_de_chuyenmuc['cate_1']['ten_chuyen_muc'] != '')
		{
			$title = $tieu_de_chuyenmuc['cate_1']['ten_chuyen_muc'];
		}
		else if($noidungtop)
		{
			$title = $noidungtop['ten_chuyen_muc'];
		}
		else
		{
			$title = "Không tìm thấy trang";
		}
	}
	else
	{
		$title = $trang_thai_web['tieu_de'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$title?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="http://datdangtin.byethost17.com/">
    <link rel="stylesheet" href="public/vendor/bootstrap.css">
    <link rel="stylesheet" href="public/vendor/font-awesome.css">
    <link rel="stylesheet" href="public/sstyle.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-103296277-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
	
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=200334997060372";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		
		<div class="scroll">
			<div class="fa fa-arrow-up"></div>
		</div> <!-- hết scrollTop -->		

        <div class="container">
        	<div class="row">
            <div class="messenger">
			<p><span class="fa fa-commenting"></span> Tin nhắn <span class="fa fa-close float-xs-right"></span></p>
			<div class="main-chat">
			<!-- Load file auto.php -->			
			</div>
			<form method="post" onsubmit="return false" id="messenger" data-id="<?=$user?>">
				<div class="form-group">
					<input type="text" placeholder="Nhập nội dung tin nhắn.." class="form-control">
				</div>
			</form>
		</div>
		<div class="nut-messenger"><span class="fa fa-commenting"></span></div>
                </div></div>

	    <nav class="navbar navbar-dark bg-inverse menu1">
	        <div class="container">
	        	<div class="row">
		        	<div class="col-xs-12">
		        		<div class="collapse navbar-toggleable-sm menu1" id="menu">
		                    
		                    <ul class="nav navbar-nav">
		                 		<li class="nav-item">
		                        	<a class="nav-link" href="trang-chu">HOME</a>
		                      	</li>
		                      	<?php
		                      		if($menutop)
		                      		{	
		                      		foreach ($menutop as $key => $value) {
		                      	?>		
		                      	<li class="nav-item">
		                        	<a class="nav-link" href="<?=$value['url']?>"><?=$value['ten_chuyen_muc']?></a>
		                      	</li>
		                      	<?php
		                      		}}
                                               if(@!$user){
		                      	?>
                                        <li class="nav-item" data-toggle="modal" data-target="#mod">
		                        	<a class="nav-link">Đăng nhập</a>
		                      	</li>
                                        <?php
                                        }
                                        ?>
		                    </ul>
							<div class="col-xs-12">
			                    <ul class="nav navbar-nav float-md-right mangxahoi">
				                    
			                 		<li class="nav-item">
			                        	<a class="nav-link" href="http://facebook.com/dangminhdat.77"><span class="fa fa-facebook"></span></a>
			                      	</li>
			                      	<li class="nav-item">
			                        	<a class="nav-link" href="#"><span class="fa fa-twitter"></span></a>
			                      	</li>
			                      	<li class="nav-item">
			                        	<a class="nav-link" href="#"><span class="fa fa-google"></span></a>
			                      	</li>
			                      	<li class="nav-item">
			                        	<a class="nav-link" href="#"><span class="fa fa-youtube"></span></a>
			                      	</li>
			                      	<form class="form-inline navbar-form float-lg-right" id="TimKiem">
										<input type="text" class="form-control" id="search" placeholder="Search for...">
					    				<span class="input-group-btn">
					    					<button class="btn btn-secondary" type="button"><span class="fa fa-search"></span></button>
					    				</span>
		    						</form>
			                    </ul>
			                </div>    
		                </div>
		        		<button class="btn btn-default hidden-md-up" type="button" data-toggle="collapse" data-target="#menu">
		                    &#9776;
		                </button>
					</div>
	       		</div>
	        </div>
	    </nav> <!-- hết container -->
	   	
	   	<div class="logo">
	   		<div class="container">
	   			<div class="row">
	   				<div class="col-xs-3">
	   					<img src="public/img/logo11.png" class="img-responsive" alt="" width="200">
	   				</div>
	   				
	   				<!--<div class="col-xs-9">
	   					<div class="quangcao">
	   						<img src="public/img/1.png" class="img-responsive" alt="" height="150" width="600">
	   					</div>
	   					
	   				</div>-->
	   			</div>
	   		</div>
	   	</div> <!-- hết logo -->

		<nav class="navbar navbar-dark bg-inverse menu2">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
				        <button class="btn btn-default hidden-md-up" type="button" data-toggle="collapse" data-target="#menu2">
				            MENU
				        </button>
				        <div class="collapse navbar-toggleable-sm" id="menu2">
				            <a class="navbar-brand active" href="trang-chu"><span class="fa fa-home"></span></a>
				            <ul class="nav navbar-nav">
								
				           		<?php
				           			// print_r($menu1);
				           			foreach ($menu1 as $key => $value) {
				           				$menu2 = $c_tin_tuc->menu2($value['id_cate']);
				           				if($menu2)
				           				{
				           		?>
				           		<li class="nav-item dropdown">
					           		<!-- data-toggle="dropdown"  -->
									<a class="nav-link dropdown-toggle" href="<?=$value['url']?>" role="button" aria-haspopup="true" aria-expanded="false"><?=$value['ten_chuyen_muc']?></a>
									<div class="dropdown-menu">
				           		<?php		
				           					
				           				foreach ($menu2 as $key => $valueC) {
				           		?>
						           		<a class="dropdown-item" href="<?=$value['url'].'/'.$valueC['url']?>"><?=$valueC['ten_chuyen_muc']?></a>
						        <?php 		
						    				}
						    	?>			
									</div>
								</li>
				           		<?php
				           				}
				           				else
				           				{
				           		?>
										<li class="nav-item">
											<a href="<?=$value['url']?>" class="nav-link"><?=$value['ten_chuyen_muc']?></a>
										</li>
						    		
								<?php			
				           				}
				           			}		
				           		?>
				            	
									
									</div>
								</li>
							</ul>
						</div>
					</div>		
				</div>
			</div>	
		</nav> <!-- hết menu2 -->


		<div class="noidung" >
			<div class="container">
				<div class="row">
					<div class="noidungchinh col-lg-8 float-lg-left" id="show_timkiem">	
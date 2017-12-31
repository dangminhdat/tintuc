							<?php
								if($tin)
								{
							?>
							<ol class="breadcrumb hide">
								<li class="breadcrumb-item"><a href="<?=$tieu_de_chuyenmuc['cate_1']['url']?>"><?=$tieu_de_chuyenmuc['cate_1']['ten_chuyen_muc']?></a></li>
								<li class="breadcrumb-item"><a href="<?=$tieu_de_chuyenmuc['cate_1']['url'].'/'.$tieu_de_chuyenmuc['cate_2']['url']?>"><?=$tieu_de_chuyenmuc['cate_2']['ten_chuyen_muc']?></a></li>
							</ol>
						
						<div class="nd3">
							<?php
								// print_r($tin);
								
								foreach ($tin as $key => $value) {
									$hour = substr($value['ngay_tao'],11,2);
									$minute = substr($value['ngay_tao'],14,2);
									$day = substr($value['ngay_tao'],8,2);
									$month = substr($value['ngay_tao'],5,2);
									$year = substr($value['ngay_tao'],2,2);
									$date = $hour.":".$minute." ".$day."/".$month."/".$year;
									if(preg_match('#\,#',$value['cmuc']))
										{
											list($cate1,$cate2) = explode(',',$value['cmuc']);
											$cate2 .= '/';
										}
										else
										{
											$cate1 = $value['cmuc'];
											$cate2 = '';
										}
							?> 	
							<div class="col-xs-12 noidung3">
								<div class="media">	
									<a class="media-left" href="<?=$cate1.'/'.$cate2.$value['slug'].'-'.$value['id_post'].'.html'?>">
										<img src="<?=$value['url']?>" class="media object img-fluid" alt="">
									</a>
									<div class="media-body">
										<p class="lead"><a href="<?=$cate1.'/'.$cate2.$value['slug'].'-'.$value['id_post'].'.html'?>"><?=$value['tieu_de']?></a></p>
										<small><span class="fa fa-calendar"></span> <?=$date?></small>
										<small><span class="fa fa-comments"></span> <?=$c_tin_tuc->sumComment($value['id_post'])?> COMMENTS</small>
										<small><span class="fa fa-view"></span> <span class="fa fa-eye"> <?=$value['luot_xem']?></span></small>
										<p class="title"><?=html_entity_decode(substr($value['mieu_ta'],0,117).'..')?></p>
									</div>
								</div>
							</div>
							<?php
								}
								}
								else if($noidungtop)
								{
							?>
								<ol class="breadcrumb hide">
									<li class="breadcrumb-item"><a href="<?=$noidungtop['url_cate']?>"><?=$noidungtop['ten_chuyen_muc']?></a></li>
								</ol>
							<div class="nd3">		
								<div class="col-xs-12 noidung3">
								
									<div class="chitietdau">
										<h3><?=$noidungtop['tieu_de']?></h3>
		                				<small>Post by<i> admin</i></small>
									</div>	
								
									<div class="chitiettieude">	
		                				<p><strong><?=$noidungtop['mieu_ta']?></strong></p>
									</div>
								
									<div class="chitietbody">	
										<p><?=html_entity_decode($noidungtop['noi_dung'])?></p>
									</div>
					
								</div>		
							<?php		
								}
								else
								{
							?>		
							<ol class="breadcrumb hide">
								<li class="breadcrumb-item"><a href="<?=$tieu_de_chuyenmuc['cate_1']['url']?>"><?=$tieu_de_chuyenmuc['cate_1']['ten_chuyen_muc']?></a></li>
								<li class="breadcrumb-item"><a href="<?=$tieu_de_chuyenmuc['cate_1']['url'].'/'.$tieu_de_chuyenmuc['cate_2']['url']?>"><?=$tieu_de_chuyenmuc['cate_2']['ten_chuyen_muc']?></a></li>
							</ol>
						
						<div class="nd3">
							<?php
								}
							?>
							
						</div>

						<div class="nd4 hide">
							
			            	<?=$trang?>

						</div>
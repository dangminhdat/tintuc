							<?php
								// print_r($tin_xa_hoi);
								foreach ($tin_xa_hoi as $key => $data) {
									$hour = substr($value['ngay_tao'],11,2);
									$minute = substr($value['ngay_tao'],14,2);
									$day = substr($value['ngay_tao'],8,2);
									$month = substr($value['ngay_tao'],5,2);
									$year = substr($value['ngay_tao'],2,2);
									$date = $hour.":".$minute." ".$day."/".$month."/".$year;
									$j=1;
									if($data)
									{
									foreach ($data as $keyC => $valueC) {
										if(preg_match('#\,#',$valueC['cmuc']))
										{
											list($cateC1,$cateC2) = explode(',',$valueC['cmuc']);
											$cateC2 .= '/';
										}
										else
										{
											$cateC1 = $valueC['cmuc'];
											$cateC2 = '';
										}
										if($j==1)
										{
							?>
						<div class="clearfix"></div>
						<div class="nd2" >
							<h4><a href="<?=$cateC1?>"><?=$valueC['ten_chuyen_muc']?></a></h4>	
							<div class="col-lg-7 float-lg-left noidung1">
								<a href="<?=$cateC1.'/'.$cateC2.$valueC['slug'].'-'.$valueC['id_post'].'.html'?>"><img src="<?=$valueC['url']?>" class="img-fluid" alt=""></a>
								<p class="lead"><a href="<?=$cateC1.'/'.$cateC2.$valueC['slug'].'-'.$valueC['id_post'].'.html'?>"><?=$valueC['tieu_de']?></a></p>
								<small><span class="fa fa-calendar"></span> <?=$date?></small>
								<small><span class="fa fa-comments"></span> <?=$c_tin_tuc->sumComment($valueC['id_post'])?> COMMENTS</small>
								<small><span class="fa fa-view"></span> <span class="fa fa-eye"> <?=$valueC['luot_xem']?></span></small>
								<p><?=html_entity_decode(substr($valueC['mieu_ta'],0,117).'..')?></p>
							</div>
							<div class="col-lg-5 float-lg-right noidung2">
							<?php
										$j++;
										}
										else if($j==6)
										{
							?>
								<div class="nd" style="border: none;">
									<a href="<?=$cateC1.'/'.$cateC2.$valueC['slug'].'-'.$valueC['id_post'].'.html'?>"><?=substr($valueC['tieu_de'],0,43).'..'?></a>
									<p>
										<small><span class="fa fa-calendar"></span> <?=$date?></small>
										<small><span class="fa fa-comments"></span> <?=$c_tin_tuc->sumComment($valueC['id_post'])?> COMMENTS</small>
										<small><span class="fa fa-view"></span> <span class="fa fa-eye"> <?=$valueC['luot_xem']?></span></small>
									</p>
								</div>
							<?php		
										}
										else
										{
							?>
								<div class="nd">
									<a href="<?=$cateC1.'/'.$cateC2.$valueC['slug'].'-'.$valueC['id_post'].'.html'?>"><?=substr($valueC['tieu_de'],0,43).'..'?></a>
									<p>
										<small><span class="fa fa-calendar"></span> <?=$date?></small>
										<small><span class="fa fa-comments"></span> <?=$c_tin_tuc->sumComment($valueC['id_post'])?> COMMENTS</small>
										<small><span class="fa fa-view"></span> <span class="fa fa-eye"> <?=$valueC['luot_xem']?></span></small>
									</p>	
								</div>
							<?php
										$j++;
										}
									}
									
							?>
							</div>
						</div>
							<?php	
									}
								}
							?>	
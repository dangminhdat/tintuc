						<div class="nd1">
							<h4>Tin Hot</h4>
							<?php
								// print_r($tin_hot);
								$i=1;
								foreach ($tin_hot as $key => $value) {
									list($cate1,$cate2) = explode(',',$value['cmuc']);
									if($cate2 != '')
									{
										$cate2 .= '/';
									}
									if($i==1){
							?>
							<div class="col-lg-7 float-lg-left noidung1">
								<a href="<?=$cate1.'/'.$cate2.$value['slug'].'-'.$value['id_post'].'.html'?>">
									<img src="<?=$value['url']?>" class="img-fluid" alt="">
								</a>
								<p class="lead"><a href="<?=$cate1.'/'.$cate2.$value['slug'].'-'.$value['id_post'].'.html'?>"><?=$value['tieu_de']?></a></p>
								<small><span class="fa fa-calendar"></span> <?=$value['ngay_tao']?></small>
								<small><span class="fa fa-comments"></span> <?=$c_tin_tuc->sumComment($value['id_post'])?> COMMENTS</small>
								<small><span class="fa fa-view"></span> View: <?=$value['luot_xem']?></small>
								<p><?=html_entity_decode(substr($value['mieu_ta'],0,117).'..')?></p>
							</div>
							<div class="col-lg-5 float-lg-right noidung2">
							<?php
									$i++;
									}
									else if($i==6)
									{
							?>			
								<div class="nd" style="border: none;">
									<a href="<?=$cate1.'/'.$cate2.$value['slug'].'-'.$value['id_post'].'.html'?>"><?=substr($value['tieu_de'],0,43).'..'?></a>
									<small><span class="fa fa-calendar"></span> <?=$value['ngay_tao']?></small>
									<small><span class="fa fa-comments"></span> <?=$c_tin_tuc->sumComment($value['id_post'])?> COMMENTS</small>
									<small><span class="fa fa-view"></span> View: <?=$value['luot_xem']?></small>
								</div>
							<?php	
									}
									else
									{
							?>
							
								<div class="nd">
									<a href="<?=$cate1.'/'.$cate2.$value['slug'].'-'.$value['id_post'].'.html'?>"><?=substr($value['tieu_de'],0,43).'..'?></a>
									<small><span class="fa fa-calendar"></span> <?=$value['ngay_tao']?></small>
									<small><span class="fa fa-comments"></span> <?=$c_tin_tuc->sumComment($value['id_post'])?> COMMENTS</small>
									<small><span class="fa fa-view"></span> View: <?=$value['luot_xem']?></small>
								</div>
							<?php
									$i++;
									}
								}	
							?>	

							</div>
						</div>
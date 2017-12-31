						<div class="ndp1">
							<p class="label">Liên quan</p>
							<?php
								$z=1;
								// print_r($tin_lien_quan);
								if($tin_lien_quan)
								{
								foreach ($tin_lien_quan as $key => $value) {
									if(preg_match('#\,#',$value['cmuc']))
										{
											list($cateC1,$cateC2) = explode(',',$value['cmuc']);
											$cateC2 .= '/';
 										}
										else
										{
											$cateC1 = $value['cmuc'];
											$cateC2 = '';
										}
									
							?>
										<div class="media">
											<a class="media-left" href="<?=$cateC1.'/'.$cateC2.$value['slug'].'-'.$value['id_post'].'.html'?>">
												<img class="media-object" src="<?=$value['url']?>" width="70" height="50" alt="">
											</a>
											<div class="media-body">
												<p class="media-heading"><a href="<?=$cateC1.'/'.$cateC2.$value['slug'].'-'.$value['id_post'].'.html'?>"><?=$value['tieu_de']?></a></p>
												<p><span class="fa fa-eye"> <?=$value['luot_xem']?></span></p>
											</div>
										</div>
							<?php
								}
								}	
							?>
						</div>
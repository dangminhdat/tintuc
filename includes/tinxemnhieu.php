						<div class="ndp2">
							<div class="fb-page" data-href="https://www.facebook.com/facebook" data-width="350" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
						</div>	
						<div class="ndp1">
							<p class="label" style="background: yellow">POPULAR</p>
							<?php
								$z=1;
								// print_r($tin_coi_nhieu);
								foreach ($tin_coi_nhieu as $key => $value) {
									if(preg_match('#\,#',$value['cmuc']))
										{
											list($cateN1,$cateN2) = explode(',',$value['cmuc']);
											$cateN2 .= '/';
										}
										else
										{
											$cateN1 = $value['cmuc'];
											$cateN2 = '';
										}
									
							?>
										<div class="media">
											<a class="media-left" href="<?=$cateN1.'/'.$cateN2.$value['slug'].'-'.$value['id_post'].'.html'?>">
												<img class="media-object" src="<?=$value['url']?>" width="70" height="50" alt="">
											</a>
											<div class="media-body">
												<p class="media-heading"><a href="<?=$cateN1.'/'.$cateN2.$value['slug'].'-'.$value['id_post'].'.html'?>"><?=$value['tieu_de']?></a></p>
												<p><span class="fa fa-eye"> <?=$value['luot_xem']?></span></p>
											</div>
										</div>
							<?php
								}	
							?>
							
						</div>
					</div> <!-- hết noidungphu -->

				</div>
			</div>
		</div> <!-- hết noidung -->
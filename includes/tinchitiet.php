							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?=$tieu_de_chuyenmuc['cate_1']['url']?>"><?=$tieu_de_chuyenmuc['cate_1']['ten_chuyen_muc']?></a></li>
								<li class="breadcrumb-item"><a href="<?=$tieu_de_chuyenmuc['cate_1']['url'].'/'.$tieu_de_chuyenmuc['cate_2']['url']?>"><?=$tieu_de_chuyenmuc['cate_2']['ten_chuyen_muc']?></a></li>
							</ol>

						<div class="chitiet" style="border-top: 1px solid #ccc"	>
							<div class="chitietdau">
								<?php
									if($tieu_de_chuyenmuc['cate_2']['ten_chuyen_muc'] != '')
									{
										$tieu_de_chuyenmuc['cate_1']['url'] .= '/';
									} 
								?>
								<h3><?=$tin['tieu_de']?></h3>
		                		<small>Post by<i> admin</i></small>
								<small><span class="fa fa-calendar"></span> <?=$tin['ngay_tao']?></small>
								<small><span class="fa fa-comments"></span> <?=$c_tin_tuc->sumComment($tin['id_post'])?> COMMENTS</small>
								<small><span class="fa fa-view"></span> Lượt xem: <?=$tin['luot_xem']?></small>
								<div class="fb-share-button" data-href="http://localhost/datdang/tttt/<?=$tieu_de_chuyenmuc['cate_1']['url'].$tieu_de_chuyenmuc['cate_2']['url'].'/'.$tin['slug'].'-'.$tin['id_post'].'.html'?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%2Fdatdang%2Ftttt%2F<?=str_replace('/','%2F',$tieu_de_chuyenmuc['cate_1']['url']).$tieu_de_chuyenmuc['cate_2']['url'].'%2F'.$tin['slug'].'-'.$tin['id_post'].'.html'?>&amp;src=sdkpreparse">Chia sẻ</a></div>
							</div>	
								
							<div class="chitiettieude">	
		                		<p><strong><?=$tin['mieu_ta']?></strong></p>
							</div>
							<div class="text-xs-center">
					            <img src="<?=$tin['url']?>" class="img-responsive" alt="">
							</div>
								
							<div class="chitietbody">	
								<p><?=html_entity_decode($tin['noi_dung'])?></p>
							</div>
						</div>
						<div class="comment">
							<form method="post" id="AddComment" onsubmit="return false" data-id="<?=$_GET['id_post']?>">
								<div class="form-group">
									<div class="col-xs-12">
										<label>Viết bình luận<span class="alert alert-danger hidden-xs-up"></span></label>
										<textarea class="form-control" id="nd_cmt"></textarea>
									</div>
								</div>
								<div class="form-inline">
									<label class="col-xs-8">Name(*)<span class="alert alert-danger hidden-xs-up"></span></label>
									<div class="col-xs-4">
										<input type="text" class="form-control" id="name_cmt">
									</div>	
								</div>
								<div class="form-inline">
									<label class="col-xs-8">Email(*)<span class="alert alert-danger hidden-xs-up"></span></label>
									<div class="col-xs-4">
										<input type="text" class="form-control" id="mail_cmt">
									</div>	
								</div>
								<div class="form-group">
									<div class="col-xs-12">
										<button type="button" class="btn btn-primary">Gửi</button>
									</div>	
								</div>
								<span class="alert alert-danger hidden-xs-up"></span>	
							</form>
							<hr>
							<div class="col-xs-12">
								<?php
									if($comment)
									{
										foreach ($comment as $key => $value) {
								?>
								<div class="media">
									<a class="media-left media-top" href="#">
										<img class="media-object" src="public/img/logo11.png" width="120" alt="">
									</a>
									<div class="media-body">
										<h4 class="media-heading"><?=$value['name']?> <small><?=$value['ngay_tao']?></small></h4>
										<p><?=$value['noi_dung']?></p>
										<!-- <a href="">Báo cáo</a> <a href="">Reply</a> -->
									</div>
								</div>
								<?php
										}
									}
									if($sum_comment > 10)
									{
								?>
								<button class="btn btn-default" data-id="<?=$_GET['id_post']?>">Xem all</button>
								<?php
									}
								?>
							</div>
						</div>
					
						
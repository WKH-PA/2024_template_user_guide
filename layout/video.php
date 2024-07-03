<div class="banner_detail" style="background-image: url('delete/banner/inner_header-3.jpg');">
</div>
<div class="page_conten_page pagewrap">
	<div class="tin_left">
		<div class="title_news">
			<h2>Thư viện video</h2>
		</div>
		<div class="tt_page_top tt_video">
			<?php for ($i=0; $i < 8; $i++) {  ?>
				<div class="new_id_bs">
					<li>
						<a href="video-popup.php" class="preview fancybox.ajax"><img src="delete/hinhanh/<?=$i+1 ?>.jpg">
							<i class="fa fa-play" aria-hidden="true"></i>
						</a>
					</li>
					<ul>
						<h3><a href="video-popup.php" class="preview fancybox.ajax">Xem video của chúng tôi</a></h3>
					</ul>
					<div class="clr"></div>
				</div>
			<?php } ?>
		</div>
	</div>
	<?php include"tin_right.php";?>
	<div class="clr"></div>
</div>
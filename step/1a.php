<?php
if($motty 	== "404"){
    $nd_404 		 = DB_fet_rd("*","`#_seo_name` "," `id` = 1 ","",1);
    $arr_running = reset($nd_404);
    // $bre 				= SHOW_text($arr_running['tenbaiviet_'.$_SESSION['lang']]);
}

$bre  = SHOW_text($arr_running['tenbaiviet_'.$lang]);
if(empty($thongtin_step)){
    $thongtin_step['id'] = 1;
}
else {
    $bre =  '<a href="'.GET_link($full_url, SHOW_text($thongtin_step['seo_name'])).'">'.$thongtin_step['tenbaiviet_'.$lang].'</a>';
}
$thongtin_step   = LAY_anhstep_now($thongtin_step['id']);

// $img_bg = checkImage($fullpath, $thongtin_step['icon'], $thongtin_step['duongdantin']);

// if($arr_running['icon_hover'] != "") {
//   $img_bg = checkImage($fullpath, $arr_running['icon_hover'], $arr_running['duongdantin']);
// }
// full_src($thongtin_step, '')
?>
<!-- <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><span><i class="fa fa-angle-right"></i></span><a <?=full_href($arr_running) ?>><?=$arr_running['tenbaiviet_'.$lang] ?></a></li> -->
<div class="banner">
    <?php
    $banner_top = LAY_banner_new("`id_parent` = 32");
    foreach ($banner_top as $rows) {
        echo '<img src="' . htmlspecialchars($fullpath . "/" . $rows['duongdantin'] . "/" . $rows['icon'], ENT_QUOTES, 'UTF-8') . '" alt="Banner Image" style="width: 100%; height: auto; object-fit: cover;">';
    }
    ?>
</div>
<div class="page_conten_page pagewrap">
    <div class="tin_left tin_left_2column">
        <div class="title_news">
            <h2><?= SHOW_text($arr_running['tenbaiviet_'.$lang]) ?>
                <?php if (isset($arr_running['ngaydang']) && !empty($arr_running['ngaydang'])): ?>
                    <li><i class="fa fa-calendar"></i> <?= date("d/m/Y", $arr_running['ngaydang']) ?></li>
                <?php endif; ?>
        </div>
        <div class="showText">
            <?= SHOW_text($arr_running['noidung_'.$_SESSION['lang']]) ?>
            <?php if ($motty == "404"): ?>
                <div class="dv_404_gohome">
                    <a href="<?=$full_url ?>"><?=$glo_lang['ve_trang_chu'] ?> <span class="time_doi"></span></a>
                </div>
                <script type="text/javascript">
                    var time_doi = 11;
                    setInterval(function(){ time_doi--; $('.time_doi').html("("+time_doi+")"); if(time_doi < 1) window.location.href = '<?=$full_url ?>' }, 1000);
                </script>
            <?php else: ?>
                <div class="fl-post-meta fl-post-meta-bottom">
                    <div class="fl-post-cats-tags">
                        <i class="fa fa-tags"></i>
                        <a<?= full_href(['seo_name' => 'gioi-thieu']) ?>><?= $glo_lang['gioi-thieu'] ?></a>
<!--                        <a href="#" rel="tag">--><?//= SHOW_text($arr_running['tenbaiviet_'.$lang]) ?><!--</a>-->
                    </div>
                </div>
                <div id="sharelink">
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style "> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
                    <script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js#pubid=xa-502225fb496239a5"></script>
                    <!-- AddThis Button END -->
                </div>
                <div class="dv-fb_coment">
                    <?php include _source."fb_coment.php"; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <?php include _source."left_conten.php";?>



    <div class="clr"></div>
</div>

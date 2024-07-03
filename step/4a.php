<?php
$kietxuat_name = DB_fet_rd("*", "#_danhmuc", "`step` = '".$slug_step."' AND `id` = '".$arr_running['id_parent']."'", "`id` DESC", 1, "id");
if (empty($kietxuat_name)) {
    $kietxuat_name = $thongtin_step['tenbaiviet_'.$lang];
} else {
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_'.$lang];
}

$lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);

$wh = " AND `id_parent` = (".$lay_all_kx.") AND `id` <> '".$arr_running['id']."'";
$numview = 12;

$nd_kietxuat = DB_fet_rd(" * ", "`#_baiviet`", "`step` IN (".$slug_step.") $wh", "`catasort` DESC", $numview);

?>
<div class="banner">
    <?php
    $banner_top = LAY_banner_new("`id_parent` = 32");
    foreach ($banner_top as $rows) {
        echo '<img src="' . htmlspecialchars($fullpath . "/" . $rows['duongdantin'] . "/" . $rows['icon'], ENT_QUOTES, 'UTF-8') . '" alt="Banner Image" style="width: 100%; height: auto; object-fit: cover;">';
    }
    ?>
</div>

</div>
<div class="page_conten_page pagewrap">
    <div class="viewLeft">
        <div id="pro_img_main">
            <div id="bridal_images">
                <img src="<?= htmlspecialchars($fullpath . "/" . $arr_running['duongdantin'] . "/" . $arr_running['icon'], ENT_QUOTES, 'UTF-8') ?>"
                     alt="<?= htmlspecialchars($arr_running['alt'], ENT_QUOTES, 'UTF-8') ?>"
                     width="500" height="500" style="object-fit: cover;"></a>
            </div>
        </div>
    </div>
    <!--end viewLeft-->
    <div class="viewRight">
        <div class="viewRight_more">
            <div class="titleView"><?= SHOW_text($arr_running['tenbaiviet_' . $lang]) ?></div>
            <p><?= SHOW_text($arr_running['mota_' . $lang]) ?></p>
            <div class="fl-post-meta fl-post-meta-bottom">
                <div class="fl-post-cats-tags">
                    <i class="fa fa-tags"></i>
                    <a<?= full_href(['seo_name' => 'dich-vu']) ?>><?= $glo_lang['dich_vu'] ?></a>
<!--                    <a href="#" rel="tag">--><?//= SHOW_text($arr_running['tenbaiviet_'.$lang]) ?><!--</a>-->
                </div>
            </div>
            <div class="clr"></div>
            <div class="ct_add">
                <ul>
                    <h3><a <?= full_href(['seo_name' => 'popup-lien-he']) ?>class="clor_01 preview fancybox.ajax"><?= $glo_lang['tuvan_baogia'] ?></a></h3>
                    <div class="clr"></div>
                </ul>
            </div>
            <div id="sharelink">
                <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                </div>
                <script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js#pubid=xa-502225fb496239a5"></script>
                <!-- AddThis Button END -->
            </div>
            <div class="clr"></div>
        </div>
    </div>
    <div class="clr"></div>
    <div class="detail-sp">
        <h5><?= $glo_lang['mo_ta_chi_tiet'] ?></h5>
        <div id="ftwp-postcontent">
            <?= SHOW_text($arr_running['noidung_' . $lang]) ?>
        </div>
    </div>
    <div class="box_page">
        <div class="title_page">
            <ul><h3 class="h_title"><?= $glo_lang['dich_vu_chung_toi'] ?></h3></ul>
        </div>
        <div class="owl-carousel owl-theme owl-custome" id="dichvu_slide">
            <?php foreach ($nd_kietxuat as $rows) { ?>
                <div class="col-lg-4">
                    <div class="scale_hover_img lazyload">
                        <div class="scale_hover">
                            <a <?= full_href($rows) ?>>
                                <img src="<?= htmlspecialchars($fullpath . "/" . $rows['duongdantin'] . "/" . $rows['icon'], ENT_QUOTES, 'UTF-8') ?>"
                                     alt="<?= htmlspecialchars($rows['alt'], ENT_QUOTES, 'UTF-8') ?>"
                                     width="500" height="500" style="object-fit: cover;"></a>
                        </div>
                        <div class="info">
                            <h3><a href="<?= full_href($rows) ?>" title="<?= SHOW_text($rows['tenbaiviet_'.$lang]) ?>"><?= SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="clr"></div>
</div>

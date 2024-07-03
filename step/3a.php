<?php
$kietxuat_name = DB_fet_rd("*", "#_danhmuc", "`step` = '".$slug_step."' AND `id` = '".$arr_running['id_parent']."'", "`id` DESC", 1, "id");
if(empty($kietxuat_name)) {
    $kietxuat_name = $thongtin_step['tenbaiviet_'.$lang];
} else {
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_'.$lang];
}

$lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);

$wh = " AND `id_parent` = (".$lay_all_kx.") AND `id` <> '".$arr_running['id']."'";
$numview = 6;

// Fetch related articles excluding those with specific `catasort` values already present
$nd_kietxuat = DB_fet_rd("*", "`#_baiviet`", "`step` IN (".$slug_step.") $wh AND `catasort` NOT IN (SELECT DISTINCT `catasort` FROM `#_baiviet` WHERE `catasort` IS NOT NULL)", "`catasort` DESC", $numview);

$banner_top = LAY_banner_new("`id_parent` = 32");

// Fetch other articles (not related) based on additional criteria
$sp_baiviet = LAY_baiviet(7, 3, "`opt` = 1");

?>

<div class="banner">
    <?php foreach ($banner_top as $rows) : ?>
        <img src="<?= htmlspecialchars($fullpath . "/" . $rows['duongdantin'] . "/" . $rows['icon'], ENT_QUOTES, 'UTF-8') ?>" alt="Banner Image" style="width: 100%; height: auto; object-fit: cover;">
    <?php endforeach; ?>
</div>

<div class="page_conten_page pagewrap">
    <div class="tin_left tin_left_2column">
        <div class="box_page_id">
            <div class="title_page">
                <div class="clr"></div>
            </div>
            <div class="title_news">
                <h2><?= SHOW_text($arr_running['tenbaiviet_'.$lang]) ?></h2>
                <ul>
                    <li><i class="fa fa-calendar"></i> <?= date("d/m/Y", $arr_running['ngaydang']) ?></li>
                </ul>
            </div>
            <div class="showText">
                <?= SHOW_text($arr_running['noidung_'.$lang]); ?>
                <div class="clr"></div>
            </div>
            <div class="fl-post-meta fl-post-meta-bottom">
                <div class="fl-post-cats-tags">
                    <i class="fa fa-tags"></i>
                    <a<?= full_href(['seo_name' => 'tin-tuc']) ?>><?= $glo_lang['tin_tuc_su_kien'] ?></a>
<!--                    <a href="#" rel="tag">--><?//= SHOW_text($arr_running['tenbaiviet_'.$lang]) ?><!--</a>-->
                </div>
            </div>
            <div id="sharelink">
                <div class="addthis_toolbox addthis_default_style">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                </div>
            </div>
            <div class="dv-fb_coment">
                <?php include _source."fb_coment.php"; ?>
            </div>
        </div>

        <div class="box_page_id">
            <div class="title_page">
                <ul>
                    <h3 class="h_title"><?= $glo_lang['bai_viet_lien_quan'] ?></h3>
                </ul>
                <div class="clr"></div>
            </div>
            <div class="menu_top_id">
                <div class="tt_page_top owl-carousel owl-theme owl-custome dv-tintuc" id="tintuc_slide1">
                    <?php foreach ($sp_baiviet as $rows) : ?>
                        <div class="new_id_bs">
                            <ul>
                                <li>
                                    <a <?= full_href($rows) ?>>
                                        <img src="<?= full_img($rows) ?>">
                                        <div class="blog_masonry_date_holder">
                                            <span class="masonry_date_pattern"></span>
                                            <div class="blog_masonry_date_holder_inner">
                                                <span class="date_month"><?= date("F", $rows['ngaydang']) ?></span>
                                                <span class="date_day"><?= date("d",$rows['ngaydang']) ?></span>
                                                <span class="date_year"><?= date("Y", $rows['ngaydang']) ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <ul>
                                <h3><a <?= full_href($rows) ?>><?= SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
                                <p class="mota"><?= SHOW_text(strip_tags($rows['mota_'.$lang], '<img>')) ?></p>

                            </ul>
                            <div class="clr"></div>
                        </div>
                    <?php endforeach; ?>

                </div>
                <div class="clr"></div>
            </div>
        </div>
    </div>

    <?php include _source."left_conten.php";?>



    <div class="clr"></div>
</div>

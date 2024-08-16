<?php include"banner_top.php";?>

<section class="dv-home-gioithieu" id="about-us-section">
    <div class="pagewrap">
        <div class="col-lg-12">
            <div class="col-lg-4 wow fadeInLeft">
                <div class="row img-box">
                    <div class="col">
                        <div class="one">
                            <div class="about-img">
                                <?php
                                $noidung = LAYTEXT_rieng(77);
                                $image_url = full_src($noidung, '');
                                ?>
                                <?=full_img($noidung, 'thumb_') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-center justify-content-between wow fadeInRight">
                <div class="text-box">
                    <div class="sec-title">
                        <h2><?=SHOW_text($noidung['p1_'.$lang]) ?></h2>
                    </div>
                    <p><?=SHOW_text($noidung['noidung_'.$lang]) ?></p>
                </div>
            </div>
            <?php
            $sp_baiviet = LAY_baiviet(1, 3, "`opt` = 0");
            ?>
            <div class="col-lg-4 d-flex align-items-center justify-content-between wow fadeInRight" data-wow-duration="2s">
                <div class="text-box">
                    <div class="aheto-heading">

                        <?php foreach ($sp_baiviet as $rows) { ?>
                            <h2><?= SHOW_text($rows['tenbaiviet_'.$lang]) ?></h2>
                            <div><?= substr(strip_tags(SHOW_text($rows['noidung_'.$lang])), 0, 300) . '...' ?></div>
                            <a<?= full_href($rows) ?>><i class="fa fa-caret-right" aria-hidden="true"></i> Xem thêm</a>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="clr"></div>
    </div>
</section>
<div class="dv-home-video wow fadeIn" data-wow-duration="2s">
    <div class="elementor-widget-wrap">
        <div class="elementor-element">
            <div class="cta-video text-center">
                <a<?= full_href(['seo_name' => 'popup-video']) ?> class="popup-video preview fancybox.ajax">
                    <i class="fa fa-play" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="section-title wow flipInX">
            <span><?=$glo_lang['video_gioi_hieu']?></span>
            <h2><span class="tl1"><?=$glo_lang['nhung_gi_toi_co_the_lam_cho_bạn']?></span></h2>
        </div>
    </div>
    <div class="clr"></div>
</div>

<?php
$sp_baiviet   = LAY_baiviet(2, 12, "`opt` = 1");
$sp_step      = LAY_step(2, 1);
if(count($sp_baiviet)){
    ?>
    <section class="provide dv-home-dichvu wow fadeIn" data-wow-duration="2s">
        <div class="pagewrap">
            <div class="sec-title wow flipInX">
                <h3><?=$glo_lang['dich_vu_chung_toi_cung_cap']?></h3>
                <p><?=$glo_lang['description']?></p>
            </div>
            <div class="col-lg-12 flex">
                <?php
                foreach ($sp_baiviet as $rows) {
                    ?>
                    <div class="col-lg-4">
                        <div class="scale_hover_img lazyload">
                            <div class="scale_hover">
                                <a <?= full_href($rows) ?>"><img src="<?= htmlspecialchars($fullpath . "/" . $rows['duongdantin'] . "/" . $rows['icon'], ENT_QUOTES, 'UTF-8') ?>"
                                                                 alt="<?= htmlspecialchars($rows['alt'], ENT_QUOTES, 'UTF-8') ?>"
                                                                 width="500" height="500" style="object-fit: cover;">
                            </div>

                            <div class="info">
                                <h3>
                                    <a href="<?=full_href($rows)?>" title="<?=SHOW_text($rows['tenbaiviet_'.$lang])?>"><?=SHOW_text($rows['tenbaiviet_'.$lang])?></a>
                                </h3>
                            </div>
                        </div>
                    </div>
                <?php }?>
                <div class="col-lg-4">
                    <div class="dangky-r">
                        <div class="elementor-background-overlay"></div>
                        <form action="" method="post" name="dk_email_nhantin" id="dk_email_nhantin" accept-charset="utf-8">

                            <h4 class="wow flipInX" style="visibility: visible; animation-name: flipInX;">NHẬN BÁO GIÁ BẤT KỲ LOẠI DỊCH VỤ NÀO TỪ ĐÂY.</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" name="ip_sentmail" id="ip_sentmail" class="form-control"
                                           placeholder="<?= $glo_lang['email'] ?> *">
                                </div>
                                <div class="col-md-12">
                                    <div class="bt_bb_button">
                                        <a onclick="DANGKY_email('<?= $full_url ?>')" class="cur button_dangky">
                                            <span class="bt_bb_button_text"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Gửi yêu cầu</span>
                                        </a>
                                        <input name="capcha_hd" type="hidden" id="capcha_hd" value="">
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
                <div class="clr"></div>
    </section>



<?php }?>
<section class="contact py-100 wow fadeIn" data-wow-duration="2s">
    <div class="overlay"></div>
    <div class="pagewrap">
        <div class="menu-so1">
            <div class="menu_style">
                <i class="fa fa-building" aria-hidden="true"></i>
                <div class="count">3000</div>
                <h5>CÁC GÓI DỊCH VỤ ĐƯỢC GIAO</h5>
            </div>
            <div class="menu_style">
                <i class="fa fa-smile-o" aria-hidden="true"></i>
                <div class="count">749</div>
                <h5>KHÁCH HÀNG HÀI LÒNG</h5>
            </div>
            <div class="menu_style">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                <div class="count">1225</div>
                <h5>CÔNG NHÂN LÀM VIỆC</h5>
            </div>
            <div class="menu_style">
                <i class="fa fa-truck" aria-hidden="true"></i>
                <div class="count">400</div>
                <h5>TỔNG SỐ XE TẢI VẬN CHUYỂN</h5>
            </div>
        </div>
    </div>
</section>
<?php
$sp_baiviet = LAY_baiviet(7, 12, "`opt` = 1");
$sp_step = LAY_step(7, 1);
?>
<div class="dv-home-tintuc wow fadeIn" data-wow-duration="2s">
    <div class="pagewrap">
        <div class="sec-title wow flipInX">
            <h3><?=$glo_lang['tin_tuc_su_kien']?></h3>
        </div>
        <div class="tt_page_top owl-carousel owl-theme owl-custome" id="tintuc_slide">
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
                                        <span class="date_day"><?= date("d", $rows['ngaydang']) ?></span>
                                        <span class="date_year"><?= date("Y", $rows['ngaydang']) ?></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <h3><a <?= full_href($rows) ?>><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></a></h3>
                        <p><?= SHOW_text(strip_tags($rows['mota_' . $lang])) ?></p>
                    </ul>
                    <div class="clr"></div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="clr"></div>
    </div>
</div>

<?php
$sp_baiviet = LAY_baiviet(8, '', "`opt` = 0");
?>
<div class="dv-home-doitac">
    <div class="pagewrap">
        <div class="sec-title text-center wow fadeInDown">
            <h3>Đối tác của chúng tôi</h3>
        </div>
        <div class="logo_doitac owl-auto owl-carousel owl-theme owl-custome wow flipInX" id="images_slide">
            <?php
            foreach ($sp_baiviet as $partner)  { ?>
                <ul>
                    <li><a <?= full_src_muti($partner) ?> ><?= full_img($partner) ?></a></li>
                </ul>

            <?php }?>
        </div>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div><div class="clr"></div>
</div>


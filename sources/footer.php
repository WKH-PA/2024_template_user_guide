<div class="footer">
    <div class="pagewrap">
        <div class="center-footer">
            <ul class="social">
                <?php
                $noidung = LAYTEXT_rieng(78);
                $image_url = full_src($noidung, '');
                ?>
                <a href="<?=$full_url ?>">
                    <img src="<?=$image_url ?>" alt="<?=$noidung['icon'] ?>">
                </a>

                <?=SHOW_text($noidung['noidung_'.$lang]) ?>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            </ul>

            <ul class="menu-footer" id="ITme">
                <h3><?=$glo_lang['ve_chung_toi'] ?></h3>
                <div>
                    <?=GET_menu_2($full_url, $lang, '', '', '1') ?>
                </div>
            </ul>

            <ul class="menu-footer">
                <h3><?=$glo_lang['gio_lam_viec'] ?></h3>
                <?php
                $noidung = LAYTEXT_rieng(81);
                ?>


                <?=SHOW_text($noidung['noidung_'.$lang]) ?>
<!--                <p><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> --><?//=$glo_lang['xem_them'] ?><!--</a></p>-->
            </ul>
            <?php
            $sp_baiviet = LAY_baiviet(7, 3, "`opt` = 1");

            ?>
            <ul class="menu-footer">
                <h3><?=$glo_lang['bai_viet_moi'] ?></h3>
                <?php foreach ($sp_baiviet as $rows) {?>
                    <div class="new_id_bs">
                        <li>
                            <a<?=full_href($rows) ?>><?=full_img($rows, '') ?>
                            </a>
                        </li>
                        <ul>
                            <a<?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang])?></a>
                        </ul>
                        <div class="clr"></div>
                    </div>
                <?php }?>
            </ul>
        </div>
        <div class="clr"></div>
    </div>
</div>
<div class="bottom_ft">
    <p><?=$glo_lang['ban_quyen_name'] ?>
    <div class="clr"></div>
</div>
<div id="back-top" style="display: block;"><a href="#top"><i class="fa fa-angle-double-up"></i></a></div>
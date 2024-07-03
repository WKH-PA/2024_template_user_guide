<div class="banner" ">
<?php
$banner_top = LAY_banner_new("`id_parent` = 32");
foreach ($banner_top as $rows) {
    echo '<img src="' . htmlspecialchars($fullpath . "/" . $rows['duongdantin'] . "/" . $rows['icon'], ENT_QUOTES, 'UTF-8') . '" alt="Banner Image" style="width: 100%; height: auto; object-fit: cover;">';
}
?>
</div>
<div div class="page_conten_page pagewrap"  style="background-color: white;
    padding: 10px;
    border: 1px solid #ccc;
     width: 80%;
     margin: 10px auto;
     min-height: 120px;">
    <div class="left_contact">
       <h3><?=$glo_lang['form_lien_he'] ?></h3>
        <p><strong><?php
                $noidung = LAYTEXT_rieng(78);
                $image_url = full_src($noidung, '');
                ?>
                <a href="<?=$full_url ?>">
        <h2><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h2>
        </a></p>

        <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        <p><strong><?php
                $noidung = LAYTEXT_rieng(80);
                $image_url = full_src($noidung, '');
                ?>
                <a href="<?=$full_url ?>">
        </a></p>

        <?=SHOW_text($noidung['noidung_'.$lang]) ?>
    </div>

    <div class="right_contact">
        <h3 style="font-size: 35px;margin-bottom: 40px;"><?= $glo_lang['thongtin_lienhe'] ?></h3>

        <form action="" class="formBox no_box" method="post" accept-charset="UTF-8" name="formnamecontact2" id="formnamecontact2">
            <!-- Add your form fields here -->
            <input type="hidden" name="send_lienhe">
            <input type="hidden" class="lang_ok" value="Yêu cầu của bạn đã được gửi">
            <input type="hidden" class="lang_false" value="Nhập mã bảo vệ chưa đúng">
            <input type="hidden" name="tieude_lienhe" value="Thông tin liên hệ">
            <div class="left">
                <li class="name">
                    <input type="hidden" name="s_fullname_s" value="<?=base64_encode($glo_lang['ho_va_ten']) ?>">
                    <input class="cls_data_check_form" data-rong="1" name="s_fullname" id="s_fullname" type="text" placeholder="<?=$glo_lang['ho_va_ten'] ?> (*)" value="<?=!empty($_POST['s_fullname']) ? $_POST['s_fullname'] : @$hoten ?>" onFocus="if (this.value == '<?=$glo_lang['ho_va_ten'] ?> (*)'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=$glo_lang['ho_va_ten'] ?> (*)';}" data-name="<?=$glo_lang['ho_va_ten'] ?> (*)" data-msso="<?=$glo_lang['nhap_ho_ten'] ?>"/>
                </li>
                <li class="phone">
                    <input type="hidden" name="s_dienthoai_s" value="<?=base64_encode($glo_lang['so_dien_thoai']) ?>">
                    <input class="cls_data_check_form" data-rong="1"  name="s_dienthoai" id="s_dienthoai" type="text" placeholder="<?=$glo_lang['so_dien_thoai'] ?> (*)" value="<?=!empty($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : @$sodienthoai ?>" onFocus="if (this.value == '<?=$glo_lang['so_dien_thoai'] ?> (*)'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=$glo_lang['so_dien_thoai'] ?> (*)';}" data-name="<?=$glo_lang['so_dien_thoai'] ?> (*)" data-msso="<?=$glo_lang['nhap_so_dien_thoai'] ?>" data-msso1="<?=$glo_lang['so_dien_thoai_khong_hop_le'] ?>"/>
                </li>
                <li class="mail">
                    <input type="hidden" name="s_email_s" value="<?=base64_encode($glo_lang['email']) ?>">
                    <input class="cls_data_check_form" data-rong="1" data-email="1" name="s_email" id="s_email" type="text" placeholder="<?=$glo_lang['email'] ?> (*)" value="<?=!empty($_POST['s_email']) ? $_POST['s_email'] : @$email  ?>" onFocus="if (this.value == '<?=$glo_lang['email'] ?> (*)'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=$glo_lang['email'] ?> (*)';}" data-msso="<?=$glo_lang['chua_nhap_dia_chi_email'] ?>" data-msso1="<?=$glo_lang['dia_chi_email_khong_hop_le'] ?>"/>
                </li>

            </div>
            <div class="right">
                <li class="local">
                    <input type="hidden" name="s_address_s" value="<?=base64_encode($glo_lang['dia_chi']) ?>">
                    <input name="s_address" id="s_address" type="text" placeholder="<?=$glo_lang['dia_chi'] ?>" value="<?=!empty($_POST['s_address']) ? $_POST['s_address'] : @$diachi ?>" onFocus="if (this.value == '<?=$glo_lang['dia_chi'] ?>'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=$glo_lang['dia_chi'] ?>';}"/>
                </li>

                <li class="subject">
                    <input type="hidden" name="s_title_s" value="<?=base64_encode($glo_lang['tieu_de']) ?>">
                    <input  name="s_title" id="s_title" type="text" placeholder="<?=$glo_lang['tieu_de'] ?>" value="<?=!empty($_POST['s_title']) ? $_POST['s_title'] : '' ?>" onFocus="if (this.value == '<?=$glo_lang['tieu_de'] ?>'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=$glo_lang['tieu_de'] ?>';}" data-name="<?=$glo_lang['tieu_de'] ?>" data-msso="<?=$glo_lang['nhap_tieu_de'] ?>"/>
                </li>
                <li class="code">
                    <span style="line-height: 0;padding-right: 0;"><img src="<?=$full_url."/load-capcha/" ?>" alt="CAPTCHA code" style="height: 41px; width: auto; cursor: pointer; position: relative; top: 2px; right: 2px;" onclick="$(this).attr('src','<?=$full_url."/load-capcha/" ?>')" id="img_contact_cap"><i class="fa fa-refresh" style="position: absolute; right: 3px; bottom: 3px; font-size: 10px; color: #666;" onclick="$('#img_contact_cap').attr('src','<?=$full_url."/load-capcha/" ?>')"></i></span>
                    <input class="cls_data_check_form" data-rong="1" name="mabaove" id="mabaove" type="text" placeholder="<?=$glo_lang['ma_bao_ve'] ?> (*)" value="" onFocus="if (this.value == '<?=$glo_lang['ma_bao_ve'] ?> (*)'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=$glo_lang['ma_bao_ve'] ?> (*)';}" data-msso="<?=$glo_lang['vui_long_nhap_ma_bao_ve'] ?>"/>
                </li>

            </div>
            <div class="clr"></div>
            <li class="mess">
                <input type="hidden" name="s_message_s" value="<?=base64_encode($glo_lang['noi_dung_lien_he']) ?>">
                <textarea class="cls_data_check_form" data-rong="1" name="s_message" id="s_message" cols="" rows="" placeholder="<?=$glo_lang['noi_dung_lien_he'] ?>  (*)" data-msso="<?=$glo_lang['nhap_noi_dung'] ?>"><?=!empty($_POST['s_message']) ? $_POST['s_message'] : '' ?></textarea>
                <div class="clr"></div>
            </li>
            <a onclick="return CHECK_send_lienhe('<?=$full_url?>/','#formnamecontact2', '.cls_data_check_form')" style="cursor:pointer" class="button"><?=$glo_lang['gui'] ?> <img src="images/loading2.gif" class="ajax_img_loading"></a>
            <a onclick="RefreshFormMailContact(formnamecontact2)" style="cursor:pointer" class="button"><?=$glo_lang['lam_lai'] ?> </a>

        </form>

    </div>
<div class="contact-maps">
    <li><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15677.684748873357!2d106.690252!3d10.779018!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x312e2babd77bc83b!2zQ8O0bmcgdHkgUC5BIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1606268915324!5m2!1svi!2s" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></li>
    <div class="clr"></div>
</div>
</div>




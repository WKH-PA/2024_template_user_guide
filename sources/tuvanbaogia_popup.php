<?php
$noidung = LAYTEXT_rieng(78);
$image_url = full_src($noidung, '');
?>
<div class="tuvanbaogia_popup">
    <h3> <?=$glo_lang['gui_yeu_cau_cho']?> <img src="<?=$image_url ?>"> </h3>
    <form action="" method="post" accept-charset="UTF-8" id="formname12">
        <input type="hidden" name="send_lienhe1">
        <input type="hidden" class="lang_ok" value="Yêu cầu của bạn đã được gửi">
        <input type="hidden" class="lang_false" value="Nhập mã bảo vệ chưa đúng">
        <input type="hidden" name="tieude_lienhe" value="Thông tin liên hệ">
        <input type="hidden" name="tieude_lienhe" value="<?=!empty($thongtin_lienhe) ? $thongtin_lienhe : base64_encode($glo_lang['gui_yeu_cau_lien_he']) ?>">
        <ul>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_fullname_s" class="form-control" value="<?=base64_encode($glo_lang['ho_va_ten']) ?>">
                    <input class="cls_data_check_form form-control" data-rong="1" name="s_fullname" id="s_fullname" type="text" placeholder="<?=$glo_lang['ho_va_ten'] ?> (*)" value="<?=!empty($_POST['s_fullname']) ? $_POST['s_fullname'] : @$hoten ?>" onFocus="if (this.value == '<?=$glo_lang['ho_va_ten'] ?> (*)'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=$glo_lang['ho_va_ten'] ?> (*)';}" data-name="<?=$glo_lang['ho_va_ten'] ?> (*)" data-msso="<?=$glo_lang['nhap_ho_ten'] ?>"/>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_email_s" value="<?=base64_encode($glo_lang['email']) ?>">
                    <input class="cls_data_check_form form-control" data-rong="1" data-email="1" name="s_email" id="s_email" type="text" placeholder="<?=$glo_lang['email'] ?> (*)" value="<?=!empty($_POST['s_email']) ? $_POST['s_email'] : @$email ?>" onFocus="if (this.value == '<?=$glo_lang['email'] ?> (*)'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=$glo_lang['email'] ?> (*)';}" data-msso="<?=$glo_lang['chua_nhap_dia_chi_email'] ?>" data-msso1="<?=$glo_lang['dia_chi_email_khong_hop_le'] ?>"/>
                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <input type="hidden" name="s_dienthoai_s" value="<?=base64_encode($glo_lang['so_dien_thoai']) ?>">
                    <input class="cls_data_check_form form-control" data-rong="1"  name="s_dienthoai" id="s_dienthoai" type="text" placeholder="<?=$glo_lang['so_dien_thoai'] ?> (*)" value="<?=!empty($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : @$sodienthoai ?>" onFocus="if (this.value == '<?=$glo_lang['so_dien_thoai'] ?> (*)'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=$glo_lang['so_dien_thoai'] ?> (*)';}" data-name="<?=$glo_lang['so_dien_thoai'] ?> (*)" data-msso="<?=$glo_lang['nhap_so_dien_thoai'] ?>" data-msso1="<?=$glo_lang['so_dien_thoai_khong_hop_le'] ?>"/>                </div>
            </li>
            <li class="mess">
                <div class="col-md row-frm">
                    <input type="hidden" name="s_message_s" value="<?=base64_encode($glo_lang['noi_dung_lien_he']) ?>">
                    <textarea class="cls_data_check_form form-control" data-rong="1" name="s_message" id="s_message" cols="" rows="" placeholder="<?=$glo_lang['noi_dung_lien_he'] ?>  (*)" data-msso="<?=$glo_lang['nhap_noi_dung'] ?>"><?=!empty($_POST['s_message']) ? $_POST['s_message'] : '' ?></textarea>
                    <div class="clr"></div>                </div>
            </li>
            <li>
                <div class="col-md row-frm">
                    <h4>
                        <a onclick="return CHECK_send_lienhe1('<?=$full_url?>','#formname12', 'cls_data_check_form form-control')" style="cursor:pointer;" class="button-link">
                            <?=$glo_lang['gui_yeu_cau']?>  <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            <img src="images/loading2.gif" class="ajax_img_loading" style="display:none;">
                        </a>
                    </h4>
                </div>
            </li>
        </ul>
    </form>
    <div style="margin-top: 20px;">
        <?=$glo_lang['dich_tu_van_khach_hang']?>

    </div>
</div>


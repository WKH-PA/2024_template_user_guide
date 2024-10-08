<?php
if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0)
{
    // ALERT_js($glo_lang['hien_chua_co_san_pham_nao_trong_gio_hang']);
    LOCATION_js($full_url);
}
$sql = DB_que("SELECT * FROM `#_module_tinhnang` WHERE `m_action` = 'danh-sach-thanh-toan-vnpay' ORDER BY `sort` ASC ");
$pt  = mysqli_fetch_assoc($sql);
$thongtin_step  = DB_que("SELECT * FROM `#_step` WHERE `showhi` = 1 AND `id` = 3 LIMIT 1");
$thongtin_step  = mysqli_fetch_assoc($thongtin_step);

$link_cart      = GET_link($full_url, SHOW_text(laySeoName('seo_name', '#_step', '`showhi` = 1 AND `step` = 2')));
if(isset($_SESSION['email']))
{
    $info_acc     = DB_fet("*", "#_members", "`email` = '".$_SESSION['email']."' AND `phanquyen` = 0", "`id` DESC");
    $info_acc     = mysqli_fetch_assoc($info_acc);
    $hoten        = $info_acc['hoten'];
    $sodienthoai  = $info_acc['sodienthoai'];
    $email        = $info_acc['email'];
    $diachi       = $info_acc['diachi'];
}
else
{
    $hoten        = '';
    $sodienthoai  = '';
    $email        = '';
    $diachi       = '';
}
$thongtin_step   = LAY_anhstep_now(LAY_id_step(1));
?>


<div class="page_conten_page">
    <div class="link_page" style="margin-left: 100px">
        <ul>
            <h3><?=$glo_lang['dat_hang'] ?></h3>
            <li><a href="<?=$full_url ?>"><i class="fa fa-home"></i><?=$glo_lang['trang_chu'] ?></a><span>/</span><a href="<?=$full_url."/dat-hang" ?>"><?=$glo_lang['dat_hang'] ?></a></li>
        </ul>
    </div>
    <div class="pagewrap no_box">
        <style>
            .dv-pttt-child { width: calc(100% - 20px); margin: 0 10px; position: relative;}
            .dv-pttt-child .dv-ndpm { display: none; }
            .dv-pttt-child input { width: 18px; height: 18px; position: absolute; top: 6px; }
            .dv-pttt-child img { height: 70px; width: auto; margin: 10px 0; filter: gray; filter: grayscale(100%); opacity: .8; display: none}
            .dv-pttt-child h3 { font-size: 15px; font-weight: 500; line-height: 25px; }
            .dv-phuongthucthanhtoan {margin: 15px 0;}
            .dv-ndphuongthuc-thanhtoan.no_box.flex {  margin: 0 -10px;}
            .dv-pttt-child label { display: block; padding: 2px 25px; border: none; outline: none; background: none; height: 100%; }
            /*.dv-pttt-child input[type="radio"]:checked+label { background: #43a04714; display: block; }*/
            .dv-pttt-child input[type="radio"]:checked+label h3 { color: #ff4242; }
            .dv-pttt-child input[type="radio"]:checked+label img { filter: grayscale(0); opacity: 1}
            .dv-ndphuongthuc-thanhtoan .dv-ndpm { display: none; background: rgba(241, 241, 241, 0.14); border: dashed 1px #e1e1e1; outline: solid 1px #fff; padding: 10px 15px; line-height: 25px; width: calc(100% - 20px); font-size: 14px; margin-top: 10px; }
            .dv-ndphuongthuc-thanhtoan .dv-ndpm strong { font-weight: 500; font-size: 16px; color: #000; line-height: 22px; }
            .dv-ndphuongthuc-thanhtoan .dv-ndpm p { margin-bottom: 5px }
            .dv-ndphuongthuc-thanhtoan .dv-ndpm ul li { margin-left: 39px; list-style-type: disc !important; display: list-item !important; margin: 0 0 0 25px; }
            .dv-send-hd-buy { margin-bottom: 0px; display: inline-block; width: 100%; }
            .div-buy-checkout { background: #fff; padding: 15px; }
            .div-buy-checkout div#cart_list { padding: 0; }

            @media only screen and (max-width: 767px) {.dv-pttt-child { width: calc(100% - 20px);}}
        </style>
        <div class="pagewrap page_conten_page page_conten_page_dh "  style="padding-top: 0">
            <!--  -->
            <div class="div-buy-checkout">
                <form action="" class="formBox" method="post" name="FormNameContact_cart" id="FormNameContact_cart">
                    <div id="cart_list" class="buy_cart_list">
                        <h2><?=$glo_lang['thong_tin_don_hang'] ?></h2>

                        <div class="dv-table-reposive tb_rps">
                            <table width="100%" border="0" cellspacing="1" cellpadding="5">
                                <tr>
                                    <th><?=$glo_lang['cart_ten_sp'] ?></th>
                                    <th width="10%" class="text-center"><?=$glo_lang['cart_qty'] ?></th>
                                    <th width="15%" style="text-align:right"><?=$glo_lang['cart_dongia'] ?></th>
                                    <th width="15%" style="text-align:right"><?=$glo_lang['cart_thanhtien'] ?></th>
                                </tr>
                                <?php
                                $tongtien      = 0;
                                $stt           = 0;
                                // $tinhnang_arr  = LAY_bv_tinhnang(LAY_id_step(2));
                                $tinhnang_arr  = LAY_bv_tinhnang(2);
                                foreach ($_SESSION['cart'] as $key => $value) {
                                    $id_sp     = explode("_", $key);
                                    $id_sp     = $id_sp[0];

                                    $sanpham   = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` = 1 AND `id` = '".$id_sp."' LIMIT 1");
                                    if(mysqli_num_rows($sanpham) > 0) {
                                        $sanpham    = mysqli_fetch_assoc($sanpham);

                                        $dongia     = check_gia_sql($id_sp, @$_SESSION['tinhnang'][$key], $sanpham['giatien']);
                                        // $thuoctinh  = thuoctinh_lang($sanpham, $lang);

                                        $thanhtien = $dongia * $value;
                                        $tongtien  += $thanhtien;
                                        $stt       ++;
                                        // $tinhnang_arr  = @DB_fet("*","#_baiviet_tinhnang","`id` IN (".@$_SESSION['tinhnang'][$id_sp].")","`catasort` DESC","","arr");
                                        //
                                        // lay hinh
                                        $anhsp = checkImage($fullpath, $sanpham['icon'], $sanpham['duongdantin'], '');
                                        $check_sl_tinhnang  = DB_fet_rd("* "," `#_baiviet_select_tinhnang` ","`id_baiviet` = '".$id_sp."'","","","id_val");

                                        $isthuoctinh = @explode(",", $_SESSION['tinhnang'][$key]);
                                        if(is_array($isthuoctinh)) {
                                            foreach ($isthuoctinh as $ittinh) {
                                                if(@$check_sl_tinhnang[$ittinh]['icon'] == "") continue;
                                                $anhsp = checkImage($fullpath, $check_sl_tinhnang[$ittinh]['icon'], $check_sl_tinhnang[$ittinh]['duongdantin']);
                                                break;
                                            }
                                        }
                                        //
                                        ?>
                                        <tr>
                                            <!-- <td class="cls_cart_mb" title="<?=$glo_lang['cart_hinh'] ?>"><?=$stt ?></td> -->
                                            <td style="text-align:left" title="<?=$glo_lang['cart_ten_sp'] ?>" class="dv-anh-cart-sp">
                                                <a href="<?=GET_link($full_url, SHOW_text($sanpham['seo_name'])) ?>"><img src="<?=$anhsp ?>" alt="<?=SHOW_text($sanpham['tenbaiviet_'.$_SESSION['lang']]) ?>"/></a>
                                                <div class="dv-anh">

                                                    <a href="<?=GET_link($full_url, SHOW_text($sanpham['seo_name'])) ?>"><?=SHOW_text($sanpham['tenbaiviet_'.$_SESSION['lang']]) ?></a>
                                                    <p><?=SHOW_text($sanpham['p1']) ?></p>
                                                    <p class="p_mota_cart">
                                                        <?php
                                                        // foreach ($tinhnang_arr as $tnr) {
                                                        //    echo '<span>'.$tnr['tenbaiviet_'.$lang].'</span>';
                                                        // }
                                                        ?>
                                                        <?php
                                                        $isthuoctinh = @explode(",", $_SESSION['tinhnang'][$key]);
                                                        if(is_array($isthuoctinh)) {
                                                            foreach ($isthuoctinh as $ittinh) {
                                                                if(@$tinhnang_arr[$ittinh]['tenbaiviet_'.$lang] == "") continue;
                                                                echo '<span>'.$tinhnang_arr[$ittinh]['tenbaiviet_'.$lang].'</span>';
                                                            }
                                                        }
                                                        ?>
                                                    </p>
                                                </div>

                                            </td>
                                            <td  title="<?=$glo_lang['cart_qty'] ?>"><?=$value ?></td>
                                            <td style="text-align:right" title="<?=$glo_lang['cart_dongia'] ?>"><b><?=($dongia == 0) ? 0 : NUMBER_fomat($dongia)." ".$glo_lang['dvt'] ?></b></td>
                                            <td style="text-align:right" title="<?=$glo_lang['cart_thanhtien'] ?>"><b><span class="td_thanhtien_<?=$key ?>"><?=($thanhtien== 0)  ? 0 : NUMBER_fomat($thanhtien) ?></span> <?=$glo_lang['dvt'] ?></b></td>

                                        </tr>
                                    <?php  }} ?>
                            </table>
                        </div>
                        <div class="clr"></div>
                        <div class="dv-tongtien no_box">
                            <input type="hidden" class="cls_datafalse" value="<?=$glo_lang['alert_dat_hang'] ?>">
                            <span id="pro_sum"><?=$glo_lang['cart_tong_tien'] ?>:
                    <label class='tb_tongtien'><?=($tongtien == 0) ? "0": NUMBER_fomat($tongtien)." ".$glo_lang['dvt'] ?></label>
                    </span>
                        </div>
                        <div class="clr"></div>
                        <div class="clr"></div>
                    </div>
                    <div class=" contact_cart contact_sp">
                        <h2><?=$glo_lang['thong_tin_nguoi_mua_hang'] ?></h2>
                        <div class=" contact_lh contact_lh_cart no_box" id="contact">
                            <input type="hidden" name="gui_donhang">
                            <input type="hidden" class="lang_ok" value="<?=$glo_lang['don_hang_cua_ban_da_duoc_gui'] ?>">
                            <input type="hidden" class="lang_false" value="<?=$glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
                            <input type="hidden" name="id_token" id="id_token" class="id_token" value="<?=$_SESSION['token'] = md5(RANDOM_chuoi(5)) ?>">
                            <div class="left">
                                <li class="name">
                                    <input type="hidden" name="s_fullname_s" value="<?= base64_encode($glo_lang['ho_va_ten']) ?>">
                                    <input class="cls_data_check_form" data-rong="1" name="s_fullname" id="s_fullname" type="text" placeholder="<?= $glo_lang['ho_va_ten'] ?> (*)" value="<?= !empty($_POST['s_fullname']) ? $_POST['s_fullname'] : @$hoten ?>" onFocus="if (this.value == '<?= $glo_lang['ho_va_ten'] ?> (*)'){this.value='';}" onBlur="if (this.value == '') {this.value='<?= $glo_lang['ho_va_ten'] ?> (*)';}" data-name="<?= $glo_lang['ho_va_ten'] ?> (*)" data-msso="<?= $glo_lang['nhap_ho_ten'] ?>" />
                                </li>
                                <li class="phone">
                                    <input type="hidden" name="s_dienthoai_s" value="<?= base64_encode($glo_lang['so_dien_thoai']) ?>">
                                    <input class="cls_data_check_form" data-rong="1" data-phone="1" name="s_dienthoai" id="s_dienthoai" type="text" placeholder="<?= $glo_lang['so_dien_thoai'] ?> (*)" value="<?= !empty($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : @$sodienthoai ?>" onFocus="if (this.value == '<?= $glo_lang['so_dien_thoai'] ?> (*)'){this.value='';}" onBlur="if (this.value == '') {this.value='<?= $glo_lang['so_dien_thoai'] ?> (*)';}" data-name="<?= $glo_lang['so_dien_thoai'] ?> (*)" data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>" data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>" />
                                </li>
                                <li class="mail">
                                    <input type="hidden" name="s_email_s" value="<?= base64_encode($glo_lang['email']) ?>">
                                    <input class="cls_data_check_form" data-rong="1" data-email="1" name="s_email" id="s_email" type="text" placeholder="<?= $glo_lang['email'] ?> (*) " value="<?= !empty($_POST['s_email']) ? $_POST['s_email'] : @$email ?>" onFocus="if (this.value == '<?= $glo_lang['email'] ?>'){this.value='';}" onBlur="if (this.value == '') {this.value='<?= $glo_lang['email'] ?>';}" data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>" data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>" />
                                </li>
                                <li class="local">
                                    <input name="address" id="address"  type="text" placeholder="<?= $glo_lang['dia_chi'] ?> (*)">
                                    <select id="city" name="city" onchange="filterDistricts()">
                                        <option value="">Chọn Thành Phố</option>
                                        <?php
                                        // Kết nối database và lấy danh sách thành phố
                                        $tp = DB_que("SELECT id, tenbaiviet_vi FROM lh_ship_khuvuc WHERE id_parent = 0");
                                        while ($row = mysqli_fetch_assoc($tp)) {
                                            echo "<option value='".$row['id']."'>".$row['tenbaiviet_vi']."</option>";
                                        }
                                        ?>
                                    </select>

                                    <select id="district" name="district">
                                        <option value="">Chọn Quận/Huyện</option>
                                        <?php
                                        // Lấy danh sách quận/huyện
                                        $quan = DB_que("SELECT id, id_parent, tenbaiviet_vi FROM lh_ship_khuvuc WHERE id_parent > 0 ");
                                        while($row = mysqli_fetch_assoc($quan)) {
                                            echo "<option value='".$row['id']."' data-parent='".$row['id_parent']."'>".$row['tenbaiviet_vi']."</option>";
                                        }
                                        ?>
                                    </select>

                                    <input type="hidden" name="s_address_s" value="<?= base64_encode($glo_lang['dia_chi']) ?>">
                                    <input type="hidden" class="cls_data_check_form" data-rong="1" name="s_address" id="s_address" type="text" placeholder="<?= $glo_lang['dia_chi'] ?>" value="<?= !empty($_POST['s_address']) ? $_POST['s_address'] : @$diachi ?>" onFocus="if (this.value == '<?= $glo_lang['dia_chi'] ?>'){this.value='';}" onBlur="if (this.value == '') {this.value='<?= $glo_lang['dia_chi'] ?>';}" data-msso="<?= $glo_lang['dia_chi_khong_du'] ?>" />
                                </li>
                            </div>
                            <div class="right">
                                <li class="mess">
                                    <input type="hidden" name="s_message_s" value="<?= base64_encode($glo_lang['noi_dung_lien_he']) ?>">
                                    <textarea class="cls_data_check_form" name="s_message" id="s_message" cols="" rows="" placeholder="<?= $glo_lang['noi_dung_lien_he'] ?>"><?= !empty($_POST['s_message']) ? $_POST['s_message'] : '' ?></textarea>
                                    <div class="clr"></div>
                                </li>
                            </div>

                            <div class="clr"></div>
                            <div>
                                <div class="left">
                                    <p class="require_pc" style="color:red;"><?=$glo_lang['thong_tin_bat_buoc']?></p>
                                </div>
                                <div class="clr"></div>
                            </div>
                        </div>
                    </div>

                    <div id="cart_list" class="buy_cart_list dv-phuongthucthanhtoan">
                        <h2><?=$glo_lang['phuong_thuc_thanh_toan'] ?></h2>
                        <div class="dv-ndphuongthuc-thanhtoan no_box flex">
                            <?php
                            $i = 0;
                            $pthucthanhtoan = DB_fet("*","#_phuongthucthanhtoan","`showhi` = 1","`catasort` DESC","","arr");
                            foreach ($pthucthanhtoan as $rows) {
                                $i++;
                                ?>
                                <div class="dv-pttt-child">
                                    <input type="radio" value="<?=$rows['id'] ?>" name="type_payment" id="type<?=$rows['id'] ?>" <?=$i == 1 ? "checked='checked'" : "" ?> >
                                    <label for="type<?=$rows['id'] ?>" onclick="$('.dv-ndpm').hide(); $('.dv-ndpm-<?=$rows['id'] ?>').show()">
                                        <img src="<?=checkImage($fullpath, $rows['icon'], $rows['duongdantin'], '') ?>" alt="">
                                        <h3><?=$rows['tenbaiviet_'.$lang] ?></h3>
                                    </label>
                                </div>

                            <?php } ?>
                            <div class="dv-pttt-child">
                                <input type="radio" value="0" name="type_payment" id="typepp" <?=!empty($_POST['type_payment']) && $_POST['type_payment'] == 0 ? 'checked="checked"' : '' ?> >
                                <label for="typepp" onclick="$('.dv-ndpm').hide(); $('.dv-ndpm-0').show()">
                                    <h3><?=$glo_lang['thanh_toan_paypal'] ?></h3>
                                </label>
                            </div>
                            <?php if($pt['showhi'] == 1){ ?>
                                <div class="dv-pttt-child">
                                    <input type="radio" value="0" name="type_payment" id="typevnp" <?=!empty($_POST['type_payment']) && $_POST['type_payment'] == 0 ? 'checked="checked"' : '' ?> >
                                    <label for="typevnp" onclick="$('.dv-ndpm').hide(); $('.dv-ndpm-0').show()">
                                        <h3><?=$glo_lang['thanh_toan_vnpay'] ?></h3>
                                    </label>
                                </div>
                            <?php } ?>

                            <div class="clr"></div>
                            <?php
                            $i = 0;
                            foreach ($pthucthanhtoan as $rows) {
                                $i++;
                                ?>
                                <div class="dv-ndpm dv-ndpm-<?=$rows['id'] ?>" style="<?=$i == 1 ? "display: block" : "" ?>">
                                    <?=SHOW_text($rows['noidung_'.$lang]) ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="clr"></div>
                    <div class="dv-send-hd dv-send-hd-buy">
                        <a onclick="RefreshFormMailContact(FormNameContact_cart)" style="cursor:pointer" class="button"><?=$glo_lang['lam_lai'] ?></a>
                        <a href="<?=$full_url?>/gio-hang/" class="button mar"><?=$glo_lang['chinh_sua_don_hang'] ?></a>
                        <a onclick="return CHECK_send_lienhe('<?=$full_url ?>/','#FormNameContact_cart', '.cls_data_check_form')"  style="cursor:pointer" class="button"><?=$glo_lang['gui_don_hang'] ?> <img src="images/loading2.gif" class="ajax_img_loading"></a>
                    </div>
                </form>
            </div>
            <!--  -->
        </div>
    </div>
</div>
<?php include _source."paypal.php"; ?>
<?php include _source."vnpay.php"; ?>
<script>
    document.getElementById('FormNameContact_cart').addEventListener('click', function(event) {
        updateAddress();
    });
    function filterDistricts() {
        var cityId = document.getElementById('city').value;
        var districtDropdown = document.getElementById('district');
        var options = districtDropdown.getElementsByTagName('option');

        if (cityId) {
            districtDropdown.style.display = 'block';
        } else {
            districtDropdown.style.display = 'none';
            districtDropdown.value = "";
            return;
        }

        for (var i = 1; i < options.length; i++) { // Bắt đầu từ 1 để bỏ qua option mặc định
            var option = options[i];
            var parentId = option.getAttribute('data-parent');

            if (cityId === parentId) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        }
        districtDropdown.value = "";

    }

    function updateAddress() {
        var cityDropdown = document.getElementById('city');
        var districtDropdown = document.getElementById('district');
        var addressInput = document.getElementById('address');

        // Lấy tên thành phố, quận/huyện và địa chỉ
        var cityName = cityDropdown.options[cityDropdown.selectedIndex]?.text || '';
        var districtName = districtDropdown.options[districtDropdown.selectedIndex]?.text || '';
        var addressName = addressInput?.value || '';

        // Kiểm tra nếu cả 3 biến đều có giá trị
        if (cityName && districtName && addressName) {
            var address = addressName + ', ' + districtName + ', ' + cityName;
            document.getElementById('s_address').value = address;
            console.log('Updated s_address:', address);
        } else {
            console.log('Không thể cập nhật địa chỉ. Vui lòng đảm bảo cả ba trường đều có giá trị.');
        }
    }
    document.addEventListener('DOMContentLoaded', function () {filterDistricts(); });
</script>
<style>
    .page_conten_page{
        margin-top: 110px;

    }

    h2 {
        color: #444;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .dv-tongtien {
        font-size: 22px;
        font-weight: bold;
        text-align: right;
        margin-top: 15px;
    }

    .dv-ndphuongthuc-thanhtoan .dv-ndpm {
        background-color: #fff;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 5px;
        margin-top: 10px;
        display: none;
    }


    #cart_list table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    #cart_list table th,
    #cart_list table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    #cart_list table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    .dv-anh-cart-sp img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin-right: 15px;
        border-radius: 5px;
    }

    .dv-anh-cart-sp .dv-anh {
        display: flex;
        flex-direction: column;
    }

    @media (max-width: 767px) {
        .dv-pttt-child {
            width: 100%;
        }

        .dv-anh-cart-sp img {
            width: 60px;
            height: 60px;
        }

        .pagewrap {
            padding: 10px;
        }
    }
    .page_conten_page {
        background: #f9f9f9;
        padding: 20px 0;
    }

    .page_conten_page h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
        text-transform: uppercase;
    }

    .contact_cart input,
    .contact_cart textarea,
    .contact_cart select {
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #fff;
        font-size: 16px;
        color: #333;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .contact_cart input:focus,
    .contact_cart textarea:focus,
    .contact_cart select:focus {
        border-color: #ff4242;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.2);
    }

    .contact_cart textarea {
        resize: vertical;
        min-height: 150px;
    }

    .contact_cart label {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 5px;
        color: #555;
    }
    .page_conten_page {
        background: #f9f9f9;
        padding: 20px 0;
    }

    .page_conten_page h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
        text-transform: uppercase;
    }

    .contact_cart input,
    .contact_cart textarea,
    .contact_cart select {
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #fff;
        font-size: 16px;
        color: #333;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .contact_cart input:focus,
    .contact_cart textarea:focus,
    .contact_cart select:focus {
        border-color: #ff4242;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.2);
    }

    .contact_cart textarea {
        resize: vertical;
        min-height: 150px;
    }

    .contact_cart label {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 5px;
        color: #555;
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        background: #ff4242;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        text-align: center;
        transition: background 0.3s ease;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .button:hover {
        background: #e53935;
        cursor: pointer;
    }





    .dv-tongtien {
        font-size: 18px;
        font-weight: 700;
        margin-top: 20px;
        color: #ff4242;
    }

    .dv-send-hd-buy a.button {
        margin-top: 10px;
        margin-right: 10px;
        text-align: center;
    }

    .dv-send-hd-buy .ajax_img_loading {
        width: 20px;
        height: auto;
        display: none;
    }

    .dv-send-hd-buy a.button:hover .ajax_img_loading {
        display: inline-block;
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        background: #ff4242;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        text-align: center;
        transition: background 0.3s ease;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .button:hover {
        background: #e53935;
        cursor: pointer;
    }






    .dv-tongtien {
        font-size: 18px;
        font-weight: 700;
        margin-top: 20px;
        color: #ff4242;
    }

    .dv-send-hd-buy a.button {
        margin-top: 10px;
        margin-right: 10px;
        text-align: center;
    }

    .dv-send-hd-buy .ajax_img_loading {
        width: 20px;
        height: auto;
        display: none;
    }

    .dv-send-hd-buy a.button:hover .ajax_img_loading {
        display: inline-block;
    }


</style>
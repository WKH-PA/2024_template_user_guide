<?php
// Start of PHP code block
if ((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step)) {
    $numview = 8;
} else {
    $numview = $thongtin_step['num_view'];
}

$key = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
$is_search = isset($_GET['key']) ? true : false;

$lay_all_kx = "";
$name_titile = !empty($arr_running['tenbaiviet_'.$lang]) ? SHOW_text($arr_running['tenbaiviet_'.$lang]) : "";
if ($is_search) {
    $slug_step = "2";
    $name_titile = $glo_lang['tim_kiem'];
    // $thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `id` = '6' LIMIT 1");
    // $thongtin_step = mysqli_fetch_assoc($thongtin_step);
} else if ($slug_table != 'step') {
    $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
}
$wh = "";
if ($lay_all_kx != "") {
    $wh = "  AND `id_parent` in (".$lay_all_kx.") ";
}

if ($is_search) {
    $wh .= " AND (`tenbaiviet_vi` LIKE '%".$key."%' OR `tenbaiviet_en` LIKE '%".$key."%')";
}

// //check tieu thuyet
if ($slug_step == 1) {
    $wh .= " AND `id_baiviet` = 0";
}
//

include _source."phantrang_kietxuat.php";
// include _source."phantrang_danhmuc.php";

// $anhcon   = LAY_anhstep($thongtin_step['id'], 1);

if ($is_search != "") {
    $link_p = '<span>/</span><a>'.$glo_lang['tim_kiem']."</a>";
    $thongtin_step = LAY_anhstep_now(3);
} else {
    $link_p =  GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/');
}

// full_src($thongtin_step, '')
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
    <div class="tin_left">
        <div class="title_news">
            <h2>KHÁCH HÀNG VÀ ĐỐI TÁC</h2>
        </div>
        <div class="tt_page_top tt_doitac flex">
            <?php
            if ($nd_total == 0) {
                echo "<div class='dv-notfull'>".$glo_lang['khong_tim_thay_du_lieu_nao']."</div>";
            } else {
                $i = 0;
                foreach ($nd_kietxuat as $rows) {
                    $i++;
                    if ($i == 6) $i = 0;
                    ?>
                    <div class="new_id_bs">
                        <li>
                            <a <?= full_href($rows) ?>><?= full_img($rows) ?>
                            </a>
                        </li>
                        <ul>
                            <h3><a <?= full_href($rows) ?>><?= SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
                        </ul>
                        <div class="clr"></div>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
        <div class="nums no_box">
            <?= PHANTRANG($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
            <div class="clr"></div>
        </div>
    </div>
    <?php include _source."left_conten.php";?>
    <div class="clr"></div>
</div>

<?php
$numview = (!empty($thongtin_step) && $thongtin_step['num_view'] != 0) ? $thongtin_step['num_view'] : 12;

$key = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
$is_search = !empty($key);

$lay_all_kx = "";
$name_titile = !empty($arr_running['tenbaiviet_'.$lang]) ? SHOW_text($arr_running['tenbaiviet_'.$lang]) : "";

if ($is_search) {
    $slug_step = "2";
    $name_titile = $glo_lang['tim_kiem'];
} else if ($slug_table != 'step') {
    $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
}

$wh = "";
if ($lay_all_kx != "") {
    $wh = " AND `id_parent` IN (".$lay_all_kx.") ";
}

if ($is_search) {
    $key_lower = strtolower($key);
    //Sử dụng explode(' ', $key_lower) để chia từ khóa thành các phần nhỏ hơn.
    $key_parts = explode(' ', $key_lower);
    $wh .= " AND (";
    foreach ($key_parts as $part) {
        $wh .= "LOWER(`tenbaiviet_vi`) LIKE '%".$part."%' OR LOWER(`tenbaiviet_en`) LIKE '%".$part."%' OR ";
    }
    $wh = rtrim($wh, " OR ") . ")";
}

include _source."phantrang_kietxuat.php";


?>
<div class="banner">
    <?php
    $banner_top = LAY_banner_new("`id_parent` = 32");
    foreach ($banner_top as $rows) {
        echo '<img src="' . htmlspecialchars($fullpath . "/" . $rows['duongdantin'] . "/" . $rows['icon'], ENT_QUOTES, 'UTF-8') . '" alt="Banner Image" style="width: 100%; height: auto; object-fit: cover;">';
    }
    ?>
</div>
<div class="page_conten_page pagewrap">
    <div class="tin_left">
        <div class="title_news">
            <h2><?= $glo_lang['dich_vu_chung_toi'] ?></h2>
        </div>
        <div class="col-lg-12 flex">
            <?php
            if ($nd_total == 0) {
                echo "<div class='dv-notfull'>".$glo_lang['khong_tim_thay_du_lieu_nao']."</div>";
            } else {
                $i = 0;
                foreach ($nd_kietxuat as $rows) {
                    $i++;
                    // Start a new row after every 2 items
                    if ($i % 2 == 1) {
                        echo '<div class="row">';
                    }
                    ?>
                    <div class="col-lg-6">
                        <div class="scale_hover_img lazyload">
                            <div class="scale_hover">
                                <a <?= full_href($rows) ?>>
                                    <img src="<?= htmlspecialchars($fullpath . "/" . $rows['duongdantin'] . "/" . $rows['icon'], ENT_QUOTES, 'UTF-8') ?>"
                                         alt="<?= htmlspecialchars($rows['alt'], ENT_QUOTES, 'UTF-8') ?>"
                                         width="500" height="500" style="object-fit: cover;">
                                </a>

                                <div class="info">
                                    <h3><a <?= full_href($rows) ?>><?= SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    // Close the row after every 2 items
                    if ($i % 2 == 0 || $i == count($nd_kietxuat)) {
                        echo '</div>'; // Close the row
                    }
                }
            }
            ?>
        </div>
        <div class="nums">
            <ul>
                <div class="nums no_box">
                    <?= PHANTRANG($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
                    <div class="clr"></div>
                </div>
            </ul>
            <div class="clr"></div>
        </div>
    </div>
    <?php include _source."left_conten.php";?>



    <div class="clr"></div>
</div>

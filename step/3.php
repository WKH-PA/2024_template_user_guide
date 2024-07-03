<div class="banner">
    <?php
    $banner_top = LAY_banner_new("`id_parent` = 32");
    foreach ($banner_top as $rows) {
        echo '<img src="' . htmlspecialchars($fullpath . "/" . $rows['duongdantin'] . "/" . $rows['icon'], ENT_QUOTES, 'UTF-8') . '" alt="Banner Image" style="width: 100%; height: auto; object-fit: cover;">';
    }
    ?>
</div>

<?php
// Initialize variables
$numview = 3; // Default number of items per page
$key = isset($_GET['key']) ? htmlspecialchars($_GET['key']) : ''; // Sanitize user input
$is_search = !empty($key); // Check if search query is present

// Default title
$name_title = !empty($arr_running['tenbaiviet_'.$lang]) ? SHOW_text($arr_running['tenbaiviet_'.$lang]) : "";

// Determine slug_step based on conditions
if ($is_search) {
    $slug_step = "1,3,4";
    $name_title = $glo_lang['tim_kiem']; // Update title for search
} else if ($slug_table != 'step') {
    $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
}

// Additional filter based on lay_all_kx
$wh = "";
if (!empty($lay_all_kx)) {
    $wh = " AND `id_parent` IN (".$lay_all_kx.")";
}

// Add search keyword filter
if ($is_search) {
    $wh .= " AND (`tenbaiviet_vi` LIKE '%".$key."%' OR `tenbaiviet_en` LIKE '%".$key."%')";
}

// Additional filter for slug_step == 1 (optional)
if ($slug_step == 1) {
    $wh .= " AND `id_baiviet` = 0";
}

// Include pagination script
include _source . "phantrang_kietxuat.php";
?>

<div class="page_conten_page pagewrap dv-tintuc">
    <div class="tin_left">
        <div class="title_news">
            <h2><?= $name_title ?></h2>
        </div>
        <div class="tt_page_top dv-tintuc">
            <?php foreach ($nd_kietxuat as $rows) : ?>
                <div class="new_id_bs">
                    <li>
                        <a <?= full_href($rows) ?>>">
                            <a <?= full_href($rows) ?>"><?= full_img($rows) ?></a>
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
                    <ul>
                        <h3><a <?= full_href($rows) ?>><?= SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
                        <p><?= SHOW_text(strip_tags($rows['mota_'.$lang])) ?></p>
                    </ul>
                    <div class="clr"></div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="nums">
            <ul>
                <div class="nums no_box">
                    <?=PHANTRANG($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
                    <div class="clr"></div>
                </div>
            </ul>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>

    <?php include _source."left_conten.php";?>



    <div class="clr"></div>
</div>

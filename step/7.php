<?php
// Lấy thông tin từ URL nếu có và lọc sạch dữ liệu
$key = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
$is_search = isset($_GET['key']);

// Thiết lập các biến ban đầu
$numview = 12;
$lay_all_kx = "";
$name_title = !empty($arr_running['tenbaiviet_' . $lang]) ? SHOW_text($arr_running['tenbaiviet_' . $lang]) : "";

// Xử lý khi đang tìm kiếm
if ($is_search) {
    $slug_step = "1,3,4";
    $name_title = $glo_lang['tim_kiem'];
} elseif ($slug_table != 'step') {
    $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
}

// Tạo điều kiện WHERE cho truy vấn dữ liệu
$wh = "";
if (!empty($lay_all_kx)) {
    $wh = " AND `id_parent` IN (" . $lay_all_kx . ") ";
}

if ($is_search) {
    $wh .= " AND (`tenbaiviet_vi` LIKE '%" . $key . "%' OR `tenbaiviet_en` LIKE '%" . $key . "%')";
}

// Xử lý điều kiện riêng cho tiêu thuyết
if ($slug_step == 1) {
    $wh .= " AND `id_baiviet` = 0";
}

// Include phân trang và các tệp cần thiết
include _source . "phantrang_kietxuat.php";

// Lấy banner từ cơ sở dữ liệu
$banner_top = LAY_banner_new("`id_parent` = 32");

// Lấy video từ cơ sở dữ liệu
$video = LAY_banner_new("`id_parent` = 27");
?>

<div class="banner">
    <?php foreach ($banner_top as $rows) : ?>
        <img src="<?= htmlspecialchars($fullpath . "/" . $rows['duongdantin'] . "/" . $rows['icon'], ENT_QUOTES, 'UTF-8') ?>" alt="Banner Image" style="width: 100%; height: auto; object-fit: cover;">
    <?php endforeach; ?>
</div>

<div class="page_conten_page pagewrap">
    <div class="tin_left">
        <div class="title_news">
            <h2><?= htmlspecialchars($name_title, ENT_QUOTES, 'UTF-8') ?></h2>
        </div>
        <div class="tt_page_top tt_video">
            <?php if (empty($video)) : ?>
                <div class='dv-notfull'><?= htmlspecialchars($glo_lang['khong_tim_thay_du_lieu_nao'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php else : ?>
                <?php foreach ($video as $row) : ?>
                    <div class="new_id_bs">
                        <li>
                            <a class="popup-video-mfp" href="https://www.youtube.com/embed/<?= htmlspecialchars($row['seo_name'], ENT_QUOTES, 'UTF-8') ?>">
                                <img src="<?= htmlspecialchars($fullpath . "/" . $row['duongdantin'] . "/" . $row['icon'], ENT_QUOTES, 'UTF-8') ?>" alt="Video Image" style="width: 100%; height: auto; object-fit: cover;">
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </a>
                        </li>
                        <ul>
                            <h3><a><?= htmlspecialchars(SHOW_text($row['tenbaiviet_' . $lang]), ENT_QUOTES, 'UTF-8') ?></a></h3>
                        </ul>
                        <div class="clr"></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php include _source . "left_conten.php"; ?>
    <div class="clr"></div>
</div>

<script>
    $(document).ready(function() {
        $('.popup-video-mfp').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    });
</script>

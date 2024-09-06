<?php
$kietxuat_name = DB_fet_rd("*", "#_danhmuc", "`step` = '".$slug_step."' AND `id` = '".$arr_running['id_parent']."'", "`id` DESC", 1, "id");
if(empty($kietxuat_name)) {
    $kietxuat_name = $thongtin_step['tenbaiviet_'.$lang];
}
else {
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_'.$lang];
}

$lay_all_kx   = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);

$wh           = "  AND `id_parent` = (".$lay_all_kx.") AND `id` <>  '".$arr_running['id']."'";
$numview      = 12;

$nd_kietxuat  = DB_fet_rd(" * "," `#_baiviet` "," `step` IN (".$slug_step.") $wh "," `catasort` DESC ", $numview);

// $nd_total = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
// $nd_total = mysqli_num_rows($nd_total);
// $retuen_arr = array();
// while ($r   = mysqli_fetch_assoc($nd_kietxuat)) {
//   $retuen_arr[] = $r;
// }
// $anhcon   = LAY_anhstep($thongtin_step['id'], 1);
// $img_bg = checkImage($fullpath, $thongtin_step['icon'], $thongtin_step['duongdantin']);

// if($arr_running['icon_hover'] != "") {
//   $img_bg = checkImage($fullpath, $arr_running['icon_hover'], $arr_running['duongdantin']);
// }
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
<div class="page_conten_page pagewrap">
    <div class="tin_left tin_left_2column">
        <div class="title_news">
            <h2><?= SHOW_text($arr_running['tenbaiviet_'.$lang]) ?></h2>
            <ul>
                <li><i class="fa fa-calendar"></i> <?= date("d/m/Y", $arr_running['ngaydang']) ?></li>
            </ul>
        </div>
        <div class="showText">
            <div class="partner-l">
                <?=full_img($arr_running) ?>
            </div>
            <div class="partner-r">
                <?= SHOW_text($arr_running['noidung_'.$lang]) ?>
                <div class="clr"></div>
            </div>
        </div>


        <div id="sharelink">
            <div class="addthis_toolbox addthis_default_style ">
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
    <?php include _source."left_conten.php";?>



    <div class="clr"></div>
</div>
<style>
    .showText {
        display: flex;
        align-items: flex-start; /* Căn chỉnh phần tử theo đỉnh của khối */
        gap: 20px; /* Khoảng cách giữa hai khối */
    }

    .partner-l {
        max-width: 50%; /* Giới hạn chiều rộng của khối chứa icon */
        flex-shrink: 0; /* Ngăn icon co lại khi nội dung quá lớn */
    }

    .partner-l img {
        width: 100%; /* Hình ảnh sẽ không vượt quá khối chứa */
        height: 50%;
        object-fit: contain; /* Đảm bảo hình ảnh giữ nguyên tỷ lệ */
    }

    .partner-r {
        flex-grow: 1; /* Nội dung chiếm hết không gian còn lại */
    }

</style>
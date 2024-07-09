<?php
$table = '#_module_page';
$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? intval($_GET['edit']) : 0;

// Lấy danh sách menu items
$menu_items = LEFT_mainmenu_new();
$filtered_menu_item = get_menu_item_by_id($menu_items, $id);

// Khởi tạo các biến với giá trị mặc định
$ten_vi = '';
$mota = '';
$noidung = '';
$mota2 = '';
$noidung2 = '';
$page = '';
$sort = '';
$showhi = 0;

// Xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_vi   = isset($_POST['ten_vi']) ? $_POST['ten_vi'] : '';
    $mota     = isset($_POST['mota']) ? $_POST['mota'] : '';
    $noidung  = isset($_POST['noidung']) ? $_POST['noidung'] : '';
    $mota2    = isset($_POST['mota2']) ? $_POST['mota2'] : '';
    $noidung2 = isset($_POST['noidung2']) ? $_POST['noidung2'] : '';
    $page     = isset($_POST['page']) ? $_POST['page'] : '';
    $sort     = isset($_POST['sort']) ? $_POST['sort'] : '';
    $showhi   = isset($_POST['showhi']) ? 1 : 0;

    // Chuẩn bị dữ liệu để lưu vào CSDL
    $data = array(
        'ten_vi' => $ten_vi,
        'mota' => $mota,
        'noidung' => $noidung,
        'mota2' => $mota2,
        'noidung2' => $noidung2,
        'page' => is_numeric($page) ? $page : 0,
        'sort' => is_numeric($sort) ? $sort : 0,
        'showhi' => $showhi
    );

    // Thêm mới hoặc cập nhật dữ liệu vào CSDL
    if ($id == 0) {
        $id = ACTION_db($data, $table, 'add', NULL, NULL);
        $_SESSION['show_message_on'] = "Thêm chủ đề thành công!";
        LOCATION_js($url_page);
        exit();
    } else {
        ACTION_db($data, $table, 'update', NULL, "`id` = ".$id);
        $_SESSION['show_message_on'] = "Cập nhật chủ đề thành công!";
    }
}

// Lấy dữ liệu từ CSDL để hiển thị trên form khi sửa đổi
if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='$id' LIMIT 1");
    if (DB_num($sql_se) > 0) {
        $sql_se = DB_arr($sql_se, 1);
        $ten_vi = SHOW_text($sql_se['ten_vi']);
        $mota = SHOW_text($sql_se['mota']);
        $noidung = SHOW_text($sql_se['noidung']);
        $mota2 = SHOW_text($sql_se['mota2']);
        $noidung2 = SHOW_text($sql_se['noidung2']);
        $page = SHOW_text($sql_se['page']);
        $sort = number_format($sql_se['sort'], 0, ',', '.');
        $showhi = SHOW_text($sql_se['showhi']);
    }
} else {
    // Tạo số thứ tự mặc định nếu thêm mới
    $sort = DB_que("SELECT * FROM `$table`");
    $sort = number_format((DB_num($sort) + 1), 0, ',', '.');
}
?>

<section class="content-header">
    <h1>Danh sách Page</h1>
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách Page</li>
    </ol>
</section>

<form id="form_submit" name="form_submit" action="" method="post" enctype="multipart/form-data">
    <section class="content form_create">
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i><?=$id > 0 ? 'Sửa' : 'Thêm' ?> Page
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                            <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                            <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                        </h3>
                    </div>
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="form-group">
                                    <label>Tên Page</label>
                                    <input type="text" class="form-control" value="<?=$ten_vi ?>" name="ten_vi">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea id="mota" name="mota" class="paEditor"><?=$mota ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea id="noidung" name="noidung" class="paEditor"><?=$noidung ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả2</label>
                                    <textarea id="mota2" name="mota2" class="paEditor"><?=$mota2 ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung2</label>
                                    <textarea id="noidung2" name="noidung2" class="paEditor"><?=$noidung2 ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>ID Page</label>
                                    <input type="text" class="form-control" name="page" value="<?=$page ?>">
                                </div>
                                <div class="form-group">
                                    <label>Số thứ tự</label>
                                    <input type="text" class="form-control" name="sort" value="<?=$sort ?>">
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input name="showhi" type="checkbox" class="minimal" <?= $showhi == 1 ? "checked='checked'" : "" ?>> Hiển thị
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <div class="box-header mb-60">
        <h3 class="box-title box-title-td pull-right">
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
            <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
            <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
        </h3>
    </div>
</form>

<?php
$table = '#_file_import_data';
$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }

    $data = array(
        'ten_vi' => $ten_vi,
        'noidung_vi' => $noidung_vi,
        'duongdantin' => "datafiles",
        'file_excel' => $file_excel,
        'ngay_dang' => time()
    );

    // Upload file và lưu thông tin file nếu có
    if($upckfinder != true){
        $file_excel                = UPLOAD_file("file", "../datafiles/files/", time());
        if($file_excel != false)
        {
            $data['file_excel']   = $file_excel;
            if($id > 0){
                $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='".$id."' LIMIT 1");
                $sql_thongtin = DB_arr($sql_thongtin, 1);
                @unlink("../".$sql_thongtin["duongdantin"]."/".$sql_thongtin["file_excel"]);
            }
        }
    }else{
        if (!empty($_FILES['file_excel']['name'])) {
            $file = $_FILES['file_excel'];
            $filename = time() . '_' . $file['name'];
            move_uploaded_file($file['tmp_name'], "../datafiles/" . $filename);
            $data['file_excel'] = $filename;

        }
    }


    if ($id == 0) {
        $id = ACTION_db($data, $table, 'add', NULL, NULL);
        $_SESSION['show_message_on'] = "Thêm file thành công!";
        LOCATION_js($url_page . "&edit=" . $id);
        exit();
    } else {
        ACTION_db($data, $table, 'update', NULL, "`id`='$id'");
        $_SESSION['show_message_on'] = "Cập nhật file thành công!";
    }
}

// Lấy thông tin để chỉnh sửa nếu có
if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='$id' LIMIT 1");
    $sql_se = DB_arr($sql_se, 1);

    // Gán giá trị cho các biến để hiển thị trên form
    foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
    }

    // Xây dựng URL để tải file nếu có
    if (!empty($file_excel)) {
        $file_excel_url = $fullpath . "/" . $duongdantin . "/" . $file_excel;
    }
}
?>

<section class="content-header">
    <h1>Danh sách file import dữ liệu</h1>
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách file import dữ liệu</li>
    </ol>
</section>
<form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>
    <section class="content form_create">
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i> <?=$id > 0 ? 'Sửa' : 'Thêm' ?> file
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu lại</button>
                            <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                            <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                        </h3>
                    </div>
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="form-group">
                                    <label for="file_excel">File <span style="font-weight: 500; color: #ec2626;">(Chỉ hỗ trợ import dữ liệu file dạng *.xlsx)</span></label>
                                    <?php if($upckfinder != true){ ?>
                                        <input name="file" type="file" class="form-control" id="exampleInputFile">
                                    <?php }else{ ?>
                                    <button type="button" class="btn btn-primary" onclick="selectFileWithCKFinder('file_excel');">Chọn file</button>
                                    <input type="hidden" name="file_excel" id="file_excel" value="<?= !empty($file_excel) ? $file_excel : '' ?>">
                                    <?php } ?>
                                    <?= !empty($file_excel) ? "<p style='font-size: 12px; margin-top: 5px;'>$file_excel " . (!is_file("../" . $duongdantin . "/" . $file_excel) ? "<span style='font-weight: 500; color: #ec2626;'>(File không tồn tại)</span>" : "<a href='" . $file_excel_url . "' download>[Tải về]</a>") . "</p>" : '' ?>
                                </div>

                                <div class="form-group">
                                    <label>Tên file</label>
                                    <input type="text" class="form-control" value="<?= !empty($ten_vi) ? SHOW_text($ten_vi) : '' ?>" name="ten_vi" id="ten_vi">
                                </div>
                                <div class="form-group">
                                    <label>Ghi chú</label>
                                    <textarea id="noidung_vi" name="noidung_vi" class="form-control" rows="10"><?= !empty($noidung_vi) ? SHOW_text($noidung_vi) : '' ?></textarea>
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
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu lại</button>
            <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
            <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
        </h3>
    </div>
</form>



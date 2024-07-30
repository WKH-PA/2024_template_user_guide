<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }
}

if(!empty($_POST))
{
    $data                       = array();
    $data['seo_title_vi']       = $seo_title_vi;
    $data['seo_description_vi'] = $seo_description_vi;
    $data['seo_keywords_vi']    = $seo_keywords_vi;
    $data['tenbaiviet_vi']       = $tenbaiviet_vi;
    $data['diachi_vi']          = $diachi_vi;
    $data['sodienthoai_vi']     = $sodienthoai_vi;
    $data['hotline_vi']         = $hotline_vi;
    $data['email_vi']           = $email_vi;

    $data['tenbaiviet_en']       = @$tenbaiviet_en;
    $data['diachi_en']          = @$diachi_en;
    $data['seo_title_en']       = @$seo_title_en;
    $data['seo_description_en'] = @$seo_description_en;
    $data['seo_keywords_en']    = @$seo_keywords_en;

    $data['tenbaiviet_cn']       = @$tenbaiviet_cn;
    $data['diachi_cn']          = @$diachi_cn;
    $data['seo_title_cn']       = @$seo_title_cn;
    $data['seo_description_cn'] = @$seo_description_cn;
    $data['seo_keywords_cn']    = @$seo_keywords_cn;


    $data['robots']             = $robots;
    $data['duongdantin']        = $duongdantin;

    $data['fb_app']             = $fb_app;
    $data['fb_id']              = $fb_id;
    $data['url_fb']             = $url_fb;
    $data['url_zalo']           = $url_zalo;

    $data['em_ip']              = $em_ip;
    $data['em_taikhoan']        = $em_taikhoan;
    $data['em_pass']            = $em_pass;
    $data['js_google_anilatic'] = $js_google_anilatic;
    $data['show_fb']           = isset($_POST['show_fb']) ? 1 : 0;
    $data['show_zalo']           = isset($_POST['show_zalo']) ? 1 : 0;
    $data['is_https']           = isset($_POST['is_https']) ? 1 : 0;
    $data['is_comment']         = isset($_POST['is_comment']) ? 1 : 0;
    $data['is_lang']            = isset($_POST['is_lang']) ? 1 : 0;
    $data['is_saochep']         = isset($_POST['is_saochep']) ? 1 : 0;
    $data['is_tiengviet']       = isset($_POST['is_tiengviet']) ? 1 : 0;
    $data['upload_ckfinder']    = isset($_POST['upload_ckfinder']) ? 1 : 0;
    $data['sl_toiuu']           = $sl_toiuu;
    $api_keys = [
        'group_1' => ['api_key' => $_POST['api_key_1'], 'api_secret' => $_POST['api_secret_1']],
        'group_2' => ['api_key' => $_POST['api_key_2'], 'api_secret' => $_POST['api_secret_2']],
        'group_3' => ['api_key' => $_POST['api_key_3'], 'api_secret' => $_POST['api_secret_3']],
        'group_4' => ['api_key' => $_POST['api_key_4'], 'api_secret' => $_POST['api_secret_4']],
        'group_5' => ['api_key' => $_POST['api_key_5'], 'api_secret' => $_POST['api_secret_5']],
    ];

    // Lấy dữ liệu từ POST, kiểm tra sự tồn tại trước
    $api_keys = [
        'group_1' => ['api_key' => $_POST['api_key_1'] ?? '', 'api_secret' => $_POST['api_secret_1'] ?? ''],
        'group_2' => ['api_key' => $_POST['api_key_2'] ?? '', 'api_secret' => $_POST['api_secret_2'] ?? ''],
        'group_3' => ['api_key' => $_POST['api_key_3'] ?? '', 'api_secret' => $_POST['api_secret_3'] ?? ''],
        'group_4' => ['api_key' => $_POST['api_key_4'] ?? '', 'api_secret' => $_POST['api_secret_4'] ?? ''],
        'group_5' => ['api_key' => $_POST['api_key_5'] ?? '', 'api_secret' => $_POST['api_secret_5'] ?? ''],
    ];

    // Chuyển mảng API keys thành JSON
    $json_data = json_encode($api_keys);
    $data['api_kraken'] = $json_data;

    // Cập nhật dữ liệu trong cơ sở dữ liệu
    ACTION_db($data, '#_seo', 'update', NULL, "1 = 1");
    $_SESSION['show_message_on'] = "Cập nhật dữ liệu thành công!";


    // Truy xuất lại dữ liệu từ cơ sở dữ liệu sau khi cập nhật
    $sql_se = DB_que("SELECT * FROM `#_seo` LIMIT 1");
    $sql_se = DB_arr($sql_se, 1);
    $api_keys_json = $sql_se['api_kraken'];
    $api_keys = json_decode($api_keys_json, true);




// Xử lý tệp tin icon và favico nếu có

    $sql_thongtin = DB_que("SELECT * FROM `#_seo` LIMIT 1");
    $sql_thongtin = DB_arr($sql_thongtin, 1);
    if($upckfinder != true){
        $icon                       = UPLOAD_image("icon", "../".$duongdantin."/", time());
        $favico                     = UPLOAD_image("favico", "../".$duongdantin."/", time());
        if($icon != ''){
            $data['icon']             = $icon;
            @unlink("../".$sql_thongtin["duongdantin"]."/".$sql_thongtin["icon"]);
        }
        if($favico != ''){
            $data['favico']           = $favico;
            @unlink("../".$sql_thongtin["duongdantin"]."/".$sql_thongtin["favico"]);
        }
    }else{
        $icon                       = $icon;
        if($icon != ''){
            $data['icon']             = $icon;
        }
        $favico                     = $favico;
        if($favico != ''){
            $data['favico']           = $favico;
        }
    }


    ACTION_db($data, '#_seo','update',NULL,"1 = 1");
    $_SESSION['show_message_on'] = "Cập nhật dữ liệu thành công!";
}
$sql_se             = DB_que("SELECT * FROM `#_seo` LIMIT 1");
$sql_se             = DB_arr($sql_se, 1);
foreach ($sql_se as $key => $value) {
    ${$key} = Show_text($value);

    // Chuyển đổi JSON thành mảng PHP khi lấy ra
    if ($key == 'api_kraken') {
        $api_keys = json_decode($value, true);
    }
}
$sql_se             = DB_que("SELECT * FROM `#_seo` LIMIT 1");
$sql_se             = DB_arr($sql_se, 1);
foreach ($sql_se as $key => $value) {
    ${$key} = Show_text($value);
    if($key = 'js_google_anilatic') {
        $js_google_anilatic = $sql_se['js_google_anilatic'];
    }
}

if($icon != ''){
    $full_icon = "../$duongdantin/$icon";
}
if($favico != ''){
    $full_icon_hover = "../$duongdantin/$favico";
}
?>

<section class="content-header">
    <h1><?php if(isset($_SESSION['admin'])){ ?><a style="cursor: pointer;" onclick="AUTO_dich(this)">[NGÔN NGỮ]</a> <a class="js_okkk" style="cursor: pointer;" onclick="OKKK_by_lh()">[UPDATE]</a> <?php } ?>Thiết lập website</h1>
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Thiết lập website</li>
    </ol>
</section>

<form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>
    <input type="hidden" name="token" value="<?=GET_token() ?>">
    <section class="content form_create">
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i> Cập nhật
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button onclick="return checkSubmit()" type="submit" name="capnhat" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                        </h3>
                    </div>
                    <div class="nav-tabs-custom">
                        <?php include _source."lang.php" ?>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="form-group">
                                    <label>Tên công ty</label>
                                    <input type="text" class="form-control" name="tenbaiviet_vi" value="<?=$tenbaiviet_vi ?>">
                                </div>

                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="diachi_vi" value="<?=$diachi_vi ?>">
                                </div>
                                <div class="form-group">
                                    <label>Seo Title</label>
                                    <input type="text" class="form-control" name="seo_title_vi" value="<?=$seo_title_vi ?>">
                                </div>

                                <div class="form-group">
                                    <label>Seo Description</label>
                                    <input type="text" class="form-control" name="seo_description_vi" value="<?=$seo_description_vi ?>">
                                </div>

                                <div class="form-group">
                                    <label>Seo keywords</label>
                                    <input type="text" class="form-control" name="seo_keywords_vi" value="<?=$seo_keywords_vi ?>">
                                </div>
                            </div>
                            <?php if($lang_nb2){ ?>
                                <div class="tab-pane" id="tab_2">
                                    <div class="form-group">
                                        <label>Tên công ty (<?=_lang_nb2_key ?>)</label>
                                        <input type="text" class="form-control" name="tenbaiviet_en" value="<?=$tenbaiviet_en ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Địa chỉ (<?=_lang_nb2_key ?>)</label>
                                        <input type="text" class="form-control" name="diachi_en" value="<?=$diachi_en ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Seo Title (<?=_lang_nb2_key ?>)</label>
                                        <input type="text" class="form-control" name="seo_title_en" value="<?=$seo_title_en ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Seo Description (<?=_lang_nb2_key ?>)</label>
                                        <input type="text" class="form-control" name="seo_description_en" value="<?=$seo_description_en ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Seo keywords (<?=_lang_nb2_key ?>)</label>
                                        <input type="text" class="form-control" name="seo_keywords_en" value="<?=$seo_keywords_en ?>">
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if($lang_nb3){ ?>
                                <div class="tab-pane" id="tab_3">
                                    <div class="form-group">
                                        <label>Tên công ty (<?=_lang_nb3_key ?>)</label>
                                        <input type="text" class="form-control" name="tenbaiviet_cn" value="<?=$tenbaiviet_cn ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ (<?=_lang_nb3_key ?>)</label>
                                        <input type="text" class="form-control" name="diachi_cn" value="<?=$diachi_cn ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Seo Title (<?=_lang_nb3_key ?>)</label>
                                        <input type="text" class="form-control" name="seo_title_cn" value="<?=$seo_title_cn ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Seo Description (<?=_lang_nb3_key ?>)</label>
                                        <input type="text" class="form-control" name="seo_description_cn" value="<?=$seo_description_cn ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Seo keywords (<?=_lang_nb3_key ?>)</label>
                                        <input type="text" class="form-control" name="seo_keywords_cn" value="<?=$seo_keywords_cn ?>">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-lg-12">
                <div class="box p10">
                    <div class="form-group">
                        <label for="exampleInputFile2">Logo</label>
                        <div class="dv-anh-chitiet-img-cont">
                            <div class="dv-anh-chitiet-img">
                                <p><i class="fa fa-cloud-upload" aria-hidden="true"></i></p>
                                <?php if ($upckfinder != true) { ?>
                                <input type="file" name="icon" id="input_icon" class="cls_hinhanh" accept="image/*" onchange="pa_previewImg(event, '#img_icon', 'input_icon');">
                                <img src="<?=@$full_icon ?>" alt="" class="img_chile_dangtin" style="<?php if (!empty($full_icon)) echo 'display: block'; else echo 'display: none'; ?>" id="img_icon">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile2">Favico</label>
                        <div class="dv-anh-chitiet-img-cont">
                            <div class="dv-anh-chitiet-img">
                                <p><i class="fa fa-cloud-upload" aria-hidden="true"></i></p>
                                <input type="file" name="favico" id="input_icon_hover" class="cls_hinhanh" accept="image/*" onchange="pa_previewImg(event, '#img_icon_hover', 'input_icon_hover');">
                                <img src="<?=@$full_icon_hover ?>" alt="" class="img_chile_dangtin" style="<?php if (!empty($full_icon_hover)) echo 'display: block'; else echo 'display: none'; ?>" id="img_icon_hover">
                                <?php } else { ?>
                                <input type="text" name="icon" id="input_icon" class="cls_hinhanh" onclick="selectFileWithCKFinder('input_icon', 'img_icon');" value="<?= $icon ?>">
                                <img src="<?=@$full_icon ?>" alt="" class="img_chile_dangtin" style="<?php if (!empty($icon)) echo 'display: block'; else echo 'display: none'; ?>" id="img_icon">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile2">Favico</label>
                        <div class="dv-anh-chitiet-img-cont">
                            <div class="dv-anh-chitiet-img">
                                <p><i class="fa fa-cloud-upload" aria-hidden="true"></i></p>
                                <input type="text" name="favico" id="input_favico" class="cls_hinhanh" onclick="selectFileWithCKFinder('input_favico', 'img_favico');" value="<?= $favico ?>">
                                <img src="<?=@$full_icon_hover ?>" alt="" class="img_chile_dangtin" style="<?php if (!empty($favico)) echo 'display: block'; else echo 'display: none'; ?>" id="img_favico">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" class="form-control" name="sodienthoai_vi" value="<?=$sodienthoai_vi ?>">
                    </div>
                    <div class="form-group">
                        <label>Hotine</label>
                        <input type="text" class="form-control" name="hotline_vi" value="<?=$hotline_vi ?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email_vi" value="<?=$email_vi ?>">
                    </div>
                </div>
                <div class="box p10">
                    <div class="form-group">
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="is_https" class="minimal minimal_click" <?=isset($is_https) && $is_https == 1 ? 'checked="checked"' : '' ?> colum="is_https" idcol="<?=$id ?>" table="#_seo" value="1"> Bật Https
                        </label>
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="is_comment" class="minimal minimal_click" <?=isset($is_comment) && $is_comment == 1 ? 'checked="checked"' : '' ?> colum="is_comment" idcol="<?=$id ?>" table="#_seo" value="1"> Bật Comment Facebook
                        </label>
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="is_lang" class="minimal minimal_click" <?=isset($is_lang) && $is_lang == 1 ? 'checked="checked"' : '' ?> colum="is_lang" idcol="<?=$id ?>" table="#_seo" value="1"> Bật ngôn ngữ
                        </label>
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="is_saochep" class="minimal minimal_click" <?=isset($is_saochep) && $is_saochep == 1 ? 'checked="checked"' : '' ?> colum="is_saochep" idcol="<?=$id ?>" table="#_seo" value="1"> Chống sao chép
                        </label>
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="is_tiengviet" class="minimal minimal_click" <?=isset($is_tiengviet) && $is_tiengviet == 1 ? 'checked="checked"' : '' ?> colum="is_tiengviet" table="#_seo" idcol="1"> Tiếng Việt (Mặc định)
                        </label>
                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="show_fb" class="minimal minimal_click" <?=isset($show_fb) && $show_fb == 1 ? 'checked="checked"' : '' ?> colum="show_fb" table="#_seo" idcol="1"> Bật Facebook
                        </label>

                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="show_zalo" class="minimal minimal_click" <?=isset($show_zalo) && $show_zalo == 1 ? 'checked="checked"' : '' ?> colum="show_zalo" table="#_seo" idcol="1"> Bật Zalo
                        </label>

                        <label class="mr-20 checkbox-mini">
                            <input type="checkbox" name="upload_ckfinder" class="minimal minimal_click" <?=isset($upload_ckfinder) && $upload_ckfinder == 1 ? 'checked="checked"' : '' ?> colum="upload_ckfinder" table="#_seo" idcol="1"> Bật upload_ckfinder
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Facebook App</label>
                        <input type="text" class="form-control" name="fb_app" value="<?=$fb_app ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Facebook ID</label>
                        <input type="text" class="form-control" name="fb_id" value="<?=$fb_id ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile"> Popup Facebook URL</label>
                        <input type="text" class="form-control" name="url_fb" value="<?=$url_fb ?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Popup Zalo URL</label>
                        <input type="text" class="form-control" name="url_zalo" value="<?=$url_zalo ?>">
                    </div>
                </div>
            </section>
            <section class="col-lg-12">
                <div class="box p10" style="margin-top: 10px">
                    <div class="form-group">
                        <label for="exampleInputFile">Email gửi tin</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">IP/Server</label>
                        <input type="text" class="form-control" name="em_ip" value="<?=$em_ip ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Email</label>
                        <input type="text" class="form-control" name="em_taikhoan" value="<?=$em_taikhoan ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Mật khẩu</label>
                        <input type="text" class="form-control" name="em_pass" value="<?=$em_pass ?>">
                    </div>
                </div>
            </section>
            <section class="col-lg-12">
                <div class="box p10" style="margin-top: 10px; ">
                        <!-- Group API Keys and Secrets -->
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        $api_key = htmlspecialchars($api_keys["group_$i"]['api_key'] ?? '');
                        $api_secret = htmlspecialchars($api_keys["group_$i"]['api_secret'] ?? '');
                        ?>
                        <div style="margin-bottom: 10px;">
                            <div style="margin-bottom: 10px;">
                                <strong>Group <?= $i ?></strong>
                            </div>

                            <div style="display: flex; justify-content: space-between;">
                                <div style="flex: 1; margin-right: 10px;">
                                    <label for="api_key_<?= $i ?>">API Key:</label>
                                    <input type="text" style="width: 100%;" name="api_key_<?= $i ?>" id="api_key_<?= $i ?>" value="<?= $api_key ?>" />
                                </div>

                                <div style="flex: 1;">
                                    <label for="api_secret_<?= $i ?>">API Secret:</label>
                                    <input type="text" style="width: 100%;" name="api_secret_<?= $i ?>" id="api_secret_<?= $i ?>" value="<?= $api_secret ?>" />
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label>Số lượng hình ảnh tối ưu </label>
                        <input type="text" class="form-control" name="sl_toiuu" value="<?=$sl_toiuu?>">
                    </div>
                </div>

            </section>
            <section class="col-lg-12">
                <div class="box p10" style="margin-top: 10px">
                    <div class="form-group" stylw=" margin-bottom: 5px;">
                        <label for="exampleInputFile">Code Header</label>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="js_google_anilatic" style="min-height: 200px"><?=$js_google_anilatic ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Robots</label>
                    <textarea name="robots" id="robots" class="form-control" rows="10" cols="80" style="height: 200px"><?=$robots ?></textarea>
                </div>
            </section>
        </div>
    </section>
    <div class="box-header mb-60">
        <h3 class="box-title box-title-td pull-right">
            <button type="submit" name="capnhat" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
        </h3>
    </div>
</form>
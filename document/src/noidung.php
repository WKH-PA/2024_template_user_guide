<?php
$menu_items = LEFT_mainmenu_new();
$filtered_menu_item = get_menu_item_by_id($menu_items, $id);
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }
    .sidebar {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 20px;
        z-index: 100;
    }
    .container {
        max-width: 960px;
        margin: 0 auto;
        padding: 20px;
    }
    h1, h2, h3 {
        color: #333;
    }
    .feature-box {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .feature-list li {
        margin-bottom: 10px;
    }
    .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .sidebar ul li {
        margin-bottom: 10px;
    }
    .sidebar ul li a {
        color: #555;
        text-decoration: none;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php
            if (!empty($id)) {
                if ($module == 'true') {
                    $data = lay_du_lieu_theo_id_step($id);
                } else {
                    $data = lay_du_lieu_theo_id_tinhnang($id);
                }
                if (is_array($data) && !empty($data)) {
                    ?>
                    <h3 id="section1"><?= SHOW_text($data['ten_vi']) ?></h3>
                    <div class="feature-box" id="bai-viet">
                        <ul class="feature-list">
                            <h2>Mô tả</h2>
                            <li><?= SHOW_text($data['mota']) ?></li>
                            <h2>Nội dung</h2><li><?= SHOW_text($data['noidung']) ?></li>
                        </ul>
                        <div class="feature-box" id="bai-viet2">
                            <?php if ($module == 'main-module' && !empty($data['noidung2'])) { ?>
                                <?php if (in_array($filtered_menu_item['id'], $array_only_bv)) { ?>
                                    <ul>
                                        <h2>Mô tả</h2><li><?= SHOW_text($data['mota2']) ?></li>
                                        <h2 id="section4">Nội dung chủ đề</h2><li><?= SHOW_text($data['noidung2']) ?></li>
                                    </ul>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "No content found for the specified action.";
                    echo $id;
                }
            } else {
                echo "No action specified.";

            }
            ?>
        </div>
                <div class="col-md-4">
                    <div class="sidebar">
                        <h3>Chủ đề</h3>
                        <ul>
                            <?php


                            if ($module == 'true' && $filtered_menu_item) {
                                ?>
                                <li><a href="bai_viet"><i class="fa fa-circle-o"></i> Danh sách <?= $filtered_menu_item['name'] ?></a></li>
                                <?php
                                if (in_array($filtered_menu_item['id'], $array_only_bv)) {
                                    ?>
                                    <li ><a href="bai_viet2"><i class="fa fa-circle-o"></i> Danh sách chủ đề</a></li>
                                    <?php
                                }
                            } else {
                                ?>
                                <li><a href="#section1"><i class="fa fa-circle-o"></i> <?= SHOW_text($data['ten_vi']) ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
    </div>
</div>

<script>
    // Lấy tất cả các liên kết trong sidebar
    const sidebarLinks = document.querySelectorAll('.sidebar a');
    // Thêm sự kiện click cho mỗi liên kết
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            // Tính toán khoảng cách cần cuộn
            const offsetTop = targetElement.getBoundingClientRect().top + window.pageYOffset - 110;
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        });
    });
</script>

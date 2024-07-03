
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
        top: 20px; /* Sử dụng top để đặt khoảng cách từ đỉnh trang */
        z-index: 100; /* Đảm bảo sidebar hiển thị trên các phần tử khác khi cuộn */
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

    .sidebar {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 20px;
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

<body>
<div class="container">
    <?php
    if ($module != '') {
        if (!empty($action)) {
            if ($module == 'main-module') {
                // Use lay_du_lieu_theo_seoname if module is 'main-module'
                $data = lay_du_lieu_theo_seoname($action);
            } elseif ($module == 'quan-ly-hinh-anh') {
                // Use lay_du_lieu_theo_id_parent if module is 'quan-ly-hinh-anh'
                $data = lay_du_lieu_theo_id_parent($action);
//                echo $action;
            } else {
                // Use lay_du_lieu_theo_action for other modules
                $data = lay_du_lieu_theo_action($action);
            }

            if (is_array($data) && !empty($data)) {
                ?>
                <h3><?= SHOW_text($data['ten_vi']) ?></h3>
                <div class="card">
                    <h3>Danh sách bài viết</h3>
                    <ul>
                        <li><?= SHOW_text($data['mota']) ?></li>
                        <li><?= SHOW_text($data['noidung']) ?></li>
                    </ul>
                </div>
                <?php
            } else {
                echo "No content found for the specified action.";
            }
        } else {
            echo "No action specified.";
        }
    } else {
        include "home.php";
    }
    ?>


</div>

</body>

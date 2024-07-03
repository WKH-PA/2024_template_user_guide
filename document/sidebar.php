<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <img class="img-fluid" src="images/logo/logo.png" alt="">
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        </div>
        <nav class="sidebar-main">
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="<?= $fullpath_admin ?>"></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div></div>
                    </li>
                    <?php
                    $sql = DB_que("SELECT * FROM `#_module_tinhnang` WHERE `showhi` = 1 ORDER BY `sort` ASC ");
                    $sql_array = DB_arr($sql);
                    $nhom_1 = '';

                    foreach ($sql_array as $value) {
                        if ($value['id_parent'] != 0) continue;

                        $nhom_2 = "";
                        foreach ($sql_array as $value_2) {
                            if ($value_2['id_parent'] != $value['id']) continue;

                            $nhom_3 = "";
                            foreach ($sql_array as $value_3) {
                                if ($value_3['id_parent'] != $value_2['id']) continue;

                                $nhom_3 .= '<li class="submenu-group"><a href="' . $value_3['lien_ket'] . '"><i class="' . ($value_3['icon'] != "" ? $value_3['icon'] : "fa fa-circle-o") . '"></i> ' . $value_3['ten_vi'] . '</a></li>';
                            }

                            $nhom_2 .= '<li class="main-submenu submenu-group"><a class="d-flex sidebar-menu" href="' . $value_2['lien_ket'] . '"><i class="' . ($value_2['icon'] != "" ? $value_2['icon'] : "fa fa-circle-o") . '"></i> ' . $value_2['ten_vi'] . '' . ($nhom_3 != "" ? '<svg class="arrow"><use href="../assets/svg/icon-sprite.svg#Arrow-right"></use></svg>' : "") . '</a>' . ($nhom_3 != "" ? '<ul class="submenu-wrapper">' . $nhom_3 . '</ul>' : "") . '</li>';
                        }

                        // Kiểm tra xem có nhóm con hay không, hoặc có action là 'main-module'
                        if ($nhom_2 != "" || $value['m_action'] == 'main-module' || $value['m_action'] == 'quan-ly-hinh-anh') {
                            $nhom_1 .= '<li class="sidebar-list">
                                <a class="sidebar-link sidebar-title " href="javascript:void(0)">
                                    <i class="' . ($value['icon'] != "" ? $value['icon'] : "fa fa-circle-o") . '"></i> <span>' . $value['ten_vi'] . '</span>
                                </a>';

                            // Kiểm tra action
                            if ($value['m_action'] == 'quan-ly-hinh-anh') {
                                // Xử lý cho 'quan-ly-hinh-anh'
                                $nhom_1 .= '<ul class="sidebar-submenu custom-scrollbar submenu-group">';
                                $loaibanner = DB_que('SELECT * FROM `#_banner_danhmuc` WHERE `showhi` = 1 ORDER BY `catasort` ASC');
                                $loaibanner = DB_arr($loaibanner);

                                foreach ($loaibanner as $r) {
                                    $nhom_1 .= '<li class="main-submenu submenu-group"><a class="d-flex sidebar-menu"href="?module=quan-ly-hinh-anh&action=' . $r['id'] . '"><i class="fa fa-circle-o"></i> ' . $r['tenbaiviet_vi'] . '</a></li>';
                                }
                                $nhom_1 .= '</ul>';
                            } elseif ($value['m_action'] == 'main-module') {
                                // Xử lý cho 'main-module'
                                $nhom_1 .= '<ul class="sidebar-submenu custom-scrollbar main-module-submenu submenu-group">';
                                foreach (LEFT_mainmenu_new() as $val) {
                                    $nhom_1 .= '<li class="main-submenu submenu-group">
                                        <a class="d-flex sidebar-menu" href="?module=main-module&action=' . $val['seoname'] . '">
                                            <i class="fa fa-circle-o"></i> <ul> <li>'. $val['cataname'] . '</li> </ul>
                                            <svg class="arrow" >
                                                <use href="icon-sprite.svg#Arrow-right"></use>
                                            </svg>
                                        </a>
                                    </li>';
                                }
                                $nhom_1 .= '</ul>';
                            } else {
                                // Nếu không phải 'quan-ly-hinh-anh' hoặc 'main-module'
                                $nhom_1 .= '<ul class="sidebar-submenu custom-scrollbar submenu-group">' . $nhom_2 . '</ul>';
                            }

                            $nhom_1 .= '</li>';
                        } else {
                            // Nếu không có nhóm con và không phải 'main-module', tạo liên kết đơn
                            $nhom_1 .= '<li class="sidebar-list"><a class="sidebar-link sidebar-title " href="' . $value['lien_ket'] . '"><i class="' . ($value['icon'] != "" ? $value['icon'] : "fa fa-circle-o") . '"></i> <span>' . $value['ten_vi'] . '</span></a></li>';
                        }
                    }

                    // Hiển thị danh sách menu đã xử lý
                    echo $nhom_1;
                    ?>
                </ul>
            </div>
        </nav>
    </div>
</div>

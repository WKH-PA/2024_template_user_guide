<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="index.php">
                <img class="img-fluid" src="images/logo/logo.png" alt="Logo">
            </a>
        </div>
        <nav class="sidebar-main">
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
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

                            $nhom_2 .= '<li class="main-submenu submenu-group"><a class="d-flex sidebar-menu" href="' . $value_2['lien_ket'] . '"><i class="' . ($value_2['icon'] != "" ? $value_2['icon'] : "fa fa-circle-o") . '"></i> ' . $value_2['ten_vi'] . '' . ($nhom_3 != "" ? '<svg class="arrow"><use href="svg/icon-sprite.svg#Arrow-right"></use></svg>' : "") . '</a>' . ($nhom_3 != "" ? '<ul class="submenu-wrapper">' . $nhom_3 . '</ul>' : "") . '</li>';
                        }

                        // Handle 'Quản lý hình ảnh' module separately to prevent submenus
                        if ($value['m_action'] == 'quan-ly-hinh-anh') {
                            $nhom_1 .= '<li class="sidebar-list">
                                <a class="sidebar-link sidebar-title" href="?module=quan-ly-hinh-anh">
                                    <i class="' . ($value['icon'] != "" ? $value['icon'] : "fa fa-circle-o") . '"></i> <span>' . $value['ten_vi'] . '</span>
                                </a>
                            </li>';
                        } elseif ($nhom_2 != "" || $value['m_action'] == 'main-module') {
                            $nhom_1 .= '<li class="sidebar-list">
                                <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                    <i class="' . ($value['icon'] != "" ? $value['icon'] : "fa fa-circle-o") . '"></i> <span>' . $value['ten_vi'] . '</span>
                                </a>';

                            if ($value['m_action'] == 'main-module') {
                                // Process for 'main-module'
                                $nhom_1 .= '<ul class="sidebar-submenu custom-scrollbar main-module-submenu submenu-group">';
                                foreach (LEFT_mainmenu_new() as $val) {
                                    $nhom_1 .= '<li class="main-submenu submenu-group">
                                        <a class="d-flex sidebar-menu" href="?module=main-module&action=' . $val['seoname'] . '">
                                            <i class="fa fa-circle-o"></i> <span>' . $val['cataname'] . '</span>
                                        </a>
                                    </li>';
                                }
                                $nhom_1 .= '</ul>';
                            } else {
                                // If not 'quan-ly-hinh-anh' or 'main-module', display regular submenus
                                $nhom_1 .= '<ul class="sidebar-submenu custom-scrollbar submenu-group">' . $nhom_2 . '</ul>';
                            }

                            $nhom_1 .= '</li>';
                        } else {
                            // If no subgroups and not 'main-module', display single link
                            $nhom_1 .= '<li class="sidebar-list"><a class="sidebar-link sidebar-title" href="' . $value['lien_ket'] . '"><i class="' . ($value['icon'] != "" ? $value['icon'] : "fa fa-circle-o") . '"></i> <span>' . $value['ten_vi'] . '</span></a></li>';
                        }
                    }

                    // Output processed menu list
                    echo $nhom_1;
                    ?>
                </ul>
            </div>
        </nav>
    </div>
</div>

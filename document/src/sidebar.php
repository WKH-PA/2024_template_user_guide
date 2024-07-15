<style>
    .logo-wrapper {
        text-align: center; /* Center align logo */
    }

    .logo-wrapper img {
        max-width: 90px; /* Maximum width of the logo */
        height: auto; /* Maintain aspect ratio */
        display: block; /* Ensure image displays as block */
        margin: 0 auto; /* Center align the image */
        background-color: transparent; /* Transparent background */
    }

    .sidebar-list {
        list-style-type: none; /* Remove default list styling */
    }

    /* Add any additional styling as needed */
</style>

<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="<?php echo $fullpath.'/document'?>">
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

                                $nhom_3 .= '<li class="submenu-group"><a href="?id=' . $value_3['id'] . '"><i class="' . ($value_3['icon'] != "" ? $value_3['icon'] : "fa fa-circle-o") . '"></i> ' . $value_3['ten_vi'] . '</a></li>';
                            }

                            $nhom_2 .= '<li class="main-submenu submenu-group"><a class="d-flex sidebar-menu" href="?id=' . $value_2['id'] . '"><i class="' . ($value_2['icon'] != "" ? $value_2['icon'] : "fa fa-circle-o" ) . '"></i>&nbsp;&nbsp;' . shorten_text( $value_2['ten_vi'], 28 ). '' . ($nhom_3 != "" ? '<svg class="arrow"><use href="svg/icon-sprite.svg#Arrow-right"></use></svg>' : "") . '</a>' . ($nhom_3 != "" ? '<ul class="submenu-wrapper">' . $nhom_3 . '</ul>' : "") . '</li>';
                        }

                        if ($value['m_action'] == 'quan-ly-hinh-anh' || in_array($value['id'], ['13', '66', '75', '49', '90'])) {
                            $nhom_1 .= '<li class="sidebar-list">
                                <a class="sidebar-link sidebar-title" href="?id=' . $value['id'] . '">
                                    <i class="' . ($value['icon'] != "" ? $value['icon'] : "fa fa-circle-o") . '"></i> <span>' . $value['ten_vi'] . '</span>
                                </a>
                            </li>';
                        } elseif ($nhom_2 != "" || $value['m_action'] == 'main-module') {
                            $nhom_1 .= '<li class="sidebar-list">
                                <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                    <i class="' . ($value['icon'] != "" ? $value['icon'] : "fa fa-circle-o") . '"></i> <span>' . $value['ten_vi'] . '</span>
                                </a>';

                            if ($value['m_action'] == 'main-module') {
                                $nhom_1 .= '<ul class="sidebar-submenu custom-scrollbar main-module-submenu submenu-group">';
                                foreach (LEFT_mainmenu_new() as $val) {
                                    $nhom_1 .= '<li class="main-submenu submenu-group">
                                        <a class="d-flex sidebar-menu" href="?module=true&id=' . $val['id'] . '">
                                            <i class="fa fa-circle-o"></i> &nbsp;&nbsp;' . $val['cataname'] . '
                                        </a>
                                    </li>';
                                }
                                $nhom_1 .= '</ul>';
                            } else {
                                $nhom_1 .= '<ul class="sidebar-submenu custom-scrollbar submenu-group">' . $nhom_2 . '</ul>';
                            }

                            $nhom_1 .= '</li>';
                        } else {
                            $nhom_1 .= '<li class="sidebar-list"><a class="sidebar-link sidebar-title" href="?id=' . $value['id'] . '"><i class="' . ($value['icon'] != "" ? $value['icon'] : "fa fa-circle-o") . '"></i> <span>' . $value['ten_vi'] . '</span></a></li>';
                        }
                    }

                    echo $nhom_1;
                    ?>
                </ul>
            </div>
        </nav>
    </div>
</div>

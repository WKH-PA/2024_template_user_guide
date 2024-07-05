<?php
$menu_items = LEFT_mainmenu_new();
$filtered_menu_item = get_menu_item_by_id($menu_items, $id);
$dataadd = lay_du_lieu_theo_id_step($id);

if (!empty($id)) {
    if ($module == 'true') {
        $data = lay_du_lieu_theo_id_module_page($id);
    } else {
        $data = lay_du_lieu_theo_id_tinhnang($id);
    }
    if (is_array($data) && !empty($data)) {
    } else {
        echo "No content found for the specified action.";
    }
} else {
    echo "No action specified.";
}
?>
<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3><?= SHOW_text($data['ten_vi']) ?></h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a></li>
                        <li class="breadcrumb-item">Main modules</li>
                        <li class="breadcrumb-item active"> <?= SHOW_text($data['ten_vi']) ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card" id="card1">
                    <div class="card-header pb-0">
                        <h3>Danh sách bài viết</h3>
                    </div>
                    <div class="card-body card-wrapper input-group-wrapper">
                        <div class="intro">
                            <h5 class="border rounded card-body f-w-300 mt-3" id="clipboardExample3">
                                <ul>
                                    <?= SHOW_text($data['mota']) ?>
                                    <?php if (!empty($dataadd['mota']) ) { ?>
                                        <?= SHOW_text($dataadd['mota']) ?>
                                    <?php } ?>
                                </ul>
                            </h5>
                        </div>
                        <div class="intro">
                            <?= SHOW_text($data['noidung']) ?>
                            <?php if (!empty($dataadd['noidung']) ) { ?>
                                <?= SHOW_text($dataadd['noidung']) ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php if (in_array($filtered_menu_item['id'], $array_only_bv) && !empty($data['mota2']) && !empty($data['noidung2'])) { ?>
                    <div class="card" id="card2">
                        <div class="card-header pb-0">
                            <h3>Danh sách chủ đề </h3>
                        </div>
                        <div class="card-body card-wrapper input-group-wrapper">
                            <div class="intro">
                                <h5 class="border rounded card-body f-w-300 mt-3" id="clipboardExample3">
                                    <ul>
                                        <?= SHOW_text($data['mota2']) ?>
                                        <?php if (!empty($dataadd['mota2']) ) { ?>
                                            <?= SHOW_text($dataadd['mota2']) ?>
                                        <?php } ?>
                                    </ul>
                                </h5>
                            </div>
                            <div class="intro">
                                <?= SHOW_text($data['noidung2']) ?>
                                <?php if (!empty($dataadd['noidung2']) ) { ?>
                                    <?= SHOW_text($dataadd['noidung2']) ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-3">
                <div class="md-sidebar-aside custom-scrollbar">
                    <div class="file-sidebar">
                        <div class="card">
                            <div class="card-body">
                                <ul>
                                    <?php
                                    if ($module == 'true' && $filtered_menu_item) {
                                        ?>
                                        <li>
                                            <a href="#card1" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-home">
                                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                </svg>
                                                Danh sách <?= SHOW_text($data['ten_vi']) ?>
                                            </a>
                                        </li>
                                        <?php
                                        if (in_array($filtered_menu_item['id'], $array_only_bv)) {
                                            ?>
                                            <li>
                                                <a href="#card2" class="btn btn-light">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-folder">
                                                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                                                    </svg>
                                                    Danh sách chủ đề
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <li>
                                            <a href="#card1" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-home">
                                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                </svg>
                                                <?= SHOW_text($data['ten_vi']) ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .intro h1 {
        text-align: center;
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 20px;
    }
    .intro p img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        max-width: 100%; /* Ensures the image fits within its container */
        height: auto; /* Maintains the aspect ratio */
    }



</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Select all the anchor links within the sidebar
        const sidebarLinks = document.querySelectorAll('.md-sidebar-aside a');

        // Add click event listener for each link
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    // Calculate the distance to scroll
                    const offsetTop = targetElement.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });

</script>
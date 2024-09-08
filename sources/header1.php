<div class="dv-header">
    <div class="dv-header-top">
        <div class="pagewrap">
            <div class="nav navbar-nav navbar-left" >
                <span id="phone_header"><i class="fa fa-phone"></i><?= $glo_lang['phone_ct'] ?></span>
                <hr>
                <span id="email_header"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?= $glo_lang['mail_ct'] ?></span>
                <?php
                $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                ?>
                <a href="<?=$full_url?>/gio-hang/" class="cart-icon">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="cart-count"><?= $cart_count ?></span>
                </a>
            </div>

            <li class="language">
                <?php include _source."lang.php"; ?>
            </li>
            <div class="clr"></div>

        </div>


    </div>
    <div class="dv-header-bt">
        <div class="pagewrap flex">
            <div class="logo_top" id="logo_ct">
                <a href="<?=$full_url ?>"><img src="<?=full_src($thongtin,'') ?>" alt="<?=$thongtin['tenbaiviet_'.$lang] ?>"></a>
                <div class="clr"></div>
            </div>
            <div class="box_menu">
                <?php include _source."menu_top.php";?>
            </div>
            <!-- Search icon -->
            <div class="search-icon-container">
                <i class="fa fa-search search-icon" aria-hidden="true"></i>

                <!-- Search overlay -->
                <div class="search-overlay">
                    <div class="search-input-wrapper">
                        <form id="searchForm" action="<?php echo $fullpath.'/search/'?>>" method="get">
                            <input type="text" class="input-search" name="key" placeholder="Nhập từ khóa tìm kiếm...">
                            <button type="submit" class="submit-button">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
            </div>

            <h4 style="display: inline-block; margin-left: 5px;"><a <a<?= full_href(['seo_name' => 'popup-lien-he']) ?> class="popup-video preview fancybox.ajax" id="tuvan_baogia"><?=$glo_lang['tuvan_baogia'] ?><i class="fa fa-paper-plane-o" aria-hidden="true"></i></a></h4>

        </div>
    </div>
    <div class="clr"></div>
</div>

<style>

</style>
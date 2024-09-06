<div class="tin_right" id="conten">
    <?php
    $sp_baiviet = LAY_baiviet(2, 12, "`opt` = 1");
    ?>
    <div class="box_right_pro_view">
        <div class="title_right_pro_view"><?=$glo_lang['dich_vu'] ?></div>
        <!--        <li><a href="index.php?page=dichvu_view" title="Dịch vụ Logistics">Dịch vụ Logistics</a></li>-->
        <?php foreach ($sp_baiviet as $rows) { ?>
            <li><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
        <?php } ?>
        <div class="clr"></div>
    </div>
    <?php
    $sp_baiviet = LAY_baiviet(1, 3, "`opt` = 0");
    ?>

    <div class="box_right_pro_view">
        <div class="title_right_pro_view"><?= $glo_lang['gioi-thieu'] ?></div>

        <ul>
            <?php foreach ($sp_baiviet as $rows) { ?>
                <li><a <?= full_href($rows) ?>><?= SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <?php
    $sp_baiviet = LAY_baiviet(7, 4, "`opt` = 1");
    ?>
    <div class="box_right_pro_view box_right_pro_tt">
        <div class="title_right_pro_view">
            <?= $glo_lang['bai-viet-xem-nhieu'] ?></div>

        <?php foreach ($sp_baiviet as $rows) { ?>
            <div class="new_id_bs">
                <li>
                    <a<?=full_href($rows) ?>><?=full_img($rows, '') ?>
                    </a>
                </li>
                <li >
                    <a <?= full_href($rows) ?>>
                        <span class="limit-lines"><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></span>
                    </a>
                </li>
                <div class="clr"></div>
            </div>

        <?php } ?>
    </div>

</div>
</div><style>
    .limit-lines {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>


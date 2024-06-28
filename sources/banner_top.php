
    <style>
        .line-break {
            display: inline-block;
            word-wrap: break-word;
        }
    </style>

<div class="bannerMain">
    <div class="banner owl-carousel owl-theme owl-custome" id="owl-banner">
        <?php
        $banner_top = LAY_banner_new("`id_parent` = 26");
        foreach ($banner_top as $index => $rows) {
            ?>
            <div class="absolute">
                <img src="<?=$fullpath."/".$rows['duongdantin']."/".$rows['icon']?>" alt="Banner Image">
                <div class="slogan">
                    <h2 class="wow fadeInDown headline" id="headline-<?=$index?>"><?=$rows['tenbaiviet_'.$lang]?></h2>
                    <h4 class="wow fadeInUp" id="noidungbanner" data-wow-duration="1s"><?= $rows['mota_'.$lang] ?></h4>
                    <p class="read_more wow fadeInUp"id="chitietbanner">
                        <?php if($rows['seo_name'] != "") { ?>
                            <a href="<?php echo GET_link($full_url, $rows['seo_name']); ?>" class="read_baogia preview fancybox.ajax">Nhận báo giá</a>
                        <?php } ?>
                        <a <?= full_href(['seo_name' => 'popup-lien-he']) ?>" class="read_baogia preview fancybox.ajax"><?=$glo_lang['nhan_bao_gia'] ?></a>
                        <a href="dich-vu"><?=$glo_lang['xem_them'] ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="clr"></div>
</div>



<script type="text/javascript">

    const headlines = document.querySelectorAll('.headline');
    headlines.forEach(headline => {
        const text = headline.innerText;
        const words = text.split(' ');
        if (words.length > 8) {
            const firstLineWords = words.slice(0, 4).join(' ');
            const remainingWords = words.slice(4).join(' ');
            headline.innerHTML = `${firstLineWords}<br>${remainingWords}`;
        }
    });
    $(document).ready(function(){
        $(".banner.owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        });
    });
</script>


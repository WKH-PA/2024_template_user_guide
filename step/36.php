<?php
// Lấy video từ database hoặc một nguồn khác dựa trên id_parent
$video = LAY_banner_new("`id_parent` = 28",1);
$video_url = $video['seo_name'];
?>

<div  class="bangdo_poup">
    <div class="video-container">
        <iframe id="video" src="https://www.youtube.com/embed/<?= $video_url ?>"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
    </div>
</div>



<style>
    /* Video responsive mặc định cho màn hình nhỏ (di động) */
    #video  {
        position: relative;
        width: 700px;
        height: 500px ;

    }

    #video iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
        padding-bottom:0;
    }

    /* Media query cho màn hình lớn hơn 768px (máy tính bảng, laptop nhỏ) */
    @media (min-width: 768px) {
        #video  {
            max-width: 500px; /* Kích thước cố định cho màn hình lớn */
            height: 350px;
            margin: 0 auto; /* Căn giữa video */
            padding-bottom:0;

        }
    }

    /* Media query cho màn hình lớn hơn 1024px (PC) */
    @media (min-width: 1024px) {
        #video  {
            max-width: 700px; /* Kích thước lớn hơn cho màn hình PC */
            height: 500px;
            padding-bottom:0;
        }
    }


</style>
<?php
$video = LAY_banner_new("`id_parent` = 28",1);
$video_url = $video['seo_name'];
?>

<div class="poup_page">
    <div class="bangdo_poup">
        <iframe width="700" height="500" src="https://www.youtube.com/embed/<?= $video_url ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>

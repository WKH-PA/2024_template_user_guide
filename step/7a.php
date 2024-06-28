<?php
// Assuming $row['seo_name'] contains the YouTube video ID or slug

$youtube_id = isset($row['seo_name']) ? GET_ID_youtube($row['seo_name']) : '';

if (!empty($youtube_id)) {
  ?>
  <iframe width="400" height="315" class="iframe_load" src="https://www.youtube.com/embed/<?= $youtube_id ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  <?php
} else {
  // Handle case where $row['seo_name'] is empty or invalid
  echo "Invalid YouTube video ID";
}
?>

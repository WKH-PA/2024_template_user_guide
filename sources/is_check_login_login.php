<?php
    $sql = DB_que("SELECT * FROM `#_members` WHERE `showhi` = 1 AND `id` = '".$_SESSION['id']."' AND `phanquyen` = 0 LIMIT 1");
    $row            = mysqli_fetch_array($sql);
    foreach ($row as $key => $value) {
      ${$key}        = $value;
    }
?>
<div class="dv-xinchao">
  <?=$glo_lang['xin_chao'] ?>: <?=$email ?> | <a href="<?=$full_url."/thoat/" ?>"><?=$glo_lang['thoat'] ?></a> 
</div>
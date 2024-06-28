<?php
	if($thongtin['is_lang'] == 1){
	$las_url    = "";
	if($motty  != "") $las_url    .= "/".$motty;
	if($haity  != "") $las_url    .= "/".$haity;
	if($baty   != "") $las_url    .= "/".$baty;
	if($bonty  != "") $las_url    .= "/".$bonty;
	if($namty  != "") $las_url    .= "/".$namty;
	// if($lang == "vi"){
?>

        <div class="lang_top">
            <ul>
                <?php if($thongtin['is_lang'] == 1){ ?>
                    <li><i class="fa fa-globe" aria-hidden="true"></i></li>
                    <li><a href="<?=$fullpath.$las_url."/?actilang=true" ?>"><i class="fa fa-flag-vn" aria-hidden="true"></i> VN</a></li>
                    <li>|</li>
                    <li><a href="<?=$fullpath.'/en'.$las_url."/?actilang=true" ?>"><i class="fa fa-flag-us" aria-hidden="true"></i>ENG</a></li>
                <?php } ?>
                <div class="clr"></div>
            </ul>
        </div>
<?php } ?>
<?php
	if(!defined("luu_lai")) exit();
	$id = addslashes($_POST['id']);
	$sql_se           = DB_que("SELECT * FROM `#_file_import_data` WHERE `id`='".$id."' LIMIT 1");
	if(!mysql_num_rows($sql_se)) {
		echo "ERR!";
		exit();
	}
	$sql_se           = mysql_fetch_assoc($sql_se);
	

	$duongdantin      = SHOW_text($sql_se['duongdantin']);
	$file_excel       = SHOW_text($sql_se['file_excel']);

	$arr_cotex = array("1" => "A", "2" => "B", "3" => "C", "4" => "D", "5" => "E", "6" => "F", "7" => "G", "8" => "H", "9" => "I", "10" => "J", "11" => "K", "12" => "L", "13" => "M", "14" => "N", "15" => "O", "16" => "P", "17" => "Q", "18" => "R", "19" => "S", "20" => "T", "21" => "U", "22" => "V", "23" => "W", "24" => "X", "25" => "Y", "26" => "Z", "27" => "AA", "28" => "AB", "29" => "AC", "30" => "AD", "31" => "AE", "32" => "AF", "33" => "AG", "34" => "AH", "35" => "AI", "36" => "AJ", "37" => "AK", "38" => "AL", "39" => "AM", "40" => "AN", "41" => "AO", "42" => "AP", "43" => "AQ", "44" => "AR", "45" => "AS", "46" => "AT", "47" => "AU", "48" => "AV", "49" => "AW", "50" => "AX");
	$arr_cotex_n  	  = array();
	foreach ($arr_cotex as $key => $value) {
		$arr_cotex_n[$value] 	= $key - 1;
	}
	$ma_sp 			  = @$arr_cotex_n[$sql_se['ma_sp']];
	$ten_sp 		  = @$arr_cotex_n[$sql_se['ten_sp']];
	$gia_md 		  = @$arr_cotex_n[$sql_se['gia_md']];
	$gia_km 		  = @$arr_cotex_n[$sql_se['gia_km']];
	$bat_gia_km 	 = @$arr_cotex_n[$sql_se['bat_gia_km']];


	// print_r($sql_se);
	
	include 'simplexlsx.class.php';
	$file = "../$duongdantin/$file_excel";
	if(is_file($file)){
		if ($xlsx = SimpleXLSX::parse($file)) {
			$list_row = $xlsx->rows();
			
			$i =0;
			$j =0;
			foreach ($list_row as $value) {
				if(empty($value[$ma_sp]) || $value[$ma_sp] == '') continue;
				//
				$sp  = DB_que("SELECT * FROM `#_baiviet`  WHERE `p1` = '".$value[$ma_sp]."'  LIMIT 1");
				if(!mysql_num_rows($sp)) continue;
				$i++;
				//
				$sp  = mysql_fetch_assoc($sp);

				

				if(!empty($value[$gia_md]) && $value[$gia_md] != '' && $value[$gia_md] != 0) {
					$gia = str_replace(",", '', $value[$gia_md]);
					$gia = str_replace(".", '', $gia);


					$ten_sp 		  = @$arr_cotex_n[$sql_se['ten_sp']];
					$gia_md 		  = @$arr_cotex_n[$sql_se['gia_md']];
					$gia_km 		  = @$arr_cotex_n[$sql_se['gia_km']];
					$bat_gia_km 	 = @$arr_cotex_n[$sql_se['bat_gia_km']];


					// if(is_numeric($gia) && $gia >= 0){
						DB_que("UPDATE `#_baiviet` SET `giatien` = '".$gia."',
						`tenbaiviet_vi` = '".$value[$ten_sp]."', 
						`giatien` = '".$value[$gia_md]."', 
						`giakm` = '".$value[$gia_km]."', 
						`opt_km` = '".(strtolower($value[$bat_gia_km]) == "y" ? 1 : 0)."'
						 WHERE `id` = '".$sp['id']."' LIMIT 1");
					// }
				}

				// update gia khu vuc 
				// print_r($gia_list);
				// foreach ($gia_list as $k => $v) {
				// 	$gkv = $value[$arr_cotex_n[$v['val']]];
				// 	if(is_numeric($gkv) && $gkv >= 0) {
				// 		//check
				// 		$check = DB_que("SELECT `id` FROM `#_baiviet_price`  WHERE `id_baiviet` = '".$sp['id']."' AND `id_khuvuc` = '".$v['id']."' LIMIT 1");
				// 		if(mysql_num_rows($check)){
				// 			DB_que("UPDATE `#_baiviet_price` SET `gia` = '".$gkv."' WHERE `id_baiviet` = '".$sp['id']."' AND `id_khuvuc` = '".$v['id']."' LIMIT 1");
				// 		} else {
				// 			$data = array();
				// 			$data['id_baiviet'] = $sp['id'];
				// 			$data['id_khuvuc'] 	= $v['id'];
				// 			$data['gia'] 		= $gkv;
				// 			ACTION_db($data, "#_baiviet_price" , 'add', NULL,NULL);
				// 		}
				// 	}
				// }
				// 

				// if(mysql_affected_rows()){
					$j++;
					echo "<p>$j. ID ".$value[$ma_sp].' - '.$sp['tenbaiviet_vi']." thành công!</p>";
				// }else{
				// 	echo "<p class='f'>$i. ID ".$value[0]." không thành công!</p>";
				// }
			}
			
			echo '<script>$(".ip_total").html("Tổng ['.count($list_row).'] - Thành công ['.$j.']")</script>';
			//cong dem
			DB_que("UPDATE `#_file_import_data` SET `import_cuoi` = '".time()."', `so_lan_import` = `so_lan_import` + 1 WHERE `id`='".$id."' LIMIT 1");
			//
		} else {
			echo SimpleXLSX::parse_error();
		}
	}else{
		echo "File không tồn tại!";
	}
?>
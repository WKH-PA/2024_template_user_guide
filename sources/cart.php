<?php
  if(isset($_POST['xoa_sp']))
  {
      if(isset($_SESSION['cart'][$_POST['id_die']])) unset($_SESSION['cart'][$_POST['id_die']]);
      if(count($_SESSION['cart']) == 0) unset($_SESSION['cart']);
  } 

  if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
    $_SESSION['cart'][$_GET['id']] = 1;
    LOCATION_js($full_url."/gio-hang/");
  }

  if(isset($_POST['id'])){
    $id = isset($_POST['id']) && $_POST['id'] > 0 ? $_POST['id'] : 0;
    if($id == 0) {
      LOCATION_js($full_url."/gio-hang/");
      exit();
    } 
    $tinhnang = "";
    for ($i=1; $i <= 100; $i++) {
      if(isset($_POST['tinhnang_'.$i])) {
        $tinhnang .= $tinhnang == "" ? trim($_POST['tinhnang_'.$i]) : ','.trim($_POST['tinhnang_'.$i]);
      }

    }

      $key = $id."_".md5($tinhnang);
      $_SESSION['tinhnang'][$key] = $tinhnang;

      // Xử lý số lượng
      $quantity = isset($_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] > 0 ? intval($_POST['quantity']) : 1;

      // Cập nhật số lượng trong giỏ hàng
      if(isset($_SESSION['cart'][$key])) {
          $_SESSION['cart'][$key] += $quantity; // Cộng thêm số lượng
      } else {
          $_SESSION['cart'][$key] = $quantity; // Thêm mới sản phẩm vào giỏ hàng
      }
    LOCATION_js($full_url."/gio-hang/");
  }

  // print_r($_SESSION['cart']);
  // unset($_SESSION['cart']);
 
  $thongtin_step   = LAY_anhstep_now(LAY_id_step(1));
?>
<div class="link_page">
  <div class="pagewrap">
      <h3><?=$glo_lang['gio_hang'] ?></h3>
     <a href="<?=$full_url ?>"><i class="fa fa-home"></i><?=$glo_lang['trang_chu'] ?></a><span>/</span><a href="<?=$full_url."/gio-hang" ?>"><?=$glo_lang['gio_hang'] ?></a>
  </div>
</div>


<div class="page_conten">
  <div class="pagewrap">
    <div class="pagewrap page_conten_page page_conten_page_dh" style="padding-top: 0">
      <!--  -->
        <div class="dv-gio-hang">
        <!--  -->
          <?php 
            $link_cart = GET_link($full_url, SHOW_text(laySeoName('seo_name', '#_step', '`showhi` = 1 AND `step` = 2')));
            if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0)
            {
          ?>
              <div class="cart-empty"><?=$glo_lang['hien_chua_co_san_pham_nao_trong_gio_hang'] ?></div>
              <div class="continue-shopping"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="<?=$link_cart ?>"><?=$glo_lang['tiep_tuc_mua_hang']  ?></a></div>
          <?php
            }
            else
            { 
          ?>
                <div id="cart_list" class="tb_rps">
                    <div class="dv-table-reposive dv-table-reposive-cart">
                        <table width="100%" border="0" cellspacing="1" cellpadding="5">
                            <thead>
                            <tr>
                                <th><?=$glo_lang['cart_ten_sp'] ?></th>
                                <th width="10%" class="text-center"><?=$glo_lang['cart_qty'] ?></th>
                                <th width="15%" style="text-align:right"><?=$glo_lang['cart_dongia'] ?></th>
                                <th width="15%" style="text-align:right"><?=$glo_lang['cart_thanhtien'] ?></th>
                                <th width="10%" class="text-center"><?=$glo_lang['cart_thaotac'] ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $tongtien = 0;
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $id_sp = explode("_", $key)[0];
                                $sanpham = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` = 1 AND `id` = '".$id_sp."' LIMIT 1");
                                if(mysqli_num_rows($sanpham) > 0) {
                                    $sanpham = mysqli_fetch_assoc($sanpham);
                                    $dongia = check_gia_sql($id_sp, @$_SESSION['tinhnang'][$key], $sanpham['giatien']);
                                    $thanhtien = $dongia * $value;
                                    $tongtien += $thanhtien;
                                    $anhsp = checkImage($fullpath, $sanpham['icon'], $sanpham['duongdantin']);
                                    ?>
                                    <tr>
                                        <td class="dv-anh-cart-sp">
                                            <a href="<?=GET_link($full_url, SHOW_text($sanpham['seo_name'])) ?>"><img src="<?=$anhsp ?>" alt="<?=SHOW_text($sanpham['tenbaiviet_'.$_SESSION['lang']]) ?>"></a>
                                            <div class="dv-anh">
                                                <a href="<?=GET_link($full_url, SHOW_text($sanpham['seo_name'])) ?>"><?=SHOW_text($sanpham['tenbaiviet_'.$_SESSION['lang']]) ?></a>
                                                <p>MS: <?=SHOW_text($sanpham['p1']) ?></p>
                                                <p class="p_mota_cart">
                                                    <?php
                                                    $isthuoctinh = @explode(",", $_SESSION['tinhnang'][$key]);
                                                    foreach ($isthuoctinh as $ittinh) {
                                                        if(@$tinhnang_arr[$ittinh]['tenbaiviet_'.$lang] == "") continue;
                                                        echo '<span>'.$tinhnang_arr[$ittinh]['tenbaiviet_'.$lang].'</span>';
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <input type="number" min="1" max="9999" name="quantity" value="<?=$value ?>" class="qty qty_is_soluong" id="product-quantity-<?=$id_sp ?>" onchange='updateQty("<?=$full_url."/update-qty/" ?>","<?=$key ?>", this)' />
                                        </td>

                                        <td class="text-right"><b><?=($dongia == 0) ? 0 : NUMBER_fomat($dongia)." ".$glo_lang['dvt'] ?></b></td>
                                        <td class="text-right"><b><span class="td_thanhtien_<?=$key ?>"><?=($thanhtien== 0)  ? 0 : NUMBER_fomat($thanhtien) ?></span> <?=$glo_lang['dvt'] ?></b></td>
                                        <td class="text-center">
                                            <form action="" method="post">
                                                <input type="hidden" name="id_die" value="<?=$key ?>">
                                                <button type="submit" class="pro_del" name="xoa_sp" onclick="return confirm('<?=$glo_lang['ban_that_su_muon_xoa'] ?>')"><?=$glo_lang['cart_xoa'] ?></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="dv-tongtien no_box">
    <span id="pro_sum"><?=$glo_lang['cart_tong_tien'] ?>:
    <label class='tb_tongtien'><?=($tongtien == 0) ? "0": NUMBER_fomat($tongtien)." ".$glo_lang['dvt'] ?></label>
    </span>
                    </div>
                    <div class="dv-btn-cart no_box formBox">
                        <a href="<?=$link_cart ?>" class="pro_del button mar"><?=$glo_lang['tiep_tuc_mua_hang'] ?></a>
                        <a onclick="cap_nhat_so_luong()" class="cur button pro_del mar"><?=$glo_lang['cap_nhat_so_luong'] ?><img src="images/loading2.gif" class="ajax_img_loading"></a>
                        <a href="<?=$full_url?>/dat-hang/" class="pro_del button mar"><?=$glo_lang['gui_don_hang'] ?></a>
                    </div>
                </div>

            <?php } ?>
          <!--  -->
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
      <!--  -->
    </div>
  </div>
</div>
<script type="text/javascript">
  $(function(){
    $(".dangky_giohang ul h3 a, .is_num_cart").html("<?php if(isset($_SESSION['cart'])) echo count($_SESSION['cart']); else echo "0"; ?>");
  })
  function updateQty(url, key, element) {
      $(".ajax_img_loading").show();
      let quantity = element.value;

      $.ajax({
          type: 'POST',
          url: url,
          data: { id: key, quantity: quantity },
          success: function (response) {
              location.reload();
          }
      });
  }

</script>

<style>
    .link_page{
        margin-top: 110px;
    }

    /* Cart Container */
    .dv-gio-hang {
        margin: 30px auto;
        padding: 20px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    /* Table Styling */
    .dv-table-reposive {
        overflow-x: auto;
        border-radius: 15px;
    }

    .dv-table-reposive table {
        width: 100%;
        border-collapse: collapse;
    }

    .dv-table-reposive th, .dv-table-reposive td {
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
        text-align: left;
    }

    .dv-table-reposive th {
        background-color: #3498db;
        color: #fff;
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .dv-table-reposive td {
        background-color: #fff;
    }

    /* Product Image */
    .dv-anh-cart-sp img {
        max-width: 100px;
        border-radius: 10px;
        margin-right: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .dv-anh {
        display: flex;
        align-items: center;
    }

    /* Product Title and Description */
    .dv-anh a {
        font-size: 1.2em;
        font-weight: bold;
        color: #3498db;
        text-decoration: none;
        transition: color 0.3s;
    }

    .dv-anh a:hover {
        color: #2980b9;
    }

    .p_mota_cart span {
        display: inline-block;
        background: #e0f7fa;
        color: #00796b;
        padding: 5px 10px;
        border-radius: 5px;
        margin-right: 5px;
        font-size: 0.9em;
    }

    /* Quantity Input */
    .qty_is_soluong {
        width: 60px;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-align: center;
    }

    /* Buttons */
    .dv-btn-cart a {
        padding: 12px 25px;
        border-radius: 30px;
        text-decoration: none;
        color: #fff;
        background: linear-gradient(45deg, #3498db, #2980b9);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        font-size: 1.1em;
        margin: 10px 5px;
        display: inline-block;
        transition: background 0.3s, box-shadow 0.3s;
    }

    .dv-btn-cart a:hover {
        background: linear-gradient(45deg, #2980b9, #3498db);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    }

    /* Cart Empty Styling */
    .cart-empty {
        font-size: 1.5em;
        color: #888;
        text-align: center;
        margin: 50px 0;
    }

    .continue-shopping {
        text-align: center;
        margin-top: 20px;
    }

    .continue-shopping a {
        font-size: 1.2em;
        color: #3498db;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s;
    }

    .continue-shopping a:hover {
        color: #2980b9;
    }

    /* Cart Total */
    .dv-tongtien {
        font-size: 1.8em;
        font-weight: bold;
        text-align: right;
        margin-top: 30px;
    }

    .tb_tongtien {
        color: #e74c3c;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .dv-table-reposive th, .dv-table-reposive td {
            padding: 10px;
        }

        .dv-btn-cart a {
            font-size: 1em;
            padding: 10px 20px;
        }
    }
</style>

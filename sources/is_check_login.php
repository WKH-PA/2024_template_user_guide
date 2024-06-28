<?php 
    if(isset($_SESSION['id'])) {
      LOCATION_js($full_url);
      exit();
    }
?>
<div class="dv-dangnhap">
  <dd class="message message fade">
    <ul>
      <li><i class="fa fa-exclamation-triangle" ></i><?=$glo_lang['ban_phai_dang_nhap_truoc'] ?></li>
    </ul>
  </dd>
  <form action="" method="post" name="dangnhap" id="dangnhap">
    <div class="dangnhap_popup no_box">
      <div class="titBox left">
        <h3 class="tit"><?=$glo_lang['title_dang_nhap'] ?></h3>
      </div>
      <p class="dangnhap-mt"><?=$glo_lang['truy_cap_dang_nhap'] ?>  </p>
      <div class="row-frm">
        <p><?=$glo_lang['login_email'] ?> (*)</p>
        <input type="text"  name="txt_email"  class="form-control cls_data_check_form_check_dangky"  data-rong="1" data-email="1" data-msso="<?=$glo_lang['chua_nhap_dia_chi_email'] ?>" data-msso1="<?=$glo_lang['dia_chi_email_khong_hop_le'] ?>">
      </div>
      <div class="row-frm">
        <p><?=$glo_lang['login_pass'] ?> (*)</p>
        <input type="password" name="txt_pass" id="txt_pass" class="form-control cls_data_check_form_check_dangky"  data-rong="1" data-msso="<?=$glo_lang['login_nhap_mat_khau'] ?>">
      </div>
      <div class="box_dangnhap_popup">
        <a class="cur" id="dangnhap" onClick="check_dangnhap()"><?=$glo_lang['dang_nhap'] ?> <img class="img_load_from_dktv" src="images/loading2.gif"></a>
      </div>
      <div class="clr"></div>
    </div>
    </form>
     
    <script type="text/javascript">
      var send_d = 0;
      function check_dangnhap() {
        var check = 0;
        $(".cls_data_check_form_check_dangky").each(function(){
            var val     = $(this).val().trim();
            var id      = $(this).attr('id');
            var rong    = $(this).attr('data-rong');
            var email   = $(this).attr('data-email');
            var place   = $(this).attr('placeholder');

            var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(rong == 1 && (val == "" || val == place)){
                alert($(this).attr('data-msso'));
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                send_d = 0;
                return false;
            } 
            else if(email == 1 && !regex.test(val) && val != ""){
                alert($(this).attr('data-msso1'));
                $(this).focus();
                $(".ajax_img_loading").hide();
                check = 1;
                send_d = 0; 
                return false;
            }
        });

        if(check == 0){
          if(send_d == 0){
            send_d = 1;
            $(".img_load_from_dktv").show();
            var dataString = $('#dangnhap').serializeArray();
            $.ajax({
                type: "POST",
                url: "<?=$full_url."/check-dang-nhap/" ?>",
                data: dataString,
                success: function(response)
                {
                  console.log(response)
                  var obj = jQuery.parseJSON(response);
                  if(obj.error > 0){
                      alert(obj.ms);
                  }else{
                    window.location.reload();
                  }
                  $(".img_load_from_dktv").hide();
                  send_d = 0;
                }
            });
          }
        }
      }

      $('.form-control').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
              check_dangnhap();
            }
        });
    </script> 
</div>

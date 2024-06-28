<div class="tuvanbaogia_popup pop-quotation">
  <form id="frmQuotation" onsubmit="return QuotationSubmit()">
    <h3>Thông tin đặt lịch chụp</h3>
    <div class="row row-8Gutter">
      <div class="col-md-6">
        <fieldset class="form-group">   
          <label>Họ và tên:</label>           
          <input type="text" placeholder="Ví dụ: Nguyễn Văn Nam" name="contact[name]" id="name" class="form-control  form-control-lg" required="">
        </fieldset>
      </div>
      <div class="col-md-6">
        <fieldset class="form-group">             
          <label>Số điện thoại:</label>
          <input type="text" placeholder="0123 456 789" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" name="contact[phone]" id="phone" class="form-control form-control-lg" required="">
        </fieldset>
      </div>
      <div class="col-md-6">
        <fieldset class="form-group">
          <label>Email của bạn:</label>
          <input type="email" name="contact[email]" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-validation="email" class="form-control form-control-lg" required="">
        </fieldset>
      </div>
      <div class="col-md-6">
        <fieldset class="form-group">             
          <label>Địa chỉ chi tiết:</label>
          <input type="text" placeholder="Ví dụ: Ngõ 898, Đường Láng..." name="contact[address]" id="address" class="form-control form-control-lg" required="">
        </fieldset>
      </div>
      <div class="col-md-12">
        <fieldset class="form-group date_pick">
          <label>Ngày chụp dự kiến:</label>
          <input type="date" name="ngay-den" value="" class="form-control" id="ngay-den" min="2021-02-06" aria-required="true" aria-invalid="false" placeholder="Ngày chụp dự kiến">
        </fieldset>
      </div>
      <div class="col-md-12">
        <fieldset class="form-group">   
          <label>Ghi chú khác:</label>
          <textarea name="contact[body]" placeholder="Ghi chú cho chúng tôi" id="comment" class="form-control form-control-lg" rows="2" required=""></textarea>
        </fieldset>
      </div>
      <div class="submit-lienhe">
        <button type="submit" class="btn btn-primary">Đặt lịch <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
      </div>
    </div>
  </form>
</div>

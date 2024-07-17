jQuery(document).ready(function() {
  $('.upper').on('input', setFill);
  $('.lower').on('input', setFill);

  // Chắc chắn rằng các phần tử .upper và .lower tồn tại
  if ($('.upper').length && $('.lower').length) {
    var max = parseFloat($('.upper').attr('max'));
    var min = parseFloat($('.lower').attr('min'));

    function setFill(evt) {
      var valUpper = parseFloat($('.upper').val());
      var valLower = parseFloat($('.lower').val());

      if (isNaN(valUpper) || isNaN(valLower)) {
        // Nếu một trong hai giá trị không hợp lệ, dừng lại
        return;
      }

      if (valLower > valUpper) {
        var trade = valLower;
        valLower = valUpper;
        valUpper = trade;
      }

      var width = (valUpper * 100) / max;
      var left = (valLower * 100) / max;
      $('.fill').css('left', 'calc(' + left + '%)');
      $('.fill').css('width', (width - left) + '%');
    }
  }
});









//
  // // Bộ lọc filter
  // jQuery(document).ready(function() {
  // $('.upper').on('input', setFill);
  // $('.lower').on('input', setFill);
  //
  // var max = $('.upper').attr('max');
  // var min = $('.lower').attr('min');
  //
  // function setFill(evt) {
  //   var valUpper = $('.upper').val();
  //   var valLower = $('.lower').val();
  //   if (parseFloat(valLower) > parseFloat(valUpper)) {
  //     var trade = valLower;
  //     valLower = valUpper;
  //     valUpper = trade;
  //   }
  //
  //   var width = valUpper * 100 / max;
  //   var left = valLower * 100 / max;
  //   $('.fill').css('left', 'calc(' + left + '%)');
  //   $('.fill').css('width', width - left + '%');
  //

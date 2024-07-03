
  // Bộ lọc filter
  jQuery(document).ready(function() {
  $('.upper').on('input', setFill);
  $('.lower').on('input', setFill);

  var max = $('.upper').attr('max');
  var min = $('.lower').attr('min');

  function setFill(evt) {
    var valUpper = $('.upper').val();
    var valLower = $('.lower').val();
    if (parseFloat(valLower) > parseFloat(valUpper)) {
      var trade = valLower;
      valLower = valUpper;
      valUpper = trade;
    }
    
    var width = valUpper * 100 / max;
    var left = valLower * 100 / max;
    $('.fill').css('left', 'calc(' + left + '%)');
    $('.fill').css('width', width - left + '%');
    

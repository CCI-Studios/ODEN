(function($){
  var $block;
  
  $(function(){
    $block = $(".block--back-to-top");
    $(window).on("scroll", updateBlockVisibility);
    $(window).on("load", updateBlockVisibility);
  });
  
  function updateBlockVisibility() {
    if ($(window).scrollTop() > 100) {
      $block.show();
    } else {
      $block.hide();
    }
  }
})(jQuery);

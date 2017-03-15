(function($){
  $(function(){
    var $container = $(".view-header-images .view-content");
    var paused = false;
    if ($container && $container.length) {
      $container.slick({
        arrows: false,
        dots: true,
        autoplay: true,
        autoplaySpeed: 6000,
        waitForAnimate: false,
        pauseOnDotsHover: true
      });
      $container.find(".slick-dots").append("<li aria-hidden='true' class='dots-pause'><button title='Pause slideshow'>Pause slideshow</button></li>");
      $container.find(".dots-pause button").click(function(){
        if (paused) {
          $container.slick("slickPlay");
        } else {
          $container.slick("slickPause");
        }
        $container.find(".dots-pause").toggleClass("slick-active");
        paused = !paused;
      });
    }
  });
})(jQuery);

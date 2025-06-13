// assets/slider.js
(function ($) {
  $(document).ready(function () {
    // Initialize each slider container on the page
    $(".bis-slider-container").each(function () {
      var $container = $(this);
      var $slides = $container.find(".bis-bg-slide");
      var totalSlides = $slides.length;

      // Only initialize if we have slides
      if (totalSlides === 0) return;

      // Set initial active slide
      $slides.removeClass("active");
      $slides.eq(0).addClass("active");

      // Only set up interval if we have multiple slides
      if (totalSlides > 1) {
        var currentIndex = 0;
        var intervalTime = 5000; // 5 seconds
        var transitionSpeed = 1000; // Matches CSS transition time

        function nextSlide() {
          // Remove active class from current slide
          $slides.eq(currentIndex).removeClass("active");

          // Calculate next index
          currentIndex = (currentIndex + 1) % totalSlides;

          // Add active class to next slide
          $slides.eq(currentIndex).addClass("active");
        }

        // Set up the interval
        var slideInterval = setInterval(nextSlide, intervalTime);

        // Optional: Pause on hover
        $container.hover(
          function () {
            clearInterval(slideInterval);
          },
          function () {
            slideInterval = setInterval(nextSlide, intervalTime);
          }
        );
      }
    });
  });
})(jQuery);

jQuery(document).ready(function($) {
    let slides = $('.bis-bg-slide'); // Target the background slides
    let current = 0;

    function showSlide(index) {
        slides.removeClass('active');
        slides.eq(index).addClass('active');
    }

    function nextSlide() {
        current = (current + 1) % slides.length;
        showSlide(current);
    }

    // Initialize the first slide
    showSlide(current);

    // Start auto-play
    setInterval(nextSlide, 5000); // change every 5 seconds
});
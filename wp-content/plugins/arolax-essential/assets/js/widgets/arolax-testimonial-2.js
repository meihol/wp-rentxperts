/* global WCF_ADDONS_JS */
(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    const ArolaxTestimonial2 = function ($scope, $) {
        const thumbSlider = $($('.prod_testimonial_thumb', $scope)[0]);
        const slider = $($('.prod_testimonial_content', $scope)[0]);
        const Settings = $($('.prod_testimonial_wrapper', $scope)[0]).data('settings') || {};

        const thumbSliderSettings = Object.assign({}, Settings, {
            slidesPerView: 'auto', //bad
            spaceBetween: 10,
            slideToClickedSlide: true,
        });
        const sliderSettings = Object.assign({}, Settings, {
            slidesPerView: 1, //bad
        });
        sliderSettings.handleElementorBreakpoints = true;

        new elementorFrontend.utils.swiper(slider, sliderSettings).then(slider => slider).then(slider => {
            new elementorFrontend.utils.swiper(thumbSlider, thumbSliderSettings).then(thumbs => thumbs).then(thumbs => {
                slider.controller.control = thumbs;
                thumbs.controller.control = slider;
            })
        });
    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/arolax--testimonial-2.default', ArolaxTestimonial2);
    });
})(jQuery);

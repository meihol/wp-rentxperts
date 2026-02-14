/* global WCF_ADDONS_JS */
(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    const ArolaxServiceSlider = function ($scope, $) {
        const slider = $($('.arolax_service_slider', $scope)[0]);
        const sliderSettings = $($('.axs_slider_wrapper', $scope)[0]).data('settings') || {};

        new elementorFrontend.utils.swiper(slider, sliderSettings).then(newSwiperInstance => newSwiperInstance);
    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/arolax--service-slider.default', ArolaxServiceSlider);
    });
})(jQuery);
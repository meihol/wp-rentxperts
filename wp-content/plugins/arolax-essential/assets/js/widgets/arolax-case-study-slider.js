/* global WCF_ADDONS_JS */
(function ($) {
  /**
   * @param $scope The Widget wrapper element as a jQuery element
   * @param $ The jQuery alias
   */
  const ArolaxCaseStudySlider = function ($scope, $) {
    const slider = $($('.case-study-slider', $scope)[0]);
    const sliderSettings = $($('.arolax-case-study-slider', $scope)[0]).data('settings') || {};
    sliderSettings.handleElementorBreakpoints = true;

    new elementorFrontend.utils.swiper(slider, sliderSettings).then(newSwiperInstance => newSwiperInstance);
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/arolax--case-study.default', ArolaxCaseStudySlider);
  });
})(jQuery);

/* global WCF_ADDONS_JS */
(function ($) {
  /**
   * @param $scope The Widget wrapper element as a jQuery element
   * @param $ The jQuery alias
   */
  const AdvanceSlider = function ($scope, $) {
    const slider = $($('.advance_slider', $scope)[0]);
    const sliderType = $('.advance_slider_wrapper', $scope).attr('slider-type') || false;
    const sliderSettings = $($('.advance_slider_wrapper', $scope)[0]).data('settings') || {};
    sliderSettings.handleElementorBreakpoints = true;

    //shader slider
    if ('shaders' === sliderType) {
      sliderSettings.modules = [SwiperGL]
    }

    //slicer
    if ('slicer' === sliderType) {
      sliderSettings.modules = [EffectSlicer]
    }

    //shutters
    if ('shutters' === sliderType) {
      sliderSettings.modules = [EffectShutters]
    }

    //fashion
    if ('fashion' === sliderType) {
      sliderSettings.modules = [EffectFashion]
    }

    //spring
    if ('spring' === sliderType) {
      sliderSettings.modules = [EffectSpring]
    }

    //carousel
    if ('carousel' === sliderType) {
      sliderSettings.modules = [EffectCarousel]
    }

    //poster
    if ('posters' === sliderType) {
      sliderSettings.modules = [EffectPoster]
    }

    //material
    if ('material' === sliderType) {
      sliderSettings.modules = [EffectMaterial]
    }

    new elementorFrontend.utils.swiper(slider, sliderSettings).then(newSwiperInstance => newSwiperInstance);
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/wcf--advance-slider.default', AdvanceSlider);
  });
})(jQuery);
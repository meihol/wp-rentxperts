/* global WCF_ADDONS_JS */
(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    const ArolaxVideoSlider = function ($scope, $) {
        const slider = $($('.arolax_video_slider', $scope)[0]);
        const sliderSettings = $($('.arolax_vs_wrapper', $scope)[0]).data('settings') || {};
        sliderSettings.handleElementorBreakpoints = true;

        new elementorFrontend.utils.swiper(slider, sliderSettings).then(newSwiperInstance => newSwiperInstance).then((newSwiperInstance)=>{

            // Video
            newSwiperInstance.on('slideChange', video_play_pause)
            video_play_pause();
        });

        let video_play_pause = () => {
            const s_video = $('.vs__video', $scope);
            s_video.each((index, item)=>{
                $(item).removeAttr('controls');
                item.pause();

                $(item).on('click', function () {
                    if ($(this).closest('.swiper-slide-active').length) {
                        $(this).attr('controls', 'controls');
                    }
                })
            })
        }


    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/arolax--video-slider.default', ArolaxVideoSlider);
    });
})(jQuery);

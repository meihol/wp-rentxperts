/* global WCF_ADDONS_JS */
(function ($) {
  /**
   * @param $scope The Widget wrapper element as a jQuery element
   * @param $ The jQuery alias
   */
  const ArolaxVideoTestimonial = function ($scope, $) {
    const slider = $($('.arolax_vtm_slider', $scope)[0]);
    const sliderSettings = $($('.a_vtm_slider_wrapper', $scope)[0]).data('settings') || {};
    sliderSettings.handleElementorBreakpoints = true;

    if (sliderSettings.hasOwnProperty('pagination')) {
      sliderSettings['pagination']['formatFractionCurrent'] = function (number) {
        return ('0' + number).slice(-2);
      }
      sliderSettings['pagination']['formatFractionTotal'] = function (number) {
        return ('0' + number).slice(-2);
      }
      sliderSettings['pagination']['renderFraction'] = function (currentClass, totalClass) {
        return '<span class="' + currentClass + '"></span>' +
            ' <span class="dash"></span> ' +
            '<span class="' + totalClass + '"></span>';
      }
    }

    // new elementorFrontend.utils.swiper(slider, sliderSettings).then(newSwiperInstance => newSwiperInstance);

    new elementorFrontend.utils.swiper(slider, sliderSettings).then(newSwiperInstance => newSwiperInstance).then((newSwiperInstance)=>{

      // Video
      newSwiperInstance.on('slideChange')
      const tsm_video = $('.arolax_vtm_slider .video', $scope);
      const play_video = $('.arolax_vtm_slider .play-video', $scope);

      tsm_video.each((index, item)=>{
        $(item).on('click', function () {
          if( this.paused ) {
            this.play();
          } else {
            this.pause();
          }

          play_video.toggle();
        })
      })

    });

    // Icon Move
    if( 'object' === typeof gsap) {
      const all_btn = gsap.utils.toArray(".btn-move");
      const all_btn_cirlce = gsap.utils.toArray(".btn-item");

      all_btn.forEach((btn, i) => {
        $(btn).mousemove(function (e) {
          callParallax(e);
        });

        function callParallax(e) {
          parallaxIt(e, all_btn_cirlce[i], 80);
        }

        function parallaxIt(e, target, movement) {
          var $this = $(btn);
          var relX = e.pageX - $this.offset().left;
          var relY = e.pageY - $this.offset().top;

          gsap.to(target, 0.3, {
            x: ((relX - $this.width() / 2) / $this.width()) * movement,
            y: ((relY - $this.height() / 2) / $this.height()) * movement,
            scale: 1.2,
            ease: Power2.easeOut,
          });
        }

        $(btn).mouseleave(function (e) {
          gsap.to(all_btn_cirlce[i], 0.3, {
            x: 0,
            y: 0,
            scale: 1,
            ease: Power2.easeOut,
          });
        });
      });
    }
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/arolax--video-testimonial.default', ArolaxVideoTestimonial);
  });
})(jQuery);

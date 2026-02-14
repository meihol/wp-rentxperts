/* global WCF_ADDONS_JS */
(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    const ArolaxGallery = function ($scope, $) {

        //gsap related
        if ('object' === typeof gsap) {

            let gsap_mm = gsap.matchMedia();

            gsap_mm.add(`(min-width: 768px)`, () => {
                let sections = $('.g-slider--one .item', $scope);
                let sections2 = $('.g-slider--two .item', $scope);

                //progress
                let scrollTimer = -1;
                let updateProgress = function (self) {
                    $('.progress-circle', $scope).css('opacity', 1);

                    if (scrollTimer != -1) {
                        clearTimeout(scrollTimer);
                    }
                    scrollTimer = window.setTimeout(() => {
                        $('.progress-circle', $scope).css('opacity', 0);
                    }, 300);

                    const scrolled = self.progress * 100;

                    $('.progress-circle', $scope).css('--value', scrolled.toFixed(0))
                }

                gsap.to(sections, {
                    xPercent: -150,
                    ease: "none",
                    scrollTrigger: {
                        trigger: $scope,
                        pin: true,
                        pinSpacing: true,
                        scrub: 1,
                        onUpdate: (self) => {
                            updateProgress(self);
                        }
                        // end: "+=3000",
                    }
                });

                gsap.to(sections2, {
                    xPercent: 150,
                    ease: "none",
                    scrollTrigger: {
                        trigger: $scope,
                        pin: false,
                        scrub: 1,
                        // end: "+=3000",
                    }
                });

                $(window).scroll(() => {
                    console.log($(document).height(), $(window).height())
                })
            });

        }

    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/arolax--gallery.default', ArolaxGallery);
    });
})(jQuery);

(function ($) {

    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var Wcf_Animated_Offcanvas = function ($scope, $) {
        $(document).on('click', '.nav-direction-icon', function (e) {
            e.preventDefault();

            if ($(this).parent('a').next('.dp-menu').length) {
                var submenu = $(this)[0];
                var dpmenu = $(this).parent('a').next('.dp-menu');
                const expanded = submenu.getAttribute('aria-expanded') === 'true';
                submenu.setAttribute('aria-expanded', !expanded);
                if (expanded) {
                    this.setAttribute('data-icon', '+');
                    dpmenu.slideUp();
                } else {
                    dpmenu.slideDown();
                    this.setAttribute('data-icon', '-');
                }
            }
        });

        var offcanvas_html = $scope.find(".cwt-element-transfer-to-body");
        if (offcanvas_html.length) {
            $($scope.find(".cwt-element-transfer-to-body").prop("outerHTML")
            ).appendTo("body");
            offcanvas_html.remove();
        }

        var canvas_gl = null;
        if (typeof gsap === "object") {
            canvas_gl = gsap.timeline();
        }

        $(document).on("click", ".cwt--animated-offcanvas", function (e) {
            e.preventDefault();

            if (typeof gsap === "object") {
                if (typeof wcf_smoother !== "undefined") {
                    wcf_smoother.paused(true);
                }

                var canvas2 = gsap.timeline();
                canvas2.to(".cwt--offcanvas-area", {
                    duration: 0.5,
                    opacity: 1,
                    visibility: "visible",
                    "z-index": 9999,
                });
                canvas2.to(
                    ".cwt--offcanvas-left",
                    {
                        duration: 0.6,
                        top: 0,
                        opacity: 1,
                        visibility: "visible",
                    },
                    "-==.5"
                );
                canvas2.to(
                    ".cwt--offcanvas-right",
                    {
                        duration: 0.6,
                        bottom: 0,
                        opacity: 1,
                        visibility: "visible",
                    },
                    "-=0.6"
                );
            } else {
                $(".cwt--offcanvas-area").css({
                    opacity: 1,
                    visibility: "visible",
                    transition: "all 0.5s",
                    "z-index": 998,
                });

                $(".cwt--offcanvas-left").css({
                    opacity: 1,
                    top: 0,
                    visibility: "visible",
                    transition: "all 0.5s",
                });

                $(".cwt--offcanvas-right").css({
                    opacity: 1,
                    bottom: 0,
                    visibility: "visible",
                    transition: "all 0.5s",
                });

                $(".cwt--offcanvas-area").css({
                    "z-index": 9999,
                });
            }
        });

        $(document).on("click", ".offcanvas--close--button-js", function () {
            if (typeof gsap === "object") {
                if (typeof wcf_smoother !== "undefined") {
                    wcf_smoother.paused(false);
                }

                var canvas2 = gsap.timeline();
                canvas2.to(".cwt--offcanvas-right", {
                    duration: 0.6,
                    bottom: "-50%",
                    opacity: 0,
                });

                canvas2.to(
                    ".cwt--offcanvas-left",
                    {
                        duration: 0.6,
                        top: "-50%",
                        opacity: 0,
                    },
                    "-=.6"
                );

                canvas2.to(".cwt--offcanvas-area", {
                    duration: 0.8,
                    opacity: 0,
                    visibility: "hidden",
                    "z-index": -1,
                });

                $(".cwt--animated-offcanvas").css({
                    cursor: "wait",
                    "pointer-events": "none",
                });

                setTimeout(function () {
                    $(".cwt--animated-offcanvas").removeAttr("style");
                }, 1000);

            } else {
                $(".cwt--offcanvas-area").css({
                    opacity: 0,
                    visibility: "hidden",
                    transition: "all 0.5s",
                    "z-index": -1,
                });
            }
        });

    };

    // Make sure you run this code under Elementor.
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/wcf--animated-offcanvas.default",
            Wcf_Animated_Offcanvas
        );
    });
})(jQuery);

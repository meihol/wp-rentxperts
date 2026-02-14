(function ($) {



  /**
   * @param $scope The Widget wrapper element as a jQuery element
   * @param $ The jQuery alias
   */
  var Wcf_Offcanvas_Menu = function ($scope, $) {


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

    var offcanvas_html = $scope.find(".wcf-element-transfer-to-body");
    if (offcanvas_html.length) {
      $(
        $scope.find(".wcf-element-transfer-to-body").prop("outerHTML")
      ).appendTo("body");
      offcanvas_html.remove();
    }
    var content_source = $scope
      .find(".wcf--info-animated-offcanvas")
      .attr("data-content_source");
    var preset = $scope
      .find(".wcf--info-animated-offcanvas")
      .attr("data-preset");
    var canvas_gl = null;
    if (typeof gsap === "object") {
      canvas_gl = gsap.timeline();
    }

    $(document).on("click", ".wcf--info-animated-offcanvas", function (e) {
      e.preventDefault();

      if (typeof gsap === "object") {
        if (typeof wcf_smoother !== "undefined") {
          wcf_smoother.paused(true);
        }
        if (content_source === "elementor_shortcode") {
          canvas_gl.to(".wcf-offcanvas-gl-style", {
            top: 0,
            visibility: "visible",
            duration: 0.8,
            opacity: 1,
            rotationX: 0,
            perspective: 0,
          });
        } else {
          var canvas2 = gsap.timeline();
          canvas2.to(".wcf-offcanvas-gl-style", {
            duration: 0.5,
            opacity: 1,
            "z-index": 9999,
          });
          canvas2.to(
            ".offcanvas__left-2",
            {
              duration: 0.6,
              top: 0,
              opacity: 1,
              visibility: "visible",
            },
            "-==.5"
          );
          // Part 2
          canvas2.to(
            ".offcanvas__right-2",
            {
              duration: 0.6,
              bottom: 0,
              opacity: 1,
              visibility: "visible",
            },
            "-=0.6"
          );
        }
      } else {
        $(".wcf-offcanvas-gl-style").css({
          opacity: 1,
          visibility: "visible",
          transition: "all 0.5s",
          "z-index": 998,
        });

        $(".offcanvas__left-2").css({
          opacity: 1,
          top: 0,
          visibility: "visible",
          transition: "all 0.5s",
        });

        $(".offcanvas__right-2").css({
          opacity: 1,
          bottom: 0,
          visibility: "visible",
          transition: "all 0.5s",
        });

        $(".offcanvas-3__area").css({
          transform: "unset",
        });

        $(
          ".offcanvas-4__area,.offcanvas-4__menu ul li,.offcanvas-3__meta, .offcanvas-3__social"
        ).css({
          transform: "unset",
          opacity: 1,
          visibility: "visible",
          top: 0,
        });

        $(".offcanvas-4__thumb,.offcanvas-4__meta").css({
          opacity: 1,
          left: 0,
          visibility: "visible",
        });

        $(".wcf-offcanvas-gl-style").css({
          "z-index": 9999,
        });

        $(".offcanvas-6__menu-wrapper,.offcanvas-6__meta-wrapper").css({
          left: 0,
          visibility: "visible",
          opacity: "1",
          transform: "unset",
        });
      } // gsap end
    });

    $(document).on("click", ".offcanvas--close--button-js", function () {
      if (typeof gsap === "object") {
        if (typeof wcf_smoother !== "undefined") {
          wcf_smoother.paused(false);
        }
        if (content_source === "elementor_shortcode") {
          canvas_gl.to(".wcf-offcanvas-gl-style", {
            top: "-20%",
            duration: 0.8,
            rotationX: 25,
            perspective: 359,
            opacity: 0,
            index: -1,
          });

          canvas_gl.to(".wcf-offcanvas-gl-style", {
            visibility: "hidden",
            duration: 0.8,
          });
        } else {
          var canvas2 = gsap.timeline();
          // Part 2
          canvas2.to(".offcanvas__right-2", {
            duration: 0.6,
            bottom: "-50%",
            opacity: 0,
          });

          canvas2.to(
            ".offcanvas__left-2",
            {
              duration: 0.6,
              top: "-50%",
              opacity: 0,
            },
            "-=.6"
          );

          canvas2.to(".wcf-offcanvas-gl-style", {
            duration: 0.8,
            opacity: 0,
            "z-index": -1,
          });

          $(".wcf--info-animated-offcanvas").css({
            cursor: "wait",
            "pointer-events": "none",
          });

          setTimeout(function () {
            $(".wcf--info-animated-offcanvas").removeAttr("style");
          }, 1000);
        }
      } else {
        $(".wcf-offcanvas-gl-style").css({
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
      "frontend/element_ready/wcf--offcanvas-menu.default",
      Wcf_Offcanvas_Menu
    );
  });
})(jQuery);

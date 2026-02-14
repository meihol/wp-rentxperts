/* global WCF_ADDONS_JS */
(function ($) {
  /**
   * @param $scope The Widget wrapper element as a jQuery element
   * @param $ The jQuery alias
   */

  // Make sure you run this code under Elementor.
  $(window).on("elementor/frontend/init", function () {
    const device_width = $(window).width();

    const elementorBreakpoints =
      elementorFrontend.config.responsive.activeBreakpoints;
    const Modules = elementorModules.frontend.handlers.Base;

    let smooth_value = 1.35;
    let on_mobile = false;
    let mobile_media = "min-width: 768px";
    if (null !== WCF_ADDONS_JS.smoothScroller) {
      smooth_value = WCF_ADDONS_JS.smoothScroller.smooth;
      on_mobile = "on" === WCF_ADDONS_JS.smoothScroller.mobile ? true : false;
      mobile_media = WCF_ADDONS_JS.smoothScroller?.media ?? mobile_media;
    }

    if ("function" === typeof ScrollSmoother && "object" === typeof gsap) {
      let gsap_mm = gsap.matchMedia();

      if (on_mobile) {
        window.wcf_smoother = ScrollSmoother.create({
          smooth: smooth_value,
          effects: true,
          smoothTouch: 0.1,
          normalizeScroll: true, //false
          ignoreMobileResize: false, //false
          // preventDefault: true
        });
      } else {
        
        gsap_mm.add(`(${mobile_media})`, () => {
          window.wcf_smoother = ScrollSmoother.create({
            smooth: smooth_value,
            effects: true,
            smoothTouch: 0.1,
            normalizeScroll: true, //false
            ignoreMobileResize: false, //false
            // preventDefault: true
          });
        });
      }
    }

    if ("object" === typeof gsap) {
      let gsap_mm = gsap.matchMedia();

      const Animation = Modules.extend({
        bindEvents: function bindEvents() {
          this.run();
        },

        run: function run() {
          //fade animation using in container and all widget
          this.fade_animation();

          //widget animation
          if ("widget" === this.getElementType()) {
            //text animation
            this.text_animation();

            //image animation
            this.image_animation();
          }

          // Button Move Animation
          this.button_move_animation();
        },

        text_animation: function text_animation() {
          if (
            this.isEdit &&
            !this.getElementSettings("wcf_text_animation_editor")
          ) {
            return;
          }

          let match_media_key = "all";

          //if has min max key
          if (this.getElementSettings("text_animation_breakpoint")) {
            const breakpoint =
              elementorBreakpoints[
                this.getElementSettings("text_animation_breakpoint")
              ].value;

            if ("min" === this.getElementSettings("text_breakpoint_min_max")) {
              match_media_key = "min-width: " + breakpoint + "px";
            } else {
              match_media_key = "max-width: " + breakpoint + "px";
            }
          }

          //charter and word animation
          if (
            "char" === this.getElementSettings("wcf_text_animation") ||
            "word" === this.getElementSettings("wcf_text_animation")
          ) {
            const duration_value = this.getElementSettings("text_duration");
            const stagger_value = this.getElementSettings("text_stagger");
            const translateX_value =
              this.getElementSettings("text_translate_x");
            const translateY_value =
              this.getElementSettings("text_translate_y");
            const onscroll_value = this.getElementSettings("text_on_scroll");
            const data_delay = this.getElementSettings("text_delay");

            const length = this.findElement(
              ".elementor-widget-container"
            ).children().length;
            const element = $(
              this.findElement(".elementor-widget-container").children()[
                length - 1
              ]
            );

            let config = {
              duration: duration_value,
              autoAlpha: 0,
              delay: data_delay,
              stagger: stagger_value,
            };

            if (translateX_value) {
              config.x = translateX_value;
            }

            if (translateY_value) {
              config.y = translateY_value;
            }

            if (onscroll_value) {
              config.scrollTrigger = {
                trigger: element,
                start: "top 90%",
              };
            }

            let split_word = new SplitText(element, {
              type: "chars, words",
            });

            let split = split_word.chars;

            if ("word" === this.getElementSettings("wcf_text_animation")) {
              split = split_word.words;
            }

            if ("all" === match_media_key) {
              gsap.from(split, config);
            } else {
              gsap_mm.add(`(${match_media_key})`, () => {
                gsap.from(split, config);
                return () => {
                  // optional
                  // custom cleanup code here (runs when it STOPS matching)
                  split.revert();
                };
              });
            }
          }

          //text_move_animation
          if ("text_move" === this.getElementSettings("wcf_text_animation")) {
            const duration_value = this.getElementSettings("text_duration");
            const data_delay = this.getElementSettings("text_delay");
            const stagger_value = this.getElementSettings("text_stagger");
            const onscroll_value = this.getElementSettings("text_on_scroll");
            const rotation_di = this.getElementSettings("text_rotation_di");
            const rotation_value = this.getElementSettings("text_rotation");
            const transformOrigin = this.getElementSettings(
              "text_transform_origin"
            );
            let onScrollOptions = {};

            const length = this.findElement(
              ".elementor-widget-container"
            ).children().length;
            let element = $(
              this.findElement(".elementor-widget-container").children()[
                length - 1
              ]
            );

            if (element.hasClass("wcf--text") && element.children().length) {
              element = element.children();
            }

            let config = {
              duration: duration_value,
              delay: data_delay,
              opacity: 0,
              force3D: true,
              transformOrigin: transformOrigin,
              stagger: stagger_value,
            };

            if ("x" === rotation_di) {
              config.rotationX = rotation_value;
            }

            if ("y" === rotation_di) {
              config.rotationY = rotation_value;
            }

            if (onscroll_value) {
              onScrollOptions.scrollTrigger = {
                trigger: element,
                duration: 2,
                start: "top 90%",
                end: "bottom 60%",
                scrub: false,
                markers: false,
                toggleActions: "play none none none",
              };
            }

            if ("all" === match_media_key) {
              const tl = gsap.timeline(onScrollOptions);
              const itemSplitted = new SplitText(element, {
                type: "lines",
              });

              gsap.set(element, {
                perspective: 400,
              });

              itemSplitted.split({
                type: "lines",
              });

              tl.from(itemSplitted.lines, config);
            } else {
              gsap_mm.add(`(${match_media_key})`, () => {
                const tl = gsap.timeline(onScrollOptions);
                const itemSplitted = new SplitText(element, {
                  type: "lines",
                });

                gsap.set(element, {
                  perspective: 400,
                });

                itemSplitted.split({
                  type: "lines",
                });

                tl.from(itemSplitted.lines, config);

                return () => {
                  // optional
                  // custom cleanup code here (runs when it STOPS matching)
                  itemSplitted.revert();
                  tl.revert();
                };
              });
            }
          }

          //text-reveal-animation
          if ("text_reveal" === this.getElementSettings("wcf_text_animation")) {
            const duration_value = this.getElementSettings("text_duration");
            const onscroll_value = this.getElementSettings("text_on_scroll");
            const stagger_value = this.getElementSettings("text_stagger");
            const data_delay = this.getElementSettings("text_delay");

            const length = this.findElement(
              ".elementor-widget-container"
            ).children().length;
            const element = $(
              this.findElement(".elementor-widget-container").children()[
                length - 1
              ]
            );

            let split = new SplitText(element, {
              type: "lines,words,chars",
              linesClass: "anim-reveal-line",
            });

            const config = {
              duration: duration_value,
              delay: data_delay,
              ease: "circ.out",
              y: 80,
              stagger: stagger_value,
              opacity: 0,
            };

            if (onscroll_value) {
              config.scrollTrigger = {
                trigger: element,
                start: "top 85%",
              };
            }

            if ("all" === match_media_key) {
              gsap.from(split.chars, config);
            } else {
              gsap_mm.add(`(${match_media_key})`, () => {
                gsap.from(split.chars, config);

                return () => {
                  // optional
                  // custom cleanup code here (runs when it STOPS matching)
                  split.revert();
                };
              });
            }
          }

          // Text Invert With Scroll
          if ("text_invert" === this.getElementSettings("wcf_text_animation")) {
            const RGBToHSL = (r, g, b) => {
              r /= 255;
              g /= 255;
              b /= 255;
              const l = Math.max(r, g, b);
              const s = l - Math.min(r, g, b);
              const h = s
                ? l === r
                  ? (g - b) / s
                  : l === g
                  ? 2 + (b - r) / s
                  : 4 + (r - g) / s
                : 0;
              return [
                60 * h < 0 ? 60 * h + 360 : 60 * h,
                100 *
                  (s
                    ? l <= 0.5
                      ? s / (2 * l - s)
                      : s / (2 - (2 * l - s))
                    : 0),
                (100 * (2 * l - s)) / 2,
              ];
            };

            const length = this.findElement(
              ".elementor-widget-container"
            ).children().length;
            const element = $(
              this.findElement(".elementor-widget-container").children()[
                length - 1
              ]
            );
            let color = element.css("color");

            color = color.toString();
            color = color.match(/(\d+)/g);
            color = RGBToHSL(color[0], color[1], color[2]);
            color = `${color[0].toFixed(1)}, ${color[1].toFixed(
              1
            )}%, ${color[2].toFixed(1)}%`;
            element.css("--text-color", color);

            if ("all" === match_media_key) {
              const split = new SplitText(element, {
                type: "lines",
                linesClass: "invert-line",
              });
              split.lines.forEach((target) => {
                gsap.to(target, {
                  backgroundPositionX: 0,
                  ease: "none",
                  scrollTrigger: {
                    trigger: target,
                    scrub: 1,
                    start: "top 85%",
                    end: "bottom center",
                  },
                });
              });
            } else {
              gsap_mm.add(`(${match_media_key})`, () => {
                const split = new SplitText(element, {
                  type: "lines",
                  linesClass: "invert-line",
                });

                split.lines.forEach((target) => {
                  gsap.to(target, {
                    backgroundPositionX: 0,
                    ease: "none",
                    scrollTrigger: {
                      trigger: target,
                      scrub: 1,
                      start: "top 85%",
                      end: "bottom center",
                    },
                  });
                });

                return () => {
                  // optional
                  // custom cleanup code here (runs when it STOPS matching)
                  split.revert();
                };
              });
            }
          }

          // Spin Text
          if ("text_spin" === this.getElementSettings("wcf_text_animation")) {
            const initHeaders = () => {
              const onscroll_value = this.getElementSettings("text_on_scroll");
              const length = this.findElement(
                ".elementor-widget-container"
              ).children().length;
              let original = $(
                this.findElement(".elementor-widget-container").children()[
                  length - 1
                ]
              );
              let clone = original[0].cloneNode(true);
              $(clone).addClass("duplicate-text");
              original.css({ perspective: "600px", "white-space": "nowrap" });
              $(clone).css({ perspective: "600px", "white-space": "nowrap" });
              const obj = this.findElement(".elementor-widget-container")[0];

              original.after(clone);
              gsap.set(clone, { yPercent: -100 });

              obj.originalSplit = SplitText.create(original, { type: "chars" });
              obj.cloneSplit = SplitText.create(clone, { type: "chars" });

              if (!onscroll_value) {
                createHeaderAnimation(obj);
                return;
              }

              const defaults = {
                trigger: this.$element,
                animation: createHeaderAnimation(obj),
                invalidateOnRefresh: true,
              };

              let config = {
                start: this.getElementSettings("spin_text_start"),
                end: this.getElementSettings("spin_text_end"),
                scrub: this.getElementSettings("spin_text_scrub") === "yes",
                toggleActions: this.getElementSettings(
                  "spin_text_toggle_action"
                ),
              };

              config = Object.assign({}, defaults, config);

              ScrollTrigger.create(config);
            };

            const createHeaderAnimation = (header) => {
              let duration = 0.4;
              let delay = this.getElementSettings("text_delay");
              let stagger = { each: 0.03, ease: "power1", from: "start" };
              gsap.set(header.cloneSplit.chars, { opacity: 0 });

              let tl = gsap.timeline();
              tl.set(header.cloneSplit.chars, {
                rotationX: -90,
                transformOrigin: () => {
                  let height = header.offsetHeight;
                  return `50% 50% -${height / 2}`;
                },
              });

              tl.to(header.originalSplit.chars, {
                delay: delay,
                duration: duration,
                rotationX: 90,
                transformOrigin: () => {
                  let height = header.offsetHeight;
                  return `50% 50% -${height / 2}`;
                },
                stagger: stagger,
              });

              tl.to(
                header.originalSplit.chars,
                {
                  duration: duration,
                  delay: delay,
                  opacity: 0,
                  stagger: stagger,
                  ease: "power2.in",
                },
                0
              );

              tl.to(
                header.cloneSplit.chars,
                {
                  duration: 0.001,
                  delay: delay,
                  opacity: 1,
                  stagger: stagger,
                },
                0.001
              );
              tl.to(
                header.cloneSplit.chars,
                {
                  duration: duration,
                  delay: delay,
                  rotationX: 0,
                  stagger: stagger,
                },
                0
              );
              return tl;
            };

            if ("all" === match_media_key) {
              initHeaders();
            } else {
              gsap_mm.add(`(${match_media_key})`, () => {
                initHeaders();
              });
            }
          }
        },

        image_animation: function image_animation() {
          if (
            this.isEdit &&
            !this.getElementSettings("wcf_img_animation_editor")
          ) {
            return;
          }

          if ("reveal" === this.getElementSettings("wcf-image-animation")) {
            let wrap = this.findElement("img").parent();
            const element = this.$element;
            this.findElement("img").parent().parent().css("overflow", "hidden");
            wrap.css({
              overflow: "hidden",
              display: "block",
              visibility: "hidden",
              transition: "none",
            });

            let ease = this.getElementSettings("image-ease");
            let image_hover_effect = false;
            let image_hover_class = [
              "effect-zoom-in",
              "effect-zoom-out",
              "left-move",
              "right-move",
            ];
            let image_hover_effect_class = "";
            $.each(image_hover_class, function (index, value) {
              if (element.hasClass(`wcf--image-${value}`)) {
                image_hover_effect = true;
                image_hover_effect_class = `wcf--image-${value}`;
                element.removeClass(image_hover_effect_class);
              }
            });

            wrap.each(function () {
              let image = $(this).find("img");
              let tl = gsap.timeline({
                scrollTrigger: {
                  trigger: $(this),
                  start: "top 50%",
                },
              });

              tl.set($(this), { autoAlpha: 1 });
              tl.from($(this), 1.5, {
                xPercent: -100,
                ease: ease,
                onComplete: function () {
                  if (image_hover_effect) {
                    element.addClass(image_hover_effect_class);
                    image_hover_effect = false;
                  }
                },
              });
              tl.from(image, 1.5, {
                xPercent: 100,
                scale: 1.3,
                delay: -1.5,
                ease: ease,
              });
            });
          }

          if ("scale" === this.getElementSettings("wcf-image-animation")) {
            let image = this.findElement("img");

            let start = this.getElementSettings("wcf-animation-start");

            if ("custom" === this.getElementSettings("wcf-animation-start")) {
              start = this.getElementSettings("wcf_animation_custom_start");
            }

            gsap.set(image, {
              scale: this.getElementSettings("wcf-scale-start"),
            });

            gsap.to(image, {
              scrollTrigger: {
                trigger: this.$element,
                start: start,
                scrub: true,
              },
              scale: this.getElementSettings("wcf-scale-end"),
              ease: this.getElementSettings("image-ease"),
            });

            image.parent().css("overflow", "hidden");
          }

          if ("stretch" === this.getElementSettings("wcf-image-animation")) {
            let image = this.findElement("img");
            let wrap = this.findElement("img").parent();
            wrap.css("padding-bottom", "395px");

            let imageStretch = gsap.timeline({
              scrollTrigger: {
                trigger: wrap,
                start: "top top",
                pin: true,
                scrub: 1,
                pinSpacing: false,
                end: "bottom bottom+=100",
              },
            });
            imageStretch.to(image, {
              width: "100%",
              borderRadius: "0px",
            });

            wrap.css("transition", "none");
          }
        },

        fade_animation: function fade_animation() {
          if ("none" === this.getElementSettings("wcf-animation")) {
            return;
          }

          if (
            this.isEdit &&
            !this.getElementSettings("wcf_enable_animation_editor")
          ) {
            return;
          }

          const fade_direction = this.getElementSettings("fade-from");
          const onscroll_value = this.getElementSettings("on-scroll");
          const duration_value = this.getElementSettings("data-duration");
          const fade_offset = this.getElementSettings("fade-offset");
          const delay_value = this.getElementSettings("delay");
          const ease_value = this.getElementSettings("ease");
          let match_media_key = "all";

          this.$element.css("transition", "none");

          //if has min max key
          if (this.getElementSettings("fade_animation_breakpoint")) {
            const breakpoint =
              elementorBreakpoints[
                this.getElementSettings("fade_animation_breakpoint")
              ].value;

            if ("min" === this.getElementSettings("fade_breakpoint_min_max")) {
              match_media_key = "min-width: " + breakpoint + "px";
            } else {
              match_media_key = "max-width: " + breakpoint + "px";
            }
          }

          let config = {
            opacity: 0,
            ease: ease_value,
            duration: duration_value,
            delay: delay_value,
          };

          if ("fade" === this.getElementSettings("wcf-animation")) {
            if ("top" === fade_direction) {
              config.y = -fade_offset;
            }

            if ("bottom" === fade_direction) {
              config.y = fade_offset;
            }

            if ("left" === fade_direction) {
              config.x = -fade_offset;
            }

            if ("right" === fade_direction) {
              config.x = fade_offset;
            }

            if ("scale" === fade_direction) {
              config.scale = this.getElementSettings("wcf-a-scale");
            }
          }

          if ("move" === this.getElementSettings("wcf-animation")) {
            const rotation_di = this.getElementSettings("wcf_a_rotation_di");
            const transformOrigin = this.getElementSettings(
              "wcf_a_transform_origin"
            );
            const rotation = this.getElementSettings("wcf_a_rotation");
            config.force3D = true;
            config.transformOrigin = transformOrigin;

            if ("x" === rotation_di) {
              config.rotationX = rotation;
            }

            if ("y" === rotation_di) {
              config.rotationY = rotation;
            }

            gsap.set(this.$element.parent(), {
              perspective: 400,
            });
          }

          if (onscroll_value) {
            config.scrollTrigger = {
              trigger: this.$element,
              start: "top 85%",
            };
          }

          if ("all" === match_media_key) {
            gsap.from(this.$element, config);
          } else {
            gsap_mm.add(`(${match_media_key})`, () => {
              gsap.from(this.$element, config);

              return () => {
                // optional
                // custom cleanup code here (runs when it STOPS matching)
              };
            });
          }
        },

        button_move_animation: function button_move_animation() {
          const btnWrap = this.findElement(".btn-wrapper");
          const btnCircle = this.findElement(".btn-item");
          if (btnWrap.length) {
            btnWrap.mousemove(function (e) {
              callParallax(e);
            });

            function callParallax(e) {
              parallaxIt(e, btnCircle, 80);
            }

            function parallaxIt(e, target, movement) {
              const relX = e.pageX - btnWrap.offset().left;
              const relY = e.pageY - btnWrap.offset().top;
              gsap.to(target, 0.5, {
                x: ((relX - btnWrap.width() / 2) / btnWrap.width()) * movement,
                y:
                  ((relY - btnWrap.height() / 2) / btnWrap.height()) * movement,
                ease: Power2.easeOut,
              });
            }

            btnWrap.mouseleave(function (e) {
              gsap.to(btnCircle, 0.5, {
                x: 0,
                y: 0,
                ease: Power2.easeOut,
              });
            });
          }

          // Button Hover Animation
          const btn_hover_all = this.findElement(".btn-hover-bgchange");
          if (btn_hover_all.length) {
            const newSpan = document.createElement("span");
            btn_hover_all.append(newSpan);
            btn_hover_all.on("mouseenter", function (e) {
              var x = e.pageX - $(this).offset().left;
              var y = e.pageY - $(this).offset().top;

              $(this).find("span").css({
                top: y,
                left: x,
              });
            });
            btn_hover_all.on("mouseout", function (e) {
              var x = e.pageX - $(this).offset().left;
              var y = e.pageY - $(this).offset().top;
              $(this).find("span").css({
                top: y,
                left: x,
              });
            });
          }
        },
      });

      elementorFrontend.hooks.addAction(
        "frontend/element_ready/widget",
        function ($scope) {
          elementorFrontend.elementsHandler.addHandler(Animation, {
            $element: $scope,
          });
        }
      );

      elementorFrontend.hooks.addAction(
        "frontend/element_ready/container",
        function ($scope) {
          elementorFrontend.elementsHandler.addHandler(Animation, {
            $element: $scope,
          });
        }
      );

      const PingArea = Modules.extend({
        bindEvents: function bindEvents() {
          if (this.isEdit) {
            return;
          }

          if ("yes" !== this.getElementSettings("wcf_enable_pin_area")) {
            return;
          }

          if (this.getElementSettings("wcf_pin_breakpoint")) {
            if (
              device_width >
              elementorBreakpoints[
                this.getElementSettings("wcf_pin_breakpoint")
              ].value
            ) {
              this.run();
            }
          } else {
            this.run();
          }
        },

        run: function run() {
          let pin_area = this.$element;
          let pin_area_start = this.getElementSettings("wcf_pin_area_start");
          let pin_area_end = this.getElementSettings("wcf_pin_area_end");
          let end_trigger = this.getElementSettings("wcf_pin_end_trigger");

          if ("custom" === pin_area_start) {
            pin_area_start = this.getElementSettings(
              "wcf_pin_area_start_custom"
            );
          }

          if ("custom" === pin_area_end) {
            pin_area_end = this.getElementSettings("wcf_pin_area_end_custom");
          }

          if (this.getElementSettings("wcf_custom_pin_area")) {
            pin_area = this.getElementSettings("wcf_custom_pin_area");
          }

          gsap.to(this.$element, {
            scrollTrigger: {
              trigger: pin_area,
              endTrigger: end_trigger,
              pin: this.$element,
              pinSpacing: false,
              start: pin_area_start,
              end: pin_area_end,
              delay: 0.5,
              markers: false,
            },
          });

          this.$element.css("transition", "none");
        },
      });

      elementorFrontend.hooks.addAction(
        "frontend/element_ready/container",
        function ($scope) {
          elementorFrontend.elementsHandler.addHandler(PingArea, {
            $element: $scope,
          });
        }
      );
    }

    const wcf_popup = Modules.extend({
      bindEvents: function bindEvents() {
        this.run();
      },

      run: function run() {
        if (this.getElementSettings("wcf_enable_popup")) {
          if (
            this.isEdit &&
            !this.getElementSettings("wcf_enable_popup_editor")
          ) {
          }
          //open the popup
          this.$element.on("click", (e) => {
            e.preventDefault();
            if (
              this.isEdit &&
              !this.getElementSettings("wcf_enable_popup_editor")
            ) {
              return;
            }
            this.ajax_call();
          });
        }
      },

      ajax_call: function ajax_call() {
        let VideoAnimation = null;
        $.ajax({
          url: WCF_ADDONS_JS.ajaxUrl,
          data: {
            action: "wcf_load_popup_content",
            element_id: this.getID(),
            post_id: WCF_ADDONS_JS.post_id,
            nonce: WCF_ADDONS_JS._wpnonce,
          },
          dataType: "json",
          type: "POST",
          success: function (data) {
            if (
              !$("#wcf-aae-global--popup-js").find(
                ".aae-popup-content-container"
              ).length
            ) {
              $(`body > #wcf-aae-global--popup-js`)
                .find(".aae-popup-content-container")
                .html(`<div class="aae-popup-content"></div>`);
            }
            $("#wcf-aae-global--popup-js")
              .find(".aae-popup-content-container")
              .html(`${data.html}`);
            VideoAnimation = gsap
              .timeline({ defaults: { ease: "power2.inOut" } })
              .to(`#wcf-aae-global--popup-js`, {
                scaleY: 0.01,
                x: 1,
                opacity: 1,
                visibility: "visible",
                duration: 0.4,
              })
              .to(`#wcf-aae-global--popup-js`, {
                scaleY: 1,
                duration: 0.6,
              })
              .to(
                `#wcf-aae-global--popup-js .wcf--popup-video`,
                {
                  scaleY: 1,
                  opacity: 1,
                  visibility: "visible",
                  duration: 0.6,
                },
                "-=0.4"
              );
          },
        });

        $(document).on(
          "click",
          `#wcf-aae-global--popup-js .wcf--popup-close`,
          function () {
            if (VideoAnimation) {
              VideoAnimation.timeScale(1.6).reverse();
            }
            VideoAnimation = null;
          }
        );
      },
    });

    elementorFrontend.hooks.addAction(
      "frontend/element_ready/container",
      function ($scope) {
        elementorFrontend.elementsHandler.addHandler(wcf_popup, {
          $element: $scope,
        });
      }
    );

    const video_mask = function ($scope) {
      $(".video--btn", $scope).on("click", function () {
        $scope.toggleClass("mask-open");
        $(".open-title", $scope).toggle();
        $(".close-title", $scope).toggle();
        const widget_id = $scope.data("id");

        $scope
          .closest(".wcf-video-mask-content")
          .toggleClass(`wcf-video-mask-content-${widget_id}`);

        $("video", $scope).each(function () {
          if (this.autoplay) {
            return;
          }

          if (this.paused) {
            this.play();
          } else {
            this.pause();
          }
        });
      });
    };

    elementorFrontend.hooks.addAction(
      `frontend/element_ready/wcf--video-mask.default`,
      video_mask
    );

    const video_popup = function ($currentEle) {
     
      let popup_content = $(`.wcf--popup-video-wrapper`).first();
      if (!popup_content.parent().is("body")) {
        if (!$("body > .wcf--popup-video-wrapper").length) {
          popup_content.appendTo("body");
        }
      }
      $currentEle.find(".wcf--popup-video-wrapper").remove();

                const open_popup = $currentEle.find('.wcf-popup-btn');                
                // Open popup animation
                open_popup.off('click').on('click', function () {
                    const $url = $(this).attr('data-src');
                    $(`.wcf--popup-video-wrapper`).find('.aae-popup-content-container').html('');


                    if(!popup_content.find('iframe').length){
                        $( `body > .wcf--popup-video-wrapper`).find('.aae-popup-content-container').html(`<iframe src="${$url}" ></iframe>`);
                    }
                    window.VideoAnimation = gsap.timeline({ defaults: { ease: "power2.inOut" } })
                        .to(`.wcf--popup-video-wrapper`, {
                            scaleY: 0.01,
                            x: 1,
                            opacity: 1,
                            visibility: 'visible',
                            duration: 0.4
                        })
                        .to(`.wcf--popup-video-wrapper`, {
                            scaleY: 1,
                            duration: 0.6
                        })
                        .to(`.wcf--popup-video-wrapper .wcf--popup-video`, {
                            scaleY: 1,
                            opacity: 1,
                            visibility: 'visible',
                            duration: 0.6
                        }, "-=0.4");
                });
        };


        // Close popup animation (close button)
        $(document).on('click', `.wcf--popup-video-wrapper .wcf--popup-close`, function () {
            close_video(VideoAnimation);
            window.VideoAnimation = null;
        });

        const close_video = function (VideoAnimation) {
            if (VideoAnimation) {
                window.VideoAnimation.timeScale(1.6).reverse();
            }
        };


        // Video Box
        const video_box = function ($currentEle) {

            const video_box_video = $('.thumb video', $currentEle);
            if (video_box_video.length) {
                $('.wcf--video-box', $currentEle).hover(function () {
                    video_box_video.get(0).play();
                }, function () {
                    video_box_video.get(0).pause();
                    video_box_video.get(0).currentTime = 0;
                });
            }
        };



        let video_widgets = [
            'video-box',
            'video-box-slider',
        ];

    for (const widget of video_widgets) {
      elementorFrontend.hooks.addAction(
        `frontend/element_ready/wcf--${widget}.default`,
        video_box
      );
    }

    elementorFrontend.hooks.addAction(
      `frontend/element_ready/wcf--video-popup.default`,
      video_popup
    );
    elementorFrontend.hooks.addAction(
      `frontend/element_ready/wcf--video-box.default`,
      video_popup
    );
    elementorFrontend.hooks.addAction(
      `frontend/element_ready/wcf--video-box-slider.default`,
      video_popup
    );
  });
})(jQuery);

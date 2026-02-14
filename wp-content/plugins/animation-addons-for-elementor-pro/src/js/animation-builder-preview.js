(function (wcfWindow) {
  "use strict";

  const wcfAnimBPreview = (function () {
    let config = {};
    const scrollTriggerInstance = [];
    let hoverEnabled = false;

    function getFullSelector(element) {
      const path = [];
      let depth = 0; // Track depth
      let idCount = 0; // Track the number of IDs in the selector

      while (element && element.tagName.toLowerCase() !== "html" && depth < 3) {
        let selector = getUniqueSelector(element);

        // Check if the current element has an ID
        if (element.id) {
          idCount++;
          // Stop adding IDs if the limit is reached
          if (idCount > 2) {
            break;
          }
        }

        path.unshift(selector);
        element = element.parentElement;
        depth++; // Increment depth
      }

      return path.join(" > ");
    }

    function getUniqueSelector(element) {
      const tag = element.tagName.toLowerCase();

      // Add ID if available
      if (element.id) {
        return `${tag}#${element.id}`; // Only tag and ID, skip classes
      }

      // Add class names, excluding the hover-highlight class
      const classList = Array.from(element.classList).filter(
        (cls) => cls !== "wcf-animb--hover-highlight"
      );

      if (classList.length > 0) {
        return `${tag}.${classList.join(".")}`; // Concatenated classes if no ID
      }

      return tag; // Return only tag if no ID or classes
    }

    function extractLastSelector(selector) {
      if (selector === undefined) {
        return { full: "", tag: "", classes: false, id: "" };
      }
      // Regular expression to match selectors based on common delimiters
      const lastPart = selector
        .trim()
        .split(/[\s>+~]+/) // Split by spaces, >, +, or ~
        .pop() // Get the last element in the array
        .trim();

      // Extract the tag (if any) and classes (if any)
      const tag = lastPart.split(".")[0].split("#")[0]; // Takes the first part before classes or IDs
      const classes = lastPart
        .split(".")
        .slice(1) // Remove the tag name
        .join("."); // Join classes back
      const id = lastPart.split("#")[1]; // Extract the ID if present

      return { full: lastPart, tag, classes, id };
    }

    function resetAnimations(config) {
      gsap.globalTimeline.clear(); // Clears all animations

      config.animation.forEach((section) => {
        section.animations.forEach((animation) => {
          const selector = extractLastSelector(
            animation.applyAnimation.className
          );
          if (selector?.full && selector.full != "") {
            gsap.set(selector.full, { clearProps: "all" });
          }
        });
      });

      ScrollTrigger.getAll().forEach((st) => st.kill());
      ScrollTrigger.killAll();
      gsap.globalTimeline.clear();
    }

    function generateAnimations(config) {
      hidePopup();
      resetAnimations(config);
      config.animation.forEach((section) => {
        const timelines = {};
        const scrollConfig = section.scrollTrigger;
        section.timelines.forEach((timeline) => {
          const config = timeline.properties.reduce((acc, prop) => {
            if (!prop.isError) {
              acc[prop.name] = prop.unit
                ? `${prop.value}${prop.unit}`
                : prop.value;
            }
            return acc;
          }, {});
          timelines[timeline.title] = gsap.timeline(config);
        });

        section.animations.forEach((animation) => {
          const timeline = timelines[animation.timeline];
          if (
            animation.applyAnimation.className &&
            animation.applyAnimation.className !== ""
          ) {
            if (document.querySelector(animation.applyAnimation.className)) {
                const properties = animation.properties.reduce((acc, prop) => {
                  if(prop.type==='custom'){
                    const ccustomArr = prop.value.split(',');
                    if(ccustomArr.length){
                      ccustomArr.forEach((cItem) => {
                        if(cItem !=''){
                          const SplcItem = cItem.split(':');
                          if(SplcItem.length > 1){
                            acc[SplcItem[0].trim()] = SplcItem[1].trim();    
                          }                                                       
                        }
                      });
                    }
                 }else{
                  if (!prop.isError) {
                    acc[prop.name] = prop.unit
                      ? `${prop.value}${prop.unit}`
                      : prop.value;
                  }
                 }
                return acc;
              }, {});
              const method = animation.method || "to";
              if (method && animation.method == "fromTo") {
                timeline[method](
                  animation.applyAnimation.className,
                  { x: -100 },
                  properties
                ); // need from propeties , change in ui
              } else {
                if(animation.absoluteTime !=''){
                  timeline[method](animation.applyAnimation.className, properties, animation.absoluteTime);
                }else{
                  timeline[method](animation.applyAnimation.className, properties);
                }
              }
            } else {
              console.warn(
                `Target not found for animation: ${animation.title}`
              );
            }
          }
        });

        // Scroll Trigger
        if (scrollConfig?.enable && scrollConfig.enable) {
          const scrolTime = timelines[scrollConfig.timeline];
          if (scrolTime && ScrollTrigger) {
            const final_scroll_configs = {
              animation: scrolTime,
              trigger: scrollConfig.trigger,
              endTrigger: scrollConfig.endTrigger,
              start: scrollConfig.start,
              end: scrollConfig.end,
              scrub: scrollConfig.scrub === "true",
              markers: scrollConfig.markers === "true", // Enable markers dynamically
            };

            if (scrollConfig.pin === "true") {
              final_scroll_configs.pin = scrollConfig.pin === "true";
              final_scroll_configs.pinSpacing =
                scrollConfig.pinSpacing === "true";
              const extraprops = extractNameAndValue(scrollConfig.properties);
              extraprops.forEach((pinprop) => {
                if (pinprop.name === "markers") {
                  final_scroll_configs.markers = pinprop.value;
                }
                if (pinprop.name === "anticipate pin") {
                  final_scroll_configs.pinAnticipate =
                    parseInt(pinprop.value, 10) || 0;
                }
                if (pinprop.name === "pinned container") {
                  final_scroll_configs.pinContainer = pinprop.value || null;
                }
                if (pinprop.name === "pin type") {
                  final_scroll_configs.pinType = pinprop.value || "fixed";
                }
              });
            }

            ScrollTrigger.create(final_scroll_configs);
            ScrollTrigger.refresh(); // Ensure everything recalculates
          }
        }
      });
    }

    function extractNameAndValue(data) {
      return data.map((item) => ({
        name: item.name,
        value: item.value,
      }));
    }

    // Show the popup near the clicked element
    function showPopup(selector, x, y) {
      const popup = document.getElementById("wcfanim-selectorPopup");
      const content = document.getElementById("wcfanim-popupContent");

      // Set the content of the popup (for example, display the selector string)
      content.textContent = selector;

      // Get the width and height of the popup and its content
      const popupWidth = popup.offsetWidth;
      const popupHeight = popup.offsetHeight;
      const contentWidth = content.offsetWidth;
      const contentHeight = content.offsetHeight;

      // Get the current viewport size
      const viewportWidth = window.innerWidth;
      const viewportHeight = window.innerHeight;

      // Adjust the x-coordinate if the popup is too wide for the screen
      if (x + popupWidth > viewportWidth) {
        x = viewportWidth - popupWidth - 10; // Keep it 10px away from the right edge
      }

      // Adjust the y-coordinate if the popup is too tall for the screen
      if (y + popupHeight > viewportHeight) {
        y = viewportHeight - popupHeight - 10; // Keep it 10px away from the bottom edge
      }

      // Position the popup
      popup.style.left = `${x}px`;
      popup.style.top = `${y}px`;

      // Show the popup
      popup.style.display = "block";
    }

    // Hide the popup
    function hidePopup() {
      const popup = document.getElementById("wcfanim-selectorPopup");
      popup.style.display = "none";
    }

    function handleMouseOver(event) {
      const target = event.target;

      if (target.classList.contains("wcfanimb-skip-selector")) {
        return;
      }

      target.classList.add("wcf-animb--hover-highlight");
      target.addEventListener(
        "mouseleave",
        () => {
          target.classList.remove("wcf-animb--hover-highlight");
        },
        { once: true }
      );
    }

    function enableHover() {
      if (!hoverEnabled) {
        document.body.addEventListener("mouseover", handleMouseOver);
        hoverEnabled = true;
      }
    }

    function disableHover() {
      if (hoverEnabled) {
        document.body.removeEventListener("mouseover", handleMouseOver);
        hoverEnabled = false;
      }
    }

    return {
      // Get the current configuration
      getConfig: function (key) {
        return key ? config[key] : { ...config }; // Return specific key or full config
      },

      // Set a single configuration or multiple configurations
      setConfig: function (key, value) {
        if (typeof key === "object") {
          // Update multiple configurations
          Object.assign(config, key);
        } else {
          // Update a single configuration
          config[key] = value;
        }
      },

      // Show a message using the current configurations
      playAnimation: function () {
        generateAnimations(config);
      },

      sendPageConfig: function () {
        window.addEventListener(
          "message",
          (event) => {
            if ("wcf-animation-config" in event.data) {
              disableHover();
              wcfAnimBPreview.setConfig(
                "animation",
                event.data["wcf-animation-config"]
              ); // Update multiple configs
              wcfAnimBPreview.playAnimation();
            }
          },
          false
        );

        setTimeout(() => {
          window.parent.postMessage(wcf_anim_preview_object);
        }, 1000);
      },

      enableHoverSelector: function () {
        enableHover();
      },

      disableHoverSelector: function () {
        disableHover();
      },

      fallbackCopyTextToClipboard: function (text) {
        var textArea = document.createElement("textarea");
        textArea.value = text;

        // Avoid scrolling to bottom
        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.position = "fixed";

        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
          var successful = document.execCommand("copy");
          var msg = successful ? "successful" : "unsuccessful";
          console.log("Fallback: Copying text command was " + msg);
        } catch (err) {
          console.error("Fallback: Oops, unable to copy", err);
        }

        document.body.removeChild(textArea);
      },

      runPopup: function () {
        const closeBtn = document.querySelector(".wcfanimb-close-btn");
        const selectorContent = document.getElementById("wcfanim-popupContent");

        closeBtn.addEventListener("click", () => {
          hidePopup();
          disableHover();
        });

        document
          .getElementById("wcfanim-expendSelector")
          .addEventListener("click", (e) => {
            selectorContent.classList.toggle("close");
           
            if (selectorContent.classList.contains("close")) {
              document.getElementById("wcfanim-expendSelector").textContent =
                "Expand";
            } else {
              document.getElementById("wcfanim-expendSelector").textContent =
                "Shrink";
            }
          });

        document.body.addEventListener("click", (event) => {
          event.preventDefault();
          const target = event.target;
          const selector = getFullSelector(target);
          // Show the popup at the click location
          enableHover();

          const isSkip = target.classList.contains("wcfanimb-skip-selector");

          if (!isSkip) {
            showPopup(selector, event.clientX + 10, event.clientY + 10);
          }
        });

       

        document
          .getElementById("wcfanim-copySelector")
          .addEventListener("click", () => {
            const textElement = document.getElementById("wcfanim-popupContent");
            const textToCopy = textElement.textContent;

            // Use navigator.clipboard if available
            if (navigator.clipboard && window.isSecureContext) {
              // Modern API for copying
              navigator.clipboard
                .writeText(textToCopy)
                .then(() => {
                  disableHover();
                  hidePopup();
                })
                .catch((err) => {
                  console.error("Failed to copy text: ", err);
                });
            } else {
              // Fallback to manual method for older browsers
              const tempTextarea = document.createElement("textarea");
              tempTextarea.value = textToCopy;

              // Style the textarea to be offscreen
              tempTextarea.style.position = "fixed";
              tempTextarea.style.top = "-9999px";
              document.body.appendChild(tempTextarea);

              // Select the text inside the textarea
              tempTextarea.focus();
              tempTextarea.select();

              try {
                if (document.execCommand("copy")) {
                  disableHover();
                  hidePopup();
                }
              } catch (err) {
                console.error("Error copying text: ", err);
              }

              // Clean up by removing the temporary textarea
              document.body.removeChild(tempTextarea);
            }
          });
      },
    };
  })();

  wcfAnimBPreview.enableHoverSelector();
  wcfAnimBPreview.runPopup();
  wcfAnimBPreview.sendPageConfig();
})(window);

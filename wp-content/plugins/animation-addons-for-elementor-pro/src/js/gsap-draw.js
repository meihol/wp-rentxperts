(function () {

    const WgsapDrawSvg = function ($scope) {
       
        // Get the data attributes for animation control using native JavaScript
        const gsapElement = $scope[0].querySelector('.gsap-draw-svg');
  
        const scroll_trigger     = Boolean(gsapElement.getAttribute('data-scroll_trigger') || false);
        const method             = gsapElement.getAttribute('data-method') || 'fromTo';
        const draw_percent       = gsapElement.getAttribute('data-draw_percent') || '0%';
        const from               = gsapElement.getAttribute('data-from') || '0%';
        const to                 = gsapElement.getAttribute('data-to') || '100%';
        const duration           = parseFloat(gsapElement.getAttribute('data-duration')) || 1;
        const delay              = parseFloat(gsapElement.getAttribute('data-delay')) || 0;
        const repeat             = parseFloat(gsapElement.getAttribute('data-repeat')) || 0;
        const ease               = gsapElement.getAttribute('data-ease') || 'power2.inOut';
        const timeline_yoyo      = Boolean( gsapElement.getAttribute('data-timeline_yoyo') || false );
        const scrub              = Boolean( gsapElement.getAttribute('data-scrub') || false );
        const scrollTriggerStart = gsapElement.getAttribute('data-scrolltrigger-start') || 'top bottom';
        const scrollTriggerEnd   = gsapElement.getAttribute('data-scrolltrigger-end') || 'bottom top';
  
        const cls = `.elementor-element-${$scope[0].getAttribute('data-id')} svg path`;       
        // Ensure paths are available and correctly selected
        const paths = Array.from(document.querySelectorAll(cls));       
        if (paths.length === 0) {
            console.log("No paths found for animation!");
            return;
        } 
        
        if(!scroll_trigger){
          
            const tl = gsap.timeline({
                duration: duration,
                delay   : delay,
                repeat  : repeat,
                yoyo    : timeline_yoyo
            });
        
            paths.forEach((path, i) => {
            
                if( method === 'fromTo' ){                      
                    tl.fromTo(
                        path,
                        { drawSVG: from },   
                        { 
                            drawSVG : to,
                            duration: duration,
                            delay   : i * delay,
                            ease    : ease,                       
                        }
                    ); 
                    
                }else{
                   
                    tl[method](
                        path,               
                        { 
                            drawSVG : draw_percent,
                            duration: duration,
                            delay   : i * delay,
                            ease    : ease,
                        }
                    );
                }    
               
            });     
           
        }else{
            // Register GSAP plugin if not already registered
            if (!gsap.plugins.ScrollTrigger && ScrollTrigger) {
                gsap.registerPlugin(ScrollTrigger);
            }
            // Apply GSAP animation with ScrollTrigger
            paths.forEach((path, i) => {
                if (method === 'fromTo') {                    
                    gsap.fromTo(
                        path,
                        { drawSVG: from },
                        {
                            drawSVG: draw_percent,
                            duration: duration,
                            delay: delay + (i * 0.5), // stagger delay
                            ease: ease,
                            scrollTrigger: {
                                trigger: $scope,
                                start  : scrollTriggerStart,
                                end    : scrollTriggerEnd,
                                scrub  : scrub,
                            },
                            repeat: repeat, // Repeat the animation
                            yoyo: timeline_yoyo // No yoyo effect (reverse)
                        }
                    );
                } else if (method === 'from') {
                    
                    gsap.from(
                        path,
                        {
                            drawSVG: draw_percent,
                            duration: duration,
                            delay: delay + (i * 0.5), // stagger delay
                            ease: ease,
                            scrollTrigger: {
                                trigger: $scope,
                                start: scrollTriggerStart,
                                end: scrollTriggerEnd,
                                scrub: scrub,
                            },
                            repeat: repeat, // Repeat the animation
                            yoyo: timeline_yoyo // No yoyo effect (reverse)
                        }
                    );
                } 
            });
        }
     
        
    };

    // Wait for Elementor frontend to initialize
    window.addEventListener('elementor/frontend/init', function () {
        // Register the action for element ready hook
        elementorFrontend.hooks.addAction('frontend/element_ready/wcf-gsap-drawsvg.default', WgsapDrawSvg);
    });
})();

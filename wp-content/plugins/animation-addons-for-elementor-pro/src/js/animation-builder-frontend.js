(function (wcfWindow) {
  "use strict";  
  const wcfAnimB = (function () {        
    function generateAnimations(config) {    
      config.forEach((section) => {  
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
          
            if (animation.applyAnimation.className && animation.applyAnimation.className !== '')
              {
                  if(document.querySelector(animation.applyAnimation.className)){
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
                      if(method && animation.method == 'fromTo' ){ 
                        if(animation.absoluteTime !=''){
                          timeline[method](animation.applyAnimation.className, { x: -100 }, properties); // need from propeties , change in ui
                        }else{
                          timeline[method](animation.applyAnimation.className, { x: -100 }, properties, animation.absoluteTime); // need from propeties , change in ui
                        }
                       
                      }else{
                        if(animation.absoluteTime !=''){
                          timeline[method](animation.applyAnimation.className, properties, animation.absoluteTime);
                        }else{
                          timeline[method](animation.applyAnimation.className, properties);
                        }
                       
                      }                  
                  }else{
                  console.warn(`Target not found for animation: ${animation.title}`);
                }
              } 
              
          });    
          // Scroll Trigger    
          if(scrollConfig?.enable && scrollConfig.enable) {
             const scrolTime = timelines[scrollConfig.timeline];              
             if(scrolTime && ScrollTrigger) {
                
                  const final_scroll_configs = {
                      animation: scrolTime,
                      trigger: scrollConfig.trigger,
                      endTrigger: scrollConfig.endTrigger,
                      start: scrollConfig.start,
                      end: scrollConfig.end,
                      scrub: scrollConfig.scrub === "true",
                      markers: scrollConfig.markers === "true" // Enable markers dynamically
                  };
                  
                  if(scrollConfig.pin === "true"){
                  
                      final_scroll_configs.pin = scrollConfig.pin === "true";
                      final_scroll_configs.pinSpacing = scrollConfig.pinSpacing === "true";                        
                      const extraprops = extractNameAndValue(scrollConfig.properties);
                      extraprops.forEach((pinprop) => { 
                         if(pinprop.name === 'markers'){
                          final_scroll_configs.markers = pinprop.value;
                         }
                         if(pinprop.name === 'anticipate pin'){
                          final_scroll_configs.pinAnticipate = parseInt(pinprop.value , 10) || 0;
                         }
                         if(pinprop.name === 'pinned container'){
                          final_scroll_configs.pinContainer = pinprop.value || null;
                         }
                         if(pinprop.name === 'pin type'){
                          final_scroll_configs.pinType = pinprop.value || "fixed";
                         }
                      });    
                  }    
                  ScrollTrigger.create(final_scroll_configs);
             }
          }
      });
    }  
    
    function extractNameAndValue(data) {
        return data.map(item => ({
            name: item.name,
            value: item.value
        }));
    }

    return {      
      playAnimation: function () {       
        try {
          if(wcfanimb !==undefined && wcfanimb?.animation_config?.length && wcfanimb.animation_config.length){
            generateAnimations(wcfanimb.animation_config);   
          }
        }catch(err) { }                       
      }     
    };
  })();
  
  wcfAnimB.playAnimation();

})(window);

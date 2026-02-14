(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var ArolaxProgressBar = function ($scope, $) {
        let wrapper = $scope.find('.arolax_progressbar');
        let percentage = wrapper.attr('data-percentage');
        let animation = wrapper.attr('data-animation');
        let duration = wrapper.attr('data-duration') * 900;
        let number = wrapper.find('.number');
        let scroll_done = false;
        let animate_progress = function () {
            if ('once' === animation) {
                scroll_done = true; // if once animation
            }

            wrapper.css("--barWidth", percentage + '%');

            let current = 0,
                increment = 1,
                step = Math.abs(Math.floor(duration / percentage)),
                timer = setInterval(() => {
                    current += increment;
                    number.html(current);
                    if (current === parseInt(percentage)) {
                        clearInterval(timer);
                    }
                }, step);
        }

        var observer = new IntersectionObserver(function (entries) {
            if (entries[0].isIntersecting && !scroll_done) {
                animate_progress();
            } else {
                if (!scroll_done) {
                    wrapper.css("--barWidth", 0);
                }

            }
        });
        observer.observe(wrapper[0]);
    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/arolax--progressbar.default', ArolaxProgressBar);
    });
})(jQuery);
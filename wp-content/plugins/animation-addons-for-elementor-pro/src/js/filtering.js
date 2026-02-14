(function ($) {
    const AAE_Filtering = function ($scope, $) {

        const $buttons = $scope.find(".posts-filter li");
        const $items = $scope.find(".wcf-post");

        $buttons.on("click", function () {
            const filter = $(this).data("filter");
            $(this).addClass('active').siblings().removeClass('active');
            AAE_FilterItems(filter);
        });

        function AAE_FilterItems(filter) {
            const state = Flip.getState($items);

            $items.each(function () {
                const $item = $(this);
                console.log($items)
                if (filter === "all" || $item.hasClass(filter)) {
                    $item.css('display', 'inline-flex');
                } else {
                    $item.css('display', 'none');
                }
            });

            Flip.from(state, {
                duration: 0.5,
                ease: "power1.inOut",
                stagger: .1,
            });
        }
    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/wcf--posts-pro.default', AAE_Filtering);
    });

})(jQuery);
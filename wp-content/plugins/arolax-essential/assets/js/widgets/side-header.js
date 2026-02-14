/* global WCF_ADDONS_JS */
(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    const ArolaxSideHeader = function ($scope, $) {
        let menu_open = $('.menu--open', $scope);
        let menu_close = $('.menu--close', $scope);
        let side_header = $('.arolax--side-header', $scope);
        let menu_item = $('.menu-item', $scope);

        menu_open.on('click', function () {
            side_header.addClass('mobile');
        });

        menu_close.on('click', function () {
            side_header.removeClass('mobile');
        });


        // Dropdown Menu
        menu_item.each(function (index) {
            if ($(this).hasClass('menu-item-has-children')) {
                $(this).append('<span class="toggle"></span>')
            }

            let submenu = $(this).find('.sub-menu');

            $(this).find('.toggle').on('click', function () {
                $(this).toggleClass('open')
                submenu.slideToggle()
            })
        })


        //Close menu outside menu area click
        $(document).mouseup((e) => {
            if (!side_header.is(e.target) && side_header.has(e.target).length === 0) {
                side_header.removeClass('mobile');
            }
        })

    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/arolax--side-header.default', ArolaxSideHeader);
    });
})(jQuery);
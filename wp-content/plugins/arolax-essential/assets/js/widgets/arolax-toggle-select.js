( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */

    const ToggleSelect = function ($scope){
        const select = $("select",  $scope);
        let toggle_pane = $(".toggle-pane",  $scope);
        select.change(function () {
            toggle_pane.slideUp('slow');
           $(`[data-target="${$(this).val()}"]`, $scope).slideDown('slow');
        })
    }

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction(`frontend/element_ready/arolax-toggle-select.default`, ToggleSelect);
    });
} )( jQuery );
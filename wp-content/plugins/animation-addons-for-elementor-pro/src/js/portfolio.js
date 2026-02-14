/* global WCF_ADDONS_JS */
(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    const WcfPosts = function ($scope, $) {
        const $buttons = $scope.find(".wcf__portfolio .filter button");
        const $items = $scope.find(".enable-filter .wcf-post");

        $buttons.on("click", function () {
            const filter = $(this).data("filter");
            $(this).addClass('mixitup-control-active').siblings().removeClass('mixitup-control-active');
            portfolioFilterItems(filter);
        });

        function portfolioFilterItems(filter) {
            const state = Flip.getState($items.toArray());

            $items.each(function () {
                const $item = $(this);
                if (filter === "all" || $item.hasClass(filter)) {
                    $item.show();
                } else {
                    $item.hide();
                }
            });

            Flip.from(state, {
                duration: 0.5,
                ease: "power1.inOut",
                stagger: 0.1,
            });
        }

        //load more
        const loadMore = $('.pf-load-more a', $scope)
        const elementId = $('.load-more-anchor', $scope).data('e-id');
        let isLoading = false;
        let currentPage = $('.load-more-anchor', $scope).data('page');
        let maxPage = $('.load-more-anchor', $scope).data('max-page');

        loadMore.on('click', function (e) {
            e.preventDefault()

            if (currentPage < maxPage) {
                handlePostsQuery();
            }
        })

        const handlePostsQuery = function () {
            handleUiBeforeLoading();

            if (isLoading) {
                $('.wcf__btn', $scope).addClass('loading');
            }

            currentPage++;
            const nextPageUrl = $('.load-more-anchor', $scope).attr('data-next-page');
            return fetch(nextPageUrl).then(response => response.text()).then(html => {
                // Convert the HTML string into a document object
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                handleSuccessFetch(doc);
            });
        }

        const handleSuccessFetch = function (result) {
            handleUiAfterLoading();

            const postsElements = result.querySelectorAll(`[data-id="${elementId}"] .wcf-posts > article`);
            const nextPageUrl = result.querySelector(`[data-id="${elementId}"] .load-more-anchor`).getAttribute('data-next-page');

            postsElements.forEach(element => $(`[data-id="${elementId}"] .wcf-posts`).append(element));

            $('.load-more-anchor', $scope).attr('data-page', currentPage);
            $('.load-more-anchor', $scope).attr('data-next-page', nextPageUrl);

            if (!isLoading) {
                $('.wcf__btn', $scope).removeClass('loading');
            }

            if (currentPage === maxPage) {
                loadMore.hide();
            }

        }

        const handleUiBeforeLoading = function () {
            isLoading = true;
        }

        const handleUiAfterLoading = function () {
            isLoading = false;
        }

    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/wcf--portfolio.default', WcfPosts);
    });
})(jQuery);
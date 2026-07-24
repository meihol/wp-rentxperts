class BrandLogoTabsHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                tab: '.blt-8ac671e4-tab',
                card: '.blt-8ac671e4-logo-card'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $tabs: this.$element.find(selectors.tab),
            $cards: this.$element.find(selectors.card)
        };
    }

    bindEvents() {
        this.elements.$tabs.on('click', this.onTabClick.bind(this));
    }

    onTabClick(event) {
        event.preventDefault();
        const $clickedTab = jQuery(event.currentTarget);
        const tabId = $clickedTab.data('tab-id') ? $clickedTab.data('tab-id').toString().trim().toLowerCase() : '';

        // Toggle active tab class
        this.elements.$tabs.removeClass('blt-active');
        $clickedTab.addClass('blt-active');

        // Filter cards
        this.elements.$cards.each((index, card) => {
            const $card = jQuery(card);
            const cardCategoriesAttr = $card.attr('data-category') || '';
            
            // Split multiple space-separated categories
            const cardCategories = cardCategoriesAttr.toLowerCase().split(/\s+/);

            if (tabId === 'all' || !tabId || cardCategories.indexOf(tabId) !== -1) {
                $card.removeClass('blt-hide');
                // Trigger reflow/animation re-triggering if needed
                const el = $card[0];
                el.style.animation = 'none';
                el.offsetHeight; /* trigger reflow */
                el.style.animation = null;
            } else {
                $card.addClass('blt-hide');
            }
        });
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(BrandLogoTabsHandler, { $element });
    };
    elementorFrontend.hooks.addAction('frontend/element_ready/brand_logo_tabs_8ac671e4.default', addHandler);
});

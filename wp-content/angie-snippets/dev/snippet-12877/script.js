class RentXpertsInquiryButtonHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                button: '.rx-inquiry-btn-5f258409',
                template: '.rx-cf7-template-5f258409'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $button: this.$element.find(selectors.button),
            $template: this.$element.find(selectors.template)
        };
    }

    bindEvents() {
        // Use event delegation for improved stability in the Elementor Edit mode
        this.$element.on('click', '.rx-inquiry-btn-5f258409', (e) => {
            e.preventDefault();
            this.openPopup();
        });
    }

    openPopup() {
        // Fetch values from the clicked button elements
        const $clickedButton = this.$element.find('.rx-inquiry-btn-5f258409');
        const service = $clickedButton.data('service') || 'None';
        const templateHtml = this.elements.$template.html();

        if (!templateHtml) return;

        let $overlay = jQuery('.rx-popup-overlay-5f258409');

        // Create overlay single instance if not exists
        if ($overlay.length === 0) {
            $overlay = jQuery(`
                <div class="rx-popup-overlay-5f258409">
                    <div class="rx-popup-container-5f258409">
                        <button class="rx-popup-close-5f258409" aria-label="Close">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <div class="rx-popup-content-5f258409"></div>
                    </div>
                </div>
            `);
            jQuery('body').append($overlay);

            // Bind Global popup dismiss events once
            $overlay.on('click', (event) => {
                if (jQuery(event.target).is('.rx-popup-overlay-5f258409') || jQuery(event.target).closest('.rx-popup-close-5f258409').length) {
                    this.closePopup($overlay);
                }
            });

            jQuery(document).on('keydown', (event) => {
                if (event.key === 'Escape' && $overlay.hasClass('rx-active')) {
                    this.closePopup($overlay);
                }
            });
        }

        // Load correct form HTML
        const $content = $overlay.find('.rx-popup-content-5f258409');
        $content.html(templateHtml);

        // Pre-select CF7 service dropdown
        const $select = $content.find('select[name="services"]');
        if ($select.length > 0) {
            if (service !== 'None') {
                $select.val(service).trigger('change');
            } else {
                // Select first placeholder option if None
                $select.prop('selectedIndex', 0).trigger('change');
            }
        }

        // Initialize CF7 AJAX behavior on newly injected form if wpcf7 exists
        // FIX: Ensure window.wpcf7.init receives the actual HTMLFormElement instead of wrapper DIV
        if (window.wpcf7 && typeof window.wpcf7.initForm === 'function') {
            $content.find('.wpcf7-form').each(function() {
                window.wpcf7.initForm(jQuery(this));
            });
        } else if (window.wpcf7 && typeof window.wpcf7.init === 'function') {
            const formEl = $content.find('.wpcf7-form')[0] || $content.find('form')[0];
            if (formEl) {
                window.wpcf7.init(formEl);
            }
        }

        // Open animation
        setTimeout(() => {
            $overlay.addClass('rx-active');
            jQuery('body').css('overflow', 'hidden');
        }, 30);
    }

    closePopup($overlay) {
        $overlay.removeClass('rx-active');
        jQuery('body').css('overflow', '');
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(RentXpertsInquiryButtonHandler, { $element });
    };
    elementorFrontend.hooks.addAction('frontend/element_ready/rentxperts_inquiry_button_5f258409.default', addHandler);
});

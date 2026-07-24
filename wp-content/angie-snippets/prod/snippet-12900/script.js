(function($) {
    'use strict';

    $(document).ready(function() {
        const $modal = $('#rx-floating-modal-bd4ab031');
        const $trigger = $('.rx-floating-trigger-bd4ab031');
        const $close = $('.rx-modal-close-bd4ab031');
        const $overlay = $('.rx-modal-overlay-bd4ab031');

        if (!$modal.length || !$trigger.length) return;

        // Open modal
        $trigger.on('click', function(e) {
            e.preventDefault();
            
            $modal.addClass('rx-active-modal').attr('aria-hidden', 'false');
            $('body').css('overflow', 'hidden');

            // Force CF7 initialization on nested forms if they didn't bind on DOM load
            if (window.wpcf7 && typeof window.wpcf7.initForm === 'function') {
                $modal.find('.wpcf7-form').each(function() {
                    window.wpcf7.initForm($(this));
                });
            } else if (window.wpcf7 && typeof window.wpcf7.init === 'function') {
                const formEl = $modal.find('.wpcf7-form')[0] || $modal.find('form')[0];
                if (formEl) {
                    window.wpcf7.init(formEl);
                }
            }
        });

        // Close modal helper
        function closeModal() {
            $modal.removeClass('rx-active-modal').attr('aria-hidden', 'true');
            $('body').css('overflow', '');
        }

        // Close on trigger click / overlay click / close button click
        $close.on('click', closeModal);
        $overlay.on('click', closeModal);

        // Close on ESC key press
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $modal.hasClass('rx-active-modal')) {
                closeModal();
            }
        });
    });

})(jQuery);

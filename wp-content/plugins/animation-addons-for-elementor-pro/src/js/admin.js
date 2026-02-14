(function ($) {

  $(document).on('click', '#wcf-addon-pro-expire-notice .notice-dismiss', function(e){  
        $.ajax({
          type: 'POST',
          url: wcf_addons_pro_admin.ajax_url,
          data: {
              action          : "wcf_animation_addon_pro_tr_dismiss_notice",          
              nonce           : wcf_addons_pro_admin.nonce
          },
          cache: false,
          success: function(response) {
             
          }
      });
   
  });

})(jQuery);
/**
 * WCF Addons Editor Core
 * @version 1.0.0
 */

/* global jQuery, WCF_Addons_Editor*/

(function ($, window, document, config) {
    
    const forms_fields_ajax_request = function ($api, $list_id) {
        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: config.ajaxUrl,
            data: {
                action: "wcf_mailchimp_list_fields",
                nonce: config._wpnonce,
                api: $api,
                list_id: $list_id,
            },
            success: function (response) {
                console.log(response);                 
            }
        })
    }
    function MailpushOptions(data,  $mailchimp_lists){
        let newOption = new Option(AAE_MailChimp.text, AAE_MailChimp.id, false, false);
        $mailchimp_lists.append(newOption).trigger('change');
    }
    const ajax_request = function ($api, $mailchimp_lists) {
        
       if(window.AAE_MailChimp){
            MailpushOptions(window.AAE_MailChimp,  $mailchimp_lists);
        }
        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: config.ajaxUrl,
            data: {
                action: "mailchimp_api",
                nonce: config._wpnonce,
                api: $api,
            },
            success: function (response) {  
              
                const audience = $mailchimp_lists;
                if (Object.keys(response).length) {
                    const data = {
                        id: Object.keys(response),
                        text: Object.values(response)
                    };
                    window.AAE_MailChimp = data;
                    MailpushOptions(window.AAE_MailChimp,  $mailchimp_lists);
                } else {
                    audience.empty();
                }
            }
        })
    } 
    
    function attachMailchimpEvent(panel){
        const $mailchimp_lists = panel.$el.find('[data-setting="mailchimp_lists"]');  
        const $element = panel.$el.find('[data-setting="mailchimp_api"]');
        console.log($element);
        if ($element.val()) {
            ajax_request($element.val(), $mailchimp_lists);
        }
        
        $mailchimp_lists.on('change', function(){        
            if($mailchimp_lists.val() && $element.val()){
                forms_fields_ajax_request($element.val(),$mailchimp_lists.val())
            }
        });
      
        $element.on('keyup', function () {
            ajax_request($element.val(), $mailchimp_lists);
        });

    }
    
    elementor.channels.editor.on('wcf:editor:play_animation', (sectionName, panelView)=>{
        sectionName.$el.parent().find('.elementor-control-wcf_enable_animation_editor .elementor-switch-input').trigger('change');
        sectionName.$el.parent().find('.elementor-control-wcf_img_animation_editor .elementor-switch-input').trigger('change');
        sectionName.$el.parent().find('.elementor-control-wcf_text_animation_editor .elementor-switch-input').trigger('change');        
    });
    
    elementor.channels.editor.on('editor:widget:wcf--mailchimp:_section_mailchimp:activated', (panelView)=>{
        attachMailchimpEvent(panelView);        
    });
    
    elementor.channels.editor.on('editor:widget:aae--advanced-mailchimp:_section_mailchimp:activated', (panelView)=>{
        attachMailchimpEvent(panelView);
    });
    
    // dynamic tags 
    
    $(document).on('change', '[data-setting="taxonomy_type"]', function () {
        const taxonomy = $(this).val();
        const $categorySelect = $('[data-setting="category_id"]');

        if (!taxonomy) return;

        // Clear the category dropdown before loading
        $categorySelect.empty().append('<option value="">Loading...</option>');

        $.ajax({
            url: config.ajaxUrl,
            method: 'POST',
            data: {
                action: 'wcf_get_terms_by_taxonomy',
                nonce: config._wpnonce,
                taxonomy: taxonomy,
            },
            success: function (response) {
                $categorySelect.empty();

                if (response.success && response.data.length > 0) {
                    response.data.forEach(function (term) {
                        $categorySelect.append(
                            $('<option></option>').attr('value', term.id).text(term.name)
                        );
                    });
                } else {
                    $categorySelect.append('<option value="">No terms available</option>');
                }
            },
            error: function () {
                $categorySelect.empty().append('<option value="">Error loading terms</option>');
            },
        });
    });

})(jQuery, window, document, WCF_Addons_Editor);

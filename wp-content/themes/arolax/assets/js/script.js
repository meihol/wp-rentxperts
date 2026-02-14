/***************************************************
==================== JS INDEX ======================
****************************************************
01. Mobile menu Start
02. Preloader

****************************************************/

(function ($) {
  "use strict";

  // Using an object literal for a jQuery arolax Theme module
  var arolax_theme_module = {
    init: function (settings) {
      arolax_theme_module.config = {
        responsive_menu_width: 1199,
        header_menu: $('.lawyer-header__inner'),
        header: $(".default-blog-header"),
      };
      // Allow overriding the default config
      $.extend(arolax_theme_module.config, settings);
      arolax_theme_module.setup();
    },
    setup: function () {
      arolax_theme_module.offcanvas();
      arolax_theme_module.woo();
    },


    offcanvas: function () {
      // Get the offcanvas element and buttons
      const offcanvas = document.querySelector('.offcanvas__area');
      const openBtn = document.querySelector('.info-default-offcanvas');
      const closeBtn = document.querySelector('.offcanvas__close');

      // Function to open the offcanvas
      if (openBtn) {
        openBtn.addEventListener('click', () => {
          offcanvas.classList.add('show');
        });
      }

      // Function to close the offcanvas
      if (closeBtn) {
        closeBtn.addEventListener('click', () => {
          offcanvas.classList.remove('show');
        });
      }

      // Close offcanvas when clicking outside of it
      document.addEventListener('click', (event) => {
    
        if(offcanvas) {
          const isClickInside = offcanvas.contains(event.target) || openBtn.contains(event.target);
          if (!isClickInside) {
            offcanvas.classList.remove('show');
          }
        }
      });


      // Get all menu items with potential submenus
      const menuItems = document.querySelectorAll('.arolax-mb-menu-items li > a');

      // Loop through each menu item to add click event listener
      menuItems.forEach(menuItem => {
        const default_icon = menuItem.nextElementSibling;
        if (default_icon && default_icon.tagName === 'UL' && default_icon.classList.contains('dp-menu')) {
          menuItem.querySelector('.nav-direction-icon').setAttribute('data-icon', '+')



          menuItem.querySelector('.nav-direction-icon').addEventListener('click', function (e) {
            const submenu = this.parentElement.nextElementSibling; // Get the next sibling, which should be the submenu <ul>

            // Check if this next sibling is a submenu (<ul>)
            if (submenu && submenu.tagName === 'UL' && submenu.classList.contains('dp-menu')) {
              e.preventDefault(); // Prevent the default link behavior (navigating)

              // Toggle aria-expanded attribute for accessibility
              const expanded = submenu.getAttribute('aria-expanded') === 'true';
              submenu.setAttribute('aria-expanded', !expanded);

              // Toggle the display of the submenu (open/close)
              submenu.style.display = expanded ? 'none' : 'block';

              // Toggle + or - symbol
              if (expanded) {
                this.setAttribute('data-icon', '+');
              } else {
                this.setAttribute('data-icon', '-');
              }
            }
          });
        }
      });

      // Accessibility: Enable keyboard navigation
      document.querySelectorAll('.hello-animation-mb-menu-items a').forEach(link => {
        link.addEventListener('keydown', function (event) {
          if (event.key === 'ArrowDown') {
            event.preventDefault();
            let nextItem = event.target.parentElement.nextElementSibling;
            if (nextItem) nextItem.querySelector('a').focus();
          }
          if (event.key === 'ArrowUp') {
            event.preventDefault();
            let prevItem = event.target.parentElement.previousElementSibling;
            if (prevItem) prevItem.querySelector('a').focus();
          }
        });
      });


    },

    woo: function () {
      let qty = 0;
      let input = null;
      $(document).on('click', '.quantity .plus', function () {
        input = $(this).parents('.quantity').find('input');
        qty = parseInt(input.val());
        input.val(++qty);
        jQuery("[name='update_cart']").prop('disabled', false);
        if (arolax_obj.cart_update_qty_change) {
          jQuery("[name='update_cart']").trigger("click");
        }

      });
      $(document).on('click', '.quantity .minus', function () {
        input = $(this).parents('.quantity').find('input');
        qty = parseInt(input.val());
        qty = --qty;
        if (qty === 0) {
          qty = 1;
        }
        input.val(qty);
        jQuery("[name='update_cart']").prop('disabled', false);
        if (arolax_obj.cart_update_qty_change) {
          jQuery("[name='update_cart']").trigger("click");
        }


      });
    }

  };
  $(document).ready(arolax_theme_module.init);

})(jQuery);




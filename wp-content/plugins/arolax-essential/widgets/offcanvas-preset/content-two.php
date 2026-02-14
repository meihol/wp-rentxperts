<?php
include_once(AROLAX_ESSENTIAL_DIR_PATH.'inc/offcanvas-walker-nav.php');


?>

<!-- Offcanves start -->
    <div class="open-offcanvas wcf--info-animated-offcanvas"
         data-content_source="<?php echo esc_attr( $settings['content_source'] ); ?>"
         data-preset="<?php echo esc_attr( $preset_style ); ?>">
        <?php if ( $settings['menu_button_text'] == '' ) { ?>
            <?php if ( $bar != '' ) { ?>
                <img src="<?php echo esc_url( $bar ); ?>" alt="<?php echo esc_html__('Offcanvas Menu Open', 'arolax-essential'); ?>">
                <?php echo arolax_get_attachment_image_html( $settings, 'thumbnail', 'sticky_bar', [ 'class' => 'wcf-sticky-bar' ] ); ?>
            <?php } else { ?>
                <span class="menu-icon-2 light-dash"><span></span></span>
            <?php } ?>
        <?php } else { ?>
            <?php echo esc_html( $settings['menu_button_text'] ); ?>
        <?php } ?>
    </div>

    <div class="wcf-element-transfer-to-body wcf-offcanvas-gl-style offcanvas__area-2">
        <div class="offcanvas__inner-2">
            <div class="offcanvas__left-2">
                <?php if ( $settings['show_logo'] == 'yes' ) { ?>
                    <div class="offcanvas__logo-2">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img
                                    src="<?php echo $this->logo_image_url( $size ); ?>" alt="<?php echo esc_html__('Logo', 'arolax-essential'); ?>"></a>
                    </div>
                <?php } ?>
                <?php if ( $contact_info ) { ?>
                    <ul class="offcanvas__contact">
                        <?php foreach ( $contact_info as $contact ) { ?>
                            <li>
                                <p><?php echo esc_html( $contact['list_title'] ) ?></p>
                                <?php if ( $contact['list_type'] === 'email' ) { ?>
                                    <a href="mailto:<?php echo esc_attr( $contact['link'] ); ?>"><?php echo esc_html( $contact['list_content'] ) ?></a>
                                <?php } ?>
                                <?php if ( $contact['list_type'] === 'phone' ) { ?>
                                    <a href="tel:<?php echo esc_attr( $contact['link'] ); ?>"><?php echo esc_html( $contact['list_content'] ) ?></a>
                                <?php } ?>
                                <?php if ( $contact['list_type'] === 'address' ) { ?>
                                    <span><?php echo nl2br( $contact['list_content'] ) ?></span>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
                <div class="offcanvas__footer-2">
                    <?php echo wpautop( $settings['copyright_texts'] ); ?>
                    <?php echo get_search_form() ?>
                </div>
            </div>
            <div class="offcanvas__right-2">
                <div class="offcanvas__lang">
                    <?php if ( ! empty( $settings['language_info'] ) ) { ?>
                        <ul class="language">
                            <?php foreach ( $settings['language_info'] as $item ) { ?>
                                <li>
                                    <a href="<?php echo esc_html( $item['link'] ); ?>"><?php echo esc_html( $item['list_title'] ); ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                    <div class="offcanvas-close__button-wrapper offcanvas__close-2 offcanvas--close--button-js">
                        <button class="text-close-button">
                            <?php if ( $settings['default_close_contentss'] == 'yes' ) { ?>
                                <span></span>
                                <span></span>
                            <?php } else { ?>
                                <?php echo esc_html( $settings['close_text'] ); ?>
                                <?php if ( arolax_render_elementor_icons( $settings['close_icon'] ) ) { ?>
                                    <div class="off-close-icon">
                                        <?php \Elementor\Icons_Manager::render_icon( $settings['close_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </button>
                    </div>
                </div>
                <div class="offcanvas__menu-2-wrapper">
                    <?php
                    wp_nav_menu( array(
                        'menu'            => $menu_selected,
                        'container'       => 'nav',
                        'container_class' => 'offcanvas__menu-2',
                        'walker'               => new \ArolaxEssentialApp\Inc\Offcanvas_Walker_Nav(),
                        'fallback_cb'          => '\ArolaxEssentialApp\Inc\Offcanvas_Walker_Nav::fallback',
                    ) );
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Offcanves end -->

<?php

// Header
CSF::createSection( AROLAX_OPTION_KEY, array(
	'id'     => 'header_tab',
	'title'  => esc_html__( 'Header', 'arolax-essential' ),
	'icon'   => 'fa fa-home',
	'fields' => array(
		array(
			'type'     => 'callback',
			'function' => 'arolax_header_style',
		),
	)
) );


// Callback function
function arolax_header_style() {

	if ( ! class_exists( 'WCF_ADDONS_Plugin' ) ) {
		?>
		<?php esc_html_e( "To Customize Header install animation addons plugin", 'arolax-essential' ); ?>
		<?php
		return;
	}
	?>
	<a class="wcf-hf-btn" href="<?php echo admin_url( 'edit.php?post_type=wcf-addons-template&template_type=header' ); ?>">
		<i class="csf-tab-icon fa fa-cog"></i>
		<?php esc_html_e( " Customize Header", 'arolax-essential' ); ?>
	</a>
	<?php
}





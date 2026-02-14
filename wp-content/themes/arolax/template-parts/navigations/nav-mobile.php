<?php

wp_nav_menu([
	'menu'                 => 'primary',
	'theme_location'       => 'primary',
	'container'            => false,
	'container_class'      => "primary-menu",	                   // Set the ARIA label
	'menu_id'              => '',
	'menu_class'           => 'arolax-mb-menu-items',
	'depth'                => 3,
	'walker'          => new \arolax\Core\Arolax_Walker_Nav(),
	'fallback_cb'     => '\arolax\Core\Arolax_Walker_Nav::fallback',
]);


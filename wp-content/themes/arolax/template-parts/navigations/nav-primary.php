<?php
use \arolax\Core\Arolax_Walker_Nav;

wp_nav_menu([
	'menu'            => 'primary',
	'theme_location'  => 'primary',
	'container'       => false,
	'menu_id'         => '',
	'menu_class'      => '',
	'depth'           => 3,
	'walker'          => new \arolax\Core\Arolax_Walker_Nav(),
	'fallback_cb'     => '\arolax\Core\Arolax_Walker_Nav::fallback',
]);


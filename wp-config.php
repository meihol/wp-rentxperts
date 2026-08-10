<?php


/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_rentxperts_d' );

/** Database username */
define( 'DB_USER', 'wp_rentxperts_u' );

/** Database password */
define( 'DB_PASSWORD', 'Mq?}EoyBu4' );

/** Database hostname */
define( 'DB_HOST', 'ec2-43-205-168-50.ap-south-1.compute.amazonaws.com' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'o`;kUf1lv^H,ObF1#56Xmi#c?n-m5?xwYvKh>bNpme=ai+DH:X*-]JroaV%^9RJh' );
define( 'SECURE_AUTH_KEY',   '@KbNK_!CB k#FL,v}Ltz7Xbj=lJSi,1IAU$OKmPU=lY{tfo-fT!sty~<l%tv`{x}' );
define( 'LOGGED_IN_KEY',     '?o2wduX+y@=T,t.8C?(Q+Z@X9~J3m`G#q:$%dt)Jg3[MwkPT|p&lR7Agw7Mk~i3S' );
define( 'NONCE_KEY',         '0lHD0rjPe^[Gr-A:I.Z(wQY~`qSea>>xxOIuc_Q/=/Oz=_tyyrL/Fux6S:Ql1]F0' );
define( 'AUTH_SALT',         'H[h6&5zb6gXT95pH^9u*p)6FS)Sitb:OHAg>)CM}aOFNKvKSSXB@]E9Dd@Wx.F;=' );
define( 'SECURE_AUTH_SALT',  'Nde_YHv*ydyFj*kVy UYEu9M=wRRDF.gb`nTJRI]nbRnRi[vo?5N/_Xm<?P:=*zw' );
define( 'LOGGED_IN_SALT',    '7P}n77E[z$E)o`YPO0b#83<%n3eRvg-<]h69>8ZKv;.WeI>0RuBE3/&Vc= u0H*:' );
define( 'NONCE_SALT',        'h2V.Z_pH^_nA4uy3Fx4_uEL?#Za(EC*E,D FZ>cV5.y19gaDfbA0I^G{v/Whd@*g' );
define( 'WP_CACHE_KEY_SALT', '+nKWdJV&C+&%hR:h&wZTbx+l`WPPHw@Xkv. ACsU>`!68t05XX47(LXR{$(#$,k*' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

// define( 'DISABLE_WP_CRON' , true );
// define( 'DISALLOW_FILE_EDIT', true );
// define( 'DISALLOW_FILE_MODS', true );
define('ALLOW_UNFILTERED_UPLOADS', true);

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '3f671edb6012fa80f79c08abc549f40b' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
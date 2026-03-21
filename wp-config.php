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
define( 'AUTH_KEY',          'w9R{Kc[p?dxdao0/M:VMd;W ^rO/7a.)OiU?FwJxIW,ae1E5*@PN]_3P{,YFC l`' );
define( 'SECURE_AUTH_KEY',   'rw0%85Kl *2*#A3LYb<^rzo:3VQ;]:s zE=1W*&2ZNSy`6I?oW-O/Zn#7;NZR|DV' );
define( 'LOGGED_IN_KEY',     'Z~w$ aphvrF-|E^*#;BX.^gi.,-D8Y`bwz  42^oYsocQ:nby3Zb4Lrd+(2mzCt^' );
define( 'NONCE_KEY',         ';R`=d~1R-/qvRAx2gA2?rc!-*:CL&*<r!@h9C5Hg40M|`:BbX5`}JnZ>m9:&jWt^' );
define( 'AUTH_SALT',         'G<IP,H><,1>weBUF>{e)lZzA!{!GKWThA)^>()Cb0QjN,UQa=Wh;bkL!M^?aH70K' );
define( 'SECURE_AUTH_SALT',  'g;pU5EJ_`apM:|KDVV61q0a[u|!471A4Rofva54818$L_ >{>l=-^(a`oNg-Q@A;' );
define( 'LOGGED_IN_SALT',    'iVNN<3w8uo5*n*LkdPt#GB(e_}6p+xn@b`NwwAYD(I5Q2~-duC~4u7,d~bPq&iz{' );
define( 'NONCE_SALT',        '+U$.u9V-U)]]?@rTR(PWy1&q|aRdpj*^pn}?}C/hw2u$%+[lNzRII.0&N;fURaI|' );
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

define( 'DISABLE_WP_CRON' , true );
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISALLOW_FILE_MODS', true );
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

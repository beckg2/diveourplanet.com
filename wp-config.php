<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'diveourplanet');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Q73gu@D<(),qQ@pL#BN<@M0(TmlCAzs)h8)VXc&33a3=;j]pVyeB2D<N=(^7hwFv');
define('SECURE_AUTH_KEY',  'a42b1/6c[]s@H-~2pR~!,36dRu(/Q)Q/T3x4,QrOAgHKxog]iQZC5#tW}#.wW %Y');
define('LOGGED_IN_KEY',    'yg`} dkldBS?ub+<`st*m[+lL_jj^k7O?Bn>~K1-m6i.[T0$nv) Z7IGq&Qc-(=V');
define('NONCE_KEY',        'SuL<ym77|,XP{~maxPm3C=fb[OZa]Bq!V<7JjOPZr0k<1X/.~|MHJnB`&>fKg@2A');
define('AUTH_SALT',        '$R4nO^mJ3W$GL#LD}}6_^In.:sUo?mYE`+7}Gukw.l^ x?k#%A_I,.2nUoC5%Z~0');
define('SECURE_AUTH_SALT', 'vl#F,a?TzxiM:I{0goC5Ei,^U_<H,|c`T5}RF&t`^|w;]PHRx}u?n.sGHOEvn8bx');
define('LOGGED_IN_SALT',   'zrIv.O5{u~$nk?+~n$*4+Nu<p,r[R)`#tjd-~:7Rxo_fzU06QXQvc^1AY}0G|Dq/');
define('NONCE_SALT',       'd@XO]&OM#Q!K-F,IC>w:p9J|AF_<)&*,9w#G-oT,VQ;-4g&9[<^H4`EJ$H.fxsTG');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

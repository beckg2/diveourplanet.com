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
define('DB_NAME', 'diveourp_ss_dbname911');

/** MySQL database username */
define('DB_USER', 'diveourp_ss_d911');

/** MySQL database password */
define('DB_PASSWORD', '5OGrhL4gH29y');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY', 'vJRXYlY{?N]kxKN)J/|dSn?CSovLadCz/pc;i)H{>DR[cel;ya>oQi<uh>e;Lj/EvmJ$(fVtY-=kXcG<(c}BcjxmN+xsnGYZMS$Ez&OUIx*}XCM]vpDiJ-wR-RKF>!}Y');
define('SECURE_AUTH_KEY', 'H)|f^ChLf{YYpOne(N$K>=F$WXplCC{Xd*&rF}Odl{M]Yr(Xaz@p^Co(>f?=N}yD(zWYCKbT?]xFEVpwS^Qrw%(Pxm]%xPr}G)=Lt)&I+kbWff[^R_JJaDz<_+zhkJjA');
define('LOGGED_IN_KEY', 'VrKM<ICGgPZ$p%Pu{R@d<=A>cOtPhaCStD;*AecRR$uH*OWNSA*RQdDg@qWzMp=VY^g?Vswz^$rqDWUZ!(Q[O^a%^syJ?kqyvm*QtdL*|sS*U+sTTjgh(?g%iVrUDpXt');
define('NONCE_KEY', 'OL[aH-q%chRrUmdDuc[DH+Bchz|)t;HR>eKOn|_fLu{ff@Ki/tOw<)g)n^dlao=i*Kqctv;ms%P!XY%[ou);ZkKp(Raim]M?En{djL&J)MXwKtxtxds*X%gX[llmuvmc');
define('AUTH_SALT', 'oEAcn/K@EfW;?kWxH>hLPy@ZUgy>?}SLrn/_?%Y<iDrlT-q@qB*Go)b-G{CmRDv%n><pbFd=<yGit]<a!^wy?/A$oNxK/rk]uF/xpQfQT-nMq)U$FjwHVO)vX];yn<Ux');
define('SECURE_AUTH_SALT', 'EbBqD;FxFKewIWflH@WJs+$wAD=E=fV$/++i^Ddphda>-?aHp}?Pmg_<gN?x%;;udYV_@aU+((esk_mcQqqCHb/;vW}re]$]t%E;PbGvBTkLpvd*CXf=&<(&&TOn%q;%');
define('LOGGED_IN_SALT', '(VJ])wC?*YpM</fSUu}Od^SKqPTLFX|YxYOo-@UmhxELbQpyEB[@cY&KwsVhke&t--ZA+achuIMA@rsFl@kZTfA*<)W%Sh_xbl-@tVY&->rtuaE}Sw(RC[hXi!EG-O&+');
define('NONCE_SALT', 'sReG<o?$B!gGd$F>b}fW!By|rs{!ETt{CY/)RF|)GlF;k(l+AvmJqE$sj<uSCrfSy+bCLM(J|Ji^j@=c+uSb+ods!JrAjvdfO??Amb}<[cZsrH+st+TkDE?(w+[<ba>p');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_rbha_';

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

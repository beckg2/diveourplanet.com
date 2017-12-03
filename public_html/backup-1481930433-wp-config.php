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
define('DB_NAME', 'diveourp_ss_dbname321');

/** MySQL database username */
define('DB_USER', 'diveourp_ss_d321');

/** MySQL database password */
define('DB_PASSWORD', 'RHJL270Isrgf');

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
define('AUTH_KEY', 'YDRry^|nxpG|m)?YHq>YILA+z/nkT&tDC!n]a&haZZh[qZkvpg*;GWFcE>{RuY<WF%$VETPj@}]CHPV@AwBqlFuV;-t$u]H*PM(/*agS/g@CRyyiZihKFP/)/q-D{rr_');
define('SECURE_AUTH_KEY', ']PCdr$ZP]_)PhSO$_VPfR?]){!FyXUf{}zlhwr-Uq<zY]k>Hzo$jlQ(ZIy|%(_T*x{$^ppdU<O>XXh-uwMurcEC*[*RhMf+^d^j@cVL/@YAr(WwB@jwb}XjDVF|XulnC');
define('LOGGED_IN_KEY', 'D@*G!V]B!+]{JNOPb@VD)XbZiefUbrZO[FOd|Oe{gniTd]{M<[b}eMKr}^id=KZk@wM)(Qz-e?ZDqcG|YF[hQQ;$NNy(|e-^)upB$;;FJcKLK&%(%FHYAy<ND-BNLSDT');
define('NONCE_KEY', 'tdt+PLDlL?OvyNrS|hU{cSlq{?@MvRlMwh?)s<s*m_&)e*x?ttl_|I^$n/u{kX/+OW>(fb+c[hwbUBRO>xF/u(Y{^baPQwq?aB>Uai|c(xkz%tXjXIz_]-/_X$IQO}l(');
define('AUTH_SALT', '{M+iP_zt&|IAf@CAxUCnc-yJ;mAayKNEA@(ynWr>=zu*Qyrk}K$pqh<mm<vpekxuRkwUpCYq(PXOWqEww^rKOG&^b|Xe<Pxu*vysXX>|(vctDOkBdsetLeu<+NK=f}BH');
define('SECURE_AUTH_SALT', '|YnpxoW^RZlsX@$CQCdV[F[v+nXBPqnviGqw]ksG[eLjDVXE}vz>SJz*Mm^);<Iem-=);x?/$L%?RljRAh;mCqCsdV$NF<LtFb$WmTN_fBTenAg<mZipG+Eb-wx^wfcA');
define('LOGGED_IN_SALT', '%RRDzURc(sk*dLga*-/Gwe+TY(RpsdTxb*A?|/Nd[XYanqjNN=D/]K*A-WAjo?-<jfMmBr(@<S/QYzbMnjWbBlXZViIwjW(iqFX%&(^(piX/qXE|<JLp/sLwR@WVbOSY');
define('NONCE_SALT', '>t)REM]knYyipV%zrewu;kn>-WO]nuUcQNg<x{L;j%dO&^bvjJ*Tz)Pu&buV=B>Eu|V{<tTVH=DIcmos{m>TZq=_bj)W{?NqtHY<TICSOs@ILGLMQep{GUH>BCpix!aw');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_ekma_';

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

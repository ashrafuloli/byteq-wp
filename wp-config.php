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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'byteq941_main' );

/** Database username */
define( 'DB_USER', 'byteq941_main' );

/** Database password */
define( 'DB_PASSWORD', 'd+Bv){UE?chL' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'Zv [?Lxpy<(<fz-ZxZ30lh<[>ec|=@(2ZH%pr|h|8?F%&j/.-_e[h`o|#5xPlH?Z' );
define( 'SECURE_AUTH_KEY',  '5 3L0<$3)7^ozSfPD>SJ7Pw!]kjGEyZ +{!:+u)!!~s,`H!~s&<3(Yt8Aa4>t{N)' );
define( 'LOGGED_IN_KEY',    'v_-m6<]bsg<]o^/b?p~$2od`)W${PVEHDLi_S[-{C>gFCUYUeg@p.&fkJ2g/V-AC' );
define( 'NONCE_KEY',        'F,&{4&40j.;J,Qw30TTRN=D!;[I.AT,Wzt<U?cYWy`S#$UR4FJPd^WW-Boo}jCCY' );
define( 'AUTH_SALT',        'Jo>wu$KTnNxOmQL-E;,g:c:t1acrw2iF--s*i8)!s4rX*x(ALEn;utG)]6RH@{jv' );
define( 'SECURE_AUTH_SALT', ',ZF9&w[4=o+b_d_5<M@lnL>DNQ JsH$J,q|9U-6Xr/YkF.eU{zA]8Jwt{|CB^9}3' );
define( 'LOGGED_IN_SALT',   '(@CU`=t qSo%xv`J{32KGg0&y*@C+iX)YQds;>*axhg-%fQn;HhVGtG]2R<3`8Ik' );
define( 'NONCE_SALT',       ' 0?><|lppBy#eelm3s;7&R-QNTeiCFS%~19{Q6)g:PTY>?-u6[#^Gn0@R$VNm2=,' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

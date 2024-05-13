<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_plugin_task' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',         'a_(gZumfF}3b2TTT3?vo;ME]MEJSZ8U^h=36.N][_,(*LC8|^:Y=LXvc1S<%sc:e' );
define( 'SECURE_AUTH_KEY',  'mfEW]vi:%/|s7t#1+<twr7D. )5}h>_?^<fI&]<#8@w2VexKC!5Q+>i)T<jIdIT<' );
define( 'LOGGED_IN_KEY',    'U2fgzYdt4Oah3N F@eS>>/B%ZvDjgf|zd#E%Rc#zc?Ja h/+M|z{PR3^VZj-V7xU' );
define( 'NONCE_KEY',        '`KD$6O=fdYLs3lQT<dr<_6GY0?}tYb6ST?IY}@u_t(%7%d-I<-> nUWhQg;?bMtw' );
define( 'AUTH_SALT',        'b3]aUd~z76h$-.pz8KKAsoWje;a#/(*Twdg?p2e0a*X*}kUR4u>FN4_`_PZ[cx3`' );
define( 'SECURE_AUTH_SALT', 'nF&eBf,uQ/`mb6`&z!xtcvz.|GF@q]cFh&z08*e9b!X68b6IlCZT,#Z_a7at2frz' );
define( 'LOGGED_IN_SALT',   '=*zF UlQD11w[*_ECN[,$0@T>.&a,%7)1)(6uo]O.i1;Pas!.K4RY|qG<IZi<L`S' );
define( 'NONCE_SALT',       'KgJ}4b1)q+mb@D*HDa39TYP:QX/I&-2P`:idt_npu9R3`-fAZAncID]xIM3]?Kv|' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */


define('FS_METHOD', 'direct');
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

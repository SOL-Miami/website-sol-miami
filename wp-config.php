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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'vwA3k1IDcD');

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
define('AUTH_KEY',         'Pp}FSn[7cV,[={ wa1O#OPS`KB~,V!(7X9xm5|9&!mtS)-OlO$7IsL%,4/FJd!Cp');
define('SECURE_AUTH_KEY',  '?C_M%30Q850a1?]:%x@_V::@`E17t7B4wd&|ixO#$vqo.qdkt=khr!dqJBA}9mgD');
define('LOGGED_IN_KEY',    '6rgJmu_GAA!I*`GWH0Z4~Ds^Yw=/.h)X>YJo^ =X7i5#${?lRqXlYzy$/<8ro.J9');
define('NONCE_KEY',        'V=]Zf7=kr?8-mGtPL5`)aJ(JY=}[2gYZ|K))yMQbdY*Q}V|o3]H&&3bQ#[:RqQ-<');
define('AUTH_SALT',        '3zlv 1g,c0$W4h1xDREo~Qyo!EqU$aiDto4H~}L;NW/ZZc`ET&1X?i?=.BI@r2LG');
define('SECURE_AUTH_SALT', 'A^mNX3^>1:lcOK^k2uW2m40Qk^YeUk/petRS=!K?qd}N4~f34Q[v[<Dxebab{*0n');
define('LOGGED_IN_SALT',   'Njh9MPn+fU/#v@Y~~4{T0c+I,u 58Mf!Woysu[ft/m,olZgznj#QobmMpN2=K7wU');
define('NONCE_SALT',       'Q;E-;<?-@pHvK/pyLWe&}P0Z6*R*R+KS-6:lj&=B?J{ RIh~SlMVElxQYNdjz+7>');

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

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
define('DB_NAME', 'sol-website');

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
define('AUTH_KEY',         ' f9;xaZa4dM:-07N3p]rHCf}ZgnkssPp&J==y#&h#7pp0f<uP,18_9WYfn2Rb}o@');
define('SECURE_AUTH_KEY',  '-4RHnL/z1#~-]C&v/jJSNPG5=a_]duR;C!`:s9LuD~7Nam]WBCx@QKJ6F_C}WK14');
define('LOGGED_IN_KEY',    '}1=ZOkh.K^1Tmr0)&A6!/-d8aeN><JL/yuof`~cp>8rHo8.~SMnnsUw&+MZ!N%/3');
define('NONCE_KEY',        'mXiJS#1oLzr!CboIeQ?wjT6c$8m69|Cu+do#R:-_u88V?uBc-tOeUZi/(w2I{9}3');
define('AUTH_SALT',        'BjuEW7NaHC00U/YNQnhZr^Q(@u#s/W(rWP6BKn?6C6Z1YZ0<7`n[v<WfNB j4w#L');
define('SECURE_AUTH_SALT', 'lr#e{?7KIn.3L#n4tE}Z)/gJ%[D.E2*&@`.rPam=eAs#g,7,A(XGUww4&`:-72-&');
define('LOGGED_IN_SALT',   'SY$}e7x20goYP34)1kg, 5!z_-{t2d?=egao_lEyBa3A2dgIHNuJ`>#MHmdaMepU');
define('NONCE_SALT',       'ZGg$X0nHVSLLM84E?vugXN#i ]2i)&A#}D7C.<0iCOpq]`zh0f2d#t|<@s7.MYK<');

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

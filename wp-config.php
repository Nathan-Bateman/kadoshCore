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
define('DB_NAME', 'hume');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'GnTtXt;J!wpP)E9s[{9t-B*xfX-4AmW!k-.s`YtT]xh>21 [sW8!<}>HxOu3h|N-');
define('SECURE_AUTH_KEY',  '|[83BEn{x`=%@~cYGN2e(ms#Sh{`{<I2xNH_D`*R&T &A@*4DK< k4Da)IO=n2oB');
define('LOGGED_IN_KEY',    'gDPLZ1BZ;UWWtt:R/yVWKri}`CRb*vE>N~e$P/=LW[NMratm}<E(im@zL)o,^Rt5');
define('NONCE_KEY',        '*3/^{5]S%XLM%Ac$6NG]`$Dn8Vb=)tXWX~lz!5)sy6;c/S4ztwj$J0V?cxR*i =K');
define('AUTH_SALT',        'oX=*TGipGW7{%c(]^/~.hW_YKdfUap4/$3Mr!5)#;~D}O$M/kc0kd~M;pHe8;[rp');
define('SECURE_AUTH_SALT', 'k$P<H+uwuK+nP]cE9K]o6Sp7*z{Fbg/?av|+]*Sq-3i%h~M@X;@Tp*o}qzi{q7_D');
define('LOGGED_IN_SALT',   '<wjDy EJ#]4(z;.D] P`4M$sluQWNpIxdVL?nWoSTG6^7tR&&Da0x21UQcT+`^|n');
define('NONCE_SALT',       '`QSZ~;x^,mf|)_qD53b-ey7CANA[0.y&v;E~-gO:]76.Cft54@Tgr2qj+`SBWz.>');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

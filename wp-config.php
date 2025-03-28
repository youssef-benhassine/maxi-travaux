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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'maxi_travaux' );

/** Database username */
define( 'DB_USER', 'maxitravaux' );

/** Database password */
define( 'DB_PASSWORD', 'J!|G0ub5$GD(j/t_}O$mU6' );

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
define( 'AUTH_KEY',         '#abHRa|wJd:=}77^oCp;7&=Xu6V|R?2^9x}<Sq`xxa5|e;r3`xGv`hJj#}alU401' );
define( 'SECURE_AUTH_KEY',  '@8tzXSc?rGZO,u<?fv=?Y@`tREEE:^8@@~IpAd]^[3Nh*X 7jo`-RYfv[(usTaF_' );
define( 'LOGGED_IN_KEY',    'pYU!t-Y^ppqGCa_ye|?S~m5HXtIzy=N/JK?}h|oDUqYhFNSdis;M4+voV#R#fey<' );
define( 'NONCE_KEY',        '/u[AkIx(MRde=/Y+e/ dIRixnP__p.eg.S3eBo?|`cTs5s}SnSycabkt2X9/f}VW' );
define( 'AUTH_SALT',        'nT8:pOb.e,)O<kE-2Y3w/BX4_/ Tx3u4tJK>q*6kP<YdVMl`{&*GvH=)#V+F~PKZ' );
define( 'SECURE_AUTH_SALT', 'x]mWkI8Vo:S{X(,b+wF`[C>,[_a+u[9=5p9ewT_PzKr]XP}>.{~p<aw>1S?tuLc1' );
define( 'LOGGED_IN_SALT',   'x67M.@1?jZ= sZ(E[Z%s9tZFiz|/7x9Em;Vq(vwdfNor(i--4^~ >}x$nYE&YkW&' );
define( 'NONCE_SALT',       '1g-LB]Bcl=?`KPFCX)A51=>7,8~bK7~EFGN {#9d;571(_pc17qHVkz7~MiACO$;' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'mt_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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

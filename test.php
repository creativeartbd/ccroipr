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
 * @link https:/codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

/** MySQL settings - You can get this info from your web host ** /
/** The name of the database for WordPress */
define('DB_NAME', 'DB4211065');

/** MySQL database username */
define('DB_USER', 'U4211065');

/** MySQL database password */
define('DB_PASSWORD', 'gZToKw306Zdy31omq');

/** MySQL hostname */
define('DB_HOST', 'rdbms.strato.de');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https:/api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'u7mAO7zs@0P6N%&)0y)ie8M%s9^1km@HkbpLH!#fDC0c85ZfQ5K@xPb0nAs4JTtx');
define('SECURE_AUTH_KEY',  '#47E1Fu#39s9Ipun@qr^UuHywJ!Y)mWL3OC6EXShIqnn9cu#ftnPPxCdLDnml6bA');
define('LOGGED_IN_KEY',    '7CLf#47NwtClJ3HwCnv!waS%UPEH^KGE1nZBNhVVWnBLr#aIth0en*v)cC&(CtqD');
define('NONCE_KEY',        '5MherBmsJienbkzYGmrzRYrbQgfC27DNR(EzU2&nQ^7q@5lilrzP^bf%gq*6P)&6');
define('AUTH_SALT',        '5#g7T)sWj^DSRVPZ2JgtM5TBDOH4(CI1p#u07GIV9BRIbsk2F8aTBI5cTElEu&K)');
define('SECURE_AUTH_SALT', 'zt4@0FukjlxA4XM9bF2CtNvQtClO0cl)pTvPL(trUUjOnAat0MG3V2Ij1zDHzMnV');
define('LOGGED_IN_SALT',   'h#sMaqOH8(ZXiK4GDbRpFDLGatljJ0NMihPpL%L@&D!oXr75JZvI2UzG4G8MHUZ^');
define('NONCE_SALT',       'GD@UaFV8MbxERKpjcze2FTrckt1Vqeup)#ye!^)gXyyxAKbLEKRJaz*c3QULixxj');
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
 * @link https:/codex.wordpress.org/Debugging_in_WordPress
 */
define ('WP_DEBUG', true);
define ('WP_DEBUG_LOG', true);
define ('WP_DEBUG_DISPLAY', false);
@ini_set ('display_errors', 0);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');

define( "WP_AUTO_UPDATE_CORE", 'minor' );


<?php
/**
 * Define for file includes
 */
define ( 'BASE_PATH', '' );

/**
 * Define which app type you are using:
 * Private - private app method
 * Public - standard public app method
 * Public - partner app method
 */
define ( "XRO_APP_TYPE", "Public" );

/**
 * Set a user agent string that matches your application name as set in the Xero developer centre
 */
$useragent = "Xero-OAuth-PHP Public";

/**
 * Set your callback url or set 'oob' if none required
 * Make sure you've set the callback URL in the Xero Dashboard
 * Go to https://api.xero.com/Application/List and select your application
 * Under OAuth callback domain enter localhost or whatever domain you are using.
 */
define ( "OAUTH_CALLBACK", 'http://yourdomain.com/public.php' );

/**
 * Application specific settings
 * Not all are required for given application types
 * consumer_key: required for all applications
 * consumer_secret: for partner applications, set to: s (cannot be blank)
 * rsa_private_key: application certificate private key - not needed for public applications
 * rsa_public_key: application certificate public cert - not needed for public applications
 */



$signatures = array (
		'consumer_key' => 'NZABKUH9OHDPQPXXSLGDNTSYCFLICC',
		'shared_secret' => 'EQ7FDGDV2WJPKBMMGKGYCBCWKZRXNA',
		// API versions
		'core_version' => '2.0',
		'payroll_version' => '1.0' 
);
?>
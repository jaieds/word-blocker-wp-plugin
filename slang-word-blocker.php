<?php
/*
Plugin Name: Slang Word Blocker
Plugin URI: https://jaiedsabid.com
Description: Block all types of slang words in comments.
Version: 1.0.0
Author: Jaied Al Sabid
Author URI: https://jaiedsabid.com
Text Domain: slang-word-blocker
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Meow' );
}

define( 'SLANG_BLOCKER_LOCATION', __FILE__ );
define( 'SLANG_BLOCKER_VERSION', '1.0.0' );

require_once dirname( __FILE__ ) . '/includes/admin-settings.php';
require_once dirname( __FILE__ ) . '/includes/comment-filter-engine.php';
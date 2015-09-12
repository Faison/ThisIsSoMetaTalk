<?php

/**
 * FZ Talk functions and definitions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * @package FZ Talk
 * @since 0.1.0
 */

// Useful global constants
define( 'FZTALK_VERSION',      '0.1.0' );
define( 'FZTALK_URL',          get_stylesheet_directory_uri() );
define( 'FZTALK_PATH',         get_stylesheet_directory() . '/' );
define( 'FZTALK_INC',          FZTALK_PATH . 'includes/' );

// Include compartmentalized functions
require_once FZTALK_INC . 'functions/core.php';

// Include lib classes

// Run the setup functions
FZ_Talk\Core\setup();
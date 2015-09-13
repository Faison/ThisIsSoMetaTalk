<?php
/**
 * Plugin Name: FZ Projects
 * Plugin URI:  https://github.com/Faison/ThisIsSoMetaTalk
 * Description: The Functionality for the talk &#34;This Talk is so Meta&#34; at WordCamp East Troy 2015
 * Version:     0.1.0
 * Author:      Faison Zutavern
 * Author URI:  http://faisonz.com
 * License:     GPLv2+
 * Text Domain: fzp
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2015 10up (email : info@10up.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using yo wp-make:plugin
 * Copyright (c) 2015 10up, LLC
 * https://github.com/10up/generator-wp-make
 */

// Useful global constants
define( 'FZP_VERSION', '0.1.0' );
define( 'FZP_URL',     plugin_dir_url( __FILE__ ) );
define( 'FZP_PATH',    dirname( __FILE__ ) . '/' );
define( 'FZP_INC',     FZP_PATH . 'includes/' );

// Include files
require_once FZP_INC . 'core/setup.php';

// Include Team Member files
require_once FZP_INC . 'team-members/team-members.php';
require_once FZP_INC . 'team-members/team-members-post.php';
require_once FZP_INC . 'team-members/team-members-meta.php';

// Include Project files
require_once FZP_INC . 'projects/projects.php';
require_once FZP_INC . 'projects/projects-post.php';
require_once FZP_INC . 'projects/projects-meta.php';


// Activation/Deactivation
register_activation_hook( __FILE__, '\FZ_Projects\Core\activate' );
register_deactivation_hook( __FILE__, '\FZ_Projects\Core\deactivate' );

// Bootstrap
FZ_Projects\Core\setup();
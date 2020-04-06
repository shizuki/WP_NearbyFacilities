<?php
/**
 * NearbyFacilities Plugin file.
 *
 * @since 1.0.0
 * @license GPL2
 * @package WP_NearbyFacilities
 */

/**
 * Plugin Name: WP_NearbyFacilities
 * Plugin URI: http://shizuki.kinezumi.net/2020/04/05/wp-nearbyfacilities/
 * Description: Display markers at facilities near the specified point in googlemaps.
 * Version: 1.0.2
 * Author: shizuki
 * Author URI: http://shizuki.kinezumi.net/about/
 * License: GPLv2
 * Text Domain: NearbyFacilities
 * Domain Path: /languages
 */

/**
 * Copyright 2020 shizuki (email : shizuki17xx@gmail.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
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

require_once plugin_dir_path( __FILE__ ) . 'class-nearbyfacilities.php';
add_action( 'init', 'NearbyFacilities::init' );
add_action( 'plugins_loaded', 'NearbyFacilities::load_lang_strings' );
add_shortcode( 'nearbyFacilities', 'NearbyFacilities::nearbymap_shortcode' );

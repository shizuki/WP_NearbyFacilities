<?php
/**
 * NearbyFacilities Class file.
 *
 * @since 1.0.0
 * @license GPL2
 * @package WP_NearbyFacilities
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

/**
 * NearbyFacilities
 *
 * NearbyFacilities plug-in class
 *
 * @since 1.0.0
 */
class NearbyFacilities {
	public const VERSION           = '1.0.0';
	public const PLUGIN_ID         = 'NearbyFacilities';
	public const CREDENTIAL_ACTION = self::PLUGIN_ID . '-nonce-action';
	public const CREDENTIAL_NAME   = self::PLUGIN_ID . '-nonce-key';
	public const PLUGIN_DB_PREFIX  = self::PLUGIN_ID . '_';
	public const PLUGIN_DIR        = __DIR__ . '/';
	public const COMPLETE_CONFIG   = self::PLUGIN_ID . '-config-cmplate';
	public const CONFIG_MENU_SLUG  = self::PLUGIN_ID . '-config';

	/**
	 * FunctionName init
	 * Initialize
	 *
	 * @return class
	 */
	public static function init() {
		return new self();
	}

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		if ( is_admin() && is_user_logged_in() ) {
			add_action( 'admin_menu', array( $this, 'set_plugin_menu' ) );
			add_action( 'admin_menu', array( $this, 'set_plugin_sub_menu' ) );
			add_action( 'admin_init', array( $this, 'save_config' ) );
			add_action( 'admin_print_scripts-toplevel_page_NearbyFacilities', array( $this, 'add_about_script' ) );
		}
	}

	/**
	 * Func set_plugin_menu
	 *
	 * @return void
	 */
	public function set_plugin_menu() {
		add_menu_page( 'Nearby Facilities', 'Nearby Facilities', 'manage_options', 'NearbyFacilities', array( $this, 'show_about_plugin' ), 'dashicons-location-alt', 99 );
	}

	/**
	 * Func set_plugin_sub_menu
	 *
	 * @return void
	 */
	public function set_plugin_sub_menu() {
		add_submenu_page( 'NearbyFacilities', 'Settings', __( 'Settings' ), 'manage_options', 'NearbyFacilities-Settings', array( $this, 'show_config_form' ) );
	}

	/**
	 * Func show_about_plugin
	 *
	 * @return void
	 */
	public function show_about_plugin() {
		$types_array = array(
			'restaurant'              => __( 'Restaurant', 'NearbyFacilities' ),
			'accounting'              => __( 'Accounting', 'NearbyFacilities' ),
			'airport'                 => __( 'Airport', 'NearbyFacilities' ),
			'amusement_park'          => __( 'Amusement park', 'NearbyFacilities' ),
			'aquarium'                => __( 'Aquarium', 'NearbyFacilities' ),
			'art_gallery'             => __( 'Art gallery', 'NearbyFacilities' ),
			'atm'                     => __( 'ATM', 'NearbyFacilities' ),
			'bakery'                  => __( 'Bakery', 'NearbyFacilities' ),
			'bank'                    => __( 'Bank', 'NearbyFacilities' ),
			'bar'                     => __( 'Bar', 'NearbyFacilities' ),
			'beauty_salon'            => __( 'Beauty salon', 'NearbyFacilities' ),
			'bicycle_store'           => __( 'Bicycle store', 'NearbyFacilities' ),
			'book_store'              => __( 'Book store', 'NearbyFacilities' ),
			'bowling_alley'           => __( 'Bowling alley', 'NearbyFacilities' ),
			'bus_station'             => __( 'Bus station', 'NearbyFacilities' ),
			'cafe'                    => __( 'Cafe', 'NearbyFacilities' ),
			'campground'              => __( 'Campground', 'NearbyFacilities' ),
			'car_dealer'              => __( 'Car dealer', 'NearbyFacilities' ),
			'car_rental'              => __( 'Car rental', 'NearbyFacilities' ),
			'car_repair'              => __( 'Car repair', 'NearbyFacilities' ),
			'car_wash'                => __( 'Car wash', 'NearbyFacilities' ),
			'casino'                  => __( 'Casino', 'NearbyFacilities' ),
			'cemetery'                => __( 'Cemetery', 'NearbyFacilities' ),
			'church'                  => __( 'Church', 'NearbyFacilities' ),
			'city_hall'               => __( 'City hall', 'NearbyFacilities' ),
			'clothing_store'          => __( 'Clothing store', 'NearbyFacilities' ),
			'convenience_store'       => __( 'Convenience store', 'NearbyFacilities' ),
			'courthouse'              => __( 'Courthouse', 'NearbyFacilities' ),
			'dentist'                 => __( 'Dentist', 'NearbyFacilities' ),
			'department_store'        => __( 'Department store', 'NearbyFacilities' ),
			'doctor'                  => __( 'Doctor', 'NearbyFacilities' ),
			'electrician'             => __( 'Electrician', 'NearbyFacilities' ),
			'electronics_store'       => __( 'Electronics store', 'NearbyFacilities' ),
			'embassy'                 => __( 'Embassy', 'NearbyFacilities' ),
			'finance'                 => __( 'Finance', 'NearbyFacilities' ),
			'fire_station'            => __( 'Fire station', 'NearbyFacilities' ),
			'florist'                 => __( 'Florist', 'NearbyFacilities' ),
			'food'                    => __( 'Food', 'NearbyFacilities' ),
			'funeral_home'            => __( 'Funeral home', 'NearbyFacilities' ),
			'furniture_store'         => __( 'Furniture store', 'NearbyFacilities' ),
			'gas_station'             => __( 'Gas station', 'NearbyFacilities' ),
			'general_contractor'      => __( 'General contractor', 'NearbyFacilities' ),
			'grocery_or_supermarket'  => __( 'Grocery or supermarket', 'NearbyFacilities' ),
			'gym'                     => __( 'Gym', 'NearbyFacilities' ),
			'hair_care'               => __( 'Hair care', 'NearbyFacilities' ),
			'hardware_store'          => __( 'Hardware store', 'NearbyFacilities' ),
			'health'                  => __( 'Health', 'NearbyFacilities' ),
			'hindu_temple'            => __( 'Hindu temple', 'NearbyFacilities' ),
			'home_goods_store'        => __( 'Home goods store', 'NearbyFacilities' ),
			'hospital'                => __( 'Hospital', 'NearbyFacilities' ),
			'insurance_agency'        => __( 'Insurance agency', 'NearbyFacilities' ),
			'jewelry_store'           => __( 'Jewelry store', 'NearbyFacilities' ),
			'laundry'                 => __( 'Laundry', 'NearbyFacilities' ),
			'lawyer'                  => __( 'Lawyer', 'NearbyFacilities' ),
			'library'                 => __( 'Library', 'NearbyFacilities' ),
			'liquor_store'            => __( 'Liquor store', 'NearbyFacilities' ),
			'local_government_office' => __( 'Local government office', 'NearbyFacilities' ),
			'locksmith'               => __( 'Locksmith', 'NearbyFacilities' ),
			'lodging'                 => __( 'Lodging', 'NearbyFacilities' ),
			'meal_delivery'           => __( 'Meal delivery', 'NearbyFacilities' ),
			'meal_takeaway'           => __( 'Meal takeaway', 'NearbyFacilities' ),
			'mosque'                  => __( 'Mosque', 'NearbyFacilities' ),
			'movie_rental'            => __( 'Movie theater', 'NearbyFacilities' ),
			'movie_theater'           => __( 'Movie theater', 'NearbyFacilities' ),
			'moving_company'          => __( 'Moving company', 'NearbyFacilities' ),
			'museum'                  => __( 'Museum', 'NearbyFacilities' ),
			'night_club'              => __( 'Night club', 'NearbyFacilities' ),
			'painter'                 => __( 'Painter', 'NearbyFacilities' ),
			'park'                    => __( 'Park', 'NearbyFacilities' ),
			'parking'                 => __( 'Parking', 'NearbyFacilities' ),
			'pet_store'               => __( 'Pet store', 'NearbyFacilities' ),
			'pharmacy'                => __( 'Pharmacy', 'NearbyFacilities' ),
			'physiotherapist'         => __( 'Physiotherapist', 'NearbyFacilities' ),
			'place_of_worship    '    => __( 'Place of worship', 'NearbyFacilities' ),
			'plumber'                 => __( 'Plumber', 'NearbyFacilities' ),
			'police'                  => __( 'Police', 'NearbyFacilities' ),
			'post_office'             => __( 'Post office', 'NearbyFacilities' ),
			'real_estate_agency'      => __( 'Real estate agency', 'NearbyFacilities' ),
			'roofing_contractor'      => __( 'Roofing contractor', 'NearbyFacilities' ),
			'rv_park'                 => __( 'Rv park', 'NearbyFacilities' ),
			'school'                  => __( 'School', 'NearbyFacilities' ),
			'shoe_store'              => __( 'Shoe store', 'NearbyFacilities' ),
			'shopping_mall'           => __( 'Shopping mall', 'NearbyFacilities' ),
			'spa'                     => __( 'Spa', 'NearbyFacilities' ),
			'stadium'                 => __( 'Stadium', 'NearbyFacilities' ),
			'storage'                 => __( 'Storage', 'NearbyFacilities' ),
			'subway_station'          => __( 'Subway station', 'NearbyFacilities' ),
			'synagogue'               => __( 'Synagogue', 'NearbyFacilities' ),
			'taxi_stand'              => __( 'Taxi stand', 'NearbyFacilities' ),
			'train_station'           => __( 'Train station', 'NearbyFacilities' ),
			'travel_agency'           => __( 'Travel agency', 'NearbyFacilities' ),
			'university'              => __( 'University', 'NearbyFacilities' ),
			'veterinary_care'         => __( 'Veterinary care', 'NearbyFacilities' ),
			'zoo'                     => __( 'Zoo', 'NearbyFacilities' ),
		);// end $types_array.
		include self::PLUGIN_DIR . 'html/about.phtml';
	} // end show_about_plugin.

	/**
	 * Func add_about_script
	 *
	 * @return void
	 */
	public static function add_about_script() {
		global $hook_suffix;
		if ( 'toplevel_page_NearbyFacilities' !== $hook_suffix ) {
			return;
		}
		$replace = array(
			'<%%addressInput%%>' => 'document.getElementById("addressInput").value',
			'<%%keywordInput%%>' => 'document.getElementById("keywordInput").value',
			'<%%radiusInput%%>'  => 'Number(document.getElementById("radiusInput").value)',
			'<%%typeInput%%>'    => 'document.getElementById("typeInput").value',
			'<%%zoomInput%%>'    => 'Number(document.getElementById("zoomInput").value)',
		);
		self::print_inline_script( 'shortcodeMap', $replace, true );
	}

	/**
	 * Func print_inline_script
	 *
	 * @param  string $map_id        Id of the div box that displays the map.
	 * @param  array  $replace_pairs An associative array of the replacement target and the replacement string.
	 * @param  bool   $is_admin      Flag that represents the output on the admin screen.
	 * @return void
	 */
	private function print_inline_script( string $map_id, array $replace_pairs, bool $is_admin = false ) {
		$api_key = get_option( self::PLUGIN_DB_PREFIX . 'api_key' );
		wp_enqueue_style( 'swiper', plugin_dir_url( __FILE__ ) . 'css/swiper.min.css', array(), true );
		wp_enqueue_style( 'nearbyfacilities', plugin_dir_url( __FILE__ ) . 'css/nearbyfacilities.css', array(), true );
		wp_enqueue_script( 'nearbyfacilities', plugin_dir_url( __FILE__ ) . 'js/nearbyfacilities.js', array(), true, false );
		require_once ABSPATH . 'wp-admin/includes/file.php';
		if ( WP_Filesystem() ) {
			global $wp_filesystem;
			$data = $wp_filesystem->get_contents( self::PLUGIN_DIR . 'js/inline-script.js' );
		}
		$data       = self::replace_default_value( $data, $map_id, $replace_pairs, $is_admin );
		$googleapis = 'https://maps.googleapis.com/maps/api/js?key=' . $api_key . '&libraries=places&callback=nearbyfacilities';
		wp_enqueue_script( 'google_maps_api', $googleapis, array(), true, true );
		wp_add_inline_script( 'google_maps_api', $data, 'befor' );
	}

	/**
	 * Func replace_default_value
	 *
	 * @param string $data          String data read from an external file.
	 * @param string $map_id        Id of the div box that displays the map.
	 * @param array  $replace_pairs An associative array of the replacement target and the replacement string.
	 * @param bool   $is_admin      Flag that represents the output on the admin screen.
	 * @return string A translation of the received data with the translation replaced.
	 */
	private function replace_default_value( string $data, string $map_id, array $replace_pairs, bool $is_admin = false ): string {
		$data        = preg_replace_callback(
			"/<%%\('(.*)'\)%%>/",
			function ( $match ) {
				return __( $match[1], 'NearbyFacilities' );
			},
			$data
		);
		$copy_notice = $is_admin ?
							'const copy_notice = \'' . __( 'Shortcode [%s] copied to clipboard.', 'NearbyFacilities' ) . '\'' :
							'';
		$replace_pairs['<%%user_locale%%>']  = substr( get_user_locale(), 0, 2 );
		$replace_pairs['<%%shortcodeMap%%>'] = $map_id;
		$replace_pairs['<%%copy_notice%%>']  = $copy_notice;
		$data        = strtr( $data, $replace_pairs );
		if ( $is_admin ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
			if ( WP_Filesystem() ) {
				global $wp_filesystem;
				$data .= $wp_filesystem->get_contents( self::PLUGIN_DIR . 'js/inline-admin.js' );
			}
		}
		return $data;
	}

	/**
	 * Func show_config_form
	 *
	 * @return void
	 */
	public function show_config_form() {
		$message = get_transient( self::COMPLETE_CONFIG );
		$api_key = get_option( self::PLUGIN_DB_PREFIX . 'api_key' );
		include self::PLUGIN_DIR . 'html/config-form.phtml';
	}

	/**
	 * Func nearbymap_shortcode
	 *
	 * @param  array $atts       shortcode attr.
	 * @return void
	 */
	public static function nearbymap_shortcode( array $atts ) {
		if ( is_page() || is_single() || is_singular() || is_front_page() || is_home() ) {
			self::execute_shortcode( $atts );
		}
	}

	/**
	 * Func execute_shortcode
	 *
	 * @param  array $atts       shortcode attr.
	 * @return void
	 */
	public static function execute_shortcode( array $atts ) {
		$default = array(
			'address'  => false,
			'width'    => '100%',
			'height'   => '300px',
			'zoom'     => 17,
			'type'     => false,
			'radius'   => 500,
			'keyword'  => '',
		);
		$atts    = shortcode_atts( $default, $atts );
		$map_id  = uniqid( 'NearbyFacilities_' );
		$replace_pairs = array(
			'<%%addressInput%%>' => '\'' . $atts['address'] . '\'',
			'<%%keywordInput%%>' => '\'' . $atts['keyword'] . '\'',
			'<%%radiusInput%%>'  => intVal( $atts['radius'] ),
			'<%%typeInput%%>'    => '[\'' . $atts['type'] . '\']',
			'<%%zoomInput%%>'    => intVal( $atts['zoom'] ),
		);
		self::print_inline_script( $map_id, $replace_pairs );
		include self::PLUGIN_DIR . 'html/nearbyfacilitiesmap.phtml';
	}

	/**
	 * Func save_config
	 *
	 * @return void
	 */
	public function save_config() {
		global $pagenow;
		if ( isset( $_POST[ self::CREDENTIAL_NAME ] ) && sanitize_text_field( wp_unslash( $_POST[ self::CREDENTIAL_NAME ] ) ) ) {
			if ( check_admin_referer( self::CREDENTIAL_ACTION, self::CREDENTIAL_NAME ) ) {
				$api_key_key = self::PLUGIN_DB_PREFIX . 'api_key';
				$api_key     = isset( $_POST['api_key'] ) ? sanitize_text_field( wp_unslash( $_POST['api_key'] ) ) : '';
				update_option( $api_key_key, $api_key );
				$completed_text = __( 'API key registration has been updated.', 'NearbyFacilities' );
				set_transient( self::COMPLETE_CONFIG, $completed_text, 5 );
				wp_safe_redirect( menu_page_url( self::CONFIG_MENU_SLUG, false ) );
			}
		}
	}

} // end of class

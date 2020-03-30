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
		add_submenu_page( 'NearbyFacilities', 'Config', 'Config', 'manage_options', 'NearbyFacilities-config', array( $this, 'show_config_form' ) );
	}

	/**
	 * Func show_about_plugin
	 *
	 * @return void
	 */
	public function show_about_plugin() {
		$api_key     = get_option( self::PLUGIN_DB_PREFIX . 'api_key' );
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
		);
		wp_admin_css_uri( 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/css/swiper.min.css' );
		include self::PLUGIN_DIR . 'html/about.phtml';
	}

	/**
	 * Func show_config_form
	 *
	 * @return void
	 */
	public function show_config_form() {
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
		global $post_type;
		if ( strpos( $_SERVER['REQUEST_URI'], 'action=edit' ) || strpos( $_SERVER['REQUEST_URI'], 'rest_route=' ) ) {
			return;
		}
		$default = array(
			'address'  => false,
			'width'    => '100%',
			'height'   => '300px',
			'zoom'     => 17,
			'type'     => false,
			'radius'   => 500,
			'keyword'  => '',
			'fRefresh' => false,
		);
		$atts    = shortcode_atts( $default, $atts );
		if ( $atts['address'] ) {
			$coordinates = self::get_coordinates( $atts['address'], $atts['fRefresh'] );
			if ( array_key_exists( 'error', $coordinates ) ) {
				return;
			}
			$map_id = uniqid( 'NearbyFacilities_' );
		}
		$api_key = get_option( self::PLUGIN_DB_PREFIX . 'api_key' );
		include self::PLUGIN_DIR . 'html/nearbyfacilitiesmap.phtml';
	}

	/**
	 * Func get_coordinates
	 *
	 * @param  string  $address       Address for geocoding.
	 * @param  boolean $force_refresh Refresh flag.
	 * @return array|null
	 */
	public static function get_coordinates( string $address, bool $force_refresh = false ): ?array {
		$address_hash = md5( $address );
		$coordinates  = get_option( self::PLUGIN_DB_PREFIX . '_' . $address_hash );
		if ( $force_refresh || false === $coordinates ) {
			$args     = array(
				'key'     => get_option( self::PLUGIN_DB_PREFIX . 'api_key' ),
				'address' => rawurlencode( $address ),
			);
			$url      = add_query_arg( $args, 'https://maps.googleapis.com/maps/api/geocode/json' );
			$response = wp_remote_get( $url );
			if ( is_wp_error( $response ) ) {
				return null;
			}
			$data = wp_remote_retrieve_body( $response );
			if ( is_wp_error( $data ) ) {
				return null;
			}
			if ( 200 === intval( $response['response']['code'] ) ) {
				$data = json_decode( $data );
				if ( 'ok' === strtolower( $data->status ) ) {
					$coordinates            = $data->results[0]->geometry->location;
					$cache_value['lat']     = $coordinates->lat;
					$cache_value['lng']     = $coordinates->lng;
					$cache_value['address'] = (string) $data->results[0]->formatted_address;
					update_option( self::PLUGIN_DB_PREFIX . '_' . $address_hash, $cache_value );
					$data = $cache_value;
				} else {
					return array( 'error' => __( 'Something went wrong while retrieving your map, please ensure you have entered the short code correctly.', 'NearbyFacilities' ) );
				}
			} else {
				return array( 'error' => __( 'Unable to contact Google API service.', 'NearbyFacilities' ) );
			}
		} else {
			$data = $coordinates;
		}
		return $data;
	}

	/**
	 * Func save_config
	 *
	 * @return void
	 */
	public function save_config() {
		if ( isset( $_POST[ self::CREDENTIAL_NAME ] ) && sanitize_text_field( wp_unslash( $_POST[ self::CREDENTIAL_NAME ] ) ) ) {
			if ( check_admin_referer( self::CREDENTIAL_ACTION, self::CREDENTIAL_NAME ) ) {
				$api_key_key = self::PLUGIN_DB_PREFIX . 'api_key';
				$api_key     = isset( $_POST['api_key'] ) ? sanitize_text_field( wp_unslash( $_POST['api_key'] ) ) : '';
				update_option( $api_key_key, $api_key );
				$completed_text = 'API key saved';
				set_transient( self::COMPLETE_CONFIG, $completed_text, 5 );
				wp_safe_redirect( menu_page_url( self::CONFIG_MENU_SLUG, false ), false );
			}
		}
	}

} // end of class

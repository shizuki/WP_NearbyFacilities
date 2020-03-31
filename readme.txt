=== WP_NearbyFacilities ===
Contributors:shizuki17xx
Tags: wp nearby facilities, Google map nearby places, google map, nearby places, wp google map, google map plugin, map
Requires at least: 4.6 or higher
Tested up to: 5.3.2
Requires PHP: 7.2
Stable tag:v1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Markers are displayed on the Google Map at the location specified by the short code and the surrounding facilities.
== Description ==
== Installation ==
1. Upload the plugin files to the `/wp-content/plugins` directory.
2. Activate the plugin through the ‘Plugins’ menu in WordPress
3. Write a shortcode like `[nearbyFacilities address="center address of map" type="type of search target" zoom="zoom level" radius="search radius"]` in the article
== Frequently Asked Questions ==
- What do I need to display the map?
    - Yes. To display a map using the Google Maps API, you need a Google Maps API key.
        Obtain the key by referring to the following pages, etc., and enable the three APIs of Geocoding API, Maps JavaScript API, Places API.
        [https://qiita.com/k2999/items/a9f41ea697a4f955ec1c]
- How do I get the shortcode to write ?
    1. Go to the setting screen from "Nearby Facilities-> Config" on the menu bar and enter your Google API key.
    1. Also enter the map setting screen in the "Nearby Facilities" menu and set the option values.
    1. Click "Submit" and a shortcode will appear in the text box below the map that reflects your options.
    1. Click the text box to copy the displayed shortcode to the clipboard, and paste it into the article.
        - In addition to the central address, type of search target, zoom level, search radius, the width and height of the box that displays the map can be specified using short codes. (Unit is `px` or`%`)
== Screenshots ==
== Changelog ==
== Upgrade Notice ==
== Arbitrary section ==

# WP_NearbyFacilities 
Markers are displayed on the Google Map at the location specified by the short code and the surrounding facilities.

### Installation
1. Upload the plugin files to the `/wp-content/plugins` directory.
2. Activate the plugin through the ‘Plugins’ menu in WordPress
3. Write a shortcode like `[nearbyFacilities address="center address of map" type="type of search target" zoom="zoom level" radius="search radius"]` in the article
### Usage
1. Go to the setting screen from "Nearby Facilities-> Config" on the menu bar and enter your Google API key.
2. Also enter the map setting screen in the "Nearby Facilities" menu and set the option values.
3. Click "Submit" and a shortcode will appear in the text box below the map that reflects your options.
4. Click the text box to copy the displayed shortcode to the clipboard, and paste it into the article.  
In addition to the central address, type of search target, zoom level, search radius, the width and height of the box that displays the map can be specified using shortcodes. (Unit is `px` or`%`)

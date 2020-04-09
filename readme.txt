=== WP_NearbyFacilities ===
Contributors:shizuki17xx
Tags: wp nearby facilities, Google map nearby places, google map, nearby places, wp google map, google map plugin, map, 周辺検索, 近くのお店, shizuki17xx, shizuki
Requires at least: 4.6 or higher
Tested up to: 5.4-ja
Requires PHP: 7.2
Stable tag:v1.0.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

ショートコードで指定した中心点とその周辺施設にマーカーを表示したGoogleMapを表示します。

Displays GoogleMap with markers at the center point specified by the shortcode and surrounding facilities.

== Description ==

中心点と検索対象を指定するだけで、中心点と検索対象のそれぞれにマーカーを表示するGoogleマップを表示するプラグインです。
使用を開始する前に、Google Maps PlatformでAPIキーを取得しておく必要があります。

It is a plug-in that displays a Google Map that displays markers at each of the center point and search target simply by specifying the center point and search target.
Before you begin, you need to have an API key on Google Maps Platform.

== Installation ==

1. `/wp-content/plugins`ディレクトリにプラグインのファイルをディレクトリごとアップロードします。
1. WordPressの「プラグイン」メニューからプラグインを有効化します。
1. 「NearbyFacilities -> 設定」メニューからAPIキーを登録します。
1. 投稿内にショートコードを書けばGoogle Mapが表示されます。
    例：[nearbyFacilities address="中心点の住所" type="検索対象の種類" zoom="ズームレベル" radius="検索半径"]

1. Upload the plugin file to the `/wp-content/plugins` directory.
1. Activate the plugin through the ‘Plugins’ menu in WordPress.
1. Register an API key from the "NearbyFacilities -> Settings" menu.
1. If you write a short code in the post, Google Map will be displayed.
    ex：[nearbyFacilities address="center address of map" type="type of search target" zoom="zoom level" radius="search radius"]

== Frequently Asked Questions ==

- 何か必要なものはありますか？
    - Google Maps PlatformでAPIキーを取得しておく必要があります。
        以下のサイトを参考にキーを取得して、Geocoding API、Maps JavaScript API、Places APIの３つを有効にしておきます。
        [https://qiita.com/k2999/items/a9f41ea697a4f955ec1c]

- What do I need to display the map?
    - Yes. To display a map using the Google Maps API, you need a Google Maps API key.

        Obtain the key by referring to the following pages, etc., and enable the three APIs of Geocoding API, Maps JavaScript API, Places API.
        [https://qiita.com/k2999/items/a9f41ea697a4f955ec1c]

- ショートコードを作成するにはどうすればよいですか？
    - APIキーを登録した後 `[nearbyFacilities address="中心点の住所" type="検索対象の種類" zoom="ズームレベル" radius="検索半径"]` の書式で書くことができます。
    - 以下の方法でにWebUIで生成することもできます。
        1. 「NearbyFacilities -> 設定」メニューからAPIキーを登録します。
        1. 「NearbyFacilities -> ショートコードの生成」メニューで各種パラメータを設定し、ショートコードを生成します。
        1. 「決定」ボタンクリックで最下部のテキストボックスに生成されたショートコードが入力されます。
        1. テキストボックスをクリックすると、自動的にクリップボードにコピーされるので、投稿の際に貼り付けてください。
        - WebUIにあるパラメーターの他に、ボックスの幅と高を指定することもできます(「px」または「%」)。

- How do I get the shortcode to write ?
    - After registering the API key, It can be written in the format of `[nearbyFacilities address="address of center point" type="type of search target" zoom="zoom level" radius="search radius"]` .
    - It can also be generated in WebUI in the following ways.
        1. Register an API key from the "NearbyFacilities -> Settings" menu.
        1. Set various parameters in the "NearbyFacilities-> Generate Shortcode" menu to generate a shortcode.
        1. Click the "Submit" button and the generated shortcode will be entered in the text box at the bottom.
        1. Clicking on the text box will automatically copy it to the clipboard, so paste it when posting.
        - In addition to the parameters found in the WebUI, you can also specify the width and height of the box ("px" or "%").

- 「address」に設定できるのは住所だけですか？
    - 住所がはっきりわからない場合は、Googleで検索できるのであれば建物名・施設名でも大丈夫です。

- Can only "address" be set for address?
    - If you do not know the address, you can use the building name or facility name if you can search on Google.

== Screenshots ==

1. ショートコード生成UIページ(Shortcode generation UI page)

== Changelog ==

= 1.0.3 =
- 重複していたサイドメニューの項目名を修正(Fixed duplicate side menu item names)
- readme.txtの修正(Modify readme.txt)
= 1.0.2 =
- 翻訳ファイル読み込みの関数をクラス内に収容(Contains translation file reading function in class)
= 1.0.1 =
- コーディングスタイルの修正(Modify coding style)
- 動作していないjavascriptの読み込みを抑制(Suppress loading of javascript that is not working)
= 1.0.0 =
- 公式申請前のバージョン。限定された環境でしか動かなかった(Version before official application. Only worked in a limited environment)

== Upgrade Notice ==

None.

== Arbitrary section ==

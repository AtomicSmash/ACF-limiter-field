=== Advanced Custom Fields: Limiter Field ===
Contributors: Atomic Smash
Tags: ACF, ACF5, ACF4, Advanced Custom Fields, Limiter, character number, word count
Requires at least: 4.9.7
Tested up to: 5.5.3
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides a textarea that limits the number of characters a user can add. The limit is cleanly represented by a jQuery UI progress bar.

== Description ==

This plugin provides an Advanced Custom Field textarea that limits the number of characters a user can add. The limit is cleanly represented by a jQuery Ui progress bar. You can define the number of characters on a per field basis.

= Compatibility =

This ACF field type is compatible with:
*   ACF 5
*   ACF 4

This has been tested in:

*   ACF - Repeater fields
*   ACF - Flexible content fields
*   ACF - Option pages

== Installation ==

1. Copy the `acf-limiter` folder into your `wp-content/plugins` folder
2. Activate the Limiter plugin via the plugins admin page
3. Create a new field via ACF and select the Limiter type
4. Read the description above for usage instructions

== Changelog ==

= 1.3.0 =
* Restructured plugin
* Fixed bug affecting field loading
* Removed support for ACF3

= 1.2.1 =
* Added composer.json

= 1.2.0 =
* Fixed deprecated jQuery method due to WP 5.5.0 update

= 1.1.1 =
* Small update to loaders

= 1.1.0 =
* Updated plugin to work with ACF 5

= 1.0.6 =
* Removed broken image links

= 1.0.5 =
* Adding empty var fix

= 1.0.4 =
* Bug fixes with jQuery UI

= 1.0.3 =
* Added character overlay

= 1.0.2 =
* Added V3 support

= 1.0.1 =
* Initial release

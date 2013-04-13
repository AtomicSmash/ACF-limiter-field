=== Advanced Custom Fields: Limiter Field ===
Contributors: Atomic Smash
Tags: 
Requires at least: 3.4
Tested up to: 3.3.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This field provides a textarea that limits the number of characters the a user can add. The limit is cleanly represented by a jQuery Ui progress bar. You can define the number of characters on a per field basis.


= Compatibility =

This add-on will work with:

* version 4 and up

== Installation ==

This add-on can be treated as both a WP plugin and a theme include.

= Plugin =
1. Copy the folder into your plugins folder
2. Activate the plugin via the Plugins admin page

= Include =
1.	Copy the folder into your theme folder (can use sub folders). You can place the folder anywhere inside the 'wp-content' directory
2.	Edit your functions.php file and add the code below (Make sure the path is correct to include the acf-limiter.php file)

`
add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
	include_once('path-to-plugin/acf-limiter.php');
}
`

== Changelog ==

= 0.0.1 =
* Initial Release.
=== Launch Checklist ===
Contributors: kanopi
Tags: launch, pre-launch, checklist
Requires at least: 5.0
Tested up to: 5.9
Stable tag: 1.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

WordPress plugin that allows for creation of interactive site launch checklist items.

== Description ==

When launching your site there are usually a series of things you do before you "go live" to validate your site is ready to go. This plugin provides an interface for managing that checklist through the Wordpress UI.

== Frequently Asked Questions ==

= I have an issue, where can I submit it? =

Kanopi uses Github for it's code management for the this plugin, please submit an issue there https://github.com/kanopi/wp-launch-checklist/issues

= How can I extended the checklist to included the things specific to my project? =

You can modify `checklist_items.php` to contain the items you need.  If you are using Composer to manage your codebase you can also [composer-patches](https://github.com/cweagans/composer-patches) to add those extra settings without having to modify the plugin files manually.

== Screenshots ==

1. The user interface for checking off items prior to launch.

== Changelog ==

= 1.0 =
* Initial release.

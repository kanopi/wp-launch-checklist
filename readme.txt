=== Launch Checklist ===
Contributors: kanopi
Tags: launch, pre-launch, checklist
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.4
Requires PHP: 8.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

WordPress plugin that allows for creation of interactive site launch checklist items.

== Description ==

When launching your site there are usually a series of things you do before you "go live" to validate your site is ready to go. This plugin provides an interface for managing that checklist through the Wordpress UI.

The plugin integrates with [The A11Y Project](https://github.com/a11yproject/a11yproject.com) and will pull a list of current accessibility tests to check against. The way to add those extra items is through the settings page for the plugin. This feature uses the [jsdelivr](https://www.jsdelivr.com/) service for fetching the data.  You must agree to the [jsdelivr terms](https://www.jsdelivr.com/terms) to use that feature.

== Frequently Asked Questions ==

= I have an issue, where can I submit it? =

Kanopi uses Github for it's code management for the this plugin, please submit an issue there https://github.com/kanopi/wp-launch-checklist/issues

= How can I extended the checklist to included the things specific to my project? =

You can modify `checklist_items.php` to contain the items you need.  If you are using Composer to manage your codebase you can also [composer-patches](https://github.com/cweagans/composer-patches) to add those extra settings without having to modify the plugin files manually.

== Screenshots ==

1. The user interface for checking off items prior to launch.
2. Button showing how to get current checklist items from "The A11Y Project"

== Changelog ==

= 1.0.4 =
* Add checklist item requested in #11 for Pantheon HTTPS check.

= 1.0.3 =
* Test against WordPress 6.4
* Fix #10. Fatal error caused when attempting to save checklist settings with no values checked.

= 1.0.2 =
* Test against WordPress 6.0
* Add icon
* Fix #8. Thank you BarryHughes

= 1.0.0 =
* Initial release.

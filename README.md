# WordPress Launch Checklist Plugin

WordPress plugin that allows for creation of interactive site launch checklist items.

## Installation
Download the plugin into a WordPress installation at `/wp-content/plugins/`, and do one of the following...
* In the terminal, cd into the project and run `wp plugin activate launch-checklist`
* Visit the WP admin plugin page and activate the plugin manually.

More info: https://wordpress.org/support/article/managing-plugins/#installing-plugins

## Features
This plugin gives you the ability to check off items related to launching a site and provides feedback as to progress.
* Checklist items are created from two sources:
  * The `/config/checklist_settings.php` array.
    * Add new items to this array as needed. They will automatically get picked up and displayed.
    * Ensure for each item in the `tasks` array the `name` makes sense and is not duplicated as these are used in field output and corresponding data storage. 
  * API call to a WCAG endpoint to obtain accessibility checklist items (these are combined with the accessibility section from the file above).
    * Results of the API call are cached via the [WP Transients API](https://developer.wordpress.org/apis/handbook/transients/) for 30 days by default, but can be refreshed manually using the button on the settings page.
* There are currently two options pages:
  * Launch Checklist Page --`/wp-admin/admin.php?page=wp_launch_checklist`, broken down into groups by tabs.
    * Settings stored in `wp_options` under `wp_launch_checklist_values`.
  * Launch Checklist Settings Page -- `/wp-admin/admin.php?page=wp_launch_checklist_settings`.
    * Settings stored in `wp_options` under `wp_launch_checklist_settings`.

## How to Use
* Visit the Plugin Checklist menu on the left side of the WordPress admin.
* Visit the `Launch Checklist` page to check off items as you complete them before site launch.
* Visit the `Settings` page above to control plugin settings.

## Development/Contributions
* This plugin is based on the [WordPress Plugin Boilerplate](https://wppb.me/), but is decently modified.
* Plugin class loading by classmap. Run `composer dump-autoload -o` when adding and/or removing classes. See `composer.json`.
* The form fields output on each plugin page are loaded from `/admin/partials/form-fields`.
  * The main checklist page uses the `checkbox-checklist-items.php` partial.
  * The settings page uses the main `checkbox.php` partial for checkboxes due to a different layout.
  * A select field and a text field types are also present for use.
  * Add additional field types as needed.
	
## Deployment

This plugin is maintained on Github but uses the [Wordpress Plugin Deploy Action](https://github.com/marketplace/actions/wordpress-plugin-deploy) to push tags to the WordPress SVN plugin repository.

To do a release make sure you update the files `readme.txt` and `wp-launch-checklist.php` to have the next correct stable tag  

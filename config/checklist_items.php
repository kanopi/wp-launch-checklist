<?php

/**
 * Checklist items organized by group.
 */
return [
	[
		'group_name'       => __( 'General Settings', 'kanopi' ),
		'group_slug' => 'general',
		'description' => __( 'General settings for the site.', 'kanopi' ),
		'tasks'       => [
			[
				'name'        => 'site_admin_email',
				'label'       => 'Site admin email',
				'description' => 'The from address in automated emails sent during registration and new password requests, and other notifications',
			],
			[
				'name'        => 'site_information_name',
				'label'       => 'Verify the site title tag is correct',
				'description' => 'Make sure the Site name field is correct.',
			],
			[
				'name'        => 'favicon',
				'label'       => 'Favicon',
				'description' => 'Verify Favicon is correct.',
			],
		],
	],
	[
		'group_name'       => __( 'Browser Checks', 'kanopi' ),
		'group_slug'       => 'browser_checks',
		'description' => __( 'Verify the look and functionality across devices.', 'kanopi' ),
		'tasks'       => [
			[
				'name'        => 'desktop_browser',
				'label'       => 'Desktop browser',
				'description' => 'Verify the site looks and behaves as expected on Desktop.',
			],
			[
				'name'        => 'mobile_browser',
				'label'       => 'Mobile browser',
				'description' => 'Verify the site looks and behaves as expected on Mobile.',
			],
		],
	],
	[
		'group_name'       => __( 'Forms', 'kanopi' ),
		'group_slug'       => 'forms',
		'description' => __( 'Verify forms work as expected.', 'kanopi' ),
		'tasks'       => [
			[
				'name'        => 'email',
				'label'       => 'Form emails',
				'description' => 'Check all web forms for recipient email and test.',
			],
			[
				'name'        => 'confirmation',
				'label'       => 'Form confirmation',
				'description' => 'Check all web forms for thank you message',
			],
			[
				'name'        => 'spam',
				'label'       => 'Form spam',
				'description' => 'Ensure Spam prevention measures are in place.',
			],
		],
	],
	[
		'group_name'       => __( 'SEO', 'kanopi' ),
		'group_slug'       => 'seo',
		'description' => __( 'SEO settings for the site.', 'kanopi' ),
		'tasks'       => [
			[
				'name'        => 'analytics',
				'label'       => 'Analytics',
				'description' => 'Verify Google Analytics or similar is installed and correct access has been given.',
			],
			[
				'name'        => 'seo_plugin',
				'label'       => 'Install WordPress SEO plugin',
				'description' => 'Install and configure the WordPress SEO plugin (or equivalent).',
			],
			[
				'name'        => 'xml_sitemap',
				'label'       => 'XML Sitemap',
				'description' => 'Check that the XML sitemap module is enabled and a sitemap has been created.',
			],
			[
				'name'        => 'title_meta_tags',
				'label'       => 'Title meta tags',
				'description' => 'Ensure that page titles and meta tags are set up.',
			],
			[
				'name'        => 'schema_settings',
				'label'       => 'Schema settings',
				'description' => 'Ensure that the schema.org settings are complete for all content types.',
			],
			[
				'name'        => 'redirect',
				'label'       => 'Redirects',
				'description' => 'Make sure any redirects are in place and that the proper plugin is installed to assist with this.',
			],
			[
				'name'        => 'rewrite_rules',
				'label'       => 'Rewrite rules',
				'description' => 'Verify that rewrite rules (Apache, nginx, or host settings) force all traffic to https and www or non-www.',
			],
			[
				'name'        => 'rewrite_rules_alt',
				'label'       => 'Alternative rewrite rules',
				'description' => 'Verify that rewrite rules (Apache, nginx, or host settings) force any temporary / alternate urls (eg. wwww.<site-name>.com) to the primary url.',
			],
		],
	],
	[
		'group_name'       => __( 'User Permissions', 'kanopi' ),
		'group_slug'       => 'user_permissions',
		'description' => __( 'User Permission settings for the site.', 'kanopi' ),
		'tasks'       => [
			[
				'name'        => 'admin_users',
				'label'       => 'Admin users',
				'description' => 'Ensure that there is a kanopi admin user account present (or super admin if multisite).',
			],
			[
				'name'        => 'relevant_roles',
				'label'       => 'Relevant roles',
				'description' => 'Ensure all (relevant) roles have the ability to login and logout.',
			],
			[
				'name'        => 'all_user_permissions',
				'label'       => 'User permissions',
				'description' => 'Check all user permissions and ensure all roles have relevant permissions.',
			],
			[
				'name'        => 'user_sign_up_settings',
				'label'       => 'User sign up settings',
				'description' => 'Check user sign up settings and ensure users cannot sign up without approval.',
			],
		],
	],
	[
		'group_name'       => __( 'Content', 'kanopi' ),
		'group_slug'       => 'content',
		'description' => __( 'Content settings for the site.', 'kanopi' ),
		'tasks'       => [
			[
				'name'        => 'content_redirects',
				'label'       => 'Content redirects',
				'description' => 'Ensure that content redirects are in place.',
			],
			[
				'name'        => 'user_roles_content',
				'label'       => 'User Roles and Content Creation',
				'description' => 'Sign in as each user role and check that they are able to create the content that they need to.',
			],
			[
				'name'        => 'search_replace',
				'label'       => 'Search and Replace Testbed URLs',
				'description' => 'Do a global search of the database for any testbed URLs in the content (eg. dev.<domain-name>.com) and replace with the real domain name.',
			],
		],
	],
	[
		'group_name'       => __( 'GDPR and Privacy', 'kanopi' ),
		'group_slug'       => 'gdpr_privacy',
		'description' => __( 'GDPR and Privacy settings for the site.', 'kanopi' ),
		'tasks'       => [
			[
				'name'        => 'approved_language_notification',
				'label'       => 'Approved Langauge Notification',
				'description' => 'Include the approved language in the notification window.',
			],
			[
				'name'        => 'privacy_policy',
				'label'       => 'Privacy Policy',
				'description' => 'Make sure a Privacy Policy page exists and that there is a link to it.',
			],
			[
				'name'        => 'privacy_policy_cookies',
				'label'       => 'Privacy Policy Cookies',
				'description' => 'Ensure the privacy policy accurately specifies the cookies that the site serves.',
			],
			[
				'name'        => 'gdpr_testing',
				'label'       => 'GDPR Testing',
				'description' => 'Perform GDPR testing on the final hosting solution.',
			],
		],
	],
	[
		'group_name'       => __( 'Performance and Security', 'kanopi' ),
		'group_slug'       => 'performance_security',
		'description' => __( 'Performance and Security settings for the site.', 'kanopi' ),
		'tasks'       => [
			[
				'name'        => 'page_caching',
				'label'       => 'Page caching',
				'description' => 'Ensure that page caching is enabled.',
			],
			[
				'name'        => 'css_aggregation',
				'label'       => 'CSS Aggregation and Compression',
				'description' => 'Ensure that CSS aggregation and compression is in place.',
			],
			[
				'name'        => 'js_aggregation',
				'label'       => 'JS aggregation',
				'description' => 'Ensure that JS aggregation and compression is in place.',
			],
			[
				'name'        => 'unused_plugins',
				'label'       => 'Unused plugins',
				'description' => 'Ensure that all unused plugins are deactivated first, then deleted.',
			],
			[
				'name'        => 'security_plugin',
				'label'       => 'Security plugin',
				'description' => "Ensure that the site's hosting plan has basic WordPress security in place or that a plugin like iThemes Security or Sucuri is installed.",
			],
			[
				'name'        => 'security_plugin_config',
				'label'       => 'Security plugin configuration',
				'description' => 'Ensure that any security plugins needed are activated and configured correctly.',
			],
			[
				'name'        => 'admin_accounts',
				'label'       => 'Proper number of administrator accounts',
				'description' => 'Ensure that there are only the amount of administrator accounts needed to manage the site. Possibly downgrade or remove those not needed.',
			],
		],
	],
	[
		'group_name'       => __( 'Database', 'kanopi' ),
		'group_slug'       => 'database',
		'description' => __( 'Database settings for the site.', 'kanopi' ),
		'tasks'       => [
			[
				'name'        => 'backups',
				'label'       => 'Database backups',
				'description' => 'Ensure that the database is being backed up routinely, either through the host or otherwise. Daily preferred. Most WP hosts handle this, but ensure that some method is present.',
			],
		],
	],
	[
		'group_name'       => __( 'Theme', 'kanopi' ),
		'group_slug'       => 'theme',
		'description' => __( 'Theme settings for the site.', 'kanopi' ),
		'tasks'       => [
			[
				'name'        => 'responsive_design',
				'label'       => 'Responsive Design',
				'description' => 'For responsive designs, check that the theme is responding properly at all resolutions and orientations, and that there are no visual issues.',
			],
			[
				'name'        => 'custom_js',
				'label'       => 'Custom Javascript',
				'description' => 'If there are any custom JS files in the theme verify if they should be added to every page.',
			],
			[
				'name'        => 'theme_structure',
				'label'       => 'Theme Structure',
				'description' => 'Make sure the theme is well structured and that there are no unused image/css/js files present.',
			],
			[
				'name'        => 'theme_child',
				'label'       => 'Child theme',
				'description' => 'Make sure that any customizations to a purchased theme are set up in a child theme.',
			],
		],
	],
	[
		'group_name'       => __( 'Accessibility Overview', 'kanopi' ),
		'group_slug'       => 'accessibility_overview',
		'description' => __( 'Accessibility settings for the site.', 'kanopi' ),
		'tasks'       => [
			[
				'name'        => 'lighthouse',
				'label'       => 'Lighthouse Audit',
				'description' => 'Running a Google Lighthouse test on your homepage and primary templates will help complete the other sections of this list.',
			],
			[
				'name'        => 'screaming_frog',
				'label'       => 'Screaming Frog Audit',
				'description' => 'Running a Screaming Frog Audit on your site will help complete the other sections of this list.',
			],
			[
				'name'        => 'accessibility_checker',
				'label'       => 'Accessibility Checker',
				'description' => 'Run an accessibility checker, such as WAVE or Axe, to check for any outstanding accessibility issues.',
			],
			[
				'name'        => 'alt_tags',
				'label'       => 'Image alt tags',
				'description' => 'Ensure that all images have alt tags.',
			],
			[
				'name'        => 'color_contrast',
				'label'       => 'Color contrast',
				'description' => 'Ensure that colors have the proper contrast to meet accessibility requirements.',
			],
			[
				'name'        => 'links',
				'label'       => 'Links',
				'description' => 'Make sure links are specific to what will happen when clicked (ie: "Read More" and "Click Here" are too vague)',
			],
			[
				'name'        => 'headings',
				'label'       => 'Headings',
				'description' => 'Ensure headings are properly assigned.',
			],
			[
				'name'        => 'accessibility_checklist',
				'label'       => 'Accessibility checklist',
				'description' => 'For a more comprehensive accessibility check, review the items from the A11y Project Checklist on the "Accessibility" tab.',
			],
		],
	],
	[
		'group_name'       => __( 'Miscellaneous', 'kanopi' ),
		'group_slug'       => 'miscellaneous',
		'description' => __( 'Miscellaneous settings for the site.', 'kanopi' ),
		'tasks'       => [
			[
				'name'        => 'dns_ttl',
				'label'       => '',
				'description' => '',
			],
			[
				'name'        => 'site_email',
				'label'       => '',
				'description' => '',
			],
			[
				'name'        => 'cron_jobs',
				'label'       => 'Cron jobs',
				'description' => 'Ensure that any necessary CRON jobs are running successfully.',
			],
			[
				'name'        => 'site_health',
				'label'       => 'Site health',
				'description' => 'Ensure that any issues on the WP admin site health page are resolved.',
			],
			[
				'name'        => 'logging_reporting',
				'label'       => 'Logging and Error Reporting',
				'description' => 'Check the Logging and Error Reporting setting and set them to not display any errors or warnings on the site. Errors should only be logged in watchdog on production sites.',
			],
		],
	],
];

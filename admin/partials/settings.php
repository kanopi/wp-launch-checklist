<div class="wrap">
	<form class="<?php echo esc_attr( KANOPI_LAUNCH_CHECKLIST_SLUG ); ?>" action='options.php' method='post'>
		<h1><?php esc_html_e( 'Site Launch Checklist Settings', 'kanopi' );  ?></h1>
		<h2>@TODOs...</h2>
		<ul>
			<li>Right now there's no way to refresh the config array if new items are added after activation unless the plugin is activated and the "kanopi_launch_checklist_config" option in the wp_option table is removed manually.</li>
			<li>There should be an option to remove the above options entry as well as the checklist values (kanopi_launch_checklist_values) from the db durind plugin deactivation. Should be unchecked by default (keep them in case the plugin is reactivated).</li>
			<li>Any additional cleanup during activation/deactivation.</li>
			<li>Tabs now anchor to via hashes on page refresh, but look into hooks with wp_redirect() to see if you can redirect back to a tab hash on checklist save submission. If not, then tabs will probably just need to be broken out in to separate pages with a global nav tab links implementation, or some other solution. </li>
			<li>See <a href="https://kanopi.teamwork.com/#/tasks/26889630">this Teamwork Task</a> for additional requests.</li>
		</ul>
		<?php
		do_settings_sections( KANOPI_LAUNCH_CHECKLIST_SLUG . '_settings' );
		settings_fields( KANOPI_LAUNCH_CHECKLIST_SLUG . '_settings' );
		submit_button();
		?>
	</form>
</div>

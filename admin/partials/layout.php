<div class="wrap">
	<form class="<?php echo esc_attr( KANOPI_LAUNCH_CHECKLIST_SLUG ); ?>" action='options.php' method='post'>
		<h1><?php esc_html_e( 'Website Launch Checklist', 'kanopi' );  ?></h1>
		<?php
		echo load_template( KANOPI_LAUNCH_CHECKLIST_ROOT . 'admin/partials/settings-section.php' );
		do_settings_sections( KANOPI_LAUNCH_CHECKLIST_SLUG );
		settings_fields( KANOPI_LAUNCH_CHECKLIST_SLUG );
		submit_button();
		?>
	</form>
</div>

<div class="wrap">
	<form class="<?php echo esc_attr( KANOPI_LAUNCH_CHECKLIST_SLUG ); ?>_settings" action="options.php" method='POST'>
		<h1><?php esc_html_e( 'Site Launch Checklist Settings', 'kanopi' );  ?></h1>
		<?php
		do_settings_sections( KANOPI_LAUNCH_CHECKLIST_SLUG . '_settings' );
		settings_fields( KANOPI_LAUNCH_CHECKLIST_SLUG . '_settings' );
		submit_button();
		?>
	</form>
</div>

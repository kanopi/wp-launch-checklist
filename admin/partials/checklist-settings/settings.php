<div class="wrap">
	<?php settings_errors(); // @TODO: figure out if we can tie in checklist items refresh message to this. ?>
	<form class="<?php echo esc_attr( KANOPI_LAUNCH_CHECKLIST_SLUG ); ?>_settings" action="options.php" method='POST'>
		<h1><?php esc_html_e( 'Site Launch Checklist Settings', 'kanopi' );  ?></h1>
		<?php
		do_settings_sections( KANOPI_LAUNCH_CHECKLIST_SLUG . '_settings' );
		settings_fields( KANOPI_LAUNCH_CHECKLIST_SLUG . '_settings' );
		submit_button();
		?>
	</form>

	<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST" class="checklist-reset">
		<h2><?php _e( 'Refresh WCAG Checklist Items', 'kanopi' ); ?></h2>
		<p>
			<?php _e( 'Clicking this button will refresh the WCAG accessibility settings from its API. These are normally cached for one month.', 'kanopi' ); ?>
		</p>
		<?php wp_nonce_field( 'refresh_checklist_items', 'refresh_checklist_items' ); ?>
		<input name="action" type="hidden" value="refresh_checklist_items">
		<?php submit_button( __( 'Refresh Checklist Items' ) ); ?>
	</form>
</div>

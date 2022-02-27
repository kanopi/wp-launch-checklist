<div class="wrap">
	<form class="<?php echo esc_attr( KANOPI_LAUNCH_CHECKLIST_SLUG ); ?>" action="options.php" method="POST">
		<h1><?php esc_html_e( 'Site Launch Checklist', 'kanopi' );  ?></h1>
		<?php
		echo load_template( KANOPI_LAUNCH_CHECKLIST_ROOT . 'admin/partials/checklist-items/settings-section.php' );
		$this->do_checklist_settings_sections( KANOPI_LAUNCH_CHECKLIST_SLUG );
		settings_fields( KANOPI_LAUNCH_CHECKLIST_SLUG );
		submit_button();
		?>
	</form>
</div>

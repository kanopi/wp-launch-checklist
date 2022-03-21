<div class="wrap">
	<?php settings_errors(); ?>
	<form class="<?php echo esc_attr( WP_LAUNCH_CHECKLIST_SLUG ); ?>" action="options.php" method="POST">
		<h1><?php esc_html_e( 'Site Launch Checklist', WP_LAUNCH_CHECKLIST_SLUG );  ?></h1>
		<?php
		echo load_template( WP_LAUNCH_CHECKLIST_ROOT . 'admin/partials/checklist-items/settings-section.php' );
		submit_button();
		$this->do_checklist_settings_sections( WP_LAUNCH_CHECKLIST_SLUG );
		settings_fields( WP_LAUNCH_CHECKLIST_SLUG );
		submit_button();
		?>
	</form>
</div>

<div class="wrap">
	<form action='options.php' method='post'>
		<h1><?php esc_html_e( 'Launch Checklist', 'kanopi' );  ?></h1>
		<?php
		$this->do_settings_sections_fields( KANOPI_LAUNCH_CHECKLIST_SLUG );
		settings_fields( KANOPI_LAUNCH_CHECKLIST_SLUG );
		submit_button();
		?>
	</form>
</div>

<?php namespace WpLaunchChecklist\Launch_Checklist; ?>

<div class="progress">
	<input id="progress-summary" type="range" min="0" max="100" value="<?php echo esc_attr( get_wp_launch_checklist_percent_complete() ); ?>" disabled="disabled">
	<label for="progress-summary">
		<?php echo wp_kses_post( launch_checklist_percent_complete_overview() ); ?>
	</label>
</div>

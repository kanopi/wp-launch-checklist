<div class="progress">
	<input id="progress-summary" type="range" min="0" value="12">
	<label for="progress-summary">Completed: <span class="num-checked">x</span> of <span class="total-checklist-items">y</span> (<span class="percent-complete"><?php echo absint( get_kanopi_launch_checklist_percent_complete() ); ?></span>%)</label>
</div>

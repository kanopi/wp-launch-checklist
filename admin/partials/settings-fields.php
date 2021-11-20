<label for="<?php echo esc_attr( $args['name'] ); ?>">
	<input
		id="<?php echo esc_attr( $args['name'] ); ?>"
		type="checkbox"
		name="<?php echo esc_attr( KANOPI_LAUNCH_CHECKLIST_SLUG . '_values[' . $args['name'] . ']' ); ?>"
		value="1"
		<?php checked( 1, get_kanopi_launch_checklist_option( $args['name'] ) ); ?>
	>
	<?php echo esc_html( $args['label'] ); ?>
</label>
<p><?php echo esc_html( $args['description'] ); ?></p>

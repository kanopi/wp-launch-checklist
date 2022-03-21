<?php namespace WpLaunchChecklist\Launch_Checklist; ?>

<label for="<?php echo esc_attr( $args['name'] ); ?>">
	<input
		id="<?php echo esc_attr( $args['name'] ); ?>"
		type="checkbox"
		name="<?php echo esc_attr( WP_LAUNCH_CHECKLIST_SLUG . '_values[' . $args['name'] . ']' ); ?>"
		value="1"
		<?php checked( 1, get_wp_launch_checklist_option( $args['name'] ) ); ?>
	>
	<?php echo wp_kses_post( $args['label'] ); ?>
</label>
<?php if ( ! empty( $args['description'] ) ) : ?>
	<p><?php echo wp_kses_post( $args['description'] ); ?></p>
<?php endif; ?>

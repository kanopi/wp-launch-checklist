<?php namespace WpLaunchChecklist\Launch_Checklist; ?>

<?php if ( isset( $args['label'] ) ) : ?>
	<label for="<?php echo esc_attr( $args['name'] ); ?>">
		<?php echo wp_kses_post( $args['label'] ); ?>
	</label>
<?php endif; ?>

<input
	id="<?php echo esc_attr( $args['name'] ); ?>"
	type="text"
	name="<?php echo esc_attr( WP_LAUNCH_CHECKLIST_SLUG . '_settings[' . $args['name'] . ']' ); ?>"
	value="<?php echo $args['value'] ?? ''; ?>"
>

<?php if ( ! empty( $args['description'] ) ) : ?>
	<p><?php echo wp_kses_post( $args['description'] ); ?></p>
<?php endif; ?>

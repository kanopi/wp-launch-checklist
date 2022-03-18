<?php namespace WpLaunchChecklist\Launch_Checklist; ?>

<input
	id="<?php echo esc_attr( $args['name'] ); ?>"
	type="checkbox"
	name="<?php echo esc_attr( WP_LAUNCH_CHECKLIST_SLUG . '_settings[' . $args['name'] . ']' ); ?>"
	value="1"
	<?php checked( isset( $args['value'] ) && 1 === (int) $args['value'] ); ?>
>

<?php if ( isset( $args['label'] ) ) : ?>
	<label for="<?php echo esc_attr( $args['name'] ); ?>">
		<?php echo wp_kses_post( $args['label'] ); ?>
	</label>
<?php endif; ?>

<?php if ( ! empty( $args['description'] ) ) : ?>
	<p><?php echo wp_kses_post( $args['description'] ); ?></p>
<?php endif; ?>

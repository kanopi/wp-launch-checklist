<?php namespace WpLaunchChecklist\Launch_Checklist; ?>

<?php if ( isset( $args['label'] ) ) : ?>
	<label for="<?php echo esc_attr( $args['name'] ); ?>">
		<?php echo wp_kses_post( $args['label'] ); ?>
	</label>
<?php endif; ?>

<select id="<?php echo esc_attr( $args['name'] ); ?>" name="<?php echo esc_attr( WP_LAUNCH_CHECKLIST_SLUG . '_settings[' . $args['name'] . ']' ); ?>">
	<?php foreach( $args['options'] as $value => $label ) : ?>
		<option value="<?php echo esc_attr( $value ); ?>" <?php selected( isset( $args['value'] ) && $value === $args['value'] ); ?>>
			<?php echo esc_html( $label ); ?>
		</option>
	<?php endforeach; ?>
</select>

<?php if ( ! empty( $args['description'] ) ) : ?>
	<p><?php echo wp_kses_post( $args['description'] ); ?></p>
<?php endif; ?>

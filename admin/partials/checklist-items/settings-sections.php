<div class="checklist-settings-wrapper">
	<?php
	global $wp_settings_sections, $wp_settings_fields;

	if ( ! isset( $wp_settings_sections[ $args['page'] ] ) ) {
		return;
	}
	?>

	<div class="checklist-settings-sections-tabs">
		<?php
		$i = 0;
		foreach ( (array) $wp_settings_sections[ $args['page'] ] as $section ) {
			if ( $section['title'] ) {
				$class = ( 0 === $i ) ? 'active' : '';
				?>
				<a href="#<?php echo esc_attr( sanitize_title( $section['title'] ) ); ?>" class="<?php echo esc_attr( $class ); ?>" role="tab">
					<?php echo esc_html( $section['title'] ); ?>
				</a>
				<?php
			}
			$i++;
		}
		?>
	</div>
	<div class="checklist-settings-sections">
		<?php
		$i = 0;
		foreach ( (array) $wp_settings_sections[ $args['page'] ] as $section ) {
			if ( $section['callback'] ) {
				call_user_func( $section['callback'], $section );
			}

			if ( ! isset( $wp_settings_fields ) || ! isset( $wp_settings_fields[ $args['page'] ] ) || ! isset( $wp_settings_fields[ $args['page'] ][ sanitize_title( $section['title'] ) ] ) ) {
				continue;
			}

			$class = ( 0 === $i ) ? ' active' : '';
			?>

			<div id="<?php echo esc_attr( sanitize_title( $section['title'] ) ); ?>" class="checklist-settings-section<?php echo esc_attr( $class ); ?>">
				<h2>
					<?php echo esc_html( $section['title'] ); ?>
				</h2>
				<?php $args['options_page']->do_checklist_settings_fields( $args['page'], sanitize_title( $section['title'] ) ); ?>
			</div>

			<?php $i++;
		}
		?>
	</div>
</div>

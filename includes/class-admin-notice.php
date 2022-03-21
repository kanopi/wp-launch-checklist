<?php

namespace WpLaunchChecklist\Launch_Checklist;

/**
 * Class Admin_Notices.
 *
 * Display admin notices.
 */
class Admin_Notice {

	/**
	 * The notice text.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public $notice;

	/**
	 * The message type (error, warning, success, etc.).
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public $type;

	/**
	 * Constructor.
	 *
	 * @param string $notice The notice text.
	 * @param string $type   The message type.
	 *
	 * @since 1.0.0
	 */
	public function __construct( string $notice, string $type = 'error' ) {
		$this->notice = $notice;
		$this->type   = $type;
		$this->display_notice();
	}

	/**
	 * The displayed notice HTML/message.
	 *
	 * @since 1.0.0
	 */
	public function display_notice() {
		?>
		<div class="notice notice-<?php echo esc_attr( $this->type ); ?> is-dismissible">
			<p><?php esc_html_e( sprintf( '%s', $this->notice ), WP_LAUNCH_CHECKLIST_SLUG ); ?></p>
		</div>
		<?php
	}

}

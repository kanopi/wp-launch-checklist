(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$( function () {
		$( '.checklist-settings-sections-tabs a' ).on( 'click', function ( e ) {
			e.preventDefault();

			let $this   = $( this );
			let $target = $this.attr( 'href' ).replace( '#', '' );
			console.log( $target );

			$this
				.parent()
				.find( 'a' )
				.removeClass( 'active' )

			$( '.checklist-settings-section' )
				.removeClass( 'active' )
				.filter( function () {
					return $target === $(this).attr( 'id' );
				} )
				.addClass( 'active' );

			$this.addClass( 'active' );

		} );
	} );

})( jQuery );

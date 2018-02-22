/**
 * MTI
 * Add Search Widget Js
 *
 * @package adforest
 */

(function ( $ ) {
	var adSearchWidget = {
		/**
		 * The init function.
		 */
		init: function () {
			adSearchWidget.registerEvents();
		},

		registerEvents: function () {
			$( '.adforest-panel-heading .panel-title' ).on( 'click', adSearchWidget.toggleDisplayWidgetContent );
		},

		/**
		 *
		 * @param event
		 */
		toggleDisplayWidgetContent: function ( event ) {
			contentClassName = '.' + event.target.parentElement.getAttribute( 'data-ad-content' );
			$( contentClassName ).slideToggle( 'adforest-display' ).slow();
		}
	};

	adSearchWidget.init();
})( jQuery );
/**
 * Functionality specific to TypeNow.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */

/**
 * Add Menu Toggle.
 */
(function( $ ) {
    var masthead, menuToggle, siteNavContain, siteNavigation;

    masthead       = $( '#masthead' );
    menuToggle     = masthead.find( '.menu-toggle' );
    siteNavContain = masthead.find( '.main-navigation' );

    // Enables menu toggle for small screens.
    (function() {

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

        // Add an initial value for the attribute.
		menuToggle.attr( 'aria-expanded', 'false' );

        menuToggle.on( 'click.typenow', function() {
			siteNavContain.toggleClass( 'toggled-on' );
            $( this ).attr( 'aria-expanded', siteNavContain.hasClass( 'toggled-on' ) );
        });
	})();
})( jQuery );

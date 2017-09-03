/**
 * Functionality specific to TypeNow.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */

(function( $ ) {
    /**
	 * Enables menu toggle for small screens.
	 */
    $(function() {
		$('.menu-toggle').click(function(){
			if($('.nav-menu').is(':hidden')){
				$('.nav-menu').slideDown();}
			else{$('.nav-menu').slideUp();}
			$('#touch-menu').toggleClass( 'open' );
		});
	});
})( jQuery );

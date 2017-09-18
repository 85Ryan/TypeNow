/**
 * Functionality specific to TypeNow.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */

(function( $ ) {

    // Top menu nav toggle.
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

    // Archives template tabs.
    $('ul.archive-tabs').each(function() {
        var $active, $content, $links = $(this).find('a');
        $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
        $active.addClass('active');
        $content = $($active[0].hash);

        $links.not($active).each(function () {
            $(this.hash).hide();
        });

        $(this).on('click', 'a', function(e){
            $active.removeClass('active');
            $content.hide();
            $active = $(this);
            $content = $(this.hash);
            $active.addClass('active');
            $content.show();
            e.preventDefault();
        });
    });

    // Fix Comment links scroll position.
    $('#comments a').click(function() {
        var target = document.getElementById(this.hash.slice(1));
        if (!target) return;
        var targetOffset = $(target).offset().top - 100;
        $('html,body').animate({
            scrollTop: targetOffset
        },
        300);
        return false;
    });

})( jQuery );

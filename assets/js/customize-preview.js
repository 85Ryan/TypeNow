/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	// Display blog title.
	wp.customize( 'typenow_display_title', function( value ) {
		value.bind( function( to ) {
			if ( false === to ) {
				$( '.site-title' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
				// Add class for different logo styles if title and description are hidden.
				$( 'body' ).addClass( 'title-hidden' );
			} else {
				$( '.site-title' ).css({
					clip: 'auto',
					position: 'relative'
				});
				// Add class for different logo styles if title and description are visible.
				$( 'body' ).removeClass( 'title-hidden' );
			}
		});
	});

	// Display blog tagline.
	wp.customize( 'typenow_display_tagline', function( value ) {
		value.bind( function( to ) {
			if ( false === to ) {
				$( '.site-description' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
				// Add class for different logo styles if title and description are hidden.
				$( 'body' ).addClass( 'tagline-hidden' );
			} else {
				$( '.site-description' ).css({
					clip: 'auto',
					position: 'relative'
				});
				// Add class for different logo styles if title and description are visible.
				$( 'body' ).removeClass( 'tagline-hidden' );
			}
		});
	});

	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}

	// Toggle a body class if a custom header exists.
	$.each( [ 'header_image' ], function( index, settingId ) {
		wp.customize( settingId, function( setting ) {
			setting.bind(function() {
				if ( hasHeaderImage() ) {
					$( document.body ).addClass( 'has-header-image' );
				} else {
					$( document.body ).removeClass( 'has-header-image' );
				}
			} );
		} );
	} );

    // Display site owner.
	wp.customize( 'typenow_site_owner', function( value ) {
		value.bind( function( to ) {
			$( '.site-copyright a' ).text( to );
		});
	});

    // Display site ICP.
	wp.customize( 'typenow_site_icp', function( value ) {
		value.bind( function( to ) {
			$( '.site-icp a' ).text( to );
		});
	});

    // Display copy notice.
	wp.customize( 'typenow_copy_notice', function( value ) {
		value.bind( function( to ) {
			$( '.site-copy-notice' ).text( to );
		});
	});

} )( jQuery );

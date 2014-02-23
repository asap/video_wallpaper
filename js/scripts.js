(function($){
    /**
     * Enables menu toggle for small screens.
     */
    ( function() {
        var nav = $( '#site-navigation' ), button, menu;
        if ( ! nav )
            return;

        button = nav.find( '.menu-toggle' );
        if ( ! button )
            return;

        // Hide button if menu is missing or empty.
        menu = nav.find( '.nav-menu' );
        if ( ! menu || ! menu.children().length ) {
            button.hide();
            return;
        }

        $('.menu-toggle' ).on( 'click', function() {
            $('#navbar').toggleClass( 'exposed' );
            $('.menu-toggle').toggleClass( 'exposed' );
        } );

    } )();

} )( jQuery );
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
        } );

        if (!Modernizr.touch) {
            setTimeout(function(){
                $('#navbar').removeClass( 'exposed' );
            }, 1000);
        }

        window.addEventListener('orientationchange', function(){
            switch (window.orientation) {
              case -90:
              case 90:
                $('#navbar').addClass( 'exposed' );
                break;
              default:
                $('#navbar').removeClass( 'exposed' );
                break;
            }
        });

    } )();

} )( jQuery );
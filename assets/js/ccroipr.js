( function( $ ) {

    $( document ).ready( function() {
        $( '#register' ).on( 'submit', function( event ) {

        	event.preventDefault();        	

	        $.ajax({
	        	type: 'POST',
	        	url : settings.ajaxurl,
	        	data : $(this).serialize()+'&action=register_action',
	        	dataType: 'HTML',
	        	success: function( result ) {
	        		$('#form_result').html( result );	        		
	        	}
	        });
		    

        })
    });

})( jQuery );
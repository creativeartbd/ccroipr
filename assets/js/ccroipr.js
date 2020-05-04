(function($){
    $( document ).ready( function() {

    	// Register form process start here. 
        $( '#register' ).on( 'submit', function( e ) {       	
        	
        	e.preventDefault();      
        	var data =  new FormData(this);  			    
			data.append("action", "register_action");

	        $.ajax({
	        	type: 'POST',
	        	url : settings.ajaxurl,
	        	data : data,
	        	cache: false,
				dataType: 'html',
				processData: false,
				contentType: false,
				beforeSend : function () {
		           	$('#registerButton').val('loading...');
		        }, 
	        	success: function( result ) {
	        		$('#registerButton').val('REGISTER BUTTON');
	        		$('#form_result').html( result );	        		
	        	}
	        });
        })
        // Register form process start end here. 

        // Fiel upload process start here. 
        $("#file").change(function(e){

		    e.preventDefault();
			var data = 'action=register_slim_file_action';		

		    $.ajax({
		        type : 'POST', 
		        url : settings.ajaxurl,		        
		        data : data,		  
		        beforeSend : function () {
		            document.getElementById("sha256").value = "";
		        },       
				success: function( result ) {	
					document.getElementById("sha256").value = "";
		            document.getElementById("sha256").value = result;     
				}		       
		    });		 	
	    });
	    // Fiel upload process end here. 

    });
})( jQuery );
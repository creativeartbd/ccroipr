(function($){
    $( document ).ready( function() {

    	// Download profile
		$("#download-profile").on('click', function(e) {
			e.preventDefault();
			var user_id = $(this).data('id');
			var nonce = $(this).data('nonce');			

			$.ajax({
	        	type: 'POST',
	        	url : settings.ajaxurl,
	        	dataType: 'html',
	        	data : {
	        		user_id : user_id,
	        		_wpnonce : nonce,
	        		action: 'download_profile_action',
	        	},
	        	success: function( result ) {	        		
	        		window.open( result, '_blank' );
	        	}
	        });
		});

    	// Confirm register
		$("#confirm_button").on('click', function(e) {
			e.preventDefault();
			var user_id = $("#user_id").val(); 
			var btn_label = $('#confirm_button').val();

			$.post( settings.ajaxurl, {
				action: 'register_confirm_action',
				user_id: user_id,	
				dataType: 'json',
				beforeSend : function () {
					$('#confirm_button').prop('disabled', true );
		           	$('#confirm_button').val('Please Wait...');
		        }, 			
			},
			function( result ){
				if(  result.success == true ) {
					$('#confirm_button, #button').prop('disabled', true );	
					$('#confirm_button').val( btn_label );		
					$('.confirm-wrapper').remove();							
        			 setTimeout(function(){// wait for 5 secs(2)
                        location.reload(); // then reload the page.(3)
                    }, 3000);	        		
				} else {
					$('#confirm_button').prop('disabled', false );
				}
				$('#form_result').html( result.data );	     				
			});
		});

    	// Update and Register
        $( '#button' ).on( 'click', function(e) {       	
        	
        	e.preventDefault();      
        	var data =  new FormData($('#register')[0]);        	
			data.append("action", "register_action");			
			var btn_label = $('#button').val();
			
	        $.ajax({
	        	type: 'POST',
	        	url : settings.ajaxurl,
	        	data : data,
	        	dataType: 'json',
	        	cache: false,				
				processData: false,
				contentType: false,
				beforeSend : function () {
					$('#button').prop('disabled', true );
		           	$('#button').val('Please Wait...');
		        }, 
	        	success: function( result ) {
	        		$('#button').prop('disabled', false );
	        		$('#button').val( btn_label );	        			        		
	        		$('#form_result').html( result.data )
	        		if( result.success == true ) {
	        			 setTimeout(function(){// wait for 5 secs(2)
	                        location.reload(); // then reload the page.(3)
	                    }, 3000);
	        		}
	        	}
	        });
        })        

        // Generate hash value when file is upload
        $("#file").on('change', function(e) {

        	readURL(this);
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

	    // show uploaded image preview
	    function readURL(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            
	            reader.onload = function (e) {
	                $('#uploaded_img').attr('src', e.target.result);
	            }
	            reader.readAsDataURL(input.files[0]);
	        }
	    }	   

	    // Home page clock	    
	    var timestamp = $("#timestamp");
	    if( timestamp.length ){
	    	function startTime() {
				var today = new Date();
				var year = today.getFullYear();
				var month = today.getMonth();
				var day = today.getDate();
				var h = today.getUTCHours();
				var m = today.getUTCMinutes();
				var s = today.getUTCSeconds();
					m = checkTime(m);
					s = checkTime(s);
				document.getElementById('timestamp').innerHTML = '<b>Register Time:</b> ' + year + '-' + month + '-' + day + ' ' + h + ":" + m + ":" + s;
				var t = setTimeout(startTime, 500);
			}
			function checkTime(i) {
				if (i < 10) {
					i = "0" + i
				};  // add zero in front of numbers < 10
				return i;
			}
			startTime();	
	    }	    

    });
})( jQuery );
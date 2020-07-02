(function($){
    $( document ).ready( function() {

    	// Update and Register form data for "Register" and "Register T"
        $( '#secret_register_btn' ).on( 'click', function(e) {       	
        	
        	e.preventDefault();      
        	var btn_label 		= $('#secret_register_btn').val();
        	var register_type 	= '' ;
        		register_type	= $(this).data('register-type');
        	var data 			=  new FormData($('#form')[0]);        	        	
				data.append("action", "secret_register_action");
				data.append("register_type", register_type);
			
	        $.ajax({
	        	type: 'POST',
	        	url : settings.ajaxurl,
	        	data : data,
	        	dataType: 'json',
	        	cache: false,				
				processData: false,
				contentType: false,
				beforeSend : function () {
					$('#secret_register_btn').prop('disabled', true );
		           	$('#secret_register_btn').val('Please Wait...');
		        }, 
	        	success: function( result ) {
	        		$('#secret_register_btn').prop('disabled', false );
	        		$('#secret_register_btn').val( btn_label );	        		
	        		if( result.success == true ) {
					$('#secret_register_btn').prop('disabled', true );
					$('#form_result').html( '<div class="alert alert-success">'+ result.data.message + '</div>' );
	        			setTimeout(function(){// wait for 5 secs(2)
	                        window.location.href = result.data.pdf_link; // Redirect to pdf link
	                    }, 3000);
	        		} else {
					$('#form_result').html( '<div class="alert alert-danger">'+ result.data.message + '</div>' );
				}
	        	}
	        });
        })  

    	// Update and Register form data for "Register" and "Register T"
        $( '#register_btn' ).on( 'click', function(e) {       	
        	
        	e.preventDefault();      
        	var btn_label 	= $('#register_btn').val();
        	var register_type 	= '' ;
        		register_type	= $(this).data('register-type');
        	var data 		=  new FormData($('#form')[0]);        	        	
				data.append("action", "register_action");
				data.append("register_type", register_type);
			
	        $.ajax({
	        	type: 'POST',
	        	url : settings.ajaxurl,
	        	data : data,
	        	dataType: 'json',
	        	cache: false,				
				processData: false,
				contentType: false,
				beforeSend : function () {
					$('#register_btn').prop('disabled', true );
		           	$('#register_btn').val('Please Wait...');
		        }, 
	        	success: function( result ) {
	        		$('#register_btn').prop('disabled', false );
	        		$('#register_btn').val( btn_label );
	        		$('#form_result').html( result.data )
	        		if( result.success == true ) {
	        			$('#register_btn').prop('disabled', true );
	        			 setTimeout(function(){// wait for 5 secs(2)
	                        location.reload(); // then reload the page.(3)
	                    }, 3000);
	        		}
	        	}
	        });
        })   

        // Confirm "Register" and "Register T" form
		$("#confirm_btn").on('click', function(e) {

			e.preventDefault();

			var user_id 		= $("#user_id").val(); 
			var btn_label 		= $('#confirm_btn').val();		
			var register_type 	= $(this).data('register-type');

			$.ajax({
	        	type: 'POST',
	        	url : settings.ajaxurl,
	        	data : {
	        		user_id : user_id,
	        		register_type : register_type,
	        		action : 'register_confirm_action'
	        	},
	        	dataType: 'json',	        	
				beforeSend : function () {
					//$('#confirm_btn').prop('disabled', true );
		           	$('#confirm_btn').val('Please Wait...');
		        }, 
	        	success: function( result ) {
	        		if(  result.success == true ) {
						$('#confirm_btn, #register_btn').prop('disabled', true );	
						$('#confirm_btn').val( btn_label );		
						$('.confirm-wrapper').remove();							
	        			setTimeout(function(){// wait for 5 secs(2)
	                        location.reload(); // then reload the page.(3)
	                    }, 3000);	        		
					} else {
						//$('#confirm_btn').prop('disabled', false );
					}
					$('#form_result').html( result.data );	     
	        	}
	        });
			
		});

    	// Download profile
		$("#download_profile").on('click', function(e) {
			e.preventDefault();
			var user_id = $(this).data('id');
			var nonce = $(this).data('nonce');		
			var submit_type = $(this).data('submit-type');
			var btn_label = $('#download_profile').val();			

			$.ajax({
	        	type: 'POST',
	        	url : settings.ajaxurl,
	        	dataType: 'html',
	        	data : {
	        		user_id : user_id,
	        		_wpnonce : nonce,
	        		action: 'download_profile_action',
	        		submit_type: submit_type,
	        	},
	        	beforeSend: function() {
	        		$('#download_profile').val('Downloading...');
	        	},
	        	success: function( result ) {	    
	        		$('#download_profile').val( btn_label );
	        		window.open( result, '_blank' );
	        	}
	        });
		});

    	

    	     

        // Update and Register T
        $( '#button_t' ).on( 'click', function(e) {
        	
        	e.preventDefault();      
        	var btn_label 	= $('#button_t').val();
        	var data 		=  new FormData($('#register_t')[0]);
			data.append("action", "register_t_action");			
			
	        $.ajax({
	        	type: 'POST',
	        	url : settings.ajaxurl,
	        	data : data,
	        	dataType: 'json',	        	
	        	cache: false,				
				processData: false,
				contentType: false,
				beforeSend : function () {
					//$('#button_t').prop('disabled', true );
		           	$('#button_t').val('Please Wait...');
		        }, 
	        	success: function( result ) {
	        		//$('#button_t').prop('disabled', false );
	        		$('#button_t').val( btn_label );	        			        		
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
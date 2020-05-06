(function($){
    $( document ).ready( function() {


		$("#confirm_button").on('click', function() {
			$.post( settings.ajaxurl, {
				action: 'register_action',				
			},
			function(data, status){
				alert("Data: " + data + "\nStatus: " + status);
			});
		});

    	// Confirm the registration
  //       $( '#confirm_button' ).on( 'click', function( e ) {       	
        	
  //       	e.preventDefault();
		// 	 $.ajax({
	 //        	type: 'POST',
	 //        	url : settings.ajaxurl,
	 //        	data : data,
	 //        	cache: false,
		// 		dataType: 'html',
		// 		processData: false,
		// 		contentType: false,
		// 		beforeSend : function () {
		//            	$('#updateData').val('loading...');
		//         }, 
	 //        	success: function( result ) {
	 //        		$('#updateData').val( 'Update Data' );	        		
	 //        		$('#form_result').html( result );	        		
	 //        	}
	 //        });
		// });

    	// Register form process start here. 
        $( '#register' ).on( 'submit', function(e) {       	
        	
        	e.preventDefault();      
        	var data =  new FormData(this);        	
			data.append("action", "register_action");			
			var btn_label = $('#button').val();
			
	        $.ajax({
	        	type: 'POST',
	        	url : settings.ajaxurl,
	        	data : data,
	        	cache: false,
				dataType: 'html',
				processData: false,
				contentType: false,
				beforeSend : function () {
					$('#button').prop('disabled', true );
		           	$('#button').val('loading...');
		        }, 
	        	success: function( result ) {
	        		$('#button').prop('disabled', false );
	        		$('#button').val( btn_label );
	        		$('#form_result').html( result );	        		
	        	}
	        });
        })
        // Register form process start end here. 

        // Fiel upload process start here. 
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
	    // Fiel upload process end here. 

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

	    // $("#file").change(function(){
	        
	    // });


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
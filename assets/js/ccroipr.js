(function($) {
    $(document).ready(function() {

        $(".accordion").click(function() {
            $(".panel").toggle('slow');
            $("i", this).toggleClass("fa fa-chevron-up fa fa-chevron-down");
        });

        // Register and Update form for the Register Menu
        $('#ccroipr_ru_form').submit(function(e) {
            e.preventDefault();
            var btn_label = $('#btn').val();
            var form_data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: settings.ajaxurl,
                data: form_data,
                dataType: 'json',
                beforeSend: function() {
                    // $('#btn').prop('disabled', true);
                    $('#btn').val('Please Wait...');
                },
                success: function(result) {
                    // $('#btn').prop('disabled', false);
                    $('#btn').val(btn_label);
                    $('#form_result').html(result.data.message)
                    if (result.success) {
                        if (result.data.type == 'update') {
                            $('#btn').prop('disabled', false);
                        }
                    }
                }
            });
        });

        // Register and Update form for the ccroipr D
        $('#ccroipr_d_ru_form').submit(function(e) {
            e.preventDefault();
            var btn_label = $('#btn').val();
            var form_data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: settings.ajaxurl,
                data: form_data,
                dataType: 'json',
                beforeSend: function() {
                    // $('#btn').prop('disabled', true);
                    $('#btn').val('Please Wait...');
                },
                success: function(result) {
                    // $('#btn').prop('disabled', false);
                    $('#btn').val(btn_label);
                    $('#form_result').html(result.data.message)
                    if (result.success) {
                        if (result.data.type == 'update') {
                            $('#btn').prop('disabled', false);
                        }
                    }
                }
            });
        });


        // Update and Register form data for "Register" and "Register T"
        $('#secret_register_btn').on('click', function(e) {

            e.preventDefault();
            var btn_label = $('#secret_register_btn').val();
            var register_type = '';
            register_type = $(this).data('register-type');
            var data = new FormData($('#form')[0]);
            data.append("action", "secret_register_action");
            data.append("register_type", register_type);

            $.ajax({
                type: 'POST',
                url: settings.ajaxurl,
                data: data,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#secret_register_btn').prop('disabled', true);
                    $('#secret_register_btn').val('Please Wait...');
                },
                success: function(result) {
                    $('#secret_register_btn').prop('disabled', false);
                    $('#secret_register_btn').val(btn_label);
                    if (result.success == true) {
                        $('#secret_register_btn').prop('disabled', true);
                        $('#form_result').html('<div class="alert alert-success">' + result.data.message + '</div>');
                        setTimeout(function() { // wait for 5 secs(2)
                            location.reload();
                        }, 3000);
                    } else {
                        $('#form_result').html('<div class="alert alert-danger">' + result.data.message + '</div>');
                    }
                }
            });
        })

        // Confirm "Register" and "Register T" form
        $("#confirm_btn").on('click', function(e) {

            e.preventDefault();

            var post_id = $("#post_id").val();
            var btn_label = $('#confirm_btn').val();
            var register_type = $(this).data('register-type');

            $.ajax({
                type: 'POST',
                url: settings.ajaxurl,
                data: {
                    post_id: post_id,
                    register_type: register_type,
                    action: 'register_confirm_action'
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#confirm_btn').prop('disabled', true);
                    $('#confirm_btn').val('Please Wait...');
                },
                success: function(result) {
                    if (result.success) {
                        $('#confirm_btn, #register_btn').prop('disabled', true);
                        $('#confirm_btn').val(btn_label);
                        $('.confirm-wrapper').remove();
                        $('#form_result').html(result.data.message);
                        setTimeout(function() { // wait for 5 secs(2)
                            window.location.href = result.data.permalink;
                        }, 3000);
                    } else {
                        $('#confirm_btn').prop('disabled', false);
                    }
                    $('#form_result').html(result.data.message);
                }
            });

        });

        // Download profile
        $("#download_profile").on('click', function(e) {
            e.preventDefault();
            var post_id = $(this).data('id');
            var nonce = $(this).data('nonce');
            var submit_type = $(this).data('submit-type');
            var btn_label = $('#download_profile').val();

            $.ajax({
                type: 'POST',
                url: settings.ajaxurl,
                dataType: 'html',
                data: {
                    post_id: post_id,
                    _wpnonce: nonce,
                    action: 'download_profile_action',
                    submit_type: submit_type,
                },
                beforeSend: function() {
                    $('#download_profile').val('Downloading...');
                },
                success: function(result) {
                    $('#download_profile').val(btn_label);
                    window.open(result, '_blank');
                }
            });
        });

        // Update and Register T		
        $('#ccroipr_t_ru_form').submit(function(e) {

            e.preventDefault();
            var btn_label = $('#btn').val();
            var form_data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: settings.ajaxurl,
                data: form_data,
                dataType: 'json',
                beforeSend: function() {
                    $('#btn').prop('disabled', true);
                    $('#btn').val('Please Wait...');
                },
                success: function(result) {
                    $('#btn').prop('disabled', false);
                    $('#btn').val(btn_label);
                    $('#form_result').html(result.data.message)
                    if (result.success) {
                        if (result.data.type == 'update') {
                            $('#btn').prop('disabled', false);
                        }
                    }
                }
            });

            // e.preventDefault();      
            // var btn_label 	= $('#button_t').val();
            // var data 		=  new FormData($('#register_t')[0]);
            // data.append("action", "register_t_action");			

            // $.ajax({
            // 	type: 'POST',
            // 	url : settings.ajaxurl,
            // 	data : data,
            // 	dataType: 'json',	        	
            // 	cache: false,				
            // 	processData: false,
            // 	contentType: false,
            // 	beforeSend : function () {
            // 		//$('#button_t').prop('disabled', true );
            //        	$('#button_t').val('Please Wait...');
            //     }, 
            // 	success: function( result ) {
            // 		//$('#button_t').prop('disabled', false );
            // 		$('#button_t').val( btn_label );	        			        		
            // 		$('#form_result').html( result.data )
            // 		if( result.success == true ) {
            // 			 setTimeout(function(){// wait for 5 secs(2)
            //                 location.reload(); // then reload the page.(3)
            //             }, 3000);
            // 		}
            // 	}
            // });
        })

        // Generate hash value when file is upload
        $("#file_change").on('change', function(e) {

            readURL(this);
            e.preventDefault();
            var data = 'action=register_slim_file_action';

            $.ajax({
                type: 'POST',
                url: settings.ajaxurl,
                data: data,
                beforeSend: function() {
                    document.getElementById("sha256").value = "";
                },
                success: function(result) {
                    document.getElementById("sha256").value = "";
                    document.getElementById("sha256").value = result;
                }
            });
        });

        // show uploaded image preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#uploaded_img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Home page clock	    
        var timestamp = $("#timestamp");
        if (timestamp.length) {
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
                document.getElementById('timestamp').innerHTML = '<b>Register Time:</b> ' + year + '-' + month + '-' + day + ' ' + h + ":" + m + ":" + s + ' <span class="color-red">(UTC±0)</span>';
                var t = setTimeout(startTime, 500);
            }

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i
                }; // add zero in front of numbers < 10
                return i;
            }
            startTime();
        }

        // For the image crop
        // var cropper = new Slim(document.getElementById('myCropper'), {
        // 	ratio: '3:4',
        // 	minSize: {
        // 		width: 150,
        // 		height: 200,
        // 	},
        // 	size: {
        // 		width: 250,
        // 		height: 300,
        // 	},
        // 	download: true,
        // 	instantEdit: true,
        // 	label: 'Upload: Click here or drag an image file onto it',
        // 	buttonConfirmLabel: 'Finished',
        // 	buttonConfirmTitle: 'Finished',
        // 	buttonCancelLabel: 'Cancel',
        // 	buttonCancelTitle: 'Cancel',
        // 	buttonEditTitle: 'To Edit',
        // 	buttonRemoveTitle: 'Remove',
        // 	buttonDownloadTitle: 'Download',
        // 	buttonRotateTitle: 'Rotate',
        // 	buttonUploadTitle: 'Upload',
        // 	statusImageTooSmall: 'This picture is too small. The minimum size is 250 X 300 pixel.'
        // });

        // let src = 'http://localhost:8888/ccroipr/wp-content/uploads/shibbir-8978.jpg';

        //cropper.load( src );		

        // For css circle menu 
        var nbOptions = 8;
        var angleStart = -360;

        // jquery rotate animation
        function rotate(li, d) {
            $({ d: angleStart }).animate({ d: d }, {
                step: function(now) {
                    $(li)
                        .css({ transform: 'rotate(' + now + 'deg)' })
                        .find('label')
                        .css({ transform: 'rotate(' + (-now) + 'deg)' });
                },
                duration: 0
            });
        }

        // show / hide the options
        function toggleOptions(s) {
            $(s).toggleClass('open');
            var li = $(s).find('li');
            var deg = $(s).hasClass('half') ? 180 / (li.length - 1) : 360 / li.length;
            for (var i = 0; i < li.length; i++) {
                var d = $(s).hasClass('half') ? (i * deg) - 90 : i * deg;
                $(s).hasClass('open') ? rotate(li[i], d) : rotate(li[i], angleStart);
            }
        }

        $('.selector button').click(function(e) {
            toggleOptions($(this).parent());
        });

        setTimeout(function() { toggleOptions('.selector'); }, 100); //@ sourceURL=pen.js


        // make it as accordion for smaller screens
        if ($(window).width() < 992) {
            $('.dropdown-menu a').click(function(e) {
                e.preventDefault();
                if ($(this).next('.submenu').length) {
                    $(this).next('.submenu').toggle();
                }
                $('.dropdown').on('hide.bs.dropdown', function() {
                    $(this).find('.submenu').hide();
                })
            });
        }


        $('[data-toggle="tooltip"]').tooltip();

    });
})(jQuery);
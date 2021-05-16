$(document).ready(function() {
	$("#SendMail").click(function() {
	
		var title = $("#title").val();
		var name = $("#name").val();
		var email = $("#email").val();
		var mobile = $("#mobile").val();
		
		var content = $("#content").val();
		var captcha = $("#captcha").val();
		var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
		//var data_string = 'name=' + name + '&email=' + email + '&mobile=' + mobile + '&title=' + title + '&content=' + content + '&captcha=' + captcha; 
		
		
		if(title == "") {
           $("#subjectError").slideDown('slow').delay(1000).slideUp('slow');
           $("#title").focus();
           return false;
        }
		
		if(name == "") {
           $("#nameError").slideDown('slow').delay(1000).slideUp('slow');
           $("#name").focus();
           return false;
        }

        if(!email_regex.test(email) || email == "") {
           $("#emailError").slideDown('slow').delay(1000).slideUp('slow');
           $("#email").focus()
           return false;
        }

        if(mobile == "") {
           $("#nameError1").slideDown('slow').delay(1000).slideUp('slow');
           $("#mobile").focus()
           return false;
        }

        

        if(content == "") {
           $("#contentError").slideDown('slow').delay(1000).slideUp('slow');
           $("#content").focus()
           return false;
        }

        if(captcha == "") {
           $("#captchaError").slideDown('slow').delay(1000).slideUp('slow');
           $("#captcha").focus()
           return false;
        }
    /*
        $("#loading").html("<img src='images/loading.gif'/>").fadeIn('fast');
            $.ajax({
                type: "POST",
                url: "sendmail.php",
                data: data_string,
                success: function(data_form) {
                    if(data_form == "true") {
                        $('#loading').fadeOut('fast');
                        $("#success").slideDown('slow').delay(3000).slideUp('slow');
                            clear_form();
                            change_captcha();
                    } else {
                        $('#loading').fadeOut('fast');
                        $("#error").slideDown('slow').delay(3000).slideUp('slow');
                        }
                    }
                });
        return false;*/

	});

	function clear_form() {
		$("#title").val('');
        $("#name").val('');
        $("#email").val('');
        $("#mobile").val('');
        $("#content").val('');
        $("#captcha").val('');
    }

    $("#load_captcha").click(function() {
        change_captcha();
    });

    function change_captcha() {
        document.getElementById('img_captcha').src="captcha.php?rnd=" + Math.random();
    }
});
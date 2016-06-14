<?php
function html_form_code()
{
	echo '<form class="mejora-career" action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post" enctype="multipart/form-data" >';
	echo '<div class="hide-all"><span class="input input--nao" >';
	echo '<input  class="input__field input__field--nao sp-form-input-name" type="text" id="input-name" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="' . (isset($_POST["cf-name"]) ? esc_attr($_POST["cf-name"]) : '') . '" size="40"/>';
	echo '<label class="input__label input__label--nao" for="input-name"><span class="input__label-content input__label-content--nao">';
	echo 'Your Name *';
	echo '<span id="sp_name"></span>';
	echo '<span id="name_error_message"></span>';
	echo '</span></label>';
	echo '<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none"><path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0" /></svg>';
	echo '</span></div>';
	echo '<div class="hide-all"><span class="input input--nao">';
	echo '<input class="input__field input__field--nao sp-form-input-email" type="text" id="input-email" name="cf-email" value="' . (isset($_POST["cf-email"]) ? esc_attr($_POST["cf-email"]) : '') . '" size="40" />';
	echo '<label class="input__label input__label--nao" for="input-email"><span class="input__label-content input__label-content--nao">';
	echo 'Your Email *';
	echo '<span id="sp_email"></span>';
	echo '<span id="email_error_message"></span>';
	echo '</span></label>';
	echo '<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none"><path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0" /></svg></span></div>';
	echo '<div class="radios">';
	echo '<label>Role *</label>';
	echo '<input tabindex="0" class="sp-form-input-position" type="radio" id="role1" name="role" value="Sr.PHPDeveloper" >';
	echo '<label for="role1">Position 1</label>';
	echo '<input tabindex="0" class="sp-form-input-position" type="radio" id="role2" name="role"value="Sr.HTMLDeveloper" >';
	echo '<label for="role2">Position 2</label>';
	echo '<span id="position_error_message"></span>';
	echo '</div>';
	echo '<span id="sp_role"></span>';
	echo '<div class="radios">';
	echo '<label>Experience *</label>';
	echo '<input class="sp-form-input-experience" type="radio" id="experience1" name="radios" value="0-1yr" >';
	echo '<label for="experience1">0-1 yr</label>';
	echo '<input class="sp-form-input-experience" type="radio" id="experience2" name="radios"value="1-2yrs" >';
	echo '<label for="experience2">1-2 yrs</label>';
	echo '<input class="sp-form-input-experience" type="radio" id="experience3" name="radios"value="2-3yrs" >';
	echo '<label for="experience3">2-3 yrs</label>';
	echo '<input class="sp-form-input-experience" type="radio" id="experience4" name="radios"value="3-4yrs" >';
	echo '<label for="experience4">3-4 yrs</label>';
	echo '<input class="sp-form-input-experience" type="radio" id="experience5" name="radios"value="4-5yrs" >';
	echo '<label for="experience5">4-5 yrs</label>';
	echo '<input class="sp-form-input-experience" type="radio" id="experience6" name="radios"value="5+yrs" >';
	echo '<label for="experience6">5+ yrs</label>';
	echo '<span id="experience_error_message"></span>';
	echo '</div>';
	echo '<span id="sp_experience"></span>';
	echo '<div class="hide-all"><span class="input input--nao">';
	echo '<textarea rows="5" class="input__field input__field--nao sp-form-input-message" id="input-msg" name="cf-message" >' . (isset($_POST["cf-message"]) ? esc_attr($_POST["cf-message"]) : '') . '</textarea>';
	echo '<label class="input__label input__label--nao" for="input-msg"><span class="input__label-content input__label-content--nao">';
	echo 'Your Message *';
	echo '<span id="sp_message"></span>';
	echo '<span id="message_error_message"></span>';
	echo '</span></label>';
	echo '<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none"><path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0" /></svg></span></div>';
	echo '<div class="custom-file-upload box">';
	echo '<label class="block">Attachment *</label>';
	echo '<span id="sp_cv"></span>';
	echo '<span id="cv_error_message"></span>';
	echo '<input  type="file" class="sp-form-input-file" id="cv_file" name="myfiles" multiple />';
	echo '</div>';
	echo '<div class="captcha">';
	echo '<label class="block"></label>';
	echo '<div class="g-recaptcha" data-sitekey="6LdGICATAAAAAEUiZeG6N9lk7_EjsE_9BBE3jTcX"></div>';
	echo '<span id="sp_captcha"></span>';
	echo '<span id="captcha_error_message"></span>';
	echo '</div>';
	echo '<div class="btn-secc"><input type="submit" name="cf-submitted" value="Send"></div>';
	echo '</form>';
}
function deliver_mail()
{
	if (isset($_POST['cf-submitted'])) {
		if (!empty($_POST['g-recaptcha-response'])) {
			$secret         = "6LdGICATAAAAAHR_y9AB-xykFB6fN--abvIf_Zne";
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
			$responseData   = json_decode($verifyResponse);
			if ($responseData->success) {
				$name = sanitize_text_field($_POST["cf-name"]);
				if ($name == "") {
					echo '<div>';
					echo '<p>Name Cannot be blank.</p>';
					echo '</div>';
				}
				$email = sanitize_email($_POST["cf-email"]);
				if ($email == "") {
					echo '<div>';
					echo '<p>Email Cannot be blank.</p>';
					echo '</div>';
				}
				$subject    = "Job Application";
				$role       = $_POST["role"];
				$experience = $_POST["radios"];
				$message    = esc_textarea($_POST["cf-message"]);
				$message    = '<table border="2"><tr><td>Name</td><td>Email id</td><td>Experience</td><td>Role</td><td>Message</td></tr><tr><td>' . $name . '</td><td>' . $email . '</td><td>' . $experience . '</td><td>' . $role . '</td><td>' . $message . '</td></tr></table>';
				move_uploaded_file($_FILES["myfiles"]["tmp_name"], WP_CONTENT_DIR . '/uploads/' . basename($_FILES['myfiles']['name']));
				if ($message == "") {
					echo '<div>';
					echo '<p>You have to give some message.</p>';
					echo '</div>';
				}
				$filename = $_FILES['myfiles']['name'];
				$ext      = pathinfo($filename, PATHINFO_EXTENSION);
				if ($ext == 'doc' || $ext == 'docx' || $ext == 'pdf' || $ext == 'rtf') {
					$attachments = array(
						WP_CONTENT_DIR . '/uploads/' . basename($_FILES['myfiles']['name'])
					);
				} else {
					echo '<div>';
					echo '<p>You have to choose only doc/docx/pdf/rtf format.</p>';
					echo '</div>';
					return false;
				}
				$to      = get_option('admin_email');
				$headers = "From:" . $name . "<" . $email . ">" . "\r\n";
				$cc      = "career@mejorainfotech.com";
				$headers .= "BCC:" . "<" . $cc . ">" . "\r\n";
				$headers = array(
					'Content-Type: text/html; charset=UTF-8'
				);
				if (wp_mail($to, $subject, $message, $headers, $attachments)) {
					echo '<div>';
					echo '<p>Thanks for contacting me, expect a response soon.</p>';
					echo '</div>';
					echo "<meta http-equiv='refresh' content='5'>";
				} else {
					echo 'An unexpected error occurred';
				}
			} else {
				echo "Robot Verification failed,please Try Again";
			}
		} else {
			echo '<p>Please click on recaptcha box</p>';
		}
	}
}
function cf_shortcode()
{
	ob_start();
	deliver_mail();
	html_form_code();
	return ob_get_clean();
}
add_shortcode('sitepoint_contact_form', 'cf_shortcode');
add_action('init', 'register_script');
function register_script()
{
	wp_register_script('jquery_min_jquery', plugins_url('/jquery.min.js', __FILE__), array(
		'jquery'
	), '2.1.3');
	wp_register_script('google-api_jquery', plugins_url('/google-api.js', __FILE__), array(
		'jquery'
	), '1.0.0');
	wp_register_script('classie_jquery', plugins_url('/classie.js', __FILE__), array(
		'jquery'
	), '1.0.0');
	wp_register_script('custom-file-input', plugins_url('/custom-file-input.js', __FILE__), array(
		'jquery'
	), '1.0.1');
	wp_register_script('custom_jquery', plugins_url('/customs.js', __FILE__), array(
		'jquery'
	), '1.0.0');
	wp_register_style('new_style', plugins_url('/main.css', __FILE__), false, '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_style');
function enqueue_style()
{
	wp_enqueue_script('jquery_min_jquery');
	wp_enqueue_script('google-api_jquery');
	wp_enqueue_script('classie_jquery');
	wp_enqueue_script('custom-file-input');
	wp_enqueue_script('custom_jquery');
	wp_enqueue_style('new_style');
}
add_action('wp_footer', 'validateCareerForm');
function validateCareerForm()
{
?>



    <script>
        var name_cannot_be_blank = 'Name cannot be blank';

        var email_cannot_be_blank = 'Email cannot be blank';

        var email_valid = 'Please provide a valid email address';

        var message_cannot_be_blank = 'Message cannot be blank';

        var cv_cannot_be_blank = 'Please upload your cv';

        var cv_format = 'You have to upload doc/docx/pdf/rtf file';

        var position_cannot_be_blank = 'Please Select a role';

        var experience_cannot_be_blank = 'Please Select Experience';

        var captcha_cannot_be_blank = 'Please Select captcha';
        

        jQuery('.sp-form-input-name').blur(function () {

            spFormValidateName();

        });


        jQuery('.sp-form-input-email').blur(function () {

            spFormValidateEmail();

        });



        jQuery('.sp-form-input-message').blur(function () {

            spFormValidateMessage();

        });



        jQuery('.sp-form-input-position').blur(function () {

            spFormValidatePosition();

        });



        jQuery('.sp-form-input-file').blur(function () {

            spFormValidateFile();

        });



        jQuery('.sp-form-input-experience').blur(function () {

            spFormValidateExperience();

        });



        function spFormValidateName() {

            var value = false;

            if (jQuery('.sp-form-input-name').val() == '') {

                jQuery('#name_error_message').addClass('error_message')

                jQuery('#name_error_message').text(name_cannot_be_blank);

            } else {

                jQuery('#name_error_message').text('');

                value = true;

            }

            return value;

        }



        function spFormValidateEmail() {

            var value = false;

            var userinput = $('.sp-form-input-email').val();

            var pattern = /^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})$/i;



            if (jQuery('.sp-form-input-email').val() == '') {

                jQuery('#email_error_message').addClass('error_message').text(email_cannot_be_blank);

            } else if (!pattern.test($('.sp-form-input-email').val())) {

                jQuery('#email_error_message').addClass('error_message').text(email_valid);

            } else {

                jQuery('#email_error_message').text('');

                value = true;

            }

            return value;

        }



        function spFormValidateMessage() {

            var value = false;

            if (jQuery('.sp-form-input-message').val() == '') {

                jQuery('#message_error_message').addClass('error_message').text(message_cannot_be_blank);

            } else {

                jQuery('#message_error_message').text('');

                value = true;

            }

            return value;

        }



        function spFormValidatePosition() {

            var value = false;

            if (jQuery('.sp-form-input-position:checked').length == 0) {

                jQuery('#position_error_message').addClass('error_message').text(position_cannot_be_blank);

            } else {

                jQuery('#position_error_message').text('');

                value = true;

            }

            return value;

        }



        function spFormValidateExperience() {

            var value = false;

            if (jQuery('.sp-form-input-experience:checked').length == 0) {

                jQuery('#experience_error_message').addClass('error_message').text(experience_cannot_be_blank);

            } else {

                jQuery('#experience_error_message').text('');

                value = true;

            }

            return value;

        }



        function spFormValidateFile() {

            var value = false;

            var uploadfile = jQuery('.sp-form-input-file').val();

            var ext = uploadfile.substring(uploadfile.lastIndexOf('.') + 1);



            if (jQuery('.sp-form-input-file').val() == '') {

                jQuery('#cv_error_message').addClass('error_message').text(cv_cannot_be_blank);

            } else if (ext != "doc" && ext != "docx" && ext != "pdf" && ext != "rtf")

            {

                jQuery('#cv_error_message').addClass('error_message').text(cv_format);

            } else {

                jQuery('#cv_error_message').text('');

                value = true;

            }

            return value;

        }



        function spFormValidateCaptcha() {

            var value = false;

            var captcha = grecaptcha.getResponse();



            if (captcha.length == 0) {

                jQuery('#captcha_error_message').addClass('error_message').text(captcha_cannot_be_blank);

            } else {

                jQuery('#captcha_error_message').text('');

                value = true;

            }

            return value;

        }



        jQuery('.mejora-career').submit(function (ev) {

            //ev.preventDefault();

            jQuery('.error_message').removeClass('error_message');



            var spFormValidateNameValue = spFormValidateName();

            var spFormValidateEmailValue = spFormValidateEmail();

            var spFormValidateMessageValue = spFormValidateMessage();

            var spFormValidatePositionValue = spFormValidatePosition();

            var spFormValidateExperienceValue = spFormValidateExperience();

            var spFormValidateFileValue = spFormValidateFile();

            var spFormValidateCaptchaValue = spFormValidateCaptcha();




            if (spFormValidateNameValue === true && spFormValidateEmailValue === true && spFormValidateMessageValue === true && spFormValidatePositionValue === true && spFormValidateExperienceValue === true && spFormValidateFileValue === true && spFormValidateCaptchaValue === true) {

                return true;

            } else {

                var i = 0;

                jQuery('.error_message').each(function () {

                    if (i == 0) {

                        jQuery(this).closest('div').find('input').focus();

                        jQuery(this).closest('div').find('textarea').focus();

                    }

                    i++;

                });



                return false;

            }

        });
    </script>



    <?php
}
?>

(function () {
	emailjs.init('nqzxQS6LeuJNLlbzs');
})();

if ($('#email-form').length) {
	$('#submit').click(function () {
		var username = $('#email-form .username').val();
		var email = $('#email-form .email').val();
		var contact_message = $('#email-form .contact_message').val();

		if (username == '' || email == '') {
			$('#email-form .response').html('<div class="failed">Please fill the required fields.</div>');
			return false;
		}
		$('#email-form .response').html('<div class="text-info"><img src="images/icons/preloader.gif"> Loading...</div>');
		//Default
		const serviceID = 'service_y3frcoc';
		const templateID = 'template_je2vqdu';

		var contactParams = {
			username: username,
			mail: email,
			message: contact_message,
		};
		emailjs.send(serviceID, templateID, contactParams)
			.then(function () {
				console.log('Mail Sent !');
				$('#email-form .response').html('<div class="success">Email has been sent successfully.</div>');
				document.getElementById("email-form").reset();
				alert('Email has been sent successfully. !');
			}, function (error) {
				console.log('FAILED...', error);
				$('#email-form .response').html('<div class="error">Error: Email has not been sent.');
			});
	});
}

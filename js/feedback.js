var feedback = {
	send: function() {
		$('#feedback-form').on('submit', function(e){
			$('.input_error').html('');
			$('.submit', this).hide();
			$('#loadingFeedback').show();

			var form = $(this);

			$.ajax({
				type: 'post',
				url: form.attr('action'),
				data: form.serialize(),
				success: function(response){
					if (typeof response.error !== 'undefined' && response.error > 0) {
						var errors = response.errors;

						$.each(errors, function(fieldName, errorText){
							$('#error_' + fieldName).html(errorText);
						});

						$('.submit', form).show();
						$('#loadingFeedback').hide();
					} else {
						location.reload();
					}

					return false;
				}
			}).done(function(response){
			});

			return false;
		});
	},
	init: function() {
		feedback.send();
	}
}

$(document).ready(function() {
	feedback.init();
});
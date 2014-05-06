var photo =
{
	deletePreviewUpload: function(object){
		var filename = $(object).attr('rel');
		var url = $('#deleteUrl').val();
		$.post(url, {
			filename: filename
		}, function(response){
			if(response == null) return;
			if (response)
			{
				$('.delClass[data-filename="' + filename + '"]').remove();
			};
		});
	}
}
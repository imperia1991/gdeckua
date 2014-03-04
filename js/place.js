var photo =
{
	deletePreviewUpload: function(object){
		var filename = $(object).attr('rel');
		$.post('/admin/place/deletePreviewUpload', {
			filename: filename
		}, function(response){
			if(response == null) return;
			if (response)
			{
				$('.delClass[data-filename="' + filename + '"]').remove();
			};
		});
	},
	deletePhotos: function(){
		if (!$('.deletePhoto').length) return;

		$('.deletePhoto').each(function(e){
			$(this).on('click', function(e){
				var id = $(this).attr('rel');
				$.post('/admin/place/deletePhoto', {
					id: id
				}, function(response){
					if(response == null) return;
					if (response)
					{
						$('.photo_' + id).remove();
					};
				});
			});

		});
	}
}

ymaps.ready(init);

var names = [];
function init()
{
	placeMap = new ymaps.Map('placeMap', {
		center: placeCenter,
		zoom: 16
	});

	placeMap.controls.add('zoomControl');

	var address = country + ', ' + region + ', ' + city + ', ' + $('#address').val();

	placemark = new ymaps.Placemark(placeCenter,
		{
			balloonContent: address
		},
		{
			iconImageHref: '/img/home_icon.png',
			iconImageSize: [32, 37]
		}
	);
	placeMap.geoObjects.add(placemark);

//	placeMap.setCenter(placeCenter, 14);

	placeMap.events.add('click', function (e) {
		var coords = e.get('coordPosition');

		// Отправим запрос на геокодирование.
		ymaps.geocode(coords).then(function (res) {
			var names = [];
			// Переберём все найденные результаты и
			// запишем имена найденный объектов в массив names.
			res.geoObjects.each(function (obj) {
				names.push(obj.properties.get('name'));
			});

			// Добавим на карту метку в точку, по координатам
			// которой запрашивали обратное геокодирование.
			if (placemark)
				placeMap.geoObjects.remove(placemark);

			$('#address').val('');
			$('#address').val(names[0]);
			$('#placeLat').val(coords[0]);
			$('#placeLng').val(coords[1]);

			placemark = new ymaps.Placemark(coords, {
				// В качестве контента иконки выведем
				// первый найденный объект.
				//                iconContent:names[0],
				// А в качестве контента балуна - подробности:
				// имена всех остальных найденных объектов.
				balloonContent:names.reverse().join(', ')
			}, {
				iconImageHref: '/img/home_icon.png',
				iconImageSize: [32, 37],
				balloonMaxWidth:'250'
			});

			placeMap.geoObjects.add(placemark);
		});
	});
}

$(document).ready(function() {
	photo.deletePhotos();
});
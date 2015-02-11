ymaps.ready(init);

var placemark;
function init()
{
	placeMap = new ymaps.Map('placeMap', {
		center: placeCenter,
		zoom: 16
	});

	placeMap.controls
		.add('zoomControl')
		.add('typeSelector');

	// Заполняем коллекцию данными.
	var placemark = new ymaps.Placemark(
		placeCenter,
		{
			balloonContentHeader: header,
//			balloonContentBody: body,
			balloonContentFooter: footer,
			hintContent: text
		},
		{
			iconImageHref: '/images/home_icon.png',
			iconImageSize: [32, 37]
		}
	);

    // Добавляем коллекцию меток на карту.
    placeMap.geoObjects.add(placemark);
}

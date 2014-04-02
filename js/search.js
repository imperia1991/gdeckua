ymaps.ready(init);

var placemarks = [];
function init()
{
	placeMap = new ymaps.Map('placeMap', {
		center: placeCenter,
		zoom: 16
	});

	placeMap.controls
		.add('zoomControl')
		.add('typeSelector');

	var searchCollection = new ymaps.GeoObjectCollection();

	// Заполняем коллекцию данными.
    searchPoints.forEach(function (point) {
		var placemark = new ymaps.Placemark(
            point.coords,
			{
                balloonContentHeader: point.header,
				balloonContentBody: point.body,
				balloonContentFooter: point.footer,
				hintContent: point.text
            },
			{
				preset: 'twirl#blueDotIcon'
			}
        );

		placemark.events
			.add('mouseenter', function (e) {
				// Ссылку на объект, вызвавший событие,
				// можно получить из поля 'target'.
				e.get('target').options.set('preset', 'twirl#darkorangeDotIcon');
			})
			.add('mouseleave', function (e) {
				e.get('target').options.set('preset', 'twirl#blueDotIcon');
			})
			.add('click', function (e) {
				e.get('target').options.set('preset', 'twirl#blueDotIcon');
			});

		placemarks[point.id] = placemark;

        searchCollection.add(placemark);
    });

    // Добавляем коллекцию меток на карту.
    placeMap.geoObjects.add(searchCollection);

	placeMap.setBounds(searchCollection.getBounds(), {checkZoomRange:true, zoomMargin:1});
}

function showPlacemark(id)
{
	placemarks[id].hint.show(placemarks[id].geometry.getPixelGeometry().getCoordinates());

	placemarks[id].events.fire('mouseenter', {
			coordPosition: placemarks[id].geometry.getCoordinates(),
			target: placemarks[id]
	});
}

function hidePlacemark(id)
{
	placemarks[id].hint.hide();

	placemarks[id].events.fire('mouseleave', {
			coordPosition: placemarks[id].geometry.getCoordinates(),
			target: placemarks[id]
	});
}

function clickPlacemark(id)
{
	placemarks[id].events.fire('click', {
			coordPosition: placemarks[id].geometry.getCoordinates(),
			target: placemarks[id]
	});

	placeMap.setCenter(placemarks[id].geometry.getCoordinates());
	placeMap.setZoom(16);
}
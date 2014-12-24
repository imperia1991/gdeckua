ymaps.ready(init);

var placemarks = [];
function init()
{
//    var newBalloonContentLayout = ymaps.templateLayoutFactory.createClass('<div id="tooltip"><div class="tooltip-inner">$[[options.contentBodyLayout]]</div></div>');
//    var newBalloonLayout = ymaps.templateLayoutFactory.createClass(
//        '<div id="tooltip"><div class="tooltip-inner"><div class="tooltip-title"><h1>$[titleText]</h1></div><div><div class="tooltip-description"><p>$[addressText]</p></div><div class="go-full">$[view]</div></div></div>', {
//            build: function () {
//                this.constructor.superclass.build.call(this);
//            },
//            clear: function () {
//                this.constructor.superclass.clear.call(this);
//            }
//        });

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
                balloonContentHeader: point.titleText,
//                balloonContentBodyLayout: newBalloonContentBodyLayout,
//                balloonContentLayout: newBalloonContentLayout,
				balloonContentBody: point.addressText,
				balloonContentFooter: point.view,
				hintContent: point.text
            },
			{
                iconImageHref: '/img/blue1.png',
                iconImageSize: [24, 34]
			}
        );

		placemark.events
			.add('mouseenter', function (e) {
				// Ссылку на объект, вызвавший событие,
				// можно получить из поля 'target'.
				e.get('target').options.set('iconImageHref', '/img/orrange1.png');
				e.get('target').options.set('iconImageSize', [24, 34]);

                var placeId = 0;
                placemarks.forEach(function(item, index){
                    if (item == e.get('target')) {
                        placeId = index;
                    }
                });

                $('.item-active').removeClass('item-active');
                $('.places div[item="' + placeId + '"]').addClass('item-active');

//                $('.places input[value="' + placeId + '"]').focus(function() {
//                    alert(3);
//                    $("#search-content").mCustomScrollbar("scrollTo", this);
//                });
			})
			.add('mouseleave', function (e) {
				e.get('target').options.set('iconImageHref', '/img/blue1.png');
				e.get('target').options.set('iconImageSize', [24, 34]);

                $('.item-active').removeClass('item-active');
			})
			.add('click', function (e) {
//                placeMap.balloon.open(e.get('coordPosition'), {
//                    titleText: point.titleText,
//                    addressText: point.addressText,
//                    view: point.view
//                }, {
//                    layout: newBalloonLayout
//                });

				e.get('target').options.set('iconImageHref', '/img/blue1.png');
				e.get('target').options.set('iconImageSize', [24, 34]);

                var placeId = 0;
                placemarks.forEach(function(item, index){
                    if (item == e.get('target')) {
                        placeId = index;
                    }
                });

                $('.places div[item="' + placeId + '"]').addClass('item-active');


			});

		placemarks[point.id] = placemark;

        searchCollection.add(placemark);
    });

	button = new ymaps.control.Button({
			data: {
				content: 'Все'
			}
		},
		{
			selectOnClick: false
		});
	button.events.add('click', function(e){
		placeMap.setBounds(searchCollection.getBounds(), {checkZoomRange:true, zoomMargin:1});
	});

    placeMap.controls.add(button, {
        left: 5,
        top: 5
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

    $('.places div[item="' + id + '"]').addClass('item-active');

	placeMap.setCenter(placemarks[id].geometry.getCoordinates());
	placeMap.setZoom(16);
}
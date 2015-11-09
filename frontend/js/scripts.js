(function () {
    var infoWindow;
    function initialize() {
        var mapOptions = {'center': new google.maps.LatLng(50.2545865900, 28.6581695100), 'zoom': 16};
        var container = document.getElementById('gmap');
        container.style.width = '100%';
        container.style.height = '512px';
        var gmap = new google.maps.Map(container, mapOptions);
        var gmarker1 = new google.maps.Marker({
            'map': gmap,
            'position': new google.maps.LatLng(50.2525286100, 28.6540925500),
            'title': 'Indepp Team'
        });
        infoWindow = new google.maps.InfoWindow();
        var infoWindowContent =
            '<p>Indepp Team</p>'+
            'Украина, г. Житомир, ул. Рыльского, 9<br/>'+
            '<strong>E-mail</strong>: info@inde.pp.ua<br/>'

        google.maps.event.addListener(gmarker1, 'click', function (event) {
            infoWindow.setContent(infoWindowContent);
            infoWindow.open(gmap, this);
        });
        google.maps.event.trigger(gmarker1, 'click');
    };
    google.maps.event.addDomListener(window, 'load', initialize);
})();
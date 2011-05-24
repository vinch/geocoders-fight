function gLoad(x, y) {
	if (GBrowserIsCompatible()) {
    	var gmap = new GMap2(document.getElementById("google_map"));
		gmap.addControl(new GLargeMapControl());
		gmap.setCenter(new GLatLng(x, y), 17);
		var point = new GLatLng(x, y);
		var marker = new GMarker(point);
		gmap.addOverlay(marker);
	}
}

function yLoad(x, y) {
	var ymap = new YMap(document.getElementById('yahoo_map'));  
	ymap.setMapType(YAHOO_MAP_REG);   
	ymap.addZoomLong();
	var point = new YGeoPoint(x, y);
	ymap.addMarker(point);
	ymap.drawZoomAndCenter(point, 1);
}
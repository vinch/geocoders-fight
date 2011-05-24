<?php

abstract class Geocoder {
	
	const GOOGLE_API_KEY = 'ABQIAAAA0MB-bwjeOkgNnvIVmieN-RRGFE70GU6HoKR8y6scev5RsM1ueBTOQJOiOylC3_4webQgysLYrT4o5A';
	const YAHOO_API_KEY = 'ERxj2g3V34HWbC4EUVmhXqsxzruo_eeQ2n6vhj3_1_geb932v.1.crOP3htc2qpA9raYBDEKqy4-';
	
	public function getLatLng($location) {
		$gc = self::getGoogleLatLng($location);
		return $gc !== null ? $gc : self::getYahooLatLng($location);
	}
	
	public function getGoogleLatLng($location) {
		$wsurl = 'http://maps.google.com/maps/geo?q=%s&output=csv&key=%s';
		$data = explode(',', file_get_contents(sprintf($wsurl, urlencode($location), self::GOOGLE_API_KEY)));
		$coord = 200 === (int)$data[0] ? array((float)$data[2], (float)$data[3]) : null;
		return $coord;
	}
	
	public function getYahooLatLng($location) {
		$wsurl = 'http://local.yahooapis.com/MapsService/V1/geocode?location=%s&appid=%s&output=php';
		$data = unserialize(file_get_contents(sprintf($wsurl, urlencode($location), self::YAHOO_API_KEY)));
		$coord = $data === false ? null : array((float)$data[ResultSet][Result][Latitude],(float)$data[ResultSet][Result][Longitude]);
		return $coord;
	}
	
}

?>
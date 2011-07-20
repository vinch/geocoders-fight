<?php

abstract class Geocoder {
	
	public function getLatLng($location) {
		$gc = self::getGoogleLatLng($location);
		return $gc !== null ? $gc : self::getYahooLatLng($location);
	}
	
	public function getGoogleLatLng($location) {
		$wsurl = 'http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=%s';
		$data = json_decode(file_get_contents(sprintf($wsurl, urlencode($location))), true);
		$coord = 'OK' === $data['status'] ? array((float)$data['results'][0]['geometry']['location']['lat'], (float)$data['results'][0]['geometry']['location']['lng']) : null;
		return $coord;
	}
	
	public function getYahooLatLng($location) {
		$wsurl = 'http://local.yahooapis.com/MapsService/V1/geocode?location=%s&appid=%s&output=php';
		$data = unserialize(file_get_contents(sprintf($wsurl, urlencode($location), YAHOO_API_KEY)));
		$coord = $data === false ? null : array((float)$data['ResultSet']['Result']['Latitude'],(float)$data['ResultSet']['Result']['Longitude']);
		return $coord;
	}
	
}

?>
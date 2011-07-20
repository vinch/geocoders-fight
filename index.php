<?php

include_once 'keys.inc.php';
include_once 'geocoder.php';

if (isset($_GET['location']) && !empty($_GET['location'])) {
	$location = $_GET['location'];
	$gc = Geocoder::getGoogleLatLng($location);
	$yc = Geocoder::getYahooLatLng($location);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Geocoders Fight</title>
	<link rel="stylesheet" href="_css/geocoder.css" type="text/css" />
	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo GOOGLE_API_KEY ?>" type="text/javascript"></script>
	<script type="text/javascript" src="http://api.maps.yahoo.com/ajaxymap?v=3.8&amp;appid=<?php echo YAHOO_API_KEY ?>"></script>
	<script type="text/javascript" src="_js/geocoder.js"></script>
</head>

<body>

<div id="container">
	<h1>Geocoders Fight</h1>
	<blockquote><p>Compare results from Google and Yahoo! geocoders...</p></blockquote>
	<div id="search">
		<form action="." method="get">
			<div>
				<input type="text" name="location" value="<?php if (isset($location)) echo $location; ?>" class="text" />
				<input type="submit" value="Go" class="submit" />
			</div>
		</form>
	</div>
	<?php if (isset($location)) : ?>
	<div id="google">
		<h2>Google</h2>
		<dl class="coordinates">
			<dt>Latitude:</dt>
			<dd><?php echo $gc[0] ?></dd>
			<dt>Longitude:</dt>
			<dd><?php echo $gc[1] ?></dd>
		</dl>
		<div class="map" id="google_map"></div>
	</div>
	<div id="yahoo">
		<h2>Yahoo!</h2>
		<dl class="coordinates">
			<dt>Latitude:</dt>
			<dd><?php echo $yc[0] ?></dd>
			<dt>Longitude:</dt>
			<dd><?php echo $yc[1] ?></dd>
		</dl>
		<div class="map" id="yahoo_map"></div>
	</div>
	<?php endif; ?>
	<div id="batch">
		<h2>Batch</h2>
		<p>Upload a text file (text/plain) with an address per line and get a list of coordinates!</p>
		<form action="batch.php" method="post" enctype="multipart/form-data">
			<div>
				<input type="file" name="file" class="text" />
				<input type="submit" value="Go" class="submit" />
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	gLoad(<?php echo $gc[0] ?>, <?php echo $gc[1] ?>);
	yLoad(<?php echo $yc[0] ?>, <?php echo $yc[1] ?>);
</script>

<a href="http://github.com/vinch/geocoders-fight"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://d3nwyuy0nl342s.cloudfront.net/img/e6bef7a091f5f3138b8cd40bc3e114258dd68ddf/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f7265645f6161303030302e706e67" alt="Fork me on GitHub"></a>

</body>
</html>
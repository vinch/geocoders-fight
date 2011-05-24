<?php

include_once('geocoder.php');

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
	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA0MB-bwjeOkgNnvIVmieN-RRGFE70GU6HoKR8y6scev5RsM1ueBTOQJOiOylC3_4webQgysLYrT4o5A" type="text/javascript"></script>
	<script type="text/javascript" src="http://api.maps.yahoo.com/ajaxymap?v=3.8&amp;appid=ERxj2g3V34HWbC4EUVmhXqsxzruo_eeQ2n6vhj3_1_geb932v.1.crOP3htc2qpA9raYBDEKqy4-"></script>
	<script type="text/javascript" src="_js/geocoder.js"></script>
</head>

<body>

<div id="container">
	<h1>Geocoders Fight</h1>
	<blockquote><p>Compare results from Google and Yahoo! geocoders...</p></blockquote>
	<div id="search">
		<form action="." method="get">
			<div>
				<input type="text" name="location" value="<?php echo $location; ?>" class="text" />
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

</body>
</html>
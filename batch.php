<?php

include_once('geocoder.php');

if (count($_FILES) > 0) {
	if ($_FILES["file"]["error"] > 0) {
		$error = "Error: " . $_FILES["file"]["error"] . "";
	}
	else {
		if ($_FILES["file"]["type"] !== "text/plain") {
			$error = "Error: Your file is not a text file. Your file type: ".$_FILES["file"]["type"]."";
		}
		else {
			$locations = explode("\n", file_get_contents($_FILES["file"]["tmp_name"]));
			$locations_c = array();
			foreach ($locations as $location) {
				$locations_c[] = array("location" => $location, "coordinates" => Geocoder::getLatLng($location));
			}
		}
	}	
}
else {
	$error = "Error: File missing";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Geocoders Fight</title>
	<link rel="stylesheet" href="_css/geocoder.css" type="text/css" />
</head>

<body>

<div id="container">
	<h1>Geocoders Fight</h1>
	<h2>Batch results</h2>
	
	<?php if (isset($error)) : ?>
	
		<p><?php echo $error; ?></p>
	
	<?php else : ?>
	
	<table>
		<?php foreach ($locations_c as $location_c) : ?>
			<tr>
				<td><?php echo $location_c['location']; ?></td>
				<td><?php echo $location_c['coordinates'][0]; ?></td>
				<td><?php echo $location_c['coordinates'][1]; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
	
	<form action="csv.php" method="post">
		<div id="csv">
			<input type="hidden" name="locations_c" value="<?php echo urlencode(serialize($locations_c)); ?>" />
			<input type="submit" value="Save as CSV" class="submit" />
		</div>
	</form>
	
	<?php endif; ?>
</div>	
	
</body>
</html>
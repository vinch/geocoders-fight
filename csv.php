<?php

if (!isset($_POST['locations_c'])) {
	header('Location: index.php');
}
 
header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="output.csv"');

$locations_c = unserialize(urldecode($_POST['locations_c']));

foreach ($locations_c as $location_c) {
	echo $location_c['location'].";".$location_c['coordinates'][0].";".$location_c['coordinates'][1]."\n";
}
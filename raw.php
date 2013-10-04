<?php
if (!file_exists('p/'.$_GET['id'].'.txt.bz2')) {
	header("HTTP/1.0 404 Not Found");
	echo "404 - Not found";
	exit;
}
else {
	include "inc.php";
	include "pastes.php";
	
	$id = $_GET['id'];
}

header("Content-Type: text/plain; charset=ISO-8859-1");

echo getp($id);
?>

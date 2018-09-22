<?php
include "inc.php";

if (!isset($_GET['id']) || !exists($_GET['id'])) {
	header("HTTP/1.0 404 Not Found");
	echo "404 - Not found";
}
else {
	echo getp($_GET['id']);
}
?>

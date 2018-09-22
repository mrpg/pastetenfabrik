<?php
if (!isset($INC_PHP)) {
	include 'pref.php';

	function tok($l = 8) {
		return substr(md5(microtime()), mt_rand(0, 32-$l), $l);
	}

	function getid() {
		do {
			$id = tok();
		} while (file_exists('p/'.$id.'.gz'));

		return $id;
	}

	function getp($id) {
		return gzdecode(file_get_contents('p/'.$id.'.gz'));
	}

	function writep($id,$str) {
		return file_put_contents('p/'.$id.'.gz', gzencode($str, 9));
	}

	function register($id, $title, $time, $user) {
		return file_put_contents('meta/'.$id, json_encode(array($title, $time, $user)));
	}
	
	function meta($id) {
		return json_decode(file_get_contents('meta/'.$id), true);
	}

	function dec($str) {
		return htmlspecialchars($str, NULL, "UTF-8");
	}
	
	function exists($id) {
		return file_exists('p/'.$id.'.gz') && file_exists('meta/'.$id);
	}

	$INC_PHP = true;
}
?>

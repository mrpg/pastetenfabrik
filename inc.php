<?php
if (!isset($INC_PHP)) {
	include 'pref.php';

	function tok($l=8) {
		$r = '';
		$a = str_split(str_shuffle('0123456789ABCDEF'));

		while ($l) {
			$r .= $a[mt_rand(0,15)];
			$l--;
		}

		return $r;
	}

	function getid() {
		do {
			$id = tok();
		} while (file_exists('p/'.$id.'.txt.bz2'));

		return $id;
	}

	function sha512($str) {
		return hash('sha512',$str);
	}

	function resolve($pwh) {
		global $pw;
		
		foreach ($pw as $i=>$p) {
			if ($pwh == $p) {
				return $i;
			}
		}

		return -1;
	}

	function getp($id) {
		return (file_exists('p/'.$id.'.txt.bz2'))?bzdecompress(file_get_contents('p/'.$id.'.txt.bz2')):'';
	}

	function writep($id,$str) {
		file_put_contents('p/'.$id.'.txt.bz2',bzcompress($str,9));
	}

	function register($id,$title,$time,$user) {
		file_put_contents('pastes.php','$p["'.$id.'"] = array("'.base64_encode($title).'",'.$time.',"'.$user.'");'."\n",LOCK_EX | FILE_APPEND);
	}

	function dec($str) {
		return htmlspecialchars($str,NULL,"ISO-8859-1");
	}

	$INC_PHP = true;
}
?>

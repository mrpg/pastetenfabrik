<?php
header("Content-Type: text/html; charset=UTF-8");

include "inc.php";

if (!isset($_GET['id']) || !exists($_GET['id'])) {
	header("HTTP/1.0 404 Not Found");
	echo "404 - Not found";
	exit;
}
else {
	$id = $_GET['id'];
	$meta = meta($id);
	$title = $meta[0];
}
?>
<!doctype html>
<html>
<head>
<title>Pastetenfabrik at <?=$_SERVER["SERVER_NAME"].(!empty($title)?': '.$title:'') ?></title>
</head>
<body>
<h1><a href="index.php">Pastetenfabrik at <?=$_SERVER["SERVER_NAME"] ?></a></h1>

<hr />

<h2><?=dec($title) ?></h2>
<p><i>Pasted at <b><?=date('r', $meta[1]) ?></b> by <b><?=$meta[2] ?></b></i> &middot; <a href="<?=$id ?>.txt">[raw]</a></p>

<pre><?=dec(getp($id)) ?></pre>

<hr />
<?php if (!empty($pgp)) echo '<p><a href="'.$pgp.'">PGP key</a></p>'; ?>
<?=$footer; ?>
<p><a href="https://github.com/mrpg/pastetenfabrik">Pastetenfabrik is Free 
Software</a>.
</p>
</body>
</html>

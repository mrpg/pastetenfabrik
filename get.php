<?php
header("Content-Type: text/html; charset=ISO-8859-1");

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
?>
<!doctype html>
<html>
<head>
<title>Pastetenfabrik</title>
</head>
<body>
<h1>Pastetenfabrik</h1>

<hr />

<p><i><?php echo date('r',$p[$id][1]); ?></i> by <?php echo (is_numeric($p[$id][2]))?'USER'.$p[$id][2]:md5($p[$id][2]).' (IP recorded)'; ?> &middot; <a href="<?php echo $id; ?>.txt">[raw]</a></p>
<h2><?php echo $id.': '.dec(base64_decode($p[$id][0])); ?></h2>

<pre>
<?php
echo dec(getp($id));
?>
</pre>

<hr />
<?php if (!empty($pgp)) echo '<p><a href="'.$pgp.'">PGP key</a></p>'; ?>
<?php if (!empty($footer)) echo $footer; ?>
<p><a href="https://github.com/mrpg/mrpasteg">Pastetenfabrik is Free Software</a>.
</p>
</body>
</html>

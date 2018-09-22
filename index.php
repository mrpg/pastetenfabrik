<?php
header("Content-Type: text/html; charset=UTF-8");

include "inc.php";
?>
<!doctype html>
<html>
<head>
<title>Pastetenfabrik at <?=$_SERVER["SERVER_NAME"] ?></title>
</head>
<body>
<h1>Pastetenfabrik at <?=$_SERVER["SERVER_NAME"] ?></h1>

<p>Current time: <i><?php echo date('r'); ?></i></p>

<?php
if (isset($_POST['do'])) {
	$u = (!empty($_POST['pw'])) ? array_search($_POST['pw'], $pw) : false;

	if ($_POST['do'] == 'add') {
		if (!$public) {
			if ($u !== false) {
				if (writep($id = getid(), $_POST['txt']) && register($id,$_POST['title'], time(), $u)) {
					echo '<p><a href="'.$id.'.html"><b>Your Paste: '.$id.'</b></a></p>';
					echo '<p>Raw size: '.strlen($_POST['txt']).' bytes, compressed size: '.filesize('p/'.$id.'.gz').' bytes.</p>';
				}
				else {
					echo '<p>Your paste could not be saved.</p>';
				}
			}
		}
		else {
			if (writep($id = getid(), $_POST['txt']) && register($id,$_POST['title'], time(), $_SERVER['REMOTE_ADDR'])) {
				echo '<p><a href="'.$id.'.html"><b>Your Paste: '.$id.'</b></a></p>';
			}
			else {
				echo '<p>Your paste could not be saved.</p>';
			}
		}
	}
	else if ($_POST['do'] == 'del' && isset($_POST['pw'])) {
		include "pref.php";

		if (exists($_POST['id'])) {
			if ($u === 0 || $u == $meta[2] || ($public && in_array($_POST['pw'], $pw))) {
				if (unlink('p/'.$_POST['id'].'.gz') && unlink('meta/'.$_POST['id'])) {
					echo '<p><a href="'.$_POST['id'].'.html"><b>'.$_POST['id'].'</b></a> deleted.</p>';
				}
				else {
					echo '<p>This paste (or its metadata) could not be deleted.</p>';
				}
			}
		}
	}
}
?>

<fieldset>
<legend><b>Add new paste</b></legend>
<form action="index.php" method="post">
	<input type="hidden" name="do" value="add" />
	Title: <input type="text" name="title" /><br />
	Text:<br />
	<textarea rows="14" cols="90" name="txt"></textarea><br />
	<?php
		if (!$public) {
			echo 'Password: <input type="password" name="pw" /><br />';
		}
	?>
	<p><i>Note:</i> Your IP address or your user ID will be recorded forever.</p>
	<input type="submit" value="Submit" />
</form>
</fieldset>

<fieldset>
<legend><b>Delete paste</b></legend>
<form action="index.php" method="post">
	<input type="hidden" name="do" value="del" />
	ID: <input type="text" name="id" /><br />
	Password: <input type="password" name="pw" /><br />
	<input type="submit" value="Submit" />
</form>
</fieldset>

<hr />
<?php if (!empty($pgp)) echo '<p><a href="'.$pgp.'">PGP key</a></p>'; ?>
<?php if (!empty($footer)) echo $footer; ?>
<p><a href="https://github.com/mrpg/pastetenfabrik">Pastetenfabrik is Free 
Software</a>.
</p>
</body>
</html>

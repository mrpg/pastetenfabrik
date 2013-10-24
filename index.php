<?php
header("Content-Type: text/html; charset=ISO-8859-1");

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
	if ($_POST['do'] == 'add') {
		if (!$public) {
			if (($u = resolve(sha512($_POST['pw']))) != -1) {
				writep($id = getid(),$_POST['txt']);
				register($id,$_POST['title'],time(),$u);
				echo '<p><a href="'.$id.'.html"><b>Your Paste: '.$id.'</b></a></p>';
			}
		}
		else {
			writep($id = getid(),$_POST['txt']);
			register($id,$_POST['title'],time(),$_SERVER['REMOTE_ADDR']);
			echo '<p><a href="'.$id.'.html"><b>Your Paste: '.$id.'</b></a></p>';
		}
	}
	else if ($_POST['do'] == 'del' && isset($_POST['pw'])) {
		include "pastes.php";
		include "pref.php";

		if (isset($p[$_POST['id']])) {
			$u = resolve(sha512($_POST['pw']));
			
			if ($u == 0 || $u == $p[$_POST['id']][2] || ($public && $u != -1)) {
				unlink('p/'.$_POST['id'].'.txt.bz2');
				file_put_contents('pastes.php','unset($p["'.$_POST['id'].'"]); // '.date('r').' - USER'.$u."\n",LOCK_EX | FILE_APPEND);
				echo '<p><a href="'.$_POST['id'].'.html"><b>'.$_POST['id'].'</b></a> deleted.</p>';
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

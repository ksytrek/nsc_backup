<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'https://';
	}
	$uri .= $_SERVER['HTTP_HOST'];



	$output = shell_exec('pwd');
	echo "<pre>$output</pre>";



	// header('Location: '.$uri.'/nsc_backup/view/login.php');
	exit;

?>

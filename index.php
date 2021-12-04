<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'https://';
	}
	$uri .= $_SERVER['HTTP_HOST'];


	shell_exec('git pull');

	// echo "555555555555555551";

	header('Location: '.$uri.'/nsc_backup/view/login.php');


	exit;
?>

<?php 
#!/usr/bin/env python

$handle = popen('python -u test.py', 'r');
while (!feof($handle)) {
    echo fgets($handle);
    echo "<br>";
    flush();
    ob_flush();
}
pclose($handle);

// require_once __DIR__.'/Config/path.php';

?>
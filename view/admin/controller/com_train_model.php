<?php
#!/usr/bin/ python3
if(isset($_POST['key']) && $_POST['key'] == 'btn-train'){

    $handle = popen('python3 -u ts_py.py', 'r');
    while (!feof($handle)) {
        echo fgets($handle);
        echo "<br>\n";
        flush();
        ob_flush();
    }
    pclose($handle);

}



?>

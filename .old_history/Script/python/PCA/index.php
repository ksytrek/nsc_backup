
<?php

set_time_limit(90000);

$handle = popen('python -u python.py', 'r');
while (!feof($handle)) {
    echo fgets($handle);
    echo "<br>";
    flush();
    ob_flush();
}
pclose($handle);

//$result = exec("python face-recognition-trainer-pcaV2.py");


// $command = escapeshellcmd('face-recognition-trainer-pcaV2.py');
// //$command = escapeshellcmd('index.py');
// $output = shell_exec($command);

// print($output);

// $handle = popen("pythn -u ./face-recognition-trainer-pcaV2.py",'r');
// while(!feof($handle)){
//     echo "$bufer<br/>\n";
//     ob_flush();
// }
// pclose($handle);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sync git update</title>
</head>
<body>
    <?php 

    $output = shell_exec('git pull');
    if($output == "Already up to date."){
        echo "อัพเดตข้อมูลจาก Github เป็นปัจจุบันแล้ว";
    }else{
        echo "<pre>$output</pre>";
    }


    ?>
</body>
</html>

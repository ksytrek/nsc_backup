<?php
if(isset($_POST['key']) && $_POST['key'] == 'btn-train'){
    // ob_start();

    // echo "oK";
    $handle = popen('python3 -u ./ts_py.py', 'r');
    while (!feof($handle)) {
        echo fgets($handle);
        echo "<br>\n";
        flush();
        ob_flush();
    }
    pclose($handle);

}



?>
<?php
#!/usr/bin/ python3
if (isset($_POST['btn-train'])) {
    
    // $handle = popen("python ./some.py ", 'r');
    // while (!feof($handle)) {
    //     $buffer = fgets($handle);
    //     echo "$buffer<br/>\n";
    //     ob_flush();
    // }
    // pclose($handle)
    // echo 
    // '<script type="text/JavaScript">
    //     window.confirm("Train Model success!!!");
    //     window.location.assign("./train_back.php")
    // </script>';
    // header("location: ./train_back.php");
    // header("location: train_back.php" );
    //    echo "window.location.href='./train_back.php'";
}



?>
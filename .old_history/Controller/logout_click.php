<?php
include_once("../Config/path.php");
    session_start();
    session_destroy();
    header("location:". _WEBSITE);
?>
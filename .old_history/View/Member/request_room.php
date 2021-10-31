<?php
include('./nabar.php');
require_once('../../Config/path.php');
require_once('../../Model/ConnectDB.php');
// session_start();




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.5.1.js"></script>
    <title>Request a room</title>

    <script language="JavaScript">
        var HttPRequest = false;

        function doCallAjax(Search) {
            HttPRequest = false;
            if (window.XMLHttpRequest) { // Mozilla, Safari,...
                HttPRequest = new XMLHttpRequest();
                if (HttPRequest.overrideMimeType) {
                    HttPRequest.overrideMimeType('text/html');
                }
            } else if (window.ActiveXObject) { // IE
                try {
                    HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {

                    }
                }
            }

            if (!HttPRequest) {
                alert('Cannot create XMLHTTP instance');
                return false;
            }

            var url = '<?php echo _CRL_MEMBER."rqroom.php" ?>';
            var pmeters = 'mySearch=' + Search;
            HttPRequest.open('POST', url, true);

            HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            HttPRequest.setRequestHeader("Content-length", pmeters.length);
            HttPRequest.setRequestHeader("Connection", "close");
            HttPRequest.send(pmeters);


            HttPRequest.onreadystatechange = function() {

                if (HttPRequest.readyState == 3) // Loading Request
                {
                    document.getElementById("mySpan").innerHTML = "Now is Loading...";
                }

                if (HttPRequest.readyState == 4) // Return Request
                {
                    document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
                }

            }

        }
    </script>

</head>

<body Onload="JavaScript:doCallAjax('');">
    <h3>Request a room : <?php echo $_SESSION["Member_Login"] ?></h3>
    <hr>
    <?php
        if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error'] ;?>
            </div>
    <?php
       unset($_SESSION['error']);
        endif;  
        
        
        
    ?> 
    <div style="display:block; width:100% ;" align="center">
        <h4>ค้นหารายชื่อห้อง</h4>
        <div  style="display:block; width:50% ;">

            <form method="POST" name="frmMain">
                <div class="input-group mb-3">
                    <input id="txtSearch" type="text" name="txtSearch" class="form-control" placeholder="กรุณากรอกชื่อห้องที่ต้องการร้องขอ" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" name="btnSearch" OnClick="JavaScript:doCallAjax(document.getElementById('txtSearch').value);" id="btnSearch">ค้นหาห้อง</button>
                </div>
            </form>
        </div>

    </div>
    

    <span id="mySpan"></span>
    
<br>
</body>

</html>
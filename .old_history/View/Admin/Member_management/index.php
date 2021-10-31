<?php
// session_start();
include_once('./nabar.php');


$search = [
    'id_code'  => $_SESSION['id_code']
];
$searcchsche = $connectDB->prepare("SELECT * FROM `schedule`");
// $searchdb = $connectDB->prepare("SELECT * FROM `tbimage` WHERE `std_code`=:id_code");
$searcchsche->execute();


$searchrq = $connectDB->prepare("SELECT * FROM `rqroom` INNER JOIN rooms ON rqroom.room_code = rooms.room_code INNER JOIN members ON rqroom.std_code = members.id_code");
// $searchdb = $connectDB->prepare("SELECT * FROM `tbimage` WHERE `std_code`=:id_code");
$searchrq->execute();

?>
<html>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Admin HOME</title>
    <!-- Main jquery-->
    <script src="../../Script/jquery/jquery-3.5.1.js"></script>
    <!-- Main CSS-->
    <!-- <link href="../../Script/css/bootstrap.min.css" rel="stylesheet" media="all"> -->
    <style type="text/css">
        body {

            /* font-family: 'Krub', sans-serif;
            font-family: 'Roboto', sans-serif; */
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Helvetica Neue, Helvetica, sans-serif;
            font-size: 16px;
            /* margin-left: 15px;
            margin-right: 15px; */
            margin-left: 3rem;
            margin-right: 3rem;
        }

    </style>

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

            var url = '<?php echo _CRL_ADMIN."src_member.php" ?>';
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
    
    <h3>Welcome TO : <?php echo $_SESSION['e_mail_ad'] ?></h3>
    <hr>
    <!-- เเจ้งเตือนเมื่อมีการทำกิจกรรมบางอย่างเสร็จ -->
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


    <!-- <script src="../../Script/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->
</body>

</html>
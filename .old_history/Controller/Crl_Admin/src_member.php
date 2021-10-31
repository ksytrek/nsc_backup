<?php
require_once("../../Config/path.php");
require_once("../../Model/ConnectDB.php");
session_start();

//แบ่งเป็น  2 ส่วน 

//กรณีไม่มีข้อความหรือค้นหาทั้งหมด
if($_POST ["mySearch"] == ""){
    $srcdb = $connectDB->prepare("SELECT * FROM rooms ORDER BY room_num ASC ");
    $srcdb->execute();
    
    ?>
<div style="display:block; width:100% ;" align="center">
    <div  style="display:block; width:100% ;">
    
        <table class="table">
            <thead>
                <tr align="center">
                    <th scope="col">ลำดับ</th>
                    <th scope="col">รหัสสมาชิก</th>
                    <th scope="col">ชื่อ</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">หมายเลขโทรศัพท์</th>
                    <th scope="col">สถานะ</th>
                    <th scope="col">เพิ่มเติม</th>
                </tr>
            </thead>
            <?php
                
                $i = 1;
                while ($objResult = $srcdb->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <tbody>
                            <tr align="center">
                                <th scope="row"><?php echo $i ?></th>
                                <td><?php echo $objResult["room_code"]; ?></td>
                                <td><?php echo $objResult["room_num"]; ?></td>
                                <td><a href="<?php echo _CRL_MEMBER . 'reqroom.php?id=' . $objResult["room_code"] ?> ">Add</a></td>
                                <td><?php echo $objResult["room_code"]; ?></td>
                                <td><?php echo $objResult["room_num"]; ?></td>
                                <td><a href="#">รายละเอียด</a></td>
                            
                            </tr>
                        </tbody>
                    <?php
                   $i++;
                }
                
            ?>
        </table>
    
    </div>
    </div>

    <?php
    //กรณีข้อความหรือค้นหาบางส่วน
}else{
    $strSearch = $_POST["mySearch"];

    // $strSQL = "SELECT * FROM rooms WHERE Name LIKE '%".$strSearch."%' ORDER BY room_num ASC ";
    $srcdb = $connectDB->prepare("SELECT * FROM rooms WHERE room_num LIKE '%" . $strSearch . "%' ORDER BY room_num ASC ");
    $srcdb->execute();
    
    if($strSearch != ""):  
?>

    
    <div style="display:block; width:100% ;" align="center">
    <div  style="display:block; width:50% ;">
    
        <table class="table">
            <thead>
                <tr align="center">
                    <th scope="col">ลำดับ</th>
                    <th scope="col">รหัสห้อง</th>
                    <th scope="col">ชื่อห้อง</th>
                    <th scope="col">เพิ่ม</th>
                </tr>
            </thead>
            <?php
                
                $i = 1;
                while ($objResult = $srcdb->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <tbody>
                            <tr align="center">
                                <th scope="row"><?php echo $i ?></th>
                                <td><?php echo $objResult["room_code"]; ?></td>
                                <td><?php echo $objResult["room_num"]; ?></td>
                                <td><a href="<?php echo _CRL_MEMBER . 'reqroom.php?id=' . $objResult["room_code"] ?> ">Add</a></td>
                            </tr>
                        </tbody>
                    <?php
                   $i++;
                }
                
            ?>
        </table>
    
    </div>
    </div>
    <?php endif;
    
            }
    ?>


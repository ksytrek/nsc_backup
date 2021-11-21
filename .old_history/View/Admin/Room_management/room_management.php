<?php
// navigatio bar
// include("./nav.php"); 
// include("./nabar.php"); 
// session_start();

//checking login
// if ($_SESSION['success_Login'] != 'Admin_Login') {
//     header("location: ../../../Controller/check_login.php");
// }
// require_once('../../../Model/ConnectDB.php');

//show all
if (isset($_GET['show_all'])) {
    $where_room = $connectDB->prepare("SELECT * FROM rooms ORDER BY room_num ASC");
}

//fetch search OR all data from database
if (isset($_SESSION['search'])) {
    $search = "'" . $_SESSION['search'] . "%" . "'";
    $where_room = $connectDB->prepare("SELECT * FROM rooms WHERE room_code LIKE $search OR room_num LIKE $search ORDER BY room_num ASC");
} else {
    $where_room = $connectDB->prepare("SELECT * FROM rooms ORDER BY room_num ASC");
}

$where_room->execute();
$row = $where_room->fetchall(PDO::FETCH_ASSOC);


//Delete a row of data in database
if (isset($_GET['code_remove'])) {
    $c = $_GET['code_remove'];
    $remove_room = $connectDB->prepare("DELETE FROM rooms where room_code = $c");
    $remove_room->execute();
    unset($_SESSION['last_modified_n']);
    unset($_SESSION['last_modified_c']);
?>
    <script>
        window.location.href='<?php echo _ROOM_MANAGEMENY."room_management.php" ?>';
    //window.location.href='View/PCA/'
    //!window.location.href();
    </script>
<?php 
}
?>

<html>

<body>

    <div style="width:80%;  margin:auto;">

        <!-- Create room form -->
        <div class="btn-group ">
            <div class='dropdown pl-4'>
                <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    สร้างห้อง
                </button>
                <div class='dropdown-menu' style='min-width: 25rem;'>
                    <form class='px-4 py-3' action='create_room.php' method='POST'>
                        <div class='form-group'>
                            <label>เลขห้อง</label>
                            <input type='text' class='form-control' name='c_num' placeholder='กรุณาป้อนเลขห้อง'>
                        </div>
                        <div class='form-group'>
                            <label>รหัสห้อง</label>
                            <input type='text' class='form-control' name='c_code' placeholder='กรุณาป้อนรหัสห้อง'>
                        </div>
                        <button type='submit' class='btn btn-primary' name='btn_createRoom_submit'>สร้าง</button>
                    </form>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='#'>สร้างล่าสุด1</a>
                    <a class='dropdown-item' href='#'>สร้างล่าสุด2</a>
                </div>
            </div>



            <!-- Search form -->
            <form class="form-inline  pr-4 pl-4" method="POST" action="search.php">
                <input class="form-control mr-sm-2" type="search" placeholder="เลขห้องที่ต้องการ" name="search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit_search">ค้นหา</button>
            </form>

            <!-- Show all-->
            <a href='?show_all=true'><button class="btn btn-info" name="show_all">แสดงทั้งหมด</button></a>

        </div>

        <?php
        if (isset($_SESSION['search'])) {
            echo "ผลการค้นหาสำหรับ :   " . "<label class='text-info'>" . $_SESSION['search'] . "</label>";
            unset($_SESSION['search']);
        }
        ?>


        <div class="row p-2">
            <div class="col">เลขห้อง</div>
            <div class="col">รหัสห้อง</div>
            <div class="col">จัดการ</div>
            <div class="col">ข้อมูล</div>
        </div>


        <div id="accordion">
            <?php
            if ($row != null) {
                //checking lastest added row
                if (isset($_SESSION['last_modified_n'])) {
                    for ($i = 0; $i < sizeof($row); $i++) {
                        if (($row[$i]["room_num"] == $_SESSION['last_modified_n']) && ($row[$i]["room_code"] == $_SESSION['last_modified_c'])) {
                            $temp = $row[0];
                            $row[0] = $row[$i];
                            $row[$i] = $temp;
                        }
                    }
                }
                $i = 0;

                //Print all data in table
                foreach ($row as $r) {
                    //marking lastest added row
                    if ($i == 0 && isset($_SESSION['last_modified_n'])) { ?>
                        <div class='card bg-warning'>
                            <div class='card-header' id='heading<?php echo $i; ?>'>
                                <div class='row'>

                                <?php } else { ?>
                                    <div class='card'>
                                        <div class='card-header' id='heading<?php echo $i; ?>'>
                                            <div class='row'>

                                            <?php } ?>

                                            <div class='col'>
                                                <label><?php print_r($r["room_num"]); ?></label>
                                            </div>

                                            <div class='col'>
                                                <label><?php print_r($r["room_code"]); ?></label>
                                            </div>

                                            <div class='col'>

                                                <!-- print check box for each row -->
                                                <input type='checkbox' value='<?php echo $r["room_code"] ?>' id='<?php echo $i; ?>c'>
                                                <!-- print remove button for each row -->
                                                <a href='?code_remove="<?php echo $r["room_code"]; ?>"'><button type='button' class='btn btn-danger'>ลบ</button></a>
                                                <!--print edit button-->
                                                <a href='edit.php?room_code="<?php echo $r["room_code"]; ?>"'><button type='button' class='btn btn-primary'>เพิ่ม</button></a>
                                            </div>

                                            <!--collapse button-->
                                            <div class='col'>
                                                <button class='btn' data-toggle='collapse' data-target='#collapse<?php echo $i; ?>' aria-expanded='true' aria-controls='collapse<?php echo $i; ?>'>
                                                    ข้อมูล
                                                </button>
                                            </div>

                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end card header-->


                                        <!--collapse content-->
                                        <div id='collapse<?php echo $i; ?>' class='collapse' aria-labelledby='heading<?php echo $i; ?>' data-parent='#accordion'>
                                            <div class='card-body'>
                                                <div class='row border'>
                                                    <div class='col'><label class='text-primary'>รหัสนักศึกษา</label></div>
                                                    <div class='col'><label class='text-primary'>ชื่อนักศึกษา</label></div>
                                                    <div class='col'></div>
                                                </div>
                                                <?php 
                                                    //ข้อมูลผู้ใช้งานที่มีสิทธ์เข้า
                                                ?>

                                                <div class='row border'>
                                                    <div class='col'>134567</div>
                                                    <div class='col'>Korawit</div>
                                                    <div class='col pt-2'><input type='checkbox'></div>
                                                </div>

                                                <div class='row border'>
                                                    <div class='col'>1234567</div>
                                                    <div class='col'>Kamonchanok</div>
                                                    <div class='col pt-2'><input type='checkbox'></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                <?php 
                            $i++;
                        }
                    } 
                ?>

                                </div>
                                <!-- check to select all -->
                                <div class='form-check form-check-inline'>
                                    <input class='form-check-input' type='checkbox' value='option1' onclick='if(this.checked){check()}else{uncheck()}'>
                                    <label class='form-check-label' for='inlineCheckbox1'>เลือกทั้งหมด</label>
                                </div>

                                <!-- Delete selected data button -->
                                <button type='button' onclick='remove_selected()' class='btn btn-danger btn-sm'>ลบที่เลือกทั้งหมด</button>

                            </div>

                            <script>
                                //Scrolling position
                                window.scrollTo(0, getCookie('y'));
                                window.addEventListener("scroll", function(event) {
                                    var scroll_y = this.scrollY;
                                    setCookie('y', scroll_y, 1);
                                    console.log(scroll_y);
                                });

                                function getCookie(cname) {
                                    var name = cname + "=";
                                    var decodedCookie = decodeURIComponent(document.cookie);
                                    var ca = decodedCookie.split(';');
                                    for (var i = 0; i < ca.length; i++) {
                                        var c = ca[i];
                                        while (c.charAt(0) == ' ') {
                                            c = c.substring(1);
                                        }
                                        if (c.indexOf(name) == 0) {
                                            return c.substring(name.length, c.length);
                                        }
                                    }
                                    return "";
                                }

                                function setCookie(cname, cvalue, exdays) {
                                    var d = new Date();
                                    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                                    var expires = "expires=" + d.toUTCString();
                                    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                                }
                                //check all
                                function check() {
                                    var count = <?php echo sizeof($row) ?>;
                                    for (x = 0; x < count; x++) {
                                        document.getElementById(x + "c").checked = true;
                                    }
                                }
                                //unchek all 
                                function uncheck() {
                                    var count = <?php echo sizeof($row) ?>;
                                    for (x = 0; x < count; x++) {
                                        document.getElementById(x + "c").checked = false;
                                    }
                                }
                                //ajax remove selected 
                                function remove_selected() {
                                    var str = [];
                                    var count = <?php echo sizeof($row) ?>;
                                    for (x = 0; x < count; x++) {
                                        var check = document.getElementById(x + "c");
                                        if (check.checked == true) {
                                            str.push(check.value);
                                        }
                                    }

                                    $.ajax({
                                        type: "POST",
                                        url: "remove_selected.php",
                                        data: {
                                            remove_val: str
                                        },
                                        success: function(response) {
                                            location.reload();
                                        }
                                    });
                                }
                            </script>

                           
</body>

</html>
    <?php 
    session_start();
    if ($_SESSION['success_Login'] != 'Admin_Login') {
        header("location: ../../../Controller/check_login.php");  
    }
    require_once('../../../Model/ConnectDB.php');

    header('Content-Type: application/json');

         if(isset($_POST['remove_val']))
        {
            
            for($i=0;$i<sizeof($_POST['remove_val']);$i++){
            
            $r = $_POST['remove_val'][$i];
            $remove_room = $connectDB->prepare("DELETE FROM rooms where room_code = $r");
            $remove_room->execute();
            
            }echo json_encode("remove is done");
        }
        

    ?>
<?php 
    session_start();
    require_once('../../../Model/ConnectDB.php');
    include("./nabar.php"); // navigatio bar
    if ($_SESSION['success_Login'] != 'Admin_Login') {
        header("location: ../../../Controller/check_login.php");  
    }
        if(isset($_GET['room_code'])){
            
        }
    ?>

<div class="row">
  <div class="col">Room number</div>
  <div class="col">Room code</div>
  <div class="col"><!-- check to select all -->
            <div class='form-check form-check-inline'>
            <input class='form-check-input' type='checkbox' value='option1' onclick="if(this.checked){check()}else{uncheck()}">
            <label class='form-check-label' for='inlineCheckbox1'>Select All</label>
            </div> 
            
            <!-- Delete selected data button -->
            <button type="submit"  name="submit_remove_selected" class="btn btn-danger btn-sm">Remove All Selected</button></form></div>
</div>

  

    
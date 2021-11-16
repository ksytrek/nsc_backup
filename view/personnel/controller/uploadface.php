<?php   
	include("../../../config/connectdb.php");
	if(isset($_POST['key']) && $_POST['key'] == "uploadface"){

		$imgBase64 = "";
		$count = "";
		if(isset($_POST['imgBase64']) && isset($_POST['count'])){

			//import Value
			$id_mem = $_POST['id_mem'];
			$imgBase64 = $_POST['imgBase64'];
			$count = $_POST['count'];


			// echo $id_mem.$count;    
			// $output = shell_exec('mkdir newdir');

			mkdir("./aklje", 0755,true);

			//set value
			// $folder = $id_mem;
			// สร้างโฟลเดอร์เพื่อไว้เก็บรูปภาพ
			// mkdir("../../../file_image/{$folder}", 0777,true);
			// mkdir("./{$folder}", 0755,true);


		}
	}































	// if ($_SESSION['success_Login'] == 'Member_Login') { //Uploaded For Admin

		//$foldeName = {$_SESSION["student_name"]} ;
		$foldeName= strtolower(str_replace(' ',"_","{$_SESSION['id_code']}"));

		$Msgerror;
		$success;
		$sucdel;
		
		// mkdir("../Script/PCA/datasets/faces/{$foldeName}", 0700,true);
		mkdir("../Script/python/PCA/datasets/faces/{$foldeName}", 0777,true);


		// Requires php5   
		define('PATH_UPLOAD', "../Script/python/PCA/datasets/faces/{$foldeName}/");
		if(isset($_POST['imgBase64']))   {

			$img = $_POST['imgBase64'];
			$count = $_POST['count']+1;

			if($count == "20"){
				$i = $_SESSION["id_code"];
				$up = $connectDB->prepare("UPDATE members SET `stu_face`='1' WHERE id_code='$i'");
				$up->execute();
			}

			$file_base = $foldeName."_".$count.'.png';

			$sear = $connectDB->prepare("SELECT `name_image` FROM `tbimage` WHERE `name_image`='$file_base'");
			// ลบฐานข้อมูล ซ้ำ path_image
			if($sear->execute()){
				try{
					$dele = $connectDB->prepare("DELETE FROM `tbimage` WHERE `tbimage`.`name_image` = '$file_base'");
					if($dele->execute()){
						$img = str_replace('data:image/png;base64,', '', $img);   
						$img = str_replace('', '+', $img);   

						$data = base64_decode($img); 

						$file = PATH_UPLOAD.$file_base;
						$success = file_put_contents($file, $data);
						
						$newPATH = str_replace('../','',PATH_UPLOAD);
						$newNAME = $foldeName."_".$count.'.png';
						$refer  = $_SESSION['id_code'];
					}
				}catch (PDOException $e) {
					$Msgerror = $e->getMessage();
				}
			}
			// $file = ../Script/python/PCA/datasets/faces/62122710108/62122710108_2.png
			if($success){
				$pachImg = [
					'id_code'	=> $refer,
					'path'		=> $newPATH,
					'name' 		=> $newNAME
				];
				//print $file;
				if(!isset($Msgerror)){
					// Add Database Path_image
					try{
						$insert_img = $connectDB->prepare("INSERT INTO `tbimage` (`std_code`, `path_image`, `name_image`) VALUES (:id_code, :path, :name)");
						if($insert_img->execute($pachImg)){
							$insertMsg = "File Uploaded successfully..........";
							
						}else{
							$Msgerror = "Seve IMG TO not Database";
						}
					}catch(PDOException $e){
						$Msgerror = $e->getMessage();
					}
				}else{
					$Msgerror = "มีข้อผิลพลาด จากข้อความ ERROR";
				}
			}
		}
		else{
			$Msgerror = "Error ไม่ได้ส่งข้อมูลมา..";
		}
	// }
	// else if($_SESSION['success_Login'] == 'Admin_Login'){  //Uploads For Admin
	// 	//$foldeName = {$_SESSION["student_name"]} ;
	// 	$foldeName= strtolower(str_replace(' ',"_","{$_SESSION['id_code']}"));
	// 	$Msgerror;
	// 	$success;
	// 	$sucdel;
	// 	// mkdir("../Script/PCA/datasets/faces/{$foldeName}", 0700,true);
	// 	mkdir("../Script/python/PCA/datasets/faces/{$foldeName}", 0700,true);


	// 	// Requires php5   
	// 	define('PATH_UPLOAD', "../Script/python/PCA/datasets/faces/{$foldeName}/");
	// 	if(isset($_POST['imgBase64']))   {

	// 		$img = $_POST['imgBase64'];
	// 		$count = $_POST['count']+1;

	// 		if($count == "20"){
	// 			$i = $_SESSION["id_code"];
	// 			$up = $connectDB->prepare("UPDATE members SET `stu_face`='1' WHERE id_code='$i'");
	// 			$up->execute();
	// 		}

	// 		$file_base = $foldeName."_".$count.'.png';

	// 		$sear = $connectDB->prepare("SELECT `name_image` FROM `tbimage` WHERE `name_image`='$file_base'");
	// 		// ลบฐานข้อมูล ซ้ำ path_image
	// 		if($sear->execute()){
	// 			try{
	// 				$dele = $connectDB->prepare("DELETE FROM `tbimage` WHERE `tbimage`.`name_image` = '$file_base'");
	// 				if($dele->execute()){
	// 					$img = str_replace('data:image/png;base64,', '', $img);   
	// 					$img = str_replace('', '+', $img);   

	// 					$data = base64_decode($img); 

	// 					$file = PATH_UPLOAD.$file_base;
	// 					$success = file_put_contents($file, $data);
						
	// 					$newPATH = str_replace('..','',PATH_UPLOAD);
	// 					$newNAME = $foldeName."_".$count.'.png';
	// 					$refer  = $_SESSION['id_code'];
	// 				}
	// 			}catch (PDOException $e) {
	// 				$Msgerror = $e->getMessage();
	// 			}
	// 		}
	// 		// $file = ../Script/python/PCA/datasets/faces/62122710108/62122710108_2.png
	// 		if($success){
	// 			$pachImg = [
	// 				'id_code'	=> $refer,
	// 				'path'		=> $newPATH,
	// 				'name' 		=> $newNAME
	// 			];
	// 			//print $file;
	// 			if(!isset($Msgerror)){
	// 				// Add Database Path_image
	// 				try{
	// 					$insert_img = $connectDB->prepare("INSERT INTO `tbimage` (`std_code`, `path_image`, `name_image`) VALUES (:id_code, :path, :name)");
	// 					if($insert_img->execute($pachImg)){
	// 						$insertMsg = "File Uploaded successfully..........";
							
	// 					}else{
	// 						$Msgerror = "Seve IMG TO not Database";
	// 					}
	// 				}catch(PDOException $e){
	// 					$Msgerror = $e->getMessage();
	// 				}
	// 			}else{
	// 				$Msgerror = "มีข้อผิดพลาด จากข้อความ ERROR";
	// 			}
	// 		}
	// 	}
	// 	else{
	// 		$Msgerror = "Error ไม่ได้ส่งข้อมูลมา..";
	// 	}
	
	// }else{
	// 	header("location: ./check_login.php");
	// }
	


	
	if(isset($insertMsg)){
		print 'DONE .... '.$insertMsg;
	}
	if(isset($Msgerror)){
		print "Error ....".$Msgerror;
	}

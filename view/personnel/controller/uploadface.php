<?php
include("../../../config/connectdb.php");
require("./up_image.php");


if (isset($_POST['key']) && $_POST['key'] == "uploadface") {

	$imgBase64 = "";
	$count = "";

	if (isset($_POST['imgBase64']) && isset($_POST['count'])) {

		//import Value
		$id_mem = $_POST['id_mem'];
		$imgBase64 = $_POST['imgBase64'];
		$count = $_POST['count'] + 1;


		// qurey 
		$qurey_id_code = Database::query("SELECT `id_code` FROM members WHERE `id_mem`= {$id_mem};", PDO::FETCH_ASSOC);
		$row = $qurey_id_code->fetch();
		//set value
		$folder = $row['id_code'];
		define('PATH_UPLOAD', "../../../file_image/{$folder}/");

		// สร้างโฟลเดอร์เพื่อไว้เก็บรูปภาพ
		@mkdir("../../../file_image/{$folder}", 0755, true);
		// mkdir("./{$folder}", 0755,true);


		if ($count == 50) {
			Database::query("UPDATE `members` SET `stu_face` = '1' WHERE `id_mem`= {$id_mem};");
		}

		// เตรียมอัพโหลดลงฐานข้อมูล
		$file_base = $folder . "_" . $count . '.png';


		try {
			if (Database::query("DELETE FROM `tbimage` WHERE `tbimage`.`name_image` = '$file_base'")) {
				// data:image/png;base64,
				$img = str_replace('data:image/png;base64,', '', $imgBase64);
				$img = str_replace('', '+', $img);

				$data = base64_decode($img);

				$file = PATH_UPLOAD . $file_base;

				// อัพโหลดไฟล์ภาพลงฐานข้อมูลสำเร็จ
				try {
					file_put_contents($file, $data);

					$insert_data_image = [
						'id_mem'		=> $id_mem,
						'path_image'	=> "file_image/{$folder}/",
						'name_image' 	=> $file_base
					];

					if (Database::insert_data("tbimage", $insert_data_image)) {
						// echo "success";
						echo $count;
					}
				} catch (Exception $e) {
					echo "error";
				}
			}
		} catch (Exception $e) {
			echo "error";
		}
	}
}
<!DOCTYPE html>
<html>
      
<head>
    <title>Test trainning </title>
	<link rel="shortcut icon" href="server2.png">
</head>
  
<body style="text-align:center;">
      
    <h1 style="color:green;">
        Test trainning server
    </h1>
    
      
    <form method="post">
        <input type="submit" name="train" value="Train all faces on server"/>

        <input type="submit" name="manage" value="Manage faces on server"/>


    </form>


    <?php



        if(isset($_POST['train'])) {


			chdir("C:/Users/koraw/Desktop/NSC/DetectionFaceV2");
			$command = escapeshellcmd('python face-recognition-trainer-pcaV3.py');
			$output = shell_exec($command);
			echo $output;

        }

        if(isset($_POST['manage'])) {

            $dir    = 'file_image';
            $files1 = array_diff(scandir($dir), array('..', '.'));
            
            //checklist for removing folder of image
            echo "<form method='post'>";
            foreach($files1 as $file)
            {
                echo "<input type='submit' name='folder' value='$file'/>";
                echo "<input type='checkbox' name='check_list[]' value='$file'><br>";
            }
            echo "<input type='submit' value='remove_folder'/></form>";

        }

        if(isset($_POST['folder'])) {
            echo $_POST['folder'];
			$dirname = "file_image/".$_POST['folder']."/";
            $images = glob($dirname."*.jpg");
            echo "<form method='post'>";
            foreach($images as $image) {
                echo "<input type='checkbox' name='check_list_img[]' value='$image'>";
                echo '<img src="'.$image.'" /><br />';
            }
            echo "<input type='submit' value='remove_file'/></form>";
        }
        
        if(!empty($_POST['check_list'])) {

            foreach($_POST['check_list'] as $check) {
                chmod("file_image/".$check,0755);
                deleteDir("file_image/".$check);
                echo "removed  ".$check."<br>";
            }
        }

        if(!empty($_POST['check_list_img'])) {
            
            foreach($_POST['check_list_img'] as $check) {
                unlink($check);
                echo "removed  ".$check."<br>";
            }
        }

        
        // $lfjreo = explode(" remo -m -f path/fofjdslf/");


        function deleteDir($dirPath) {
            if (! is_dir($dirPath)) {
                throw new InvalidArgumentException("$dirPath must be a directory");
            }
            if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
                $dirPath .= '/';
            }
            $files = glob($dirPath . '*', GLOB_MARK);
            foreach ($files as $file) {
                if (is_dir($file)) {
                    deleteDir($file);
                } else {
                    unlink($file);
                }
            }
            rmdir($dirPath);
        }

    ?>
</head>
  
</html>
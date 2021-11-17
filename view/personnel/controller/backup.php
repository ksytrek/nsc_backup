<?php 
include_once("../../../config/connectdb.php");

function createZip($zip,$dir){
    if (is_dir($dir)){

        if ($dh = opendir($dir)){
            while (($file = readdir($dh)) !== false){
                
                // If file
                if (is_file($dir.$file)) {
                    if($file != '' && $file != '.' && $file != '..'){
                        
                        $zip->addFile($dir.$file);
                    }
                }else{
                    // If directory
                    if(is_dir($dir.$file) ){

                        if($file != '' && $file != '.' && $file != '..'){

                            // Add empty directory
                            $zip->addEmptyDir($dir.$file);

                            $folder = $dir.$file.'/';
                            
                            // Read data of the folder
                            createZip($zip,$folder);
                        }
                    }
                    
                }
                    
            }
            closedir($dh);
        }
    }else{
        
    }
}

// Download Created Zip file
if(isset($_POST['backup'])){
    $id_mem = $_POST["id_mem"];
    $id_code = Database::query("SELECT `id_code` FROM `members` WHERE `id_mem` = '$id_mem'",PDO::FETCH_ASSOC);
    $name = "";

    foreach($id_code as $row){
        $name = $row['id_code'];
    }

    $zip = new ZipArchive();
    $filename = "./".$name.".zip";
    $filename1 =$name.".zip";
    if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        exit("cannot open <$filename>\n");
    }

    $dir = '../../..//file_image/'.$name."/";
    // Create zip
    createZip($zip,$dir);

    $zip->close();
    if (file_exists($filename1)) {
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="'.basename($filename1).'"');
        header('Content-Length: ' . filesize($filename1));

        flush();
        readfile($filename1);
        // delete file
        unlink($filename1);
    
    }else{
        echo "
            <script type=\"text/javascript\">
                alert('ไม่มีข้อมูลรูปภาพ');
                location.assign('../image_search.php');
            </script>
        ";
    }
}
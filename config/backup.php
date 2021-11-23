<?php
class BackUpFileImage
{
    
    // public static function createZip($zip, $dir,$path,$name )

    public static function createZip($path,$name)
    {
        $filename =  $path . $name . ".zip";
        $zip = new ZipArchive();
        // $filename1 = "../../../file_image/" .$name . ".zip";
        if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
            exit("cannot open <$filename>\n");
        }
    
        $dir = $path . $name . "/";


        if (is_dir($dir)) {

            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {

                    // If file
                    if (is_file($dir . $file)) {
                        if ($file != '' && $file != '.' && $file != '..') {

                            $zip->addFile($dir . $file);
                        }
                    } else {
                        // If directory
                        if (is_dir($dir . $file)) {

                            if ($file != '' && $file != '.' && $file != '..') {

                                // Add empty directory
                                $zip->addEmptyDir($dir . $file);

                                $folder = $dir . $file . '/';

                                // Read data of the folder
                                createZip($zip, $folder);
                            }
                        }
                    }
                }
                closedir($dh);
            }
        } else {
        }
        $zip->close();
    }
    public static function download_images($path,$name,$sgu) {
        $filename = $path.$name .$sgu;
        if (file_exists($filename)) {
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
            header('Content-Length: ' . filesize($filename));

            flush();
            readfile($filename);
            // delete file
            unlink($filename);
        } else {
            return " <script type=\"text/javascript\">
                alert('ไม่มีข้อมูลรูปภาพ');
                location.assign('../image_search.php');
            </script> ";
        }
        return "downlo";
    }
}

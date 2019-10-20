<?php

// please Increase the max upload size of the php.ini to 200M
$task = Util::getParam('task');

$videoExt = ['mp4', 'avi'];
$docsExt = ['pdf'];
$acceptedFileExt = array_merge($videoExt, $docsExt);
$fileToUpload = $_FILES['fileToUpload'];
$ext = pathinfo($fileToUpload['name'], PATHINFO_EXTENSION);
$fileClass = '';
if (in_array($ext, $acceptedFileExt)) {
    if (in_array($ext, $videoExt)) {
        $fileClass = 'video';
        $path = 'public/video';
    } elseif (in_array($ext, $acceptedFileExt)) {
        $fileClass = 'docs';
        $path = 'public/pdf';
    }
    if (isset($path)) {
        $Uploader = new Upload($fileToUpload);
        if ($fileClass == 'video') {
            $Uploader->file_new_name_body = "Video";
        } elseif ($fileClass == 'docs') {
            $Uploader->file_new_name_body = "Doc";
        }
        if ($Uploader->uploaded) {
            $Uploader->Process($path);
            if ($Uploader->processed) {
                //upload success
                echo  $Uploader->file_dst_name;
                $file = FileManager::CreateFile($Uploader->file_dst_name,$fileClass);
            } else {
                echo 'error : '.$Uploader->log;
            }
        }
    }
} else {
    echo 'unsupported file format';
}

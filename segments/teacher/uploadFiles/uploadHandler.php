<?php
$task = Util::getParam('task');
echo "task";


$pdfLocation = '/public/pdf';
$videoLocation = 'public/video';
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
    } elseif (in_array($ext, $fileExt)) {
        $fileClass = 'docs';
        $path = '/public/pdf';
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
            if ($videoUp->processed) {
                //upload success
                $file = new FileManager($Uploader->file_dst_name,$fileClass);
            } else {
                echo 'error : '.$videoUp->log;
            }
        }
    }
} else {
    echo 'unssupported file format';
}

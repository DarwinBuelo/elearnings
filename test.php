<?php
require 'init.php';

$videoUp                     = new Upload($_FILES['image']);
$videoUp->file_new_name_body = "testFile";

if ($videoUp->uploaded) {
    $videoUp->Process('images/upload');
    if ($videoUp->processed) {
        //upload success
        echo $videoUp->file_dst_name;
    } else {
        echo 'error : '.$videoUp->log;
    }
}
?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit"  name="submit">
</form>
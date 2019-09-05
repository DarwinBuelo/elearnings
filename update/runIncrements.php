<?php
include('../class/Dbcon.php');

const TABLE_NAME = 'run_increments';

$files=glob("../database/*.*");
Dbcon::$dbname = 'elearning';
$data = "
    SELECT
        file_name
    FROM
        run_increments
    ORDER BY
        date desc
";
$result = Dbcon::execute($data);
$fetchValue = Dbcon::fetch_all_assoc($result);
$message = '';

foreach ($files as $file) {
    $content = file_get_contents($file);
    $fileType = substr(strrchr($file, "."), 1);
    if ($fileType === 'sql') {
        $sqlData = [
            'file_name'  =>  $file
        ];
        $message .=  '<pre>'. var_dump('success', $file) .'</pre>';
        if (!empty($fetchValue)) {
            foreach ($fetchValue as $value) {
                if (in_array($file, $value)) {
                    continue;
                } else {
                    Dbcon::execute($content);
                    Dbcon::insert(TABLE_NAME, $sqlData);
                    echo $message;
                }
            }
        } else {
            Dbcon::execute($content);
            Dbcon::insert(TABLE_NAME, $sqlData);
            echo $message;
        }
    } else {
        continue;
    }
}
//EOF
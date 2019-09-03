<?php
include('../class/Dbcon.php');

const TABLE_NAME = 'run_increments';

$files=glob("../database/*.*");
$dbname='elearning';
Dbcon::$dbname = $dbname;
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
    $sqlData = [
        'file_name'  =>  $file
    ];
    $message .=  '<pre>'. var_dump($file) .'</pre><br>';
    $message .=  '<pre>'. var_dump('success', $content) .'</pre>';
    if (!empty($fetchValue)) {
        foreach ($fetchValue as $value) {
            if (in_array($file, $value)) {
                continue;
            } else {
                Dbcon::execute($content);
                Dbcon::insert($dbname.".".TABLE_NAME, $sqlData);
                echo $message;
            }
        }
    } else {
        Dbcon::execute($content);
        Dbcon::insert($dbname.".".TABLE_NAME, $sqlData);
        echo $message;
    }
}
//EOF
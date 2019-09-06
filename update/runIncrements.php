<?php
include('../class/Dbcon.php');

const TABLE_NAME = 'run_increments';

$files         = glob("../database/*.*");
Dbcon::$dbname = 'elearning';
$data          = "
    SELECT
        file_name
    FROM
        run_increments
    ORDER BY
        date desc
";
$result        = Dbcon::execute($data);
$fetchValue    = Dbcon::fetch_all_assoc($result);
$message       = [];
$existing      = [];
foreach ($fetchValue as $column) {
    $existing[] = $column["file_name"];
}
?>
<html>
 <body>

    <?php
foreach ($files as $file) {
    $content  = file_get_contents($file);
    $fileType = substr(strrchr($file, "."), 1);
    if ($fileType === 'sql') {
        $sqlData = [
            'file_name' => $file
        ];
        if (!in_array($file, $existing)) {
            $result = Dbcon::execute($content);
            if($result){
                Dbcon::insert(TABLE_NAME, $sqlData);
                $message[]= ["Success" => "Success in executing the query : " .$file ];
            }
            else{
               if(strpos(Dbcon::$error,"already exists") != false){
                   Dbcon::insert(TABLE_NAME, $sqlData);
               }
               $message[]= ["Failed" => "Failed to run the script : " .$file,"Error" => Dbcon::$error];
            }
        }
    } else {
        continue;
    }
}
?>
     <pre><?php var_dump($message)?></pre>
    </body>
</html>
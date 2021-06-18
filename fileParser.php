<?php
function csvLastValue($path, $unitType){
    $handle = fopen($path, "r");
    $data = fgetcsv($handle);
    $date = $data[count($data)-2];
    $value = $data[count($data)-1];
    echo($date . " " . $value . $unitType);
    fclose($handle);
};
?>
<?php
function csv_to_array($file, $delimiter, $columns) {
    $myCSV = fopen(plugin_dir_path( __FILE__ ).$file, "r");
    $retData = [];

    if ($myCSV !== FALSE) {
        $i = 0;
        while (($data = fgetcsv($myCSV, 0, $delimiter)) !== FALSE) {
            for ($c = 0; $c < $columns; $c++) {
                if ($data[$c] == "") {
                    $data[$c] = NULL;
                }
                $retData[$i][$c] = $data[$c];
            }
            $i++;
        }
        fclose($myCSV);
        return $retData;
    }
}
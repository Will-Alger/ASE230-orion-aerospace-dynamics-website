<?php
function readCsvFile($filename)
{
    $fileContent = array();
    if (file_exists($filename)) {
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                $fileContent[] = $data;
            }
            fclose($handle);
        }
    }
    return $fileContent;
}

function writeCsvFile($filename, $data)
{
    $fileHandle = fopen($filename, 'w');
    foreach ($data as $row) {
        fputcsv($fileHandle, $row);
    }
    fclose($fileHandle);
}

<?php
function readJsonFile($filename)
{
    if (!file_exists($filename)) {
        return false;
    }

    $str = file_get_contents($filename);
    return json_decode($str, true);
}

function writeJsonFile($filename, $data)
{
    $existing_data = readJsonFile($filename);

    if ($existing_data === false) {
        $existing_data = array();
    }
    $existing_data[] = $data;
    $json_data = json_encode($existing_data, JSON_PRETTY_PRINT);
    return file_put_contents($filename, $json_data);
}

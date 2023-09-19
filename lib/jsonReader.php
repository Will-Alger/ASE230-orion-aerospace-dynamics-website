<?php
function readJsonFile($filename)
{
    if (!file_exists($filename)) {
        return false;
    }

    $str = file_get_contents($filename);
    return json_decode($str, true); // second parameter to true to receive output as an array instead of object
}

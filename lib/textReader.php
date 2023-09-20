<?php
function readTxtFile($filename)
{
    $fileContent = '';
    if (file_exists($filename)) {
        $fileContent = file_get_contents($filename);
    } else {
        $fileContent = 'The file ' . $filename . ' does not exist';
    }
    return $fileContent;
}

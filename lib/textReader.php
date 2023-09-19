<?php
function readTxtFile($filename)
{
    $fileContent = '';
    if (file_exists($filename)) {
        $fileContent = file_get_contents($filename);
    }
    return $fileContent;
}

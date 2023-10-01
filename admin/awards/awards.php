<?php
require_once('../../config.php');

function getAwards($filePath)
{
    $fileHandle = fopen($filePath, 'r');
    $awards = [];
    while (($line = fgetcsv($fileHandle)) !== FALSE) {
        $awards[] = $line;
    }
    fclose($fileHandle);
    return $awards;
}

function getAward($filePath, $id)
{
    $fileHandle = fopen($filePath, 'r');
    $index = 0;
    while (($line = fgetcsv($fileHandle)) !== FALSE) {
        if ($index == $id) {
            fclose($fileHandle);
            return $line;
        }
        $index++;
    }
    fclose($fileHandle);
    return null;
}
function updateAward($id, $year = null, $description = null)
{
    $filePath = root . awards;
    $awards = getAwards($filePath);

    $id = $id + 1;

    if (!is_numeric($id) || $id < 0 || $id >= count($awards)) {
        throw new Exception("Invalid ID: {$id}");
    }

    if ($year !== null) {
        if (filter_var($year, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0, "max_range" => 9999]])) {
            $awards[$id][0] = $year;
        } else {
            throw new Exception("Invalid Year: {$year}");
        }
    }

    if ($description !== null) {
        $awards[$id][1] = $description;
    }

    $fileHandle = fopen($filePath, 'w');
    fputcsv($fileHandle, $awards[0]);
    for ($i = 1; $i < count($awards); $i++) {
        fputcsv($fileHandle, $awards[$i]);
    }
    fclose($fileHandle);
}


function addAward($year, $description)
{
    $filePath = root . awards;

    $newAward = [$year, $description];
    $fileHandle = fopen($filePath, 'a');
    fputcsv($fileHandle, $newAward);
    fclose($fileHandle);
}

function deleteAward($id)
{
    $filePath = root . awards;
    $awards = getAwards($filePath);

    if (!is_numeric($id) || $id < 0 || $id >= count($awards)) {
        throw new Exception("Invalid ID: {$id}");
    }

    array_splice($awards, $id, 1);

    $fileHandle = fopen($filePath, 'w');

    foreach ($awards as $award) {
        fputcsv($fileHandle, $award);
    }

    fclose($fileHandle);
}

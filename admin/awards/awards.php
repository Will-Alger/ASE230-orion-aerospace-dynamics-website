<?php
require_once('../../config.php');
require_once('../../lib/csvReader.php');

function getAwards($filePath)
{
    return readCsvFile($filePath);
}

function getAward($filePath, $id)
{
    $awards = readCsvFile($filePath);

    if ($id >= 0 && $id < count($awards)) {
        return $awards[$id];
    }

    return null;
}
function updateAward($id, $year = null, $description = null)
{
    $filePath = AWARDS_DATA;
    $awards = readCsvFile($filePath);

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

    writeCsvFile($filePath, $awards);
}


function addAward($year, $description)
{
    $awards = readCsvFile(AWARDS_DATA);

    $newAward = [$year, $description];
    array_push($awards, $newAward);

    writeCsvFile(AWARDS_DATA, $awards);
}

function deleteAward($id)
{
    $awards = readCsvFile(AWARDS_DATA);
    if (!is_numeric($id) || $id < 0 || $id >= count($awards)) {
        throw new Exception("Invalid ID: {$id}");
    }
    array_splice($awards, $id + 1, 1);
    writeCsvFile(AWARDS_DATA, $awards);
}

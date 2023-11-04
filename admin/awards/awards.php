<?php
require_once('../../config.php');
require_once('../../lib/csvReader.php');

// function getAwards($filePath)
// {
//     return readCsvFile($filePath);
// }

// function getAward($filePath, $id)
// {
//     $awards = readCsvFile($filePath);

//     if ($id >= 0 && $id < count($awards)) {
//         return $awards[$id];
//     }

//     return null;
// }
// function updateAward($id, $year = null, $description = null)
// {
//     $filePath = AWARDS_DATA;
//     $awards = readCsvFile($filePath);

//     $id = $id + 1;

//     if (!is_numeric($id) || $id < 0 || $id >= count($awards)) {
//         throw new Exception("Invalid ID: {$id}");
//     }

//     if ($year !== null) {
//         if (filter_var($year, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0, "max_range" => 9999]])) {
//             $awards[$id][0] = $year;
//         } else {
//             throw new Exception("Invalid Year: {$year}");
//         }
//     }

//     if ($description !== null) {
//         $awards[$id][1] = $description;
//     }

//     writeCsvFile($filePath, $awards);
// }


// function addAward($year, $description)
// {
//     $awards = readCsvFile(AWARDS_DATA);

//     $newAward = [$year, $description];
//     array_push($awards, $newAward);

//     writeCsvFile(AWARDS_DATA, $awards);
// }

// function deleteAward($id)
// {
//     $awards = readCsvFile(AWARDS_DATA);
//     if (!is_numeric($id) || $id < 0 || $id >= count($awards)) {
//         throw new Exception("Invalid ID: {$id}");
//     }
//     array_splice($awards, $id + 1, 1);
//     writeCsvFile(AWARDS_DATA, $awards);
// }


require_once '../utility/CsvHelper.php';


class Award
{
    public $id;
    public $year;
    public $description;

    public function __construct($year, $description)
    {
        $this->year = $year;
        $this->description = $description;
    }
}

class AwardManager
{
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function getAwards()
    {
        $rows = CSVHelper::read($this->filename);
        $awards = [];

        foreach (array_slice($rows, 1) as $row) {
            $award = new Award($row[1], $row[2]);
            $award->id = $row[0];
            $awards[] = $award;
        }

        return $awards;
    }

    public function addAward(Award $award)
    {
        $awards = $this->getAwards();
        $lastId = end($awards)->id ?? 0;
        $award->id = $lastId + 1;

        $awards[] = $award;

        $rows = array_map(function ($award) {
            return [$award->id, $award->year, $award->description];
        }, $awards);

        array_unshift($rows, ['Id', 'Year', 'Award']);
        return CSVHelper::write($this->filename, $rows);
    }

    public function updateAward($id, $newData)
    {
        $awards = $this->getAwards();
        foreach ($awards as $index => $award) {
            if ($award->id == $id) {
                $awards[$index]->year = $newData['year'] ?? $award->year;
                $awards[$index]->description = $newData['description'] ?? $award->description;

                $rows = array_map(function ($award) {
                    return [$award->id, $award->year, $award->description];
                }, $awards);

                array_unshift($rows, ['Id', 'Year', 'Award']);
                return CSVHelper::write($this->filename, $rows);
            }
        }
        return false;
    }

    public function deleteAward($id)
    {
        $awards = $this->getAwards();
        $awards = array_filter($awards, function ($award) use ($id) {
            return $award->id != $id;
        });

        $rows = array_map(function ($award) {
            return [$award->id, $award->year, $award->description];
        }, $awards);

        array_unshift($rows, ['Id', 'Year', 'Award']);
        return CSVHelper::write($this->filename, $rows);
    }
}

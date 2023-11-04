<?php

class CSVHelper {

    public static function read($filename) {
        $rows = [];
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($data = fgetcsv($handle)) !== false) {
                $rows[] = $data;
            }
            fclose($handle);
        }
        return $rows;
    }

    public static function write($filename, $data) {
        $handle = fopen($filename, 'w');
        if ($handle === false) {
            return false;
        }

        foreach ($data as $row) {
            if (fputcsv($handle, $row) === false) {
                fclose($handle);
                return false;
            }
        }

        fclose($handle);
        return true;
    }

    public static function updateRow($filename, $newRow, $rowIndex) {
        $data = self::read($filename);

        if (!isset($data[$rowIndex])) {
            return false;
        }

        $data[$rowIndex] = $newRow;
        return self::write($filename, $data);
    }

    public static function delete($filename) {
        return file_exists($filename) ? unlink($filename) : false;
    }
}

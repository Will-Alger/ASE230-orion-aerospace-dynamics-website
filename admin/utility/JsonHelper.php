<?php

class JsonHelper
{

    public static function read($filename)
    {
        if (!file_exists($filename)) {
            return [];
        }

        $jsonContent = file_get_contents($filename);
        return json_decode($jsonContent, true);
    }

    public static function write($filename, $data)
    {
        $jsonContent = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        return file_put_contents($filename, $jsonContent) !== false;
    }


    public static function update($filename, $newData)
    {
        $currentData = self::read($filename);
        $updatedData = array_merge($currentData, $newData);
        return self::write($filename, $updatedData);
    }

    public static function delete($filename)
    {
        return file_exists($filename) ? unlink($filename) : false;
    }
}

<?php
namespace models;

use core\Core;

class Cities
{
    public static $tableName = 'cities';

    public static function getAllCities()
    {
        return Core::get()->db->select(self::$tableName);
    }

    public static function getCityById($id)
    {
        return Core::get()->db->select(self::$tableName, '*', ['id' => $id])[0] ?? null;
    }
}

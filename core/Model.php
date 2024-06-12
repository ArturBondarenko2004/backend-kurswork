<?php

namespace core;

class Model
{
    protected $fieldsArray;
    protected static $primaryKey = 'id';
    protected static $tableName = '';

    public function __construct()
    {
        $this->fieldsArray = [];
    }

    public function __set($name, $value)
    {
        $this->fieldsArray[$name] = $value;
    }

    public function __get($name)
    {
        return $this->fieldsArray[$name];
    }

    public static function deleteById($id)
    {
        Core::get()->db->delete(static::$tableName, [static::$primaryKey => $id]);
    }

    public static function deleteByCondition($ConditionAssocArray)
    {
        Core::get()->db->delete(static::$tableName, $ConditionAssocArray);
    }

    public static function findById($id)
    {
        $arr = Core::get()->db->select(static::$tableName, '*', [static::$primaryKey => $id]);
        if (count($arr) > 0) {
            return $arr[0];
        } else
            return null;
    }

    public static function findByCondition($ConditionAssocArray)
    {
        $arr = Core::get()->db->select(static::$tableName, '*', $ConditionAssocArray);
        if (count($arr) > 0) {
            return $arr;
        } else
            return null;
    }

    public function save()
    {
        $value = $this->{static::$primaryKey};
        if (empty($value)) //insert
        {
            Core::get()->db->insert(static::$tableName, $this->fieldsArray);
        } else //update
        {
            Core::get()->db->update(static::$tableName, $this->fieldsArray, [
                static::$primaryKey => $this->{static::$primaryKey}
            ]);
        }

    }

}
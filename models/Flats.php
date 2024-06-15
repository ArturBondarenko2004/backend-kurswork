<?php

namespace models;

use core\Model;
use core\Core;

/**
 * @property string $title Заголовок новини
 * @property string $text Текст новини
 * @property string $short_text Короткий текст новини
 * @property string $date Дата новини
 * @property string $ID ID новини
 * @property mixed $rooms_id
 */
class Flats extends Model

{

    public static $tableName = 'flats';

    public static function getFlats($cityId = null)
    {
        $where = [];
        if ($cityId) {
            $where = ['city_id' => $cityId];
        }

        $flats = Core::get()->db->select('flats', '*', $where);

        foreach ($flats as $flat) {
            $city = Cities::getCityById($flat->city_id);
            if ($city) {
                $flat->city_name = $city->name;
            } else {
                $flat->city_name = 'Невідоме місто';
            }
        }

        return $flats;
    }

    public static function getFlatsById($id)
    {
        return Core::get()->db->select(self::$tableName, '*', ['id' => $id])[0] ?? null;
    }

    public static function updateFlats($id, $data)
    {
        return Core::get()->db->update(self::$tableName, $data, ['id' => $id]);
    }


    public function delete($where)
    {
        return Core::get()->db->delete(self::$tableName, $where);
    }

    public static function deleteById($id)
    {
        return Core::get()->db->delete(self::$tableName, ['id' => $id]);
    }

    public function save()
    {
        $data = [
            'city_id' => $this->city_id,
            'title' => $this->title,
            'address' => $this->address,
            'price' => $this->price,
            'description' => $this->description,
            'saler_contact' => $this->saler_contact,
            'saler_name' => $this->saler_name,
            'photo_path' => $this->photo_path,
        ];

        if (isset($this->id) && $this->id) {
            Core::get()->db->update(self::$tableName, $data, ['id' => $this->id]);
        } else {
            Core::get()->db->insert(self::$tableName, $data);
        }
    }
}

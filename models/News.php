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
 */
class News extends Model
{
    public static $tableName = 'news';

    public static function getNews(): ?array
    {
        // Використовуємо fetchAll(\PDO::FETCH_ASSOC) для отримання асоціативних масивів
        return Core::get()->db->select(self::$tableName, "*", null, \PDO::FETCH_ASSOC);
    }

    public static function getNewsById($id)
    {
        return Core::get()->db->select('news', '*', ['id' => $id])[0] ?? null;
    }

    public static function updateNews($id, $data)
    {
        return Core::get()->db->update('news', $data, ['id' => $id]);
    }

    public function delete($where)
    {
        return Core::get()->db->delete('news', $where);
    }


}
?>

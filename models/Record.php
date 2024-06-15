<?php

namespace models;

use core\Core;
use core\Model;

class Record extends Model
{
    public static $tableName = 'record';

    public $firstName;
    public $lastName;
    public $contact;
    public $time;

    public function save()
    {
        $data = [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'contact' => $this->contact,

        ];

        return Core::get()->db->insert(self::$tableName, $data);
    }
}

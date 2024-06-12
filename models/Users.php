<?php

namespace models;

use core\Core;
use core\Model;

/**
 * @property int $ID ID
 * @property string $login
 * @property string $password
 * @property string $firstname Короткий текст новини
 * @property string $lastname новини
 */
class Users extends Model
{
    public static $tableName = 'users';

    public static function FindByLoginAndPassword($login, $password)
    {
        $rows = self::findByCondition(['login' => $login, 'password' => $password]);
        if (!empty($rows)) {
            return $rows[0];
        } else
            return null;
    }
    public static function isUserLogged(){
        return  !empty(Core::get()->session->get('user'));
    }
    public static function LoginUser($user){
        Core::get()->session->set('user', $user);
    }
    public static function LogoutUser(){
        Core::get()->session->remove('user');
    }

}
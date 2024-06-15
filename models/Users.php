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
    public static $currentUser;
    public static $tableName = 'users';

    public static function FindByLoginAndPassword($login, $password)
    {
        $rows = self::findByCondition(['login' => $login, 'password' => $password]);
        if (!empty($rows)) {
            return $rows[0];
        } else
            return null;
    }

    public static function FindByLogin($login)
    {
        $rows = self::findByCondition(['login' => $login]);
        if (!empty($rows)) {
            return $rows[0];
        } else
            return null;
    }

    public static function isUserLogged()
    {
        return !empty(Core::get()->session->get('user'));
    }

    public static function LoginUser($user)
    {
        Core::get()->session->set('user', $user);
    }

    public static function LogoutUser()
    {
        Core::get()->session->remove('user');
    }

    public static function RegisterUser($login, $password, $lastname, $firstname)
    {
        $user = new Users();
        $user->login = $login;
        $user->password = $password;
        $user->lastname = $lastname;
        $user->firstname = $firstname;
        $user->save();
    }

    public static function getCurrentUser()
    {
        return Core::get()->session->get('user');
    }

    public static function isAdmin()
    {
        $user = self::getCurrentUser();
        return $user && $user->login === 'admin@ztu.edu.ua';
    }

    public static function deleteUserById($id)
    {
        return Core::get()->db->delete(self::$tableName, ['id' => $id]);
    }


}
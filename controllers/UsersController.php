<?php

namespace controllers;

use core\Controller;
use models\Users;
use models\Record;

class UsersController extends Controller
{
    public function actionLogin()
    {
        if (Users::isUserLogged())
            return $this->redirect('/');
        if ($this->isPost) {
            $user = Users::FindByLoginAndPassword($this->post->login, $this->post->password);
            if (!empty($user)) {
                Users::LoginUser($user);
                return $this->redirect('/news/index');
            } else
                $this->addErrorMessage('Неправильний логін та/або пароль');
        }
        return $this->render();
    }
    public function actionRegister()
    {
        if ($this->isPost) {
            $this->post->login;
            $user = Users::FindByLogin($this->post->login);
            if (!empty($user)) {
                $this->addErrorMessage('Користувач з таким логіном вже існує');
            }
            if (strlen($this->post->login) === 0)
                $this->addErrorMessage('Логін не вказано');
            if ($this->post->password != $this->post->password2)
                $this->addErrorMessage('Паролі не співпадають');
            if (strlen($this->post->password) === 0)
                $this->addErrorMessage('Пароль не вказано');
            if (strlen($this->post->password2) === 0)
                $this->addErrorMessage('Пароль(ще раз) не вказано');
            if (strlen($this->post->lastname) === 0)
                $this->addErrorMessage('Прізвище не вказано');
            if (strlen($this->post->firstname) === 0)
                $this->addErrorMessage("Ім`я не вказано");
            if (!$this->isErrorMessageExists()) {
                Users::RegisterUser($this->post->login, $this->post->password, $this->post->lastname, $this->post->firstname);
                return $this->redirect('/users/registersuccess');
            }
        }
        return $this->render();
    }
    public function actionRegistersuccess()
    {
        return $this->render();
    }
    public function actionLogout()
    {
        Users::LogoutUser();
        return $this->redirect('/users/login');
    }
    public function actionDeleteAccount()
    {
        if (!Users::isUserLogged()) {
            return $this->redirect('/users/login');
        }

        $user = Users::getCurrentUser();
        if ($this->isPost) {
            Users::deleteUserById($user->id);
            Users::LogoutUser();
            return $this->redirect('/news/index');
        }

        return $this->render('views/users/deleteaccount.php', ['user' => $user]);
    }
    public function actionRecord()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['firstName'] ?? '';
            $lastName = $_POST['lastName'] ?? '';
            $contact = $_POST['contact'] ?? '';
            $time = $_POST['time'] ?? '';
            $record = new Record();
            $record->firstName = $firstName;
            $record->lastName = $lastName;
            $record->contact = $contact;
            $record->time = $time;

            if ($record->save()) {
                echo "<p>Ви успішно записалися на перегляд квартири!</p>";
            } else {
                echo "<p>Не вдалося зробити запис. Спробуйте ще раз.</p>";
            }
        } else {
            include 'views/users/record.php';
        }
    }
    public function actionRecordForm()
    {
        return $this->render('views/users/recordform.php');
    }





}
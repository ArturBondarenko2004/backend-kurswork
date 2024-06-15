<?php

namespace controllers;

namespace controllers;

use core\Controller;
use core\Core;
use core\RequestMethod;
use models\Cities;
use models\Users;

class CitiesController extends Controller
{
    public function actionEditCity($params)
    {
        if (!Users::isAdmin()) {
            return $this->redirect('/cities/index');
        }
        $cityId = $params[0];
        $cityItem = Cities::getCityById($cityId);

        if (!$cityItem) {
            return $this->redirect('/cities/index');
        }
        if ($this->isPost) {
            $requestData = new RequestMethod($_POST);

            // Оновлення даних про місто
            $cityItem['name'] = $requestData->name;

            // Оновлення запису в базі даних
            Core::get()->db->update(Cities::$tableName, ['name' => $cityItem['name']], ['id' => $cityId]);

            // Після оновлення перенаправлення на сторінку перегляду міст
            return $this->redirect('/cities/index');
        }

        return $this->render('views/cities/edit.php', ['cityItem' => $cityItem]);
    }
}

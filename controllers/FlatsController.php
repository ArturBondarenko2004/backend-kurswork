<?php

namespace controllers;

use core\Controller;
use core\RequestMethod;
use core\Core;
use core\Template;
use models\Cities;
use models\Flats;
use models\News;
use models\Users;
use core\DB;

class FlatsController extends Controller
{

    //News/add

    public function actionAdd(): array
    {
        $data = Flats::getFlats();
        $cities = Cities::getAllCities(); // Завантаження списку міст



        if (!Users::isAdmin()) {
            return $this->redirect('/');
        }
        if ($this->isPost) {
            $requestData = new RequestMethod($_POST);

            // Обробка завантаження файлу
            $photoPath = null;
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
                $photoDir = 'files/flats/';
                $photoPath = $photoDir . basename($_FILES['photo']['name']);
                move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
            }

            $flat = new Flats();
            $flat->id = $requestData->id;
            $flat->city_id = $requestData->city_id;
            $flat->title = $requestData->title;
            $flat->address = $requestData->address;
            $flat->price = $requestData->price;
            $flat->area = $requestData->area;
            $flat->description = $requestData->description;
            $flat->status_id = $requestData->status_id;
            $flat->rooms_id = $requestData->rooms_id;
            $flat->saler_contact = $requestData->saler_contact;
            $flat->saler_name = $requestData->saler_name;
            $flat->photo_path = $photoPath;

            $flat->save(); // Збереження оголошення в базу даних

            // Після збереження перенаправлення на іншу сторінку чи відображення повідомлення
            $this->redirect('/flats/index', ['cities' => $cities]);
        }
        return $this->render();
    }

    public function actionDelete($params): void
    {
        if (!Users::isAdmin()) {
            return; // Обробка відсутності прав доступу
        }

        $flatId = $params[0]; // Отримуємо flat_id з параметрів URL

        $flat = new Flats();
        $flat->delete(['id' => $flatId]);

        // Після видалення перенаправлення на сторінку перегляду оголошень
        $this->redirect('/flats/index');
    }
    public function actionIndex(): array
    {
        $cityId = $_GET['city_id'] ?? null;
        var_dump($cityId);

        $cityId = $_GET['city_id'] ?? null;
        var_dump($cityId); // Перевірка значення cityId

        if ($cityId) {
            $data = Flats::getFlats(['city_id' => $cityId]);
        } else {
            $data = Flats::getFlats();
        }
        $cities = Cities::getAllCities();

        return $this->render('views/flats/view.php', [
            'data' => $data,
            'cities' => $cities,
        ]);
    }




    public function actionView($params): array
    {
        $data = [];
        return $this->render('views/flats/view.php', ['data' => $data]);
    }

        // Flats/edit/{id}
    public function actionEdit($params): array
    {

        $cities = Cities::getAllCities();
        if (!Users::isAdmin()) {
            return $this->redirect('/');
        }

        $flatId = $params[0];
        $flatItem = Flats::getFlatsById($flatId);

        if (!$flatItem) {
            return $this->redirect('/flats/index');
        }

        if ($this->isPost) {
            $requestData = new RequestMethod($_POST);

            // Оновлення даних про квартиру з новими даними
            $flatItem->city_id = $requestData->city_id;
            $flatItem->address = $requestData->address;
            $flatItem->title = $requestData->title;
            $flatItem->price = $requestData->price;
            $flatItem->area = $requestData->area;
            $flatItem->description = $requestData->description;
            $flatItem->status_id = $requestData->status_id;
            $flatItem->rooms_id = $requestData->rooms_id;
            $flatItem->saler_contact = $requestData->saler_contact;
            $flatItem->saler_name = $requestData->saler_name;

            // Обробка завантаження нового фото
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
                $photoDir = 'files/flats/';
                $photoPath = $photoDir . basename($_FILES['photo']['name']);
                move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
                $flatItem->photo_path = $photoPath;
            }

            // Оновлення запису в базі даних
            Flats::updateFlats($flatId, [
                'city_id' => $flatItem->city_id,
                'address' => $flatItem->address,
                'title' => $flatItem->title,
                'price' => $flatItem->price,
                'area' => $flatItem->area,
                'description' => $flatItem->description,
                'status_id' => $flatItem->status_id,
                'rooms_id' => $flatItem->rooms_id,
                'saler_contact' => $flatItem->saler_contact,
                'saler_name' => $flatItem->saler_name,
                'photo_path' => $flatItem->photo_path
            ]);

            // Після оновлення перенаправлення на сторінку перегляду оголошень
            return $this->redirect('/flats/index');
        }

        return $this->render('views/flats/edit.php', ['flatItem' => $flatItem, 'cities' => $cities]);
    }







}
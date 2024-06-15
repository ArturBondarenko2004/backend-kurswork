<?php

namespace controllers;

use core\Controller;
use core\RequestMethod;
use models\Cities;
use models\Flats;
use models\Users;

class FlatsController extends Controller
{

    //News/add
    public function actionAdd(): array
    {
        if (!Users::isAdmin()) {
            return $this->redirect('/');
        }

        $cities = Cities::getAllCities(); // Завантаження списку міст

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
            $flat->city_id = $requestData->city_id;
            $flat->title = $requestData->title;
            $flat->address = $requestData->address;
            $flat->price = $requestData->price;
            $flat->description = $requestData->description;
            $flat->status_id = $requestData->status_id;
            $flat->saler_contact = $requestData->saler_contact;
            $flat->saler_name = $requestData->saler_name;
            $flat->photo_path = $photoPath;

            $flat->save(); // Збереження оголошення в базу даних

            // Після збереження перенаправлення на іншу сторінку чи відображення повідомлення
            return $this->redirect('/flats/index');
        }
        return $this->render('views/flats/add.php', [
            'cities' => $cities
        ]);
    }

    public function actionDelete($params)
    {
        if (!Users::isAdmin()) {
            return $this->redirect('/flats/index');
        }

        if ($this->isPost) {
            $flatId = $params[0];

            if (Flats::deleteById($flatId)) {
                echo json_encode(['success' => true]);
                exit; // Додано вихід, щоб зупинити подальше виконання
            } else {
                echo json_encode(['success' => false]);
                exit; // Додано вихід, щоб зупинити подальше виконання
            }
        }

        return $this->redirect('/flats/index');
    }

    public function actionIndex(): array
    {
        $cityId = $_GET['city_id'] ?? null;

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
            $flatItem->city_id = $requestData->city_id;
            $flatItem->address = $requestData->address;
            $flatItem->title = $requestData->title;
            $flatItem->price = $requestData->price;
            $flatItem->description = $requestData->description;
            $flatItem->status_id = $requestData->status_id;
            $flatItem->saler_contact = $requestData->saler_contact;
            $flatItem->saler_name = $requestData->saler_name;

            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
                $photoDir = 'files/flats/';
                $photoPath = $photoDir . basename($_FILES['photo']['name']);
                move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
                $flatItem->photo_path = $photoPath;
            }
            Flats::updateFlats($flatId, [
                'city_id' => $flatItem->city_id,
                'address' => $flatItem->address,
                'title' => $flatItem->title,
                'price' => $flatItem->price,
                'description' => $flatItem->description,
                'saler_contact' => $flatItem->saler_contact,
                'saler_name' => $flatItem->saler_name,
                'photo_path' => $flatItem->photo_path
            ]);
            return $this->redirect('/flats/index');
        }
        return $this->render('views/flats/edit.php', ['flatItem' => $flatItem, 'cities' => $cities]);
    }
}
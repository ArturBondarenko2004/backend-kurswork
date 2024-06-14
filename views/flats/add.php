<?php
/** @var string $Title */
$this->Title = 'Додати оголошення';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $Title ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Додати квартиру</h1>
    <form id="flatsForm" method="post" action="/flats/add" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок оголошення</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="city_id" class="form-label">Місто</label>
            <select class="form-control" id="city_id" name="city_id">
                <?php /** @var string $cities */
                foreach ($data as $flatItem) :
                foreach ($cities as $city): ?>
                    <option value="<?= htmlspecialchars($city->id) ?>"
                        <?= ($flatItem->city_id == $city->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($city->name) ?>
                    </option>
                <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Адреса</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Ціна</label>
            <input type="text" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="area" class="form-label">Площа</label>
            <input type="text" class="form-control" id="area" name="area" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Опис</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="status_id" class="form-label">Статус</label>
            <input type="text" class="form-control" id="status_id" name="status_id" required>
        </div>
        <div class="mb-3">
            <label for="rooms_id" class="form-label">Кількість кімнат</label>
            <input type="text" class="form-control" id="rooms_id" name="rooms_id" required>
        </div>
        <div class="mb-3">
            <label for="saler_contact" class="form-label">Контакт продавця</label>
            <input type="text" class="form-control" id="saler_contact" name="saler_contact" required>
        </div>
        <div class="mb-3">
            <label for="saler_name" class="form-label">Ім'я продавця</label>
            <input type="text" class="form-control" id="saler_name" name="saler_name" required>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Фото</label>
            <input type="file" class="form-control" id="photo" name="photo" required>
        </div>
        <button type="submit" class="btn btn-primary">Додати оголошення</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

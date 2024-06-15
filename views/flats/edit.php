<?php
/** @var \models\Flats $flatItem */
/** @var string $Title */
/** @var string $cities */
$this->Title = 'Редагувати оголошення';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= $Title ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .mt-5 {
            width: 500px;
            margin: 0 auto;
        }

        .form-label {
            font-size: 20px;
        }

    </style>
</head>
<body>
<div class="container mt-5">
    <h1>Редагувати оголошення</h1>
    <form id="editFlatForm" method="post" action="/flats/edit/<?= $flatItem->id ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок оголошення</label>
            <input type="text" class="form-control" id="title" name="title"
                   value="<?= htmlspecialchars($flatItem->title) ?>" required>
        </div>
        <div class="mb-3">
            <label for="city_id" class="form-label">Місто</label>
            <select class="form-control" id="city_id" name="city_id">
                <?php
                foreach ($cities as $city): ?>
                    <option value="<?= htmlspecialchars($city->id) ?>"
                        <?= ($flatItem->city_id == $city->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($city->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Адреса</label>
            <input type="text" class="form-control" id="address" name="address"
                   value="<?= htmlspecialchars($flatItem->address) ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Ціна</label>
            <input type="text" class="form-control" id="price" name="price"
                   value="<?= htmlspecialchars($flatItem->price) ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Опис</label>
            <textarea class="form-control" id="description" name="description" rows="3"
                      required><?= htmlspecialchars($flatItem->description) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="saler_contact" class="form-label">Контакт продавця</label>
            <input type="text" class="form-control" id="saler_contact" name="saler_contact"
                   value="<?= htmlspecialchars($flatItem->saler_contact) ?>" required>
        </div>
        <div class="mb-3">
            <label for="saler_name" class="form-label">Ім'я продавця</label>
            <input type="text" class="form-control" id="saler_name" name="saler_name"
                   value="<?= htmlspecialchars($flatItem->saler_name) ?>" required>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Фото</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
        <button type="submit" class="btn btn-primary">Зберегти зміни</button>
        <a href="/flats/index" class="btn btn-secondary">Відміна</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
/** @var string $Title */
/** @var array $cities */
/** @var object|null $flatItem */
$this->Title = 'Додати оголошення';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($Title) ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container-form {
            width: 500px;
            margin: 0 auto;
        }

        .form-label {
            font-size: 20px;
        }

    </style>
</head>
<body>
<div class="container-form">
    <div class="container mt-5">
        <form id="flatsForm" method="post" action="/flats/add" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Заголовок оголошення</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="city_id" class="form-label">Місто</label>
                <select class="form-control" id="city_id" name="city_id" required>
                    <option value="" disabled selected>Виберіть місто</option>
                    <?php
                    if (!empty($cities)) {
                        foreach ($cities as $city): ?>
                            <option value="<?= htmlspecialchars($city->id) ?>">
                                <?= htmlspecialchars($city->name) ?>
                            </option>
                        <?php endforeach;
                    } else {
                        echo '<option value="" disabled>Немає доступних міст</option>';
                    }
                    ?>
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
                <label for="description" class="form-label">Опис</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
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
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

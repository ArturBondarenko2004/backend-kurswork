<?php
/** @var array $data */
/** @var string $Title */
/** @var array $cities */

use models\Users;

$this->Title = 'Оголошення';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= $Title ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-text {
            word-wrap: break-word;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <?php if (Users::isAdmin()) : ?>
        <a href="/flats/add" class="btn btn-primary mb-4">Додати оголошення</a>
    <?php endif; ?>

    <!-- Форма для вибору міста -->
    <form action="/flats/index" method="GET" class="mb-4">
        <div class="form-group">
            <label for="citySelect">Виберіть місто:</label>
            <select class="form-control" id="citySelect" name="city_id">
                <option value="">Усі міста</option>
                <?php foreach ($cities as $city) : ?>
                    <option value="<?= $city->id ?>" <?= isset($_GET['city_id']) && $_GET['city_id'] == $city->id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($city->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Фільтрувати</button>
    </form>

    <?php if (!empty($data)) : ?>
        <div class="row">
            <?php foreach ($data as $flatItem) : ?>
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($flatItem->title); ?></h5>
                            <p class="card-text"><?= htmlspecialchars($flatItem->description); ?></p>
                            <p class="card-text"><small class="text-muted">Адреса: <?= htmlspecialchars($flatItem->address); ?></small></p>
                            <p class="card-text"><small class="text-muted">Місто: <?= htmlspecialchars($flatItem->city_name); ?></small></p>
                            <p class="card-text"><small class="text-muted">Ціна: <?= htmlspecialchars($flatItem->price); ?></small></p>
                            <p class="card-text"><small class="text-muted">Площа: <?= htmlspecialchars($flatItem->area); ?></small></p>
                            <p class="card-text"><small class="text-muted">Кількість кімнат: <?= htmlspecialchars($flatItem->rooms_id); ?></small></p>
                            <p class="card-text"><small class="text-muted">Контакт продавця: <?= htmlspecialchars($flatItem->saler_contact); ?></small></p>
                            <p class="card-text"><small class="text-muted">Ім'я продавця: <?= htmlspecialchars($flatItem->saler_name); ?></small></p>
                            <?php if (!empty($flatItem->photo_path)) : ?>
                                <img src="/<?= htmlspecialchars($flatItem->photo_path); ?>" class="img-fluid" alt="Фото квартири">
                            <?php endif; ?>
                        </div>
                        <?php $currentUser = Users::getCurrentUser(); ?>
                        <?php if ($currentUser && Users::isAdmin()) : ?>
                            <div class="card-footer">
                                <a href="/flats/edit/<?= $flatItem->id ?>" class="btn btn-warning btn-sm">Редагувати</a>
                                <a href="/flats/delete/<?= $flatItem->id ?>" class="btn btn-danger btn-sm">Видалити</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p class="alert alert-warning">Немає оголошень для відображення.</p>
    <?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

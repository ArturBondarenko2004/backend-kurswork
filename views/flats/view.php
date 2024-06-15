<?php
/** @var array $data */
/** @var string $Title */

/** @var array $cities */

use models\Users;

$currentUser = Users::getCurrentUser();
$this->Title = 'Оголошення';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= $Title ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transition: box-shadow 0.3s ease-in-out;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .card-text {
            margin-bottom: 0.5rem;
        }

        .text-muted {
            color: #6c757d;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 1rem 1.5rem;
            border-bottom-left-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
            margin-top: auto;
        }

        .card-text {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .record-link {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }

        .record-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <?php if (!empty($data)) : ?>
        <div class="row">
            <?php foreach ($data as $flatItem) : ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <?php if (!empty($flatItem->photo_path)) : ?>
                            <img src="/<?= htmlspecialchars($flatItem->photo_path); ?>" class="img-fluid"
                                 alt="Фото квартири">
                        <?php endif; ?>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <h2 class="card-title"><?= htmlspecialchars($flatItem->title); ?></h2>
                                </li>
                                <li class="mb-3">
                                    <p class="card-text"><?= htmlspecialchars($flatItem->description); ?></p>
                                </li>
                                <li class="mb-3">
                                    <p class="card-text">
                                        <strong>Адреса:</strong> <?= htmlspecialchars($flatItem->address); ?></p>
                                </li>
                                <li class="mb-3">
                                    <p class="card-text">
                                        <strong>Місто:</strong> <?= htmlspecialchars($flatItem->city_name); ?></p>
                                </li>
                                <li class="mb-3">
                                    <p class="card-text"><strong>Ціна
                                            (грн):</strong> <?= htmlspecialchars($flatItem->price); ?></p>
                                </li>
                                <li class="mb-3">
                                    <p class="card-text">
                                        <strong>Продавець:</strong> <?= htmlspecialchars($flatItem->saler_name); ?></p>
                                </li>
                                <li class="mb-3">
                                    <p class="card-text">
                                        <strong>Контакти:</strong> <?= htmlspecialchars($flatItem->saler_contact); ?>
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="card-footer">
                            <?php if (Users::isUserLogged()) : ?>
                                <a class="record-link" href="/users/recordform">Запис на перегляд</a>
                            <?php endif; ?>

                        </div>
                        <?php if ($currentUser && Users::isAdmin()) : ?>
                            <div class="card-footer">
                                <a href="/flats/edit/<?= $flatItem->id ?>" class="btn btn-warning btn-sm">Редагувати</a>
                                <button class="btn btn-danger btn-sm delete-flat" data-id="<?= $flatItem->id ?>">
                                    Видалити
                                </button>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('.delete-flat').on('click', function () {
            var flatId = $(this).data('id');
            var $card = $(this).closest('.card');

            if (confirm('Ви впевнені, що хочете видалити це оголошення?')) {
                $.ajax({
                    url: '/flats/delete/' + flatId,
                    method: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            $card.parent().fadeOut('fast', function () {
                                $(this).remove(); // Видалення картки оголошення зі сторінки
                            });
                        } else {
                            alert('Не вдалося видалити оголошення.');
                        }
                    },
                    error: function () {
                        alert('Виникла помилка при видаленні оголошення.');
                    }
                });
            }
        });
    });
</script>
</body>
</html>

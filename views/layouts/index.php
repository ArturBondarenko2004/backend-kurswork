<?php
/** @var string $Title */

/** @var string $Content */

use models\Users;
use core\Core;

if (empty($Title))
    $Title = ' ';
if (empty($Content))
    $Content = ' ';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $Title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <style>

        .content {

            min-height: 600px;
        }

        .nav-link {
            font-size: 25px;
        }

        .container {
            margin: 0 auto;
        }

    </style>

</head>
<body>
<div class="container">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/news/index" class="nav-link px-2 link-secondary">Новини</a></li>
                <li><a href="/flats/index" class="nav-link px-2 link-body-emphasis">Оголошення</a></li>
                <?php if (!Users::isUserLogged()) : ?>
                    <li><a href="/users/login" class="nav-link px-2 link-body-emphasis">Увійти</a></li>
                    <li><a href="/users/register" class="nav-link px-2 link-body-emphasis">Зареєструватись</a></li>
                <?php endif; ?>
            </ul>
            <div class="dropdown text-end">
                <?php
                if (Users::isUserLogged()) :
                ?>
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                   data-bs-toggle="dropdown" aria-expanded="false">

                    <img src="/files/assets/icon.png" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>

                <ul class="dropdown-menu text-small">

                    <?php if (Users::isAdmin()) : ?>
                        <a href="/flats/add" class="dropdown-item">Додати оголошення</a>
                    <?php endif; ?>
                    </li>
                    <li> <?php if (Users::isAdmin()) : ?>
                            <a href="/news/add" class="dropdown-item">Додати новину</a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="/users/deleteaccount">Видалити акаунт</a></li>
                    <li><a class="dropdown-item" href="/users/recordform">Запис на перегляд</a></li>
                    <li><a class="dropdown-item" href="/users/logout">Вийти</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div>
        <!--        <h1>--><?php //= $Title ?><!--</h1>-->
        <h1 class="content"><?= $Content ?></h1>
    </div>
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        </ul>
        <p class="text-center text-body-secondary">© 2024 by Artur Bondarenko</p>
    </footer>
</div>
</body>
</html>
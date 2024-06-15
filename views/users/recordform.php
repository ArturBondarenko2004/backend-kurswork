<?php if (!empty($error_message)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $error_message; ?>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Запис на перегляд квартири</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-label {
            font-size: 25px;
        }
        .form-container {
            width: 50%;
            margin: 0 auto;
            margin-top: 50px;
        }
        .alert {
            font-size: 20px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Запис на перегляд квартири</h2>
    <form id="recordForm" action="/users/record" method="POST">
        <div class="mb-3">
            <label for="firstName" class="form-label">Ім'я</label>
            <input type="text" class="form-control" id="firstName" name="firstName" required>
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">Прізвище</label>
            <input type="text" class="form-control" id="lastName" name="lastName" required>
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label">Контакт</label>
            <input type="text" class="form-control" id="contact" name="contact" required>
        </div>
        <div class="mb-3">
            <label for="time" class="form-label">Дата</label>
            <input type="date" class="form-control" id="time" name="time" required>
            <small id="timeHelp" class="form-text text-muted">Дата коли вам зручно переглянути квартиру.</small>
        </div>
        <button type="submit" class="btn btn-primary">Записатися</button>
    </form>
</div>
</body>
</html>

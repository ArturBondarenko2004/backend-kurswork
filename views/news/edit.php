<?php
/** @var \models\News $newsItem */
/** @var string $Title */
$this->Title = 'Редагувати новину';
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= $Title ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <form method="post">
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($newsItem->title); ?>">
        </div>
        <div class="form-group">
            <label for="short_text">Короткий опис</label>
            <input type="text" class="form-control" id="short_text" name="short_text" value="<?= htmlspecialchars($newsItem->short_text); ?>">
        </div>
        <div class="form-group">
            <label for="text">Повний текст</label>
            <textarea class="form-control" id="text" name="text"><?= htmlspecialchars($newsItem->text); ?></textarea>
        </div>
        <div class="form-group">
            <label for="date">Дата</label>
            <input type="date" class="form-control" id="date" name="date" value="<?= htmlspecialchars($newsItem->date); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Зберегти зміни</button>
        <a href="/news/index" class="btn btn-secondary">Відміна</a>
    </form>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

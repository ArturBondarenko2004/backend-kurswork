<?php
/** @var string $Title */
$this->Title = 'Додати новину';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $Title ?></title>
</head>
<body>

<form id="newsForm" method="post" action="/news/add">
    <div class="mb-3">
        <label for="title" class="form-label">Заголовок новини</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="mb-3">
        <label for="short_text" class="form-label">Короткий опис новини</label>
        <textarea class="form-control" id="short_text" name="short_text" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Повний текст новини</label>
        <textarea class="form-control" id="text" name="text" rows="6"></textarea>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Дата публікації</label>
        <input type="date" class="form-control" id="date" name="date">
    </div>
    <button type="submit" class="btn btn-primary">Додати новину</button>
</form>



</body>
</html>

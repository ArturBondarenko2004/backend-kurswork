
<?php
/** @var array $data */
/** @var string $Title */
$this->Title = 'Новини';
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

    <a href="/news/add" class="btn btn-primary mb-4">Додати новину</a>
    <?php if (!empty($data)) : ?>
        <div class="row">
            <?php foreach ($data as $newsItem) : ?>
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($newsItem->title); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($newsItem->short_text); ?></h6>
                            <p class="card-text"><?= htmlspecialchars($newsItem->text); ?></p>
                            <p class="card-text"><small class="text-muted">Дата: <?= htmlspecialchars($newsItem->date); ?></small></p>
                        </div>
                        <div class="card-footer">
                            <a href="/news/edit/<?= $newsItem->id; ?>" class="btn btn-warning btn-sm">Редагувати</a>
                            <a href="/news/delete/<?= $newsItem->id; ?>" class="btn btn-danger btn-sm">Видалити</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p class="alert alert-warning">Немає новин для відображення.</p>
    <?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Видалити обліковий запис</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <h5 class="card-header">Видалити обліковий запис</h5>
        <div class="card-body">
            <p class="card-text">Ви дійсно хочете видалити свій обліковий запис, <?php echo htmlspecialchars($user->login); ?>?</p>
            <form method="post" action="/users/deleteaccount">
                <button type="submit" class="btn btn-danger">Видалити</button>
                <a href="/news/index" class="btn btn-secondary">Скасувати</a>
            </form>
        </div>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

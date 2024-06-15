<?php
/** @var string $error_message Повідомлення про помилку */
$this->Title = 'Авторизація'
?>
<style>
    .form-label{
        font-size: 25px;
    }
    .form-container{
        width: 50%;
        margin: 0 auto;
    }
    .alert{
        font-size: 20px;
    }
</style>

<div class="form-container">
<form method="post" action="">
    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error_message; ?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="inputEmail" class="form-label">Логін/Email</label>
        <input name="login" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="inputPassword" class="form-label">Пароль</label>
        <input name="password" type="password" class="form-control" id="inputPassword">
    </div>

    <button type="submit" class="btn btn-primary">Увійти</button>
</form>
</div>
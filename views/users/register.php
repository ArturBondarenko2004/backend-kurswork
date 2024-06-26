<?php
/** @var string $error_message Повідомлення про помилку */
$this->Title = 'Реєстрація нового користувача';

?>
<style>
    .form-label {
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
        <div class="mb-3">
            <label for="inputLastName" class="form-label">Прізвище</label>
            <input value="<?= $this->controller->post->lastname ?>" name="lastname" type="text" class="form-control"
                   id="inputLastName">
        </div>
        <label for="inputFirstName" class="form-label">Ім'я</label>
        <input value="<?= $this->controller->post->firstname ?>" name="firstname" type="text" class="form-control"
               id="inputFirstName">
    </div>

    <div class="mb-3">
        <label for="inputEmail" class="form-label">Логін/Email</label>
        <input value="<?= $this->controller->post->login ?>" name="login" type="email" class="form-control"
               id="inputEmail" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="inputPassword" class="form-label">Пароль</label>
        <input value="<?= $this->controller->post->password ?> " name="password" type="password" class="form-control"
               id="inputPassword">
    </div>
    <div class="mb-3">
        <label for="inputPassword2" class="form-label">Пароль(ще раз)</label>
        <input value="<?= $this->controller->post->password2 ?>" name="password2" type="password" class="form-control"
               id="inputPassword2">
    </div>
    <button type="submit" class="btn btn-primary">Зареєструватися</button>
</form>
</div>
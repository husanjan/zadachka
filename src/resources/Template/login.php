

<a href="/"><button class="btn btn-dark"> Главная</button></a>




<?php if (!empty($errorMessage)) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $errorMessage ?>
    </div>
<?php } ?>

<form action="/login" method="post" style="max-width: 400px">
    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" class="form-control" id="login" placeholder="Введите логин" name="login"
               value="<?= $login ?>">
    </div>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" class="form-control" id="password" placeholder="Пароль" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Войти</button>
</form>
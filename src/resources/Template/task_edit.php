<a href="/?page=<?= $curr_page ?>"><button class="btn bg-danger">Главная</button> </a>


<?php if (!empty($errorMessage)) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $errorMessage ?>
    </div>
<?php } else { ?>

    <?php if (!empty($successMessage)) { ?>
        <div class="alert alert-success" role="alert">
            <?= $successMessage ?>
        </div>
    <?php } ?>

    <form action="/tasks/<?= $task_id ?>/?page=<?= $curr_page ?>"
          method="post" style="max-width: 400px">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="status" value="1"
                   id="status" <?= $status == 1 ? 'checked' : '' ?>>
            <label class="form-check-label" for="status">Выполнено</label>
        </div>
        <div class="form-group">
            <label for="user_name">Имя</label>
            <input readonly type="text" class="form-control" id="user_name" placeholder="Имя" name="user_name"
                   value="<?= htmlspecialchars($name ?? '', ENT_HTML5, 'UTF-8') ?>">
        </div>
        <div class="form-group">
            <label for="user_email">E-mail</label>
            <input readonly type="email" class="form-control" id="user_email" placeholder="E-mail" name="user_email"
                   value="<?= htmlspecialchars($mail ?? '', ENT_HTML5, 'UTF-8') ?>">
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" id="description" rows="3" placeholder="Описание"
                      name="description"><?= htmlspecialchars($desc ?? '', ENT_HTML5, 'UTF-8') ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
        <a href="/">
            <button type="submit" class="btn btn-outline-danger">Назад</button>
        </a>
    </form>
<?php } ?>

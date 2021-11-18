
<ol class="breadcrumb mt-4 bg-secondary" >
    <a href="/"><button class="btn btn-danger"> Главная</button></a>
</ol>

<?php     if($userLogin != 'admin') {   ?>
<form action="/tasks" method="post" style="max-width: 400px">
    <div class="form-group">
        <label for="user_name">Имя</label>
        <input type="text" class="form-control bg-dark text-white" id="user_name" placeholder="Имя" name="user_name">
    </div>
    <div class="form-group">
        <label for="user_email">E-mail</label>
        <input type="email" class="form-control bg-dark text-white" id="user_email" placeholder="E-mail" name="user_email">
    </div>
    <div class="form-group">
        <label for="description">Описание</label>
        <textarea class="form-control bg-dark text-white" id="description" rows="3" placeholder="Описание" name="description"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Добавить</button>
</form>

<?php  }?>
<?php if (!empty($tasks)) { ?>
    <table class="table table-striped table-danger">
        <thead class="bg-danger">
        <tr>
            <th scope="col">
                Статус
            </th>
            <th scope="col">
                Имя
            </th>
            <th scope="col">
                E-mail
            </th>
            <th scope="col">Описание</th>
            <?php if ($userLogin === 'admin') { ?>
                <th scope="col">Редактировать</th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task) {
           ?>
            <tr>
                <td><input type="checkbox" disabled <?= $task->status? 'checked' : '' ?>/></td>
                <td><?= htmlspecialchars($task->userName, ENT_HTML5, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($task->userEmail, ENT_HTML5, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($task->description, ENT_HTML5, 'UTF-8') ?></td>
                <?php if ($userLogin === 'admin') { ?>
                    <td>
                        [<a href="/tasks/<?= $task->getId() ?>/?page=<?= $curr_page ?>">редактировать</a>]
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php for ($page = 1; $page <= $pages; $page++) { ?>
                <?php if ($curr_page === $page) { ?>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="/?page=<?= $page ?>"><?= $page ?><span class="sr-only">(current)</span></a>
                    </li>
                <?php } else { ?>
                    <li class="page-item"><a class="page-link" href="/?page=<?= $page ?>"><?= $page ?></a></li>
                <?php } ?>
            <?php } ?>
        </ul>
    </nav>
<?php } else { ?>
    <div>Нет задач</div>
<?php } ?>

<hr/>
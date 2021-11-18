<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>huseynjon </title>
</head>
<body class="bg-secondary text-white">


    <nav class="my-2 my-md-0 mr-md-3"></nav>
    <?php if (empty($userLogin)) { ?>
        <a class="btn btn-danger   w-100 " href="/login">Войти</a>
    <?php } else { ?>

        <br> <a class="btn btn-outline-warning" href="/logout">Выйти</a>
    <?php } ?>

<div class="container">
    <?= $this->html ?>
</div>
<br/><br/>
</body>
</html>

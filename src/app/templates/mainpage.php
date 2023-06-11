<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="/static/icon.ico">
    <title>TeaPotStore | Список чайников в базе</title>
</head>

<body>
    <div class="container" id="teapot-list-table">
        <h1 class="my-5">Наличие чайников в магазине</h1>
        <table class="table table-bordered border-black" id="teapots-table">
            <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Остаток</th>
                    <th scope="col">Действия</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <button id="add-teapot-button" class="btn btn-success">Добавить чайник</button>
    </div>

    <script src="static/js/jquery-3.7.0.min.js"></script>
    <script src="static/js/script.js"></script>
</body>

</html>
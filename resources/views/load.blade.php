<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post" action="/api/posts" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Название">
        <input type="text" name="description" placeholder="Текст">
        <input type="file" name="image">

        <button type="submit">Отправить</button>
    </form>
</body>
</html>

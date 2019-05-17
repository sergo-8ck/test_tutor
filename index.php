<?php
require "connect.php";
require "review.class.php";

$reviews = array();
$result = mysqli_query($link, "SELECT * FROM reviews ORDER BY id DESC");

while($row = mysqli_fetch_assoc($result))
{
    $reviews[] = new Review($row);
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Тестовое задание tutor.ru</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div id="main">

    <div id="addReviewContainer">
        <p>Добавить отзыв</p>
        <form id="addReviewForm" method="post" action="">
            <div>
                <label for="name">Ваше имя</label>
                <input type="text" name="name" id="name" />

                <label for="email">Ваш Email</label>
                <input type="text" name="email" id="email" />

                <label for="text">Отзыв</label>
                <textarea name="text" id="text" cols="20" rows="5"></textarea>

                <input type="submit" id="submit" value="Submit" />
            </div>
        </form>
    </div>
    <?php
    foreach($reviews as $c){
        echo $c->markup();
    }
    ?>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>

<?php
$db_host		= '';
$db_user		= '';
$db_pass		= '';
$db_database	= '';

$link = @mysqli_connect($db_host,$db_user,$db_pass, $db_database) or die('Не удалось соединиться с БД');

mysqli_set_charset($link, "utf8");

?>
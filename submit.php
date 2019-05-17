<?php

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

include "connect.php";
include "review.class.php";

/*
/	Заполняем массив данными или ошибками
/*/

$arr = array();
$validates = Review::validate($arr);

if($validates)
{
	/* Вставка в БД: */
	mysqli_query($link, "	INSERT INTO reviews(name,email,text)
					VALUES (
						'".$arr['name']."',
						'".$arr['email']."',
						'".$arr['text']."'
					)");
	
	$arr['created_at'] = date('r',time());
	$arr['id'] = mysqli_insert_id($link);

    /* Нужны неэкранированные данные */
	$arr = array_map('stripslashes',$arr);
	
	$insertedReview = new Review($arr);

	/* Разметка комментария */
	echo json_encode(array('status'=>1,'html'=>$insertedReview->markup()));
}
else
{
	/* Сообщения об ошибке */
	echo '{"status":0,"errors":'.json_encode($arr).'}';
}

?>
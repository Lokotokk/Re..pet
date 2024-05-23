<?php
	$host = 'localhost'; // имя хоста
 	$data = 're..pet'; // имя базы данных
	$user = '#'; // имя пользователя. Стоит заглушка. В работе использовалось настоящее имя пользователя.
	$pass = '#'; // имя пользователя. Стоит заглушка. В работе использовался настоящий пароль.
	$chrs = 'utf8mb4';
	$attr = "mysql:host=$host;dbname=$data;charset=$chrs";
	$opts =
	[
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES => false,
	];
	
?>

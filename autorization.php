<?php
    require_once 'functions.php';
    require_once 'login.php';

	try
	{
	$pdo = new PDO($attr, $user, $pass, $opts);
	}
	catch (\PDOException $e)
	{
	throw new \PDOException($e->getMessage(), (int)$e->getCode());
	}

	if (isset($_SERVER['PHP_AUTH_USER']) &&
	isset($_SERVER['PHP_AUTH_PW']))
	{

	$un_temp = sanitizeString($_POST['login']);
	$pw_temp = sanitizeString($_POST['password']);
	
	$query = "SELECT * FROM users WHERE username='$un_temp'";
	$result = $pdo->query($query);

	if (!$result->rowCount()) die("User not found");
	$row = $result->fetch();
	$fn = $row['username'];
	$pw = $row['password'];

	if (password_verify(str_replace("'", "", $pw_temp), $pw))
	{
	session_start();

	$_SESSION['username'] = $fn;
	echo htmlspecialchars("Привет, $fn");
	die ("<p><a href='#'> Щелкните здесь для продолжения </a></p>");
	$_SESSION['auth'] = true;	
	$id = mysqli_insert_id($pdo);
	$_SESSION['id'] = $id;
	}
	else die("Неверная комбинация имя пользователя – пароль");
	}
	else
	{
	header('WWW-Authenticate: Basic realm="Restricted Area"');
	header('HTTP/1.0 401 Unauthorized');
	die ("Пожалуйста, введите имя пользователя и пароль");
	}
	
?>
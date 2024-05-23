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

if (isset($_POST['birth']) && isset($_POST['get'])) {
    $bDate = strtotime(sanitizeString($_POST['birth'])); 
    $gDate = strtotime(sanitizeString($_POST['get']));
    $aDate = time();
    $datediff = $aDate - $bDate;
    $newDate = floor($datediff/(60*60*24));

    if ($newDate < 93) {
        echo "Питомцу менее 3 месяцев";
    } else
    {
        echo "Регистрация кошек не является обязательной. Можете зарегистрировать в любое время";
    }
} else {
    echo "не все поля заполнены";
}



<?php
    function sanitizeString($var) {
        if (get_magic_quotes_gpc())
            $var = stripslashes($var);
            $var = strip_tags($var);
            $var = htmlentities($var);
            return $var;
    }

    function sanitizeMySQL($pdo, $var) {
        $var = $pdo->quote($var);
        $var = sanitizeString($var);
        return $var;
    }

    // добавить пользователя
    function add_user($pdo, $us, $hs, $em, $tl) {
        $stmt = $pdo->prepare('INSERT INTO users (`username`, `password`, `email`, `tel`) VALUES(?,?,?,?)');
        $stmt->bindParam(1, $us, PDO::PARAM_STR, 32);
        $stmt->bindParam(2, $hs, PDO::PARAM_STR, 255);
        $stmt->bindParam(3, $em, PDO::PARAM_STR, 32);
        $stmt->bindParam(4, $tl, PDO::PARAM_STR, 20);
        $stmt->execute([$us, $hs, $em, $tl]);
    }

    function reg_user() {
        require_once 'login.php';

        try
        {
        $pdo = new PDO($attr, $user, $pass, $opts);
        }
        catch (\PDOException $e)
        {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $_username = sanitizeString($_POST['login']);
        $sql = "SELECT * FROM users WHERE username=:$_username";
        $query = $pdo->prepare($sql);
        $query->execute([$_username]);
        $user= $query->fetch();
        if ($user) { 
            echo "такой пользователь уже зарегистрирован";
        } else {
            $_password = sanitizeString($_POST['password']);
            $_confirm = sanitizeString($_POST['confirm']); 
            $_email = sanitizeString($_POST['email']);
            $_tel = sanitizeString($_POST['tel']);
            $_hash = password_hash($_password, PASSWORD_DEFAULT);
            add_user($pdo, $_username, $_hash, $_email, $_tel);
            echo "Успешно зарегистрирован"; 
        }
    }

    function validate_username($field)
    {
        return ($field == "") ? "Не введено имя<br>" : "";
    }

    function validate_password($field)
    {
        if ($field == "") return "Не введен пароль<br>";
        else if (strlen($field) < 6)
            return "В пароле должно быть не менее 6 символов<br>";
        else if (!preg_match("/[a-z]/", $field) ||
                !preg_match("/[A-Z]/", $field) ||
                !preg_match("/[0-9]/", $field))
            return "Пароль требует 1 символа из каждого набора a-z, A-Z и 0-9<br>";
        return "";
    }

    function validate_passwords($field, $field_next) {
        if ($field != $field_next) return "Пароли не совпадают<br>";
        return "";
    }


    function validate_email($field)
    {
        if ($field == "") return "Не введен адрес электронной почты<br>";
        else if (!((strpos($field, ".") > 0) &&
                (strpos($field, "@") > 0)) ||
                    preg_match("/[^a-zA-Z0-9.@_-]/", $field))
            return "Электронный адрес имеет неверный формат<br>";
        return "";
    }

    function fix_string($string)
    {
        if (get_magic_quotes_gpc()) $string = stripslashes($string);
        return htmlentities ($string);
    }
?>
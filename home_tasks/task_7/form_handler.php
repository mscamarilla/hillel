<?php

if (!empty($_POST)) {
    if (validate($_POST)) {
        include_once 'mysql.php';
        $bd_connect = setConnection();
        doInsert($bd_connect, $_POST);
        header('Location: http://localhost/?post=true');

    }
}

function validate($post)
{
    $error = false;
    $returned_data = false;

    foreach ($post as $field => $data) {

        //валидация полей
        if ($field == 'username') {
            if (strlen($data) < 3) {
                $error[] = 'error_' . $field;
            }
        }

        if ($field == 'password') {
            //быть минимум 8 символов в длину, иметь хотя бы 1 цифру и 1 букву.
            //ну.. хоть так..
            if (!checkPassword($data)) {
                $error[] = 'error_' . $field;
            }
        }

        if ($field == 'email') {
            if(!filter_var($data, FILTER_VALIDATE_EMAIL)){
                $error[] = 'error_' . $field;
            }
        }

        //наполнение возвращаемых данных
        //пароль в GET не возвращается
        if ($field != 'password') {
            $returned_data[] = $field . '=' . $data;
        }

    }

    if (!empty($error)) {
        $error_string = implode('&', $error);
        $returned_string = implode('&', $returned_data);
        header('Location: http://localhost/?' . $error_string . '&' . $returned_string);
    } else {
        return true;
    }

}

function checkPassword($pass)
{
    $error = false;

    if (strlen($pass) < 8 || !preg_match("#[0-9]+#", $pass) || !preg_match("#[a-zA-Z]+#", $pass)) {
        $error = true;
    }

    return !$error;
}

<?php

include_once('mysql.php');

function showUsers()
{
    $id = (!empty($_GET['user_id']) ? $_GET['user_id'] : null);
    $result = getUsers($id);
    $data['status'] = 404;
    $data['data'] = [];

    if (!mysqli_num_rows($result)) {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    }

    foreach ($result as $line) {
        $data['status'] = 200;
        $data['data'][] = $line;

    }

    return $data;
}

function addNewUser($data)
{
    foreach ($data as $key => $value) {
        if (empty($value)) {
            echo $key . ' is required!' . PHP_EOL;
            exit;

        }
    }
    if (addUser($data)) {
        echo 'New user added successfully!' . PHP_EOL;
    }
}

if (!empty($_POST)) {
    $data['username'] = (!empty($_POST['username']) ? $_POST['username'] : false);
    $data['password'] = (!empty($_POST['password']) ? $_POST['password'] : false);
    $data['email'] = (!empty($_POST['email']) ? $_POST['email'] : false);

    addNewUser($data);

} else {
    print_r(json_encode(showUsers()));
}

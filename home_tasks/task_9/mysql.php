<?php

function setConnection()
{
    $sql = mysqli_connect('', '', '')
    or die('Can not connect: ' . mysqli_error($sql));
    mysqli_select_db($sql, 'test') or die('Wrong db');

    return $sql;
}

function getUsers($id)
{
    $bd_connect = setConnection();

    $query = "SELECT * FROM users";

    if (!empty($id)) {
        $query .= " WHERE id=" . $id;

    }

    $result = mysqli_query($bd_connect, $query) or die('Query failed: ' . mysqli_error($bd_connect));
    mysqli_fetch_array($result, MYSQLI_ASSOC);

    return $result;
}

function addUser($data)
{
    $bd_connect = setConnection();
    $username = mysqli_real_escape_string($bd_connect, $data['username']);
    $password = mysqli_real_escape_string($bd_connect, $data['password']);
    $email = mysqli_real_escape_string($bd_connect, $data['email']);

    $query = "INSERT INTO users SET name = '" . $username . "', password = '" . $password . "', email = '" . $email . "'";
    mysqli_query($bd_connect, $query) or die('Query failed: ' . mysqli_error($bd_connect));

    return true;

}

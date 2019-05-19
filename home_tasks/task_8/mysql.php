<?php

function setConnection()
{
    $sql = mysqli_connect('', '', '')
    or die('Can not connect: ' . mysqli_error($sql));
    mysqli_select_db($sql, 'test') or die('Wrong db');

    return $sql;
}

$bd_connect = setConnection();


function doInsert($bd_connect, $data)
{
    $query = "INSERT INTO users SET name = '".$data['username']."', password = '".$data['password']."', email = '".$data['email']."'";
    mysqli_query($bd_connect, $query) or die('Query failed: ' . mysqli_error($bd_connect));

}

function doSelect($bd_connect)
{
    $query = 'SELECT * FROM users';
    $result = mysqli_query($bd_connect, $query) or die('Query failed: ' . mysqli_error($bd_connect));

    return $result;
}
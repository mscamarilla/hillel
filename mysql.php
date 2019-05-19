<?php

include 'config.php';

function setConnection()
{
    $sql = mysqli_connect('localhost', 'root', 'Etoparol12#')
    or die('Can not connect: ' . mysqli_error($sql));
    mysqli_select_db($sql, 'test') or die('Wrong db');

    return $sql;
}




function doInsert($bd_connect, $data)
{
    $query = "INSERT INTO users SET name = '".$data['username']."', password = '".$data['password']."', email = '".$data['email']."'";
    mysqli_query($bd_connect, $query) or die('Query failed: ' . mysqli_error($bd_connect));

}

function doSelect()
{
    $bd_connect = setConnection();

    //$query = 'SELECT * FROM users';
    $query = 'SELECT * FROM users';
    $result = mysqli_query($bd_connect, $query) or die('Query failed: ' . mysqli_error($bd_connect));

    return $result;
}

function addLotsOfAticles($bd_connect, $array)
{
    foreach ($array as $data){
    $query = "INSERT INTO articles SET title = '".$data['title']."', text = '".$data['text']."'";
    mysqli_query($bd_connect, $query) or die('Query failed: ' . mysqli_error($bd_connect));
    }

}

function getAllArticles($bd_connect, $limit, $offset)
{
    //$limit = $offset * $limit;
    $query = "SELECT * FROM articles";
    $query .= " LIMIT " . $limit;
    $query .= " OFFSET " . $offset;

    //echo $query;

    $result = mysqli_query($bd_connect, $query) or die('Query failed: ' . mysqli_error($bd_connect));

    return $result;

}
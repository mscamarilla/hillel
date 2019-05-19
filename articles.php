<?php
header('Content-Type: application/json');
include 'mysql.php';





function getArticles()
{
    $bd_connect = setConnection();
    $limit = 5;
    if(!empty($_GET['page'])){
    $offset = $limit * $_GET['page'];
    } else {
        $offset = 1;
    }

    $result = getAllArticles($bd_connect, $limit, $offset);
    $data = false;

    while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $data[$line['id']] = $line;

    }

    return $data;
}
print_r(json_encode(getArticles()));



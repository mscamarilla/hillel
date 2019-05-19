<?php
header('Content-Type: application/json');

include_once('config.php');
include_once('mysql.php');

$db_connect = setConnection($config);


if (!empty($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$data['status'] = 200;
$data['data'] = [];
$data['message'] = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data['status'] = 201;
    $data['data']['title'] = $_POST['title'];
    $data['data']['text'] = $_POST['text'];
    $data['message'] = 'success';
    header($_SERVER["SERVER_PROTOCOL"]. " 201 Created");


    if (empty($data['data']['title']) || empty($data['data']['text'])) {
        $data['status'] = 400;
        $data['message'] = 'error';
        header($_SERVER["SERVER_PROTOCOL"]. " 400 Bad Request");
    } else {
        addArticle($db_connect, $data['data']);
    }

    echo json_encode($data);

} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents('php://input'), $put_data);
    $data['status'] = 201;
    $data['data']['id'] = $_GET['id'];
    $data['data']['title'] = $put_data['title'];
    $data['data']['text'] = $put_data['text'];
    $data['message'] = 'success';
    header($_SERVER["SERVER_PROTOCOL"]. " 201 Created");

    if (empty($data['data']['title']) || empty($data['data']['text']) || !is_numeric($data['data']['id'])) {
        $data['status'] = 400;
        $data['message'] = 'error';
        header($_SERVER["SERVER_PROTOCOL"]. " 400 Bad Request");

    } else {
        changeArticle($db_connect, $data['data']);
    }

    echo json_encode($data);

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $data['data']['id'] = $_GET['id'];
    $data['message'] = 'success';
    $article = getArticles($db_connect, null, $_GET['id']);

    if (!is_numeric($data['data']['id']) || !mysqli_num_rows($article)) {
        $data['status'] = 404;
        $data['message'] = 'error';
        header($_SERVER["SERVER_PROTOCOL"]. " 404 Not Found");
    } else {
        removeArticle($db_connect, $data['data']);
    }

    echo json_encode($data);

} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $articles = getArticles($db_connect, $page, null);

    if (!mysqli_num_rows($articles)) {
        $data['status'] = 404;
        header($_SERVER["SERVER_PROTOCOL"]. "404 Not Found");
    }

    foreach ($articles as $article) {
        $data['data'][] = $article;
    }

    echo json_encode($data);
}

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


function showArticles($db_connect, $page)
{
    $articles = getArticles($db_connect, $page, null);
    $data['status'] = 404;
    $data['data'] = [];
    $data['message'] = '404 Not Found';

    if (!mysqli_num_rows($articles)) {
        header($_SERVER["SERVER_PROTOCOL"]. " 404 Not Found");
    }

    foreach ($articles as $article) {
        $data['status'] = 200;
        $data['data'][] = $article;
        $data['message'] = '';

    }

    return json_encode($data);
}

function addNewArticle($db_connect, $post_data)
{
    $data['status'] = 201;
    $data['data']['title'] = $post_data['title'];
    $data['data']['text'] = $post_data['text'];
    $data['message'] = 'success';
    header($_SERVER["SERVER_PROTOCOL"]. " 201 Created");


    if (empty($data['data']['title']) || empty($data['data']['text'])) {
        $data['status'] = 400;
        $data['message'] = 'error';
        header($_SERVER["SERVER_PROTOCOL"]. " 400 Bad Request");
    } else {
        addArticle($db_connect, $data['data']);
    }

    return json_encode($data);
}

function updateArticle($db_connect, $put_data){

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

    return json_encode($data);
}

function deleteArticle($db_connect, $id){

    $data['status'] = 200;
    $data['data']['id'] = $id;
    $data['message'] = 'success';
    $article = getArticles($db_connect, null, $id);

    if (!is_numeric($data['data']['id']) || !mysqli_num_rows($article)) {
        $data['status'] = 404;
        $data['message'] = 'error';
        header($_SERVER["SERVER_PROTOCOL"]. " 404 Not Found");
    } else {
        removeArticle($db_connect, $data['data']);
    }

    return json_encode($data);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo addNewArticle($db_connect, $_POST);
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT'){
    parse_str(file_get_contents('php://input'),$put_data);
    echo updateArticle($db_connect, $put_data);
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    echo deleteArticle($db_connect, $_GET['id']);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    print_r(showArticles($db_connect, $page));
}

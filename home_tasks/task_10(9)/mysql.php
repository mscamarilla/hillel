<?php

function setConnection($config)
{
    $sql = mysqli_connect($config['host'], $config['user'], $config['password'])
    or die('Can not connect: ' . mysqli_error($sql));
    mysqli_select_db($sql, $config['db']) or die('Wrong db');

    return $sql;
}

function getArticles($db_connect, $page, $id)
{
    $offset = $page * 10 - 10;

    $query = "SELECT * FROM articles";
    if (!empty($page)) {
        $query .= " LIMIT 10 OFFSET " . $offset;
    }
    if (!empty($id)) {
        $query .= " WHERE id=" . $id;

    }

    $result = mysqli_query($db_connect, $query) or die('Query failed: ' . mysqli_error($db_connect));

    return $result;
}

function addArticle($db_connect, $data)
{
    $title = mysqli_real_escape_string($db_connect, $data['title']);
    $text = mysqli_real_escape_string($db_connect, $data['text']);

    $query = "INSERT INTO articles SET title = '" . $title . "', text = '" . $text . "'";
    mysqli_query($db_connect, $query) or die('Query failed: ' . mysqli_error($db_connect));

    return true;

}
function changeArticle($db_connect, $data)
{
    $title = mysqli_real_escape_string($db_connect, $data['title']);
    $text = mysqli_real_escape_string($db_connect, $data['text']);

    $query = "UPDATE articles SET title = '" . $title . "', text = '" . $text . "' WHERE id='" . (int)$data['id'] . "'";
    mysqli_query($db_connect, $query) or die('Query failed: ' . mysqli_error($db_connect));

    return true;

}

function removeArticle($db_connect, $data)
{
    $query = "DELETE FROM articles WHERE id='" . (int)$data['id'] . "'";
    mysqli_query($db_connect, $query) or die('Query failed: ' . mysqli_error($db_connect));

    return true;

}

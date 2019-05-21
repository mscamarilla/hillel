<?php

if (!empty($_POST['title']) && !empty($_POST['text'])){
    if(strlen($_POST['title']) < 3){
        echo 'Title should be at least 3 characters long!';
        exit;
    } elseif(strlen($_POST['text'])< 8){
        echo 'Title should be at least 3 characters long!';
        exit;
    } else {
        require_once('config.php');
        require_once ('article.php');

        $article = new Article();
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->publish();
        $article->save($config);
        print_r($article);

    }
}

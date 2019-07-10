<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require('vendor/autoload.php');
require('config/config.php');

use Entity\Article;
use Service\ArticleManager;
use Entity\User;
use Service\UserManager;

$user_manager = new UserManager();
$user_test = $user_manager->getById(1);
print_r($user_test);


$user = new User('test name', 'text surname');
$user->setId(20);
$user_manager->save($user);

echo '<hr>';

$article_manager = new ArticleManager();
$article_test = $article_manager->getById(75);
print_r($article_test);


$article = new Article('test title', 'text text =)', $user_test);
$article->setId(75);
$article_manager->save($article);

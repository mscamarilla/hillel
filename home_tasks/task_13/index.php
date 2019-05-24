<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require ('vendor/autoload.php');
require('config/config.php');
require('/var/www/html/task_13/config/config.php');

use Entity\Article;
use Entity\DB;
use Service\ArticleManager;

$article_manager = new ArticleManager();
$article_manager->setDb(new DB($config['hostname'], $config['username'], $config['password'], $config['database']));
$article_test = $article_manager->getById(1);
print_r($article_test);


$article = new Article('test title', 'text text :)');
$article->setId(72);
$article_manager->save($article);

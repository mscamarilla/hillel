<?php

if (is_file('config.php')) {
    require_once('config.php');
} else {
    echo 'Could not find file \'/config.php\' with DB credits in it';
}

require_once('engine.php');
$registry = new Registry();

$db = new DB($config['host'], $config['user'], $config['password'], $config['database']);
$registry->set('db', $db);

$loader = new Loader($registry);
$registry->set('loader', $loader);

$output = $loader->controller('article');
echo $output;

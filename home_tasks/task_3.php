<?php

# Задание 1.1

function doFor()
{
    for ($i = 0; $i <= 10; $i++) {
        echo $i . '<br />';
    }
}

doFor();

echo '<hr>';

# Задание 1.2

function doWhile()
{
    $j = 10;
    while ($j <= 30) {
        echo $j . '<br />';
        $j += 2;
    }
}

doWhile();

echo '<hr>';

# Задание 2

function makeArray()
{
    $a = 1;
    do {
        $data[] = $a;
    } while ($a++ < 10);

    return $data;
}

echo '<pre>';
print_r(makeArray());
echo '</pre>';

echo '<hr>';

# Задание 3
function sortLanguage($data)
{
    //if (is_array($data)) {
        foreach ($data as $key => $value) {
            $sorted['en'][] = $key;
            $sorted['ua'][] = $value;
        }
        return $sorted;
    /*} else {
        return 'Invalid data!';
    }*/
}

$arr = ['green' => 'зелений', 'red' => 'червоний', 'blue' => 'блакитний'];

echo '<pre>';
print_r(sortLanguage($arr));
echo '</pre>';

echo '<hr>';

# Задание 4

function randomNumbers()
{
    for ($i = 0; $i <= 50; $i++) {
        $n = rand(1, 100);
        if ($n <= 69) {
            $data[] = $n;
        }
    }
    return $data;
}

echo '<pre>';
print_r(randomNumbers());
echo '</pre>';

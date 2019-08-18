<?php

echo '<b>Задание #2</b>';
echo '<br />';

$task2 = ['name' => null,
    'surname' => null,
    'age' => null,
    'gender' => null];

function match(&$empty_arr)
{
    $empty_arr = ['name' => 'Ирина',
        'surname' => 'Маслянко',
        'age' => 30,
        'gender' => 'Ж'
    ];
}

match($task2);

print_r($task2);

echo '<br />';
echo '<b>Задание #3</b>';
echo '<br />';

$task3 = [2, 6, '10', 12, 'f', 0, 'wow'];

function sum($array)
{
    $result = 0;
    foreach ($array as $value) {
        if (is_int($value)) {
            $result += $value;
        }
        //тут можно было бы сделать и else, но зачем, если мы считаем сумму, а else будет плюсовать 0
    }
    return $result;
}

echo sum($task3);

echo '<br />';
echo '<b>Задание #4</b>';
echo '<br />';

function dayOfWeek($num)
{
    if ($num == '1') {
        echo 'Monday';
    } elseif ($num == '2') {
        echo 'Tuesday';
    } elseif ($num == '3') {
        echo 'Wednesday';
    } elseif ($num == '4') {
        echo 'Thursday';
    } elseif ($num == '5') {
        echo 'Friday';
    } elseif ($num == '6') {
        echo 'Saturday';
    } elseif ($num == '7') {
        echo 'Sunday';
    } else {
        echo 'Unknown day';
    }
}

dayOfWeek(5);

echo '<br />';
echo '<b>Задание #5.1</b>';
echo '<br />';


function dayOfWeek2($num)
{
    switch ($num) {
        case 1:
            echo 'Понедельник';
            break;
        case 2:
            echo 'Вторник';
            break;
        case 3:
            echo 'Среда';
            break;
        case 4:
            echo 'Четверг';
            break;
        case 5:
            echo 'Пятница';
            break;
        case 6:
            echo 'Суббота';
            break;
        case 7:
            echo 'Воскресенье';
            break;
        default:
            echo 'Неизвестный день';
            break;
    }
}

dayOfWeek2(6);

echo '<br />';
echo '<b>Задание #5.2</b>';
echo '<br />';

function dayOfWeek3($num)
{
    $days = [1 => 'Today is Monday',
        2 => 'Today is Tuesday',
        3 => 'Today is Wednesday',
        4 => 'Today is Thursday',
        5 => 'Today is Friday',
        6 => 'Today is Saturday',
        7 => 'Today is Sunday'
    ];
    if (array_key_exists($num, $days)) {
        echo $days[$num];
    } else {
        echo 'Wrong input data';
    }
}

dayOfWeek3(7);


echo '<br />';
echo '<b>Задание #6</b>';
echo '<br />';

function multiply($num)
{
    if (is_int($num)) { //валидация параметра это проверка на integer?
        //если передали 0 или 1, то ничего не делать
        if ($num == 0 || $num == 1) {
            return $num;
        }
        //если это не 0 и не 1, то берем число и умножаем его на предыдущее, включая сюда все последующие умножения
        $result = $num * multiply($num - 1);
        return $result;
    } else {
        return 'Wrong input data';
    }
}

echo multiply(6);
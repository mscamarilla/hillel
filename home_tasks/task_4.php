<?php

//Задание 3
function multiply($num)
{
    if ($num == 0 || $num == 1) {
        return 1;
    }
    $result = $num * multiply($num - 1);
    return $result;

}

if (!empty($_GET)) {
    if (array_key_exists('action', $_GET)) {
        switch ($_GET['action']) {
            case 'factorial':
                //вызываем функцию факториала
                //if (!is_null(array_key_exists('number', $_GET))) { // не сработает, если 'number=' или 'number'
                if (array_key_exists('number', $_GET) && $_GET['number'] != '') {
                    $factorial_number = (int)$_GET['number'];
                    if ($factorial_number >= 0) {
                        echo 'Factorial of ' . $_GET['number'] . ' is ' . multiply((int)$_GET['number']);
                    } else {
                        echo 'Only >=0 values in number!';
                    }
                } else {
                    echo 'Number parameter is empty!';
                }
                break;
            case 'summ':
                if (array_key_exists('number', $_GET) && ($_GET['number'] !== '') && array_key_exists('number1', $_GET) && ($_GET['number1'] !== '')) {
                    $summa = (int)$_GET['number'] + (int)$_GET['number1'];
                    echo 'Sum of the numbers ' . $_GET['number'] . ' and ' . $_GET['number1'] . ' is ' . $summa;

                } else {
                    echo 'Action sum expects parameters \'number\' and \'number1\'';
                }
                break;
            default:
                echo 'Uncnown action! Expecting factorial or summ';
                break;
        }
    } else {
        echo 'No action in get';
    }
} elseif (!empty($_POST)) {
    // Задание 4

    if (array_key_exists('age', $_POST) && $_POST['age'] != '' && $_POST['age'] >= 18) {
        if (!empty(isset($_POST['name']))) {
            $name = $_POST['name'];
        } else {
            $name = 'Anonymous';
        }

        if (!empty(isset($_POST['surname']))) {
            $surname = $_POST['surname'];
        } else {
            $surname = 'Anonymous';
        }

        if (!empty(isset($_POST['gender']))) {
            switch ($_POST['gender']) {
                case 'male':
                    $gender = 'mr.';
                    break;
                case 'female':
                    $gender = 'ms.';
                    break;
                default:
                    $gender = '';
            }

        } else {
            $gender = '';
        }

        echo 'Hello ' .
        (!empty($gender) ? $gender . ' ' : '') . $name . ' ' . $surname . '!' . PHP_EOL;

    } else {
        echo 'Sorry, adults only' . PHP_EOL;
    }
} else {
    echo 'Empty data. Expecting: GET or POST array';
}
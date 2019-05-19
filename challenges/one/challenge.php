<?php
//header('Content-Type: text/html; charset=utf-8');
//8: не люблю длинные слова
//обрезать слово, если оно длиннее 7 символов и вставлять * вместо этого

/*
Дано: текст "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum"

Задание: Найти все слова длиннее 6 символов, оставить в них первые 5, а вместо остального -  вывести звездочку. Например,
слово labore превратится в labor*. Вывести весь текст с замененными словами
*/

$string = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum';

//$string_array = explode(' ', $string);
$string_array = preg_split("/[\s]+/", $string);

foreach ($string_array as $value) {

    $special_characters = ['.', ','];

    if (strlen($value) > 5) {
        $cutted_value = substr_replace($value, '*', 5);
        $end_of_the_word = substr($value, -1);

        if (in_array($end_of_the_word, $special_characters)) {
            $cutted_value .= $end_of_the_word;

        }
    } else {
        $cutted_value = $value;
    }
    $string_array2[] = $cutted_value;

}

echo implode(' ', $string_array2);


//9: не выводить дубли

/*
Дано: массив $array = [9, 9, 9, 1, 1, 1, 2, 2, 7, 7, 2, 2, 15, 15, 4, 4, 4, 5, 5];
Задание: убрать дубли значений, чтоб получилось  $array = [9, 1, 2, 7, 15, 4, 5];
Можно использовать только один цикл foreach, т.е. единожды.
Запрещается использовать функции группировки элементов массива и запрещается нарушать порядок элементов.
 */
$array = [9, 9, 9, 1, 1, 1, 2, 2, 7, 7, 2, 2, 15, 15, 4, 4, 4, 5, 5];


foreach (array_count_values($array) as $key => $value) { //зарезали функцию
    $new_array[] = $key;
}

echo '<pre>';
//print_r($new_array);
echo '</pre>';


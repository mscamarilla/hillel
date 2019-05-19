<?php

/*
1.
Дано: текст "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum"

Задание: Найти все слова длиннее 6 символов, оставить в них первые 5, а вместо остального -  вывести звездочку. Например,
слово labore превратится в labor*. Вывести весь текст с замененными словами*/


$text ="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum";




function counterCharacter (&$textArr){
    $counter = 0;
    $arrayLength  = strlen ($textArr) -1;
    for($i = 0; $i <= $arrayLength; $i++){
        if($textArr[$i] != " " && $textArr[$i] != "." && $textArr[$i] != "," && $textArr[$i] != "!" && $textArr[$i] != "?"){
            $counter++;
            if($counter == 6){
                $textArr[$i] = "*";
            }
            if($counter > 6){
                $textArr[$i] = "";
            }
        }else {
            $counter = 0;
        }
    }
}

counterCharacter($text);

echo $text;

/*
2.
Дано: массив $array = [9, 9, 9, 1, 1, 1, 2, 2, 7, 7, 2, 2, 15, 15, 4, 4, 4, 5, 5];
Задание: убрать дубли значений, чтоб получилось  $array = [9, 1, 2, 7, 15, 4, 5];
Можно использовать только один цикл foreach, т.е. единожды.
Запрещается использовать функции группировки элементов массива и запрещается нарушать порядок элементов.*/


$numArray = [9, 9, 9, 1, 1, 1, 2, 2, 7, 7, 2, 2, 15, 15, 4, 4, 4, 5, 5];

$resultArray = array();
foreach ($numArray as $key => $value){
    if(!in_array($value, $resultArray)) {
        $result[$key] = $value;
    }
}
print_r($resultArray);
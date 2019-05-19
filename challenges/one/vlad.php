<?php

$array = [9, 9, 9, 1, 1, 1, 2, 2, 7, 7, 2, 2, 15, 15, 4, 4, 4, 5, 5];

$result = array();
foreach ($array as $key => $value){
    if(!in_array($value, $result))
        $result[$key]=$value;
}
print_r($result);
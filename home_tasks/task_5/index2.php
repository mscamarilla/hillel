<?php
include 'functions.php';

echo '<style>';
include 'styles/style.css';
echo '</style>';


for ($i = 0; $i < 10; $i++) {
    //массив заполняется случайными данными:
    //имя короче, фамилия длиннее. Минимальный возраст как в соцсетях, а пол - случайный из 3х вариантов
    $users[$i] = ['name' => generateRandomString(rand(4, 8)),
                  'surname' => generateRandomString(rand(5, 10)),
                  'age' => rand(13, 77),
                  'gender' => generateRandomGender(rand(1, 3))
    ];
}

echo ShowUserTable($users);
echo ShowUserList($users);
echo ShowUserBlocks($users);

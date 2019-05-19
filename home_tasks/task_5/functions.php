<?php
//используется для заполнения массива с пользователями, потому что мне лень придумывать 10 имен/фамилий
function generateRandomString($length = 8)
{
    //разделим заглавные и строчные для красивого (но бессмысленного) написания
    $capital_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercase_letters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($lowercase_letters);

    //собираем строку из одной заглавной и остальных строчных букв
    $randomString = $capital_letters[rand(0, $charactersLength - 1)];
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $lowercase_letters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

//Используется для генерации пола пользователя
function generateRandomGender($i)
{
    switch ($i) {
        case 1:
            return 'male';
            break;
        case 2:
            return 'female';
            break;
        case 3:
            return 'unicorn'; //в интернете никто не знает, что ты - единорог.
            break;
    }

}

function ShowUserTable($data)
{
    $html = '<H1>User Table</H1>';
    $html .= '<table cellspacing="0" border="1" cellpadding="5">';
    $html .= '<thead>';
    foreach ($data[0] as $key => $value) {
        $html .= '<th>' . $key . '</th>';
    }

    $html .= '</thead>';
    $html .= '<tbody>';
    foreach ($data as $subarray) {
        $html .= '<tr>';
        foreach ($subarray as $value) {
            $html .= '<td>' . $value . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= '</tbody>';
    $html .= '</table>';

    return $html;

}

function ShowUserList($data)
{
    $html = '<H1>User List</H1>';
    $html .= '<ul>';

    foreach ($data as $subarray) {
        $html .= '<li>';
        foreach ($subarray as $key => $value) {
            $html .= '<b>' . $key . '</b>: ' . $value . '; ';
        }
        $html .= '</li>';
    }

    $html .= '</ul>';

    return $html;

}

//Наконец-то пространство для развлечений!
function ShowUserBlocks($array)
{

    $html = '<h1>User Blocks</h1>';
    $html .= '<div class="container">';
    //разбиваю весь массив пользователей на 2, чтоб было в 2 красивые колонки
    $chunk_data = array_chunk($array, count($array) / 2);

    foreach ($chunk_data as $data) {
        $html .= '<div class="row">';
        foreach ($data as $user) {
            $html .= '<div class="user">';
            $html .= '<div class="left">';
            foreach ($user as $key => $value) {
                if ($key == 'gender') {
                    //картинка берется по полу.
                    // Думала сначала по имени, потом решила генерировать имена и известным остался только пол
                    $html .= '<img src="images/' . $value . '.jpg" />';

                }
            }
            $html .= '</div>';
            $html .= '<div class="right">';
            foreach ($user as $key => $value) {
                $html .= '<b>' . $key . ':</b> ' . $value . '<br />';
            }

            $html .= '</div>';
            $html .= '</div>';
        }
        $html .= '</div>';
    }
    $html .= '</div>';

    return $html;
}

//да, я повыделывалась.
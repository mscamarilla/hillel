<?php

include_once 'mysql.php';

$result = doSelect($bd_connect);


function userTable($result)
{

    $html = '';
    $html .= '<p class="success"><a href="user_table.php">Add another user</a></p>';
    $html .= '<table>';
    $html .= '<thead>';
    $html .= '<tr><td><b>Id</b></td><td><b>Username</b></td><td><b>Password</b></td><td><b>email</b></td></tr>';
    $html .= '</thead>';

    while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $html .= '<tr>';

        foreach ($line as $col_value) {
            $html .= '<td>' . $col_value . '</td>';
        }

        $html .= '</tr>';
    }

    $html .= '</table>';

    return $html;
}


function addStyle()
{
    $html = '<style>
                    table{width: 30%;margin: 0 auto;background: #eee;}
                    td{border: 1px solid #ddd;margin0;padding: 0}
                    .success{margin: 0 auto;font-size: 14px;text-align: center;width: 30%;padding: 15px;}
            </style>';

    return $html;
}

echo addStyle();
echo userTable($result);
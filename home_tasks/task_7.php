<?php

function getTemplate($data)
{
    if (!empty($data)) {

        foreach ($data as $key => $value) {

            $$key = $data[$key];
            ${"validation_$key"} = validate($key, $value);
        }
    }

    $html = '<form method="post">';
    $html .= '<span>Name</span>';
    $html .= '<input type="text" name="name" value="' . (!empty($name) ? $name : '') . '"/> <br />';

    if (!empty($validation_name)) {
        $html .= '<p style="color:' . $validation_name['color'] . '">' . $validation_name['text'] . '</p>';
    }

    $html .= '<span>Surname</span>';
    $html .= '<input type="text" name="surname" value="' . (!empty($surname) ? $surname : '') . '"/> <br />';

    if (!empty($validation_surname)) {
        $html .= '<p style="color:' . $validation_surname['color'] . '">' . $validation_surname['text'] . '</p>';
    }

    $html .= '<span>Phone</span>';
    $html .= '<input type="text" name="phone" value="' . (!empty($phone) ? $phone : '') . '"/> <br />';

    if (!empty($validation_phone)) {
        $html .= '<p style="color:' . $validation_phone['color'] . '">' . $validation_phone['text'] . '</p>';
    }

    $html .= '<span>Email</span>';
    $html .= '<input type="text" name="email" value="' . (!empty($email) ? $email : '') . '"/> <br />';

    if (!empty($validation_email)) {
        $html .= '<p style="color:' . $validation_email['color'] . '">' . $validation_email['text'] . '</p>';
    }

    $html .= '<input type="submit" />';
    $html .= '</form>';

    return $html;
}

function validate($field, $data)
{
    $result['color'] = 'green';
    $result['text'] = 'Success';

    if ($field == 'name') {
        if (strlen($data) < 3) {
            $result['color'] = 'red';
            $result['text'] = 'Name must be at least 3 characters long!';
        }
    }

    if ($field == 'surname') {
        if (strlen($data) < 8 || strlen($data) > 25) {
            $result['color'] = 'red';
            $result['text'] = 'Surname must be between 8 and 25 characters!';
        }
    }

    if ($field == 'phone') {
        if (!preg_match("/^[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{3}$/", $data)) {
            $result['color'] = 'red';
            $result['text'] = 'Use the "000-00-00-000" pattern for phone number!';
        }
    }

    if ($field == 'email') {
        if (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $data)) {
            $result['color'] = 'red';
            $result['text'] = 'Email does not appear to be valid!';
        }
    }

    return $result;

}

function addStyle()
{
    $html = '<style>form{width:30%;margin:0 auto;background:#eee;padding:15px;border:1px solid #ddd;}
                    input[type="text"]{width:70%;height:34px;padding:5px;display:inline-block;margin-bottom:15px;margin-top:5px;border:1px solid #ddd;}
                    input[type="text"]:focus{border:1px solid #fff;outline:none;}
                    span {display:inline-block;width:30%;}
                    p{margin:-15px 0 0 30%;font-size:12px;text-align:right}
                    input[type="submit"] {margin:0 auto;background:#000;border:1px solid;color:#fff;padding:15px;border-radius:10px;cursor:pointer;display:inherit;}
                    input[type="submit"]:hover{background:#ddd;color:#000;}
            </style>';

    return $html;
}

echo addStyle();
echo getTemplate($_POST);

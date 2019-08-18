<?php

function addStyle()
{
    $html = '<style>form{width:30%;margin:0 auto;background:#eee;padding:15px;border:1px solid #ddd;}
                    input[type="text"],input[type="password"]{width:70%;height:34px;padding:5px;display:inline-block;margin-bottom:15px;margin-top:5px;border:1px solid #ddd;}
                    input[type="text"]:focus{border:1px solid #fff;outline:none;}
                    span {display:inline-block;width:30%;}
                    p{margin:-15px 0 0 30%;font-size:12px;text-align:right}
                    input[type="submit"] {margin:0 auto;background:#000;border:1px solid;color:#fff;padding:15px;border-radius:10px;cursor:pointer;display:inherit;}
                    input[type="submit"]:hover{background:#ddd;color:#000;}
                    .success{margin: 0 auto;font-size: 14px;text-align: center;width: 30%;padding: 15px;}
            </style>';

    return $html;
}

echo addStyle();

function getTemplate()
{
    $html = '';
    if(!empty($_GET['post'])){
        $html .= '<p class="success">Data was successfully added. <a href="user_table.php">Go to user page</a></p>';
    }

    $html .= '<form method="post" action="form_handler.php">';
    $html .= '<span>Username</span>';
    $html .= '<input type="text" name="username" value="' . (!empty($_GET['username']) ? $_GET['username'] : '') . '"/> <br />';

    if (isset($_GET['error_username'])) {
        $html .= '<p style="color:red">Name must be at least 3 characters long!</p>';
    }

    $html .= '<span>Password</span>';
    $html .= '<input type="password" name="password" value=""/> <br />';

    if (isset($_GET['error_password'])) {
        $html .= '<p style="color:red">Use strong password!</p>';
    }

    $html .= '<span>Email</span>';
    $html .= '<input type="text" name="email" value="' . (!empty($_GET['email']) ? $_GET['email'] : '') . '"/> <br />';

    if (isset($_GET['error_email'])) {
        $html .= '<p style="color:red">Email does not appear to be valid!</p>';
    }

    $html .= '<input type="submit" />';
    $html .= '</form>';

    return $html;
}

echo getTemplate();
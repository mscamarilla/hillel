<?php

class Article
{
    protected $registry;

    function __construct($registry)
    {
        $this->registry = $registry;
    }

    function __get($name)
    {
        return $this->registry->get($name);
    }

    private $article_id;
    private $title;
    private $text;
    private $is_published = false;

    /**
     * Index
     * @return string
     */

    public function index()
    {
        if (!empty($_POST['form_article'])) {
            $error = $this->validation($_POST['form_article']);
        }

        //фу темплейт тут писать, я знаю
        $html = $this->addStyle();

        if (!empty($this->article_id)) {
            $html .= '<p class="success">Data was successfully added. Article ID is ' . $this->article_id. '</p>';
        }

        $html .= '<form method="post" id="form_article">';

        $html .= '<span>Title</span>';
        $html .= '<input type="text" name="form_article[title]" value="' . (!empty($_POST['form_article']['title']) ? $_POST['form_article']['title'] : '') . '"/> <br />';

        if (in_array('error_title', $error)) {
            $html .= '<p style="color:red">Set title at least 3 characters long!</p>';
        }

        $html .= '<span>Text</span>';
        $html .= '<textarea name="form_article[text]" >' . (!empty($_POST['form_article']['text']) ? $_POST['form_article']['text'] : '') . '</textarea> <br />';

        if (in_array('error_text', $error)) {
            $html .= '<p style="color:red">Text should be at least 8 characters long!</p>';
        }

        $html .= '<input type="submit" />';
        $html .= '</form>';

        return $html;
    }

    /**
     * Post data validation
     * @param array $article_data
     * @return array|bool
     */
    private function validation(array $article_data)
    {
        foreach ($article_data as $field => $data) {

            if ($field == 'title') {
                if (strlen($data) < 3) {
                    $error[] = 'error_' . $field;
                }
            }


            if ($field == 'text') {
                if (strlen($data) < 8) {
                    $error[] = 'error_' . $field;
                }
            }
        }

        if (!$error) {
            $this->publish($article_data);
            return true;
        } else {
            return $error;
        }

    }

    /**
     * Set is_published
     * @param array $article_data
     */

    private function publish(array $article_data)
    {
        $this->title = $article_data['title'];
        $this->text = $article_data['text'];
        $this->is_published = true;

        $this->save();
    }

    /**
     * Add posted and validated data to DB
     * @return int
     */

    private function save()
    {
        if ($this->is_published == true) {

            $this->db->query("INSERT INTO articles SET title = '" . $this->db->escape($this->title) . "', text = '" . $this->db->escape($this->text) . "'");

            $this->article_id = $this->db->getLastId();
        }

    }

    /**
     * Add style to html
     * @return string
     */

    public function addStyle()
    {
        $html = '<style>form{width:30%;margin:0 auto;background:#eee;padding:15px;border:1px solid #ddd;}
                    input[type="text"],textarea{width:70%;height:34px;padding:5px;display:inline-block;margin-bottom:15px;margin-top:5px;border:1px solid #ddd;}
                    input[type="text"]:focus, textarea:focus{border:1px solid #fff;outline:none;}
                    textarea{height: 100px;}
                    span {display:inline-block;width:30%;vertical-align: top}
                    p{margin:-15px 0 0 30%;font-size:12px;text-align:right}
                    input[type="submit"] {margin:0 auto;background:#000;border:1px solid;color:#fff;padding:15px;border-radius:10px;cursor:pointer;display:inherit;}
                    input[type="submit"]:hover{background:#ddd;color:#000;}
                    .success{margin: 0 auto;font-size: 14px;text-align: center;width: 30%;padding: 15px; color:green}
            </style>';

        return $html;
    }
}
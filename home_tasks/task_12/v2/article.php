<?php

class Article
{
    public $title;
    public $text;
    private $is_published = false;

    /**
     * Set is_published
     * @param array $article_data
     */
    public function publish()
    {
        $this->is_published = true;

    }

    /**
     * Add posted and validated data to DB
     * @return int
     */
    public function save($config)
    {
        $sql = mysqli_connect($config['host'], $config['user'], $config['password'])
        or die('Can not connect: ' . mysqli_error($sql));
        mysqli_select_db($sql, $config['database']) or die('Wrong db');

        $title = mysqli_real_escape_string($sql, $this->title);
        $text = mysqli_real_escape_string($sql, $this->text);

        $query = "INSERT INTO articles SET title = '" . $title . "', text = '" . $text . "'";
        mysqli_query($sql, $query) or die('Query failed: ' . mysqli_error($sql));

    }

}

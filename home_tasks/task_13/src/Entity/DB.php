<?php

namespace Entity;

use Service\DbManager;

class DB extends DbManager
{

    /** Select article by id
     * @param int $id
     * @return array $data
     */
    public function GetArticleById(int $id)
    {
        $articles = $this->query("SELECT * FROM articles WHERE id = '" . $id . "'");

        if ($articles->num_rows) {
            foreach ($articles->rows as $row) {
                $data = $row;
            }
        } else {
            $data = [];
        }

        return $data;
    }

    /** Update table by article_id
     * @param array $data
     */
    public function UpdateArticle(array $data)
    {
        $query = "UPDATE articles SET title = '" . $this->escape($data['title']) . "', text = '" . $this->escape($data['text']) . "' WHERE id='" . (int)$data['id'] . "'";
        $this->query($query);

    }

    /**Add new article
     * @param array $data
     */
    public function AddArticle(array $data)
    {
        //id autoincrement, я помню, я добавляю его тут специально
        $query = "INSERT INTO articles SET title = '" . $this->escape($data['title']) . "', text = '" . $this->escape($data['text']) . "', id = '" . $this->escape($data['id']) . "'";
        $this->query($query);

    }
}
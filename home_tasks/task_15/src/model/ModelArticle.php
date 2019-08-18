<?php


namespace Model;

use Core\Model;


/**
 * Class ModelArticle
 * @package Model
 */
class ModelArticle extends Model
{
    /**
     * All articles by user
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function getArticlesByUserId(int $id):array
    {
        $articles = array();

        $sql = "SELECT * FROM articles WHERE  user_id='" . $id . "'";
        $query = $this->db->query($sql);

        if ($query->num_rows) {

            foreach ($query->rows as $row) {
                $articles[] = $row;
            }
        }

        return $articles;
    }

    /**
     * Add new article
     * @param string $title
     * @param string $text
     * @param int $user_id
     * @throws \Exception
     */
    public function addArticle(string $title, string $text, int $user_id):void
    {
        $sql = "INSERT INTO articles SET title = '" . $this->db->escape($title) . "', text = '" . $this->db->escape($text) . "', user_id = '" . (int)$user_id . "'";
        $this->db->query($sql);

    }

    /**
     * Update article
     * @param int $article_id
     * @param string $title
     * @param string $text
     * @param int $user_id
     * @throws \Exception
     */
    public function updateArticle(int $article_id, string $title, string $text, int $user_id):void
    {
        $sql = "UPDATE articles SET title = '" . $this->db->escape($title) . "', text = '" . $this->db->escape($text) . "' WHERE id = '" . (int)$article_id . "' AND user_id = '" . (int)$user_id . "'";
        $this->db->query($sql);

    }


    /**
     * Delete article
     * @param int $article_id
     * @param string $user_id
     * @throws \Exception
     */
    public function deleteArticle(int $article_id, string $user_id):void
    {
        $sql = "DELETE FROM articles WHERE id = '" . (int)$article_id . "' AND user_id = '" . (int)$user_id . "'";
        $this->db->query($sql);

    }

}

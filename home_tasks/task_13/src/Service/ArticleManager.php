<?php

namespace Service;

use Entity\Article;
use InterfaceNameSpace\EntityManager;
use Entity\BaseEntity;
use InterfaceNameSpace\EntityManagerInterface;


/**
 * Class ArticleManager
 * @package Service
 */
class ArticleManager implements EntityManagerInterface
{
    /**
     * Object DB
     * @var
     */
    private $db;


    /**
     * Set db connection
     * @param object $db
     */
    public function setDb(object $db): void
    {
        $this->db = $db;
    }

    /**
     * Create Article object by id
     * @param int $id
     * @return object|null
     */
    public function getById(int $id): ?object
    {
        $article_query = $this->GetArticleById($id);

        if ($article_query->num_rows) {

            foreach ($article_query->rows as $row) {
                $data['title'] = $row['title'];
                $data['text'] = $row['text'];
            }

            $article = new Article($data['title'], $data['text']);
            $article->setId($id);
            return $article;

        } else {
            return null;
        }

    }

    /**
     * Article id check
     * @param int $id
     * @return bool
     */
    private function getArticleID(int $id): bool
    {
        $article = $this->GetArticleById($id);

        if ($article->num_rows) {
            return true;

        } else {
            return false;
        }

    }

    /**
     * Add or update article
     * @param BaseEntity $object
     */
    public function save(BaseEntity $object): void
    {
        $id = $object->getId();
        $data['title'] = $object->getTitle();
        $data['text'] = $object->getText();
        $data['id'] = $id;


        if ($this->getArticleID($id)) {
            $this->UpdateArticle($data);
        } else {
            $this->AddArticle($data);
        }
    }

    /**
     * Get article by id query
     * @param int $id
     * @return object
     */
    private function GetArticleById(int $id): object
    {
        return $this->db->query("SELECT * FROM articles WHERE id = '" . $id . "'");

    }

    /**
     * Update article query
     * @param array $data
     */
    private function UpdateArticle(array $data): void
    {
        $query = "UPDATE articles SET title = '" . $this->db->escape($data['title']) . "', text = '" . $this->db->escape($data['text']) . "' WHERE id='" . (int)$data['id'] . "'";
        $this->db->query($query);

    }

    /**
     * Add article
     * @param array $data
     */
    private function AddArticle(array $data): void
    {
        //id autoincrement, я помню, я добавляю его тут специально
        $query = "INSERT INTO articles SET title = '" . $this->db->escape($data['title']) . "', text = '" . $this->db->escape($data['text']) . "', id = '" . $this->db->escape($data['id']) . "'";
        $this->db->query($query);

    }

}

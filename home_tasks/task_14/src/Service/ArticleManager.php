<?php

namespace Service;

use Entity\Article;
use Entity\MysqlConfig;
use Entity\MysqlDatabase;
use InterfaceNameSpace\EntityManager;
use Entity\BaseEntity;



/**
 * Class ArticleManager
 * @package Service
 */
class ArticleManager extends EntityManager
{

    /**
     * ArticleManager constructor.
     */
    public function __construct()
    {
        $this->config = new MysqlConfig();

        try {
            $this->db = new MysqlDatabase($this->config);
        } catch (\Throwable $exception){
            print_r($exception->getMessage());
        }
        
        $this->db_table = 'articles';
    }

    /**
     * Create Article object by id
     * @param int $id
     * @return object|null
     */
    public function getById(int $id): ?object
    {
        $article_query = $this->getRecordById($id);

        if ($article_query->num_rows) {

            foreach ($article_query->rows as $row) {
                $data['title'] = $row['title'];
                $data['text'] = $row['text'];
                $data['user_id'] = $row['user_id'];
            }
            $user_manager = new UserManager($this->config);
            $user_test = $user_manager->getById($data['user_id']);

            $article = new Article($data['title'], $data['text'], $user_test);
            $article->setId($id);
            return $article;

        } else {
            return null;
        }

    }


    /** Add or update article
     * @param BaseEntity $object
     * @throws \Exception
     */
    public function save(BaseEntity $object): void
    {
        $id = $object->getId();
        $data['title'] = $object->getTitle();
        $data['text'] = $object->getText();
        $data['id'] = $id;


        if ($this->isRecordExist($id)) {
            $this->update($data);
        } else {
            $this->add($data);
        }
    }


    /**
     * Update article
     * @param array $data
     * @throws \Exception
     */
    private function update(array $data): void
    {
        $query = "UPDATE articles SET title = '" . $this->db->escape($data['title']) . "', text = '" . $this->db->escape($data['text']) . "' WHERE id='" . (int)$data['id'] . "'";
        $this->db->query($query);

    }

    /**
     * Add article
     * @param array $data
     * * @throws \Exception
     */
    private function add(array $data): void
    {
        $query = "INSERT INTO articles SET title = '" . $this->db->escape($data['title']) . "', text = '" . $this->db->escape($data['text']) . "', id = '" . $this->db->escape($data['id']) . "'";
        $this->db->query($query);

    }

}

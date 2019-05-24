<?php

namespace Service;

use InterfaceNameSpace\EntityManagerInterface;
use Entity\BaseEntity;

class ArticleManager implements EntityManagerInterface
{
    private $db;

    /**
     * @param mixed $db
     */
    public function setDb(object $db): void
    {
        $this->db = $db;
    }

    /** Get Article by id
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {

        return $this->db->GetArticleById($id);

    }

    /** Save or update article
     * @param BaseEntity $object
     */
    public function save(BaseEntity $object)
    {
        $id = $object->getId();
        $data['title'] = $object->getTitle();
        $data['text'] = $object->getText();
        $data['id'] = $id;

        if (!empty($this->getById($id))) {
            $this->db->UpdateArticle($data);
        } else {
            $this->db->AddArticle($data);
        }
    }

}

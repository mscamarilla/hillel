<?php

namespace Service;

use Entity\MysqlConfig;
use Entity\MysqlDatabase;
use Entity\User;
use InterfaceNameSpace\EntityManager;
use Entity\BaseEntity;
use InterfaceNameSpace\EntityManagerInterface;


/**
 * Class UserManager
 * @package Service
 */
class UserManager extends EntityManager implements EntityManagerInterface
{

    /**
     * UserManager constructor.
     */
    public function __construct()
    {
        $this->config = new MysqlConfig();

        try {
            $this->db = new MysqlDatabase($this->config);
        } catch (\Throwable $exception){
            print_r($exception->getMessage());
        }

        $this->db_table = 'users';
    }

    /**
     * Create User object by id
     * @param int $id
     * @return object|null
     */
    public function getById(int $id): ?object
    {
        $user_query = $this->getRecordById($id);

        if ($user_query->num_rows) {

            foreach ($user_query->rows as $row) {
                $data['name'] = $row['name'];
                $data['surname'] = $row['surname'];
            }

            $user = new User($data['name'], $data['surname']);
            $user->setId($id);
            return $user;

        } else {
            return null;
        }

    }

    /**
     * Save data to db
     * @param BaseEntity $object
     * @throws \Exception
     */
    public function save(BaseEntity $object): void
    {
        $id = $object->getId();
        $data['name'] = $object->getName();
        $data['surname'] = $object->getSurname();
        $data['id'] = $id;


        if ($this->isRecordExist($id)) {
            $this->update($data);
        } else {
            $this->add($data);
        }
    }


    /**
     * Update User
     * @param array $data
     * @throws \Exception
     */
    private function update(array $data): void
    {
        $query = "UPDATE users SET name = '" . $this->db->escape($data['name']) . "', surname = '" . $this->db->escape($data['surname']) . "' WHERE id='" . (int)$data['id'] . "'";
        $this->db->query($query);

    }

    /**
     * Add user
     * @param array $data
     * @throws \Exception
     */
    private function add(array $data): void
    {
        $query = "INSERT INTO users SET name = '" . $this->db->escape($data['name']) . "', surname = '" . $this->db->escape($data['surname']) . "', id = '" . $this->db->escape($data['id']) . "'";
        $this->db->query($query);

    }

}

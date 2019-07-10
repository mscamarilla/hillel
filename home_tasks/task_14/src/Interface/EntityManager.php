<?php

namespace InterfaceNameSpace;

use Entity\BaseEntity;

/**
 * Class EntityManager
 * @package InterfaceNameSpace
 */
abstract class EntityManager implements EntityManagerInterface
{
    /**
     * @var
     */
    protected $config;
    protected $db;
    protected $db_table;

    /**
     * @param int $id
     * @return mixed
     */
    abstract function getById(int $id): ?object;

    /**
     * @param BaseEntity $object
     * @return mixed
     */
    abstract function save(BaseEntity $object): void;

    /**
     * Record id check
     * @param int $id
     * @return bool
     */

    protected function isRecordExist (int $id): bool
    {
        $record = $this->getRecordById($id);

        if ($record->num_rows) {
            return true;

        } else {
            return false;
        }
    }

    /**
     * Get record by id query
     * @param int $id
     * @return object
     */
    protected function getRecordById(int $id): object
    {
        return $this->db->query("SELECT * FROM " . $this->db_table . " WHERE id = '" . $id . "'");

    }

}

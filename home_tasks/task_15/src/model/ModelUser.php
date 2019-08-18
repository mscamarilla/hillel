<?php


namespace Model;

use Core\Model;

/**
 * Class ModelUser
 * @package Model
 */
class ModelUser extends Model
{
    /**
     * @var
     */
    private $token;
    /**
     * @var
     */
    private $id;

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * Token validation
     * @return bool
     * @throws \Exception
     */
    public function isTokenValid()
    {
        $sql = "SELECT * FROM users WHERE token='" . $this->token . "'";
        $query = $this->db->query($sql);

        if ($query->num_rows) {
            return true;
        }

        return false;
    }

    /**
     * Get user id by token
     * @return bool
     * @throws \Exception
     */
    public function getUserIdByToken()
    {
        $sql = "SELECT id FROM users WHERE token='" . $this->token . "'";
        $query = $this->db->query($sql);

        if ($query->row['id']) {

            return $query->row['id'];
        }

        return false;
    }

}

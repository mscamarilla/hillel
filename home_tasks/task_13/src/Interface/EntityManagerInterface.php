<?php

namespace InterfaceNameSpace;

use Entity\BaseEntity;

interface EntityManagerInterface
{
    public function getById(int $id);

    public function save(BaseEntity $object);
}

<?php

class UserAdminModel extends UserModel
{
    /** @var int */
    private $id;


    public function __construct(int $id, string $name)
    {
        parent::__construct($id, $name);
    }


    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return true;
    }

}
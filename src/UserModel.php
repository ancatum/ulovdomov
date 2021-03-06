<?php

class UserModel
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;


    public function __construct(?int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return false;
    }

}
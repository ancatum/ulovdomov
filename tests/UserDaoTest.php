<?php


use PHPUnit\Framework\TestCase;

class UserDaoTest extends TestCase
{

    public function testGettingUserList()
    {
        $expected = [
            0 => [
                "id" => 1,
                "name" => "Adam",
                "isAdmin" => true,
            ],
            1 => [
                "id" => 2,
                "name" => "Bob",
                "isAdmin" => true,
            ],
            2 => [
                "id" => 3,
                "name" => "Cyril",
                "isAdmin" => true,
            ],
            3 => [
                "id" => 4,
                "name" => "Derek",
                "isAdmin" => false,
            ],
            4 => [
                "id" => 19,
                "name" => "Pepa",
                "isAdmin" => true,
            ],
            5 => [
                "id" => 20,
                "name" => "Franta",
                "isAdmin" => true,
            ],
        ];

        $this->assertEquals($expected, UserDao::getUserList());
    }


    public function testFindingUserById()
    {
        $id = 3;
        $name = "Cyril";
        $user = UserDao::findUserById($id);

        $expected = null;
        if ($user) {
            if ($user->isAdmin()) {
                $expected = new UserAdminModel($id, $name);
            } else {
                $expected = new UserModel($id, $name);
            }
        }

        $this->assertEquals($expected, $user);
    }




}
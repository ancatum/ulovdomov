<?php


use PHPUnit\Framework\TestCase;

class UserAdminDaoTest extends TestCase
{


    public function testFindingUserAdminByName()
    {
        $id = 3;
        $name = "Cyril";
        $user = UserAdminDao::findUserAdminByName($name);

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


    public function testCheckingUserAccess()
    {
        $user = UserDao::findUserById(3);
        $expected = [
            0 => [
                "permission_id" => 1,
                "access" => true,
            ],
            1 => [
                "permission_id" => 2,
                "access" => true,
            ],
        ];

        $this->assertEquals($expected, UserAdminDao::findUserFuturePermissions($user));
    }
}
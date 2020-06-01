<?php


use PHPUnit\Framework\TestCase;

class AccessModelTest extends TestCase
{

    public function testAddVillageUserPermissionSuccess()
    {
        $user = UserDao::findUserById(20);
        $permission = PermissionDao::findPermissionById(1);

        AccessModel::set($user, AccessModel::createPermissionSettings());

        $expectedResult = AccessModel::get($user, $permission);
        $this->assertEquals([0 => "1", 1 => "2"], $expectedResult);
    }



    public function testAddVillageUserPermissionFail()
    {
        $this->expectException(Exception::class);

        $user = UserDao::findUserById(4);
        AccessModel::set($user, AccessModel::createPermissionSettings());
    }
}
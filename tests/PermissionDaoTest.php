<?php


use PHPUnit\Framework\TestCase;

class PermissionDaoTest extends TestCase
{

    public function testGettingPermissionList()
    {
        $this->assertEquals([1 => "adresář", 2 => "vyhledávač"], PermissionDao::getPermissionList());
    }


    public function testFindingPermissionByIdSuccess()
    {
        $permission = PermissionDao::findPermissionById(2);
        $expected = new PermissionModel(2, "vyhledávač");

        $this->assertEquals($expected, $permission);
    }


    public function testFindingPermissionByIdFail()
    {
        $permission = PermissionDao::findPermissionById(6);
        $expected = null;

        $this->assertEquals($expected, $permission);
    }

}
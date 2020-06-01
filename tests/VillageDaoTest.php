<?php


use PHPUnit\Framework\TestCase;

class VillageDaoTest extends TestCase
{

    public function testGettingVillageList()
    {
        $this->assertEquals([1 => "Praha", 2 => "Brno"], VillageDao::getVillageList());
    }



    public function testFindingVillageByIdSuccess()
    {
        $village = VillageDao::findVillageById(1);
        $expected = new VillageModel(1, "Praha");

        $this->assertEquals($expected, $village);
    }


    public function testFindingVillageByIdFail()
    {
        $village = VillageDao::findVillageById(3);
        $expected = null;

        $this->assertEquals($expected, $village);
    }
}
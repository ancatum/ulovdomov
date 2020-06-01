<?php

class VillageDao
{
    /**
     * @return array
     */
    public static function getVillageList(): array
    {
        $query = DB::getConnection()->prepare("SELECT * FROM village");
        $query->execute();
        $villageRows = $query->fetchAll();

        $villageList = [];
        foreach ($villageRows as $row) {
            $villageList[$row["id"]] = $row["name"];
        }

        return $villageList;
    }


    /**
     * @param int $id
     * @return VillageModel|null
     */
    public static function findVillageById(int $id): ?VillageModel
    {
        $query = DB::getConnection()->prepare("SELECT * FROM village WHERE id = ?");
        $query->execute([$id]);
        $village = $query->fetch(PDO::FETCH_ASSOC);

        if ($village) {
            return new VillageModel($village["id"], $village["name"]);
        } else {
            return null;
        }
    }


    /**
     * @param $name
     */
    public function createVillage($name): void
    {
        $queryVillage = DB::getConnection()->prepare("REPLACE INTO village (name), VALUE (?)");
        $queryVillage->execute([$name]);

        foreach (UserDao::getUserList() as $user) {
            if ($user instanceof UserAdminModel) {
                $village = self::findVillageByName($name);
                foreach (UserAdminDao::findUserFuturePermissions($user) as $userFuturePermission) {
                    if ($userFuturePermission["access"] == true) {
                        $queryAccess = DB::getConnection()->prepare("REPLACE INTO access (user_id, permission_id, village_id), VALUES (?, ?, ?)");
                        $queryAccess->execute([$user->getId(), $userFuturePermission["permission_id"], $village->getId()]);
                    }
                }
            }
        }

    }


    /**
     * @param string $name
     * @return VillageModel|null
     */
    public static function findVillageByName(string $name): ?VillageModel
    {
        $query = DB::getConnection()->prepare("SELECT * FROM village WHERE name = ?");
        $query->execute([$name]);
        $village = $query->fetch(PDO::FETCH_ASSOC);
        if ($village) {
            return new VillageModel($village["id"], $village["name"]);
        } else {
            return null;
        }
    }

}
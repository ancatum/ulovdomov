<?php

class UserAdminDao
{
    /**
     * @param $name
     */
    public static function createUserAdmin($name): void
    {
        $queryUser = DB::getConnection()->prepare("REPLACE INTO user (name, isAdmin) VALUES (?, ?)");
        $queryUser->execute([$name, true]);
        $userAdmin = self::findUserAdminByName($name);

        $queryAccess = DB::getConnection()->prepare("REPLACE INTO access (user_id, permission_id, village_id) VALUES (?, ?, ?)");
        $allPermissionIds = array_keys(PermissionDao::getPermissionList());
        $allVillagesIds = array_keys(VillageDao::getVillageList());

        foreach ($allPermissionIds as $permissionId) {
            foreach ($allVillagesIds as $villageId) {
                $queryAccess->execute([$userAdmin->getId(), $permissionId, $villageId]);
            }
        }
    }


    /**
     * @param string $name
     * @return UserAdminModel|null
     */
    public static function findUserAdminByName(string $name): ?UserAdminModel
    {
        $query = DB::getConnection()->prepare("SELECT * FROM user WHERE name = ?");
        $query->execute([$name]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return new UserAdminModel($user["id"], $user["name"]);
        } else {
            return null;
        }
    }


    /**
     * @param UserAdminModel $user
     * @return array
     */
    public static function findUserFuturePermissions(UserAdminModel $user): array
    {
        $query = DB::getConnection()->prepare("SELECT * FROM access WHERE user_id = ?");
        $query->execute([$user->getId()]);
        $accessRows = $query->fetchAll(PDO::FETCH_ASSOC);

        $allPermissionIds = array_keys(PermissionDao::getPermissionList());
        $allVillagesCount = count(VillageDao::getVillageList());

        $userPermissionsVillages = [];
        foreach ($accessRows as $accessRow) {
            $userPermissionsVillages[$accessRow["permission_id"]][] = $accessRow["village_id"];
        }

        $results = [];
        foreach ($allPermissionIds as $permissionId) {
            $results[] = [
                "permission_id" => $permissionId,
                "access" => count($userPermissionsVillages[$permissionId]) === $allVillagesCount
            ];
        }

        return $results;
    }

}
<?php

class AccessModel
{
    /** @var int */
    private $id;

    /** @var UserModel */
    private $user;

    /** @var PermissionModel */
    private $permission;

    /** @var VillageModel */
    private $village;


    /**
     * @param UserModel $user
     * @param array $permissionSettings
     * @throws Exception
     */
    public static function set(UserModel $user, array $permissionSettings)
    {
        if ($user instanceof UserAdminModel) {
            foreach ($permissionSettings as $key => $permissionForVillages) {
                foreach ($permissionForVillages as $villageId => $access) {
                    $permissionId = $key;
                    if (($access == true) or (!in_array(true, $permissionForVillages))) {
                        $query = DB::getConnection()->prepare("REPLACE INTO access (user_id, permission_id, village_id) VALUES(?, ?, ?)");
                        $query->execute([$user->getId(), $permissionId, $villageId]);
                    }
                }
            }
        } else {
            throw new Exception("Only admins can have permissions.");
        }
    }


    /**
     * @param UserModel $user
     * @param PermissionModel $permission
     * @return array
     */
    public static function get(UserModel $user, PermissionModel $permission): array
    {
        $query = DB::getConnection()->prepare("SELECT village_id FROM access WHERE user_id = ? AND permission_id = ?");
        $query->execute([$user->getId(), $permission->getId()]);

        $result = $query->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }


    /**
     * @return array
     */
    public static function createPermissionSettings(): array
    {
        return [
            1 => [
                1 => false,
                2 => false,
            ],
            2 => [
                1 => false,
                2 => true,
            ]
        ];
    }

}
<?php

class PermissionDao
{
    /**
     * @return array
     */
    public static function getPermissionList(): array
    {
        $query = DB::getConnection()->prepare("SELECT * FROM permission");
        $query->execute();
        $permissionRows = $query->fetchAll();

        $permissionList = [];
        foreach ($permissionRows as $row) {
            $permissionList[$row["id"]] = $row["name"];
        }
        return $permissionList;
    }


    /**
     * @param int $id
     * @return PermissionModel|null
     */
    public static function findPermissionById(int $id): ?PermissionModel
    {
        $query = DB::getConnection()->prepare("SELECT * FROM permission WHERE id = ?");
        $query->execute([$id]);
        $permission = $query->fetch(PDO::FETCH_ASSOC);

        if ($permission) {
            return new PermissionModel($permission["id"], $permission["name"]);
        } else {
            return null;
        }
    }

}
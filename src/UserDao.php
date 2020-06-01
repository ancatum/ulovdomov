<?php

class UserDao
{
    /**
     * @param $name
     */
    public static function createUser($name): void
    {
        $queryUser = DB::getConnection()->prepare("REPLACE INTO user (name, isAdmin) VALUES (?, ?)");
        $queryUser->execute([$name, false]);
    }


    /**
     * @return array
     */
    public static function getUserList()
    {
        $query = DB::getConnection()->prepare("SELECT * FROM user");
        $query->execute();
        $userRows = $query->fetchAll();

        $userList = [];
        foreach ($userRows as $row) {
            $userList[] = [
                "id" => intval($row["id"]),
                "name" => $row["name"],
                "isAdmin" => boolval($row["isAdmin"]),
            ];
        }

        return $userList;
    }


    /**
     * @param int $id
     * @return UserModel|null
     */
    public static function findUserById(int $id): ?UserModel
    {
        $query = DB::getConnection()->prepare("SELECT * FROM user WHERE id = ?");
        $query->execute([$id]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user["isAdmin"] == true) {
                return new UserAdminModel($user["id"], $user["name"]);
            } else {
                return new UserModel($user["id"], $user["name"]);
            }
        } else {
            return null;
        }
    }

}
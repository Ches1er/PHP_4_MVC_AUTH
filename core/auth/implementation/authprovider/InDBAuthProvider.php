<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 20.02.2019
 * Time: 19:11
 */

namespace core\auth\implementation\authprovider;


use core\auth\contracts\AuthProvider;
use core\db\DBQueryBuilder;
use core\auth\Credential;

class InDBAuthProvider implements AuthProvider
{

    private $credentials=[];

    /**
     * InDBAuthProvider constructor.
     * @param $credentials
     */
    public function __construct()
    {
        $this->credentials = DBQueryBuilder::create(DBQueryBuilder::DEF_CONFIG_NAME)
        ->from("users")->all();
    }


    function getCredentials(string $login): ?Credential
    {
        foreach ($this->credentials as $credential){
            //Get roles
            if($credential["login"]===$login){
                $roles = array_map(function($f){
                    return $f["role_name"];
                },$this->getRoles($credential["id"]));

                return new Credential($credential["login"],$credential["pass"],$roles);
            }
        }
        return null;
    }

    private function getRoles($id):?array{
            return DBQueryBuilder::create(DBQueryBuilder::DEF_CONFIG_NAME)
                ->select(["roles.role_name"])->from("roles")->join("inner","users_roles",
                    ["role_id","role_id"],["users","id","users_roles","user_id"])
                ->where("users.id",$id)->all();
    }
}
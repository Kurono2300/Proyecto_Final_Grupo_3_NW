<?php

namespace Dao\Mnt;

class Usuarios extends \Dao\Table
{
    public static function getAll()
    {
        return self::obtenerRegistros("SELECT * from usuario;", array());
    }

    
    public static function getOne($usercod)
    {
        $sqlstr = "Select * from usuario where usercod=:usercod;";
        return self::obtenerUnRegistro($sqlstr, array("usercod"=>$usercod));
    }


    public static function insert($useremail, $username, $userpswd, $userfching, $userpswdest, $userpswdexp, $userest, $useractcod, $userpswdchg, $usertipo)
    {
        $insstr = "insert into usuario (useremail, username, userpswd, userfching, userpswdest, 
        userpswdexp, userest, useractcod, userpswdchg, usertipo)
        values (:useremail, :username, :userpswd, :userfching, :userpswdest, :userpswdexp, :userest, 
        :useractcod, :userpswdchg, :usertipo);";
        return self::executeNonQuery(
            $insstr,
            array("useremail"=>$useremail, "username"=>$username, "userpswd"=>$userpswd, "userfching"=>$userfching, 
            "userpswdest"=>$userpswdest, "userpswdexp"=>$userpswdexp, "userest"=>$userest, "useractcod"=>$useractcod,
            "userpswdchg"=>$userpswdchg, "usertipo"=>$usertipo)
        );
    }


    public static function update($useremail, $username, $userpswd, $userfching, $userpswdest, $userpswdexp, $userest, $useractcod, $userpswdchg, $usertipo, $usercod)
    {
        $updsql = "update usuario set useremail = :useremail, username=:username, userpswd=:userpswd, userfching=:userfching,
        userpswdest=:userpswdest, userpswdexp=:userpswdexp, userest=:userest, useractcod=:useractcod, userpswdchg=:userpswdchg, usertipo=:usertipo where usercod=:usercod;";
        return self::executeNonQuery(
            $updsql,
            array("useremail"=>$useremail, "username"=>$username, "userpswd"=>$userpswd, "userfching"=>$userfching, 
            "userpswdest"=>$userpswdest, "userpswdexp"=>$userpswdexp, "userest"=>$userest, "useractcod"=>$useractcod, 
            "userpswdchg"=>$userpswdchg, "usertipo"=>$usertipo, "usercod" => $usercod)
        );
    }


    public static function delete($usercod)
    {
        $delsql = "delete from usuario where usercod=:usercod;";
        return self::executeNonQuery(
            $delsql,
            array( "usercod" => $usercod)
        );
    }



    /*($usercod, $useremail, $username, $userpswd, 
    $userfching, $userpswdest, $userpswdexp, $userest, $useractcod, $userpswdchg, $usertipo)*/
}

?>

<?php

namespace Dao\Mnt;

class Funciones extends \Dao\Table
{
    public static function getAll()
    {
        return self::obtenerRegistros("SELECT * from funciones;", array());
    }

    
    public static function getOne($fncod)
    {
        $sqlstr = "Select * from funciones where fncod=:fncod;";
        return self::obtenerUnRegistro($sqlstr, array("fncod"=>$fncod));
    }


    public static function insert($fncod, $fndsc, $fnest, $fntyp)
    {
        $insstr = "insert into funciones (fncod, fndsc, fnest, fntyp) values (:fncod, :fndsc, :fnest, :fntyp);";
        return self::executeNonQuery(
            $insstr,
            array("fncod"=>$fncod, "fndsc"=>$fndsc, "fnest"=>$fnest, "fntyp"=>$fntyp)
        );
    }


    public static function update($fndsc, $fnest, $fntyp, $fncod )
    {
        $updsql = "update funciones set fndsc=:fndsc, fnest=:fnest, fntyp=:fntyp where fncod=:fncod;";
        return self::executeNonQuery(
            $updsql,
            array("fndsc"=>$fndsc, "fnest"=>$fnest, "fntyp"=>$fntyp, "fncod"=>$fncod)
        );
    }


    public static function delete($fncod)
    {
        $delsql = "delete from funciones where fncod=:fncod;";
        return self::executeNonQuery(
            $delsql,
            array( "fncod" => $fncod)
        );
    }




}

?>

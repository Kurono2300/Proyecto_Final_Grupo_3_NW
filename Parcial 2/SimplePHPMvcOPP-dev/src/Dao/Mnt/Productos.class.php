<?php

namespace Dao\Mnt;

class Productos extends \Dao\Table
{
    public static function getAll()
    {
        return self::obtenerRegistros("SELECT * from productos;", array());
    }

    public static function getOne($invPrdId)
    {
        $sqlstr = "Select * from productos where invPrdId=:invPrdId;";
        return self::obtenerUnRegistro($sqlstr, array("invPrdId"=>$invPrdId));
    }


    public static function insert($invPrdBrCod, $invPrdCodInt, $invPrdDsc, $invPrdTip, $invPrdEst, $invPrdPadre, $invPrdFactor, $invPrdVnd)
    {
        $insstr = "insert into productos (invPrdBrCod, invPrdCodInt, invPrdDsc, invPrdTip, invPrdEst, 
        invPrdPadre, invPrdFactor, invPrdVnd) values (:invPrdBrCod, :invPrdCodInt, :invPrdDsc, :invPrdTip, :invPrdEst, 
        :invPrdPadre, :invPrdFactor, :invPrdVnd);";
        return self::executeNonQuery(
            $insstr,
            array("invPrdBrCod"=>$invPrdBrCod, "invPrdCodInt"=>$invPrdCodInt, "invPrdDsc"=>$invPrdDsc, "invPrdTip"=>$invPrdTip, 
            "invPrdEst"=>$invPrdEst, "invPrdPadre"=>$invPrdPadre, "invPrdFactor"=>$invPrdFactor, "invPrdVnd"=>$invPrdVnd)
        );
    }
    public static function update($invPrdBrCod, $invPrdCodInt, $invPrdDsc, $invPrdTip, $invPrdEst, $invPrdPadre, $invPrdFactor, $invPrdVnd, $invPrdId)
    {
        $updsql = "update productos set invPrdBrCod = :invPrdBrCod, invPrdCodInt=:invPrdCodInt, invPrdDsc=:invPrdDsc, invPrdTip=:invPrdTip,
        invPrdEst=:invPrdEst, invPrdPadre=:invPrdPadre, invPrdFactor=:invPrdFactor, invPrdVnd=:invPrdVnd where invPrdId=:invPrdId;";
        return self::executeNonQuery(
            $updsql,
            array("invPrdBrCod"=>$invPrdBrCod, "invPrdCodInt"=>$invPrdCodInt, "invPrdDsc"=>$invPrdDsc, "invPrdTip"=>$invPrdTip, 
            "invPrdEst"=>$invPrdEst, "invPrdPadre"=>$invPrdPadre, "invPrdFactor"=>$invPrdFactor, "invPrdVnd"=>$invPrdVnd, "invPrdId" => $invPrdId)
        );
    }


    public static function delete($invPrdId)
    {
        $delsql = "delete from productos where invPrdId=:invPrdId;";
        return self::executeNonQuery(
            $delsql,
            array( "invPrdId" => $invPrdId)
        );
    }

}

?>

<?php

namespace Reservaciones;


class Reserva implements ITabla{
    private $conn;

    public static function getStruct(){
        return array(
            "rsvId"=>0, "rsvIdentidad"=>"", "rsvNombre"=>"", "rsvTelefono"=>"", "rsvCorreo"=>"", "rsvHabitacion"=>0,"rsvPrecio"=>0
        );
    }

    /*------------------------------------ESTRUCTURA----------------------------------------------*/

    public static function getStructFrom($data){
        if (is_array($data)){
            $newData = self::getStruct();
            foreach($data as $itemKey=>$itemVal){
                if(isset($newData[$itemKey])){
                    $newData[$itemKey] = $itemVal;
                }
        }
            return $newData;
        }else{
            return array();
        }
    }

    /*-------------------------CONSTRUCTOR-------------------------------------------------------*/

    public function __construct(){
        $this->conn = Conn::getConn();
    }

    /*------------------------VERIFICAR CREACION O NO BD-----------------------------------------*/

    public function verificar(){
        $sqlDDL = "CREATE TABLE IF NOT EXISTS reservas (rsvId INTEGER PRIMARY KEY AUTOINCREMENT, rsvIdentidad TEXT, rsvNombre TEXT, rsvTelefono TEXT, rsvCorreo TEXT, rsvHabitacion NUMBER, rsvPrecio NUMBER)";
        $this->conn->exec($sqlDDL);
        //$this->conn->query($sqlDDL);
    }

    /*----------------------------INSERT---------------------------------------------------------*/

    public function insert($pdata){
        $data = self::getStructFrom($pdata);
        $insertSQL = "INSERT INTO reservas (rsvIdentidad, rsvNombre, rsvTelefono, rsvCorreo, rsvHabitacion, rsvPrecio) VALUES('%s','%s','%s','%s',%d, %f);";
        $status = $this->conn->exec(
            sprintf($insertSQL, $data["rsvIdentidad"], $data["rsvNombre"], $data["rsvTelefono"], $data["rsvCorreo"], $data["rsvHabitacion"], $data["rsvPrecio"] )
        );
        return $status;
    }

    /*------------------------SELECT--------------------------------------------------------------*/

    public function find($filters){
        $cursor = $this->conn->query("select * from reservas;");
        $reservas = array();
        while($reserva = $cursor->fetchArray(SQLITE3_ASSOC)){
        $reservas[] = $reserva;
        }
        return $reservas;
    }

    /*------------------------UPDATE--------------------------------------------------------------*/

    public function update($pdata){
        $data = self::getStructFrom($pdata);
        $updSql = "UPDATE reservas SET rsvIdentidad='%s', rsvNombre='%s', rsvTelefono='%s', rsvCorreo='%s', rsvHabitacion=%d, rsvPrecio=%f where rsvId=%d ;";
        return $this->conn->exec(
            sprintf($updSql, $data["rsvIdentidad"], $data["rsvNombre"], $data["rsvTelefono"], $data["rsvCorreo"], $data["rsvHabitacion"], $data["rsvPrecio"], $data["rsvId"])
        );
    }

    /*------------------------DELETE--------------------------------------------------------------*/

    public function delete($pdata){
        $data = self::getStructFrom($pdata);
        $delSQL = "DELETE FROM reservas where rsvId=%d;";
        return $this->conn->exec(
            sprintf($delSQL,$data["rsvId"])
        );
    }

}

?>
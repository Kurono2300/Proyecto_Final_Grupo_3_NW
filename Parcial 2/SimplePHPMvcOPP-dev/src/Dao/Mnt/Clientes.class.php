<?php

namespace Dao\Mnt;

class Clientes extends \Dao\Table
{
    public static function getAll()
    {
        return self::obtenerRegistros("SELECT * from clientes;", array());
    }

    public static function getOne($clientid)
    {
        $sqlstr = "Select * from clientes where clientid=:clientid;";
        return self::obtenerUnRegistro($sqlstr, array("clientid"=>$clientid));
    }

    public static function insert($clientname, $clientgender, $clientphone1, $clientphone2, $clientemail, $clientIdnumber, $clientbio, $clientstatus, $clientdatecrt, $clientusercreates)
    {
        $insstr = "insert into clientes (clientname, clientgender, clientphone1, clientphone2, 
        clientemail, clientIdnumber, clientbio, clientstatus, clientdatecrt, 
        clientusercreates) values (:clientname, :clientgender, :clientphone1,
        :clientphone2, :clientemail, :clientIdnumber, :clientbio, :clientstatus, :clientdatecrt, :clientusercreates);";
        return self::executeNonQuery(
            $insstr,
            array("clientname"=>$clientname, "clientgender"=>$clientgender, "clientphone1"=>$clientphone1,
            "clientphone2"=>$clientphone2, "clientemail"=>$clientemail, "clientIdnumber"=>$clientIdnumber,
            "clientbio"=>$clientbio, "clientstatus"=>$clientstatus, "clientdatecrt"=>$clientdatecrt,
            "clientusercreates"=>$clientusercreates)
        );
    }
    public static function update($clientname, $clientgender, $clientphone1, $clientphone2, $clientemail, $clientIdnumber, $clientbio, $clientstatus, $clientdatecrt, $clientusercreates, $clientid)
    {
        $updsql = "update clientes set clientname = :clientname , clientgender=:clientgender, clientphone1=:clientphone1,
        clientphone2=:clientphone2, clientemail=:clientemail, clientIdnumber=:clientIdnumber, clientbio=:clientbio,
        clientstatus=:clientstatus, clientdatecrt=:clientdatecrt, clientusercreates=:clientusercreates where clientid=:clientid;";
        return self::executeNonQuery(
            $updsql,
            array("clientname"=>$clientname, "clientgender"=>$clientgender, "clientphone1"=>$clientphone1,
            "clientphone2"=>$clientphone2, "clientemail"=>$clientemail, "clientIdnumber"=>$clientIdnumber,
            "clientbio"=>$clientbio, "clientstatus"=>$clientstatus, "clientdatecrt"=>$clientdatecrt,
            "clientusercreates"=>$clientusercreates, "clientid" => $clientid)
        );
    }
    public static function delete( $clientid)
    {
        $delsql = "delete from clientes where clientid=:clientid;";
        return self::executeNonQuery(
            $delsql,
            array( "clientid" => $clientid)
        );
    }

}

?>

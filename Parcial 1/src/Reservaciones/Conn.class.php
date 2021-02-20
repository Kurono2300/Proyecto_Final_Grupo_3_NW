<?php

//Aplicar un patron SINGLETON
namespace Reservaciones;

use SQLite3;



class Conn {
  private static $conn = null;

  private function __construct()
  {}
  private function __clone()
  {}

  public static function getConn(){
    if (self::$conn == null){
      self::$conn = new Sqlite3("reservas.db");
    }
    return self::$conn;
  }
}

?>
<?php
class database{
    public static function connect(){
        $db = new mysqli('127.0.0.1', 'root', 'dragonballz', 'tienda');
        $db-> query("SET NAMES 'utf8'");
        return $db;
    }
}

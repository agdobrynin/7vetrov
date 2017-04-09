<?php
namespace Core;

class Db {

    private static $instance = NULL;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    public static function Init( Conf $conf )
    {
        if (!isset(self::$instance)) {
            try {
                if( $conf->DbDriver() == "sqlite" ){
                    self::$instance = new \PDO($conf->DbDsn());
                } elseif( $conf->DbDriver() == "mysql" ){
                    self::$instance = new \PDO($conf->DbDsn(), $conf->DbUser(), $conf->DbPassword());
                } else {
                    throw new Exception("Драйвер БД не определен");
                }
            } catch (\Exception $e) {
                print $e->getMessage();
            }
        }
        return self::$instance;
    }

    public static function getInstance()
    {
      return self::$instance;
    }

    public static function getLastId()
    {
      return self::$instance::lastInsertId();
    }

    public static function escape( $value ){
        return \SQLite3::escapeString( $value );
    }

    public static function query( $sql )
    {
        return self::$instance->query( $sql );
    }
}

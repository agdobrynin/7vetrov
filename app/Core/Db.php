<?php
/**
 * Класс рабоыт с БД
 * Раширение PDO с учетом драйверов БД
 *
 */
namespace Core;

class Db {

    private static $instance = null;

    private function __construct(){}

    private function __clone(){}

    public static function Init( Conf $conf )
    {
        if ( self::$instance === null ) {
            try {
                if( $conf->DbDriver() == "sqlite" ){
                    self::$instance = new \PDO($conf->DbDsn());
                } elseif( $conf->DbDriver() == "mysql" ){
                    $opt  = array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => TRUE,
                    );
                    self::$instance = new \PDO($conf->DbDsn(), $conf->DbUser(), $conf->DbPassword(), $opt);
                } else {
                    throw new \Exception("Драйвер БД не определен");
                }
            } catch (\Exception $e) {
                print $e->getMessage();
            }
        }
        return self::$instance;
    }

    public static function instance()
    {
        if( self::$instance === null ){
            throw new \Exception("Конфигурация БД не загружена");
        }
        return self::$instance;
    }

    public static function getLastId()
    {
      return self::$instance::lastInsertId();
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function run($sql, $args = [])
    {
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
    /**
     * Создание таблицы
     *
     *      В качестве $arrCols массив
     *      [
     *          'имя_колонки' => [
     *              string 'тип поля',
     *              boolean 'первичный ключ',
     *              boolean 'автоинкремен',
     *              boolean 'уникальное поле'
     *          ]
     *      ]
     *
     * @method CreateTable
     * @param  string      $table_name имя таблицы
     * @param  array      $arrCols    описание полей
     */
    public static function MakeTable($table_name, $arrCols)
    {
        //DB::field('id')->integer()->autoincrement()->unique();
        return 0;
    }

    public static function errorText(){
        return self::instance()->errorInfo()[2];

    }

}

<?php
/**
 * Класс рабоыт с БД
 * Раширение PDO с учетом драйверов БД
 *
 */
namespace Core;

class Db {

    private static $instance = null;

    private static $dbDriver = null;

    private function __construct(){}

    private function __clone(){}

    /**
     * Инициализирует соединение с БД
     * @param Conf $conf конфигурация соединения
     * @return object \PDO
     */
    public static function Init( Conf $conf )
    {
        if ( self::$instance === null ) {
            try {
                self::$dbDriver = $conf->DbDriver();
                if( $conf->DbDriver() == "sqlite" ){
                    self::$instance = new \PDO($conf->DbDsn());
                } elseif( $conf->DbDriver() == "mysql" ){
                    $opt  = array(
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                        \PDO::ATTR_EMULATE_PREPARES => TRUE,
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

    public static function getDriver()
    {
        return self::$dbDriver;
    }

    /**
     * Получить инстанс БД
     * @return object \PDO
     */
    public static function instance()
    {
        if( self::$instance === null ){
            throw new \Exception("Конфигурация БД не загружена. Используйте Db::Init");
        }
        return self::$instance;
    }

    /**
     * Получить последний ID при INSERT для полей autoincrement
     * @return integer
     */
    public static function getLastId()
    {
      return self::$instance::lastInsertId();
    }

    /**
     * Вызов метода PDO
     * @param  string $method метод
     * @param  array $args аргументы
     * @return mix возвращаемое значение метода PDO
     */
    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    /**
     * Выполнить SQL запрос
     * @param  string $sql  SQL запрос
     * @param  array $args агрументы для SQL запроса (переменные)
     * @return mix Возвращает PDOStatement или false
     */
    public static function run($sql, $args = [])
    {
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;

    }

    /**
     * Вернуть текстовое описание ошибки при SQL запросе
     * @return string описание ошибки при SQL запросе
     */
    public static function errorText()
    {
        return self::instance()->errorInfo()[2];

    }

}

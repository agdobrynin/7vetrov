<?php
/**
 * Класс конфигурации
 */
namespace Core;

class Conf {
    /**
     * Конфигурпация
     * @var array
     */
    protected $conf= [];

    /**
     * Поддерживаемы драйверы БД
     * @var array
     */
    protected $db_drivers = ['mysql', 'sqlite'];

    protected $default_db_host = 'localhost';

    /**
     * Конструктор Конфиграция проекта
     * @param array $conf   основная конфигурация проекта
     */
    public function __construct( $conf )
    {
        if( count($conf) == 0 ) {
            throw new \Exception("Файл конфигурации пустой");
        }
        $this->conf = $conf;
        $route_file = realpath( $this->conf["routes"] );
        if( is_file( $route_file ) == false ){
            throw new \Exception("Файл роутов не найден. ".$route_file);
        }
        $this->conf["routes"] = require_once $route_file;
    }

    /**
     * Путь к диреткории шаблонов
     * @return string
     */
    public function ViewPath()
    {
        return realpath($this->conf["views_path"]);
    }

    /**
     * Получение роутов и действий
     * @return array
     */
    public function Routes()
    {
        return $this->conf["routes"];
    }

    /**
     * Получить параметры базы по имени драйвера
     * @param string $driver имя драйвера
     * @return string
     */
    protected function DbParamByDriver( $driver )
    {
        return $this->conf["db_connection"][$driver];
    }

    /**
     * Поучить драйвер БД
     * @return string
     */
    public function DbDriver()
    {
        if( in_array($this->conf["db_driver"], $this->db_drivers) == false ){
            throw new \Exception("Драйвер ".$this->conf["db_driver"]." БД не определен");
        }
        return  $this->conf["db_driver"];
    }

    /**
     * Получить DSN к базе
     * @return string
     */
    public function DbDsn()
    {
        //текущий драйвер
        $driver = $this->DbDriver();
        //конфигурация по драйверу
        $db_conf = $this->DbParamByDriver( $driver );
        $dns = null;
        if( $driver == "mysql" ){
            $dns = "mysql:host="
                    .(empty($db_conf["host"]) ? $this->default_db_host : $db_conf["host"] )
                    .";dbname=".$db_conf["db"]
                    .($db_conf["charset"]? ";charset=".$db_conf["charset"]:"")
                    .($db_conf["port"]? ";port=".$db_conf["port"]:"");
        } elseif ( $this->conf["db_driver"] == "sqlite" ){
            $dns = "sqlite:".$db_conf["db"];
        }
        return $dns;
    }
    /**
     * Получить пароль к БД
     * @return mix string|null
     */
    public function DbPassword()
    {
        $db_conf = $this->DbParamByDriver( $this->DbDriver() );

        if ( empty( $db_conf["password"] ) == false ){
            return $db_conf["password"];
        } else {
            return null;
        }

    }
    /**
     * Получить Логин к БД
     * @return mix string|null
     */
    public function DbUser()
    {
        $db_conf = $this->DbParamByDriver( $this->DbDriver() );
        if ( empty( $db_conf["user"] ) == false ){
            return $db_conf["user"];
        } else {
            return null;
        }
    }

}

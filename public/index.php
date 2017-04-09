<?php
//автозагрузка классов
require_once '../app/autoload.php';
//загрузка основных настроек
$conf_main = require_once '../conf/index.php';
//Конфигурация приложения
$conf = new \Core\Conf( $conf_main );
//Экземпляр приложения
$app = new \Core\App( $conf );
//Роуты из конфигурации
$app->RoutesArray( $conf->Routes() );
//Запуск приложения и вывод результатов
$app->Run();

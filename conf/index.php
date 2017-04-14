<?php
return [
  //Путь к шаблонам
  "views_path" => __DIR__."/../views",
  //Путь к файлу роутов
  "routes" => __DIR__."/routes.php",
  //драйвер БД - конфигурация в conf/database.php
  "db_driver" => "sqlite",
  //Конфигурация коннекта к БД
  "db_connection" => [
      //для БД SQLite
      "sqlite"=>[
          "db"=>__DIR__."/../database/database.db"
      ],
      //для БД MySQL
      "mysql" =>[
          "host"=>"127.0.0.1",
          "db"=>"dev4",
          "user"=>"homestead",
          "password"=>"secret",
          "port" => "33060",
          "charset" => "utf8"
      ]
  ]
];

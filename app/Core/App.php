<?php

namespace Core;

class App{

      protected $request;

      protected $routes=[];

      protected $uri;

      protected $view;

      protected $db;
      /**
       *
       * @method __construct
       * @param  Conf       $conf конфигурация
       */
      public function __construct( Conf $conf )
      {
          $this->view = new View( $conf->ViewPath() );
          $this->request = array_merge($_POST, $_GET);
          $this->db = Db::Init( $conf );
      }

      /**
       * Добавить единичный роут
       * @method RouteAdd
       * @param  string   $route  uri роута
       * @param  [type]   $calabel класс@метод
       */
      public function RouteAdd($route, $calabel)
      {
          if ( is_string( $calabel ) && strpos( $calabel, '@') ) {
              $controller = strstr($calabel, '@', true);
              $method = substr(strrchr($calabel, "@"), 1);
              //$calabel = array( new $controller($this), $method );
              $controller = '\\Controllers\\'.$controller;
              $calabel = array( new $controller($this) , $method );
          }
          $this->routes[$route]= $calabel;
      }

      /**
       * Загружает массив роутов
       * @method RoutesArray
       * @param  array $routes массив роутов
       */
      public function RoutesArray( array $routes )
      {
        if( count($routes) ){
          foreach ($routes as $route => $action) {
            $this->RouteAdd($route, $action);
          }
        }
      }

      /**
       * Получить экземпляр класса View шаблон
       * @method GetView
       */
      public function GetView()
      {
          return $this->view;
      }

      /**
       * Получить реквести переданнный приложению
       * @method Request
       */
      public function Request( $key=null )
      {
          if( $key === null ){
            return $this->request;
          }else{
            return $this->request[$key];
          }
      }
      /**
       * Поучить текущий URI
       * @return string
       */
      public function Uri()
      {
          return urldecode( parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) );
      }

      /**
       * Запуск приложения и выдача результата
       * @method Run
       */
      public function Run()
      {
          $this->uri = $this->Uri();
          foreach ($this->routes as $route => $action) {
              if ( $route == $this->uri ){
                  print call_user_func_array( $action, [] );
                  return;
              }
          }
          header("HTTP/1.0 404 Not Found");

          try {
              $uri = $this->uri;
              print $this->view->Render('404.php', compact(["uri"]));
          } catch (\Exception $e) {
              print "<h1>Page not found!</h1><p>
              uri: <strong>$this->uri</strong>
              </p>";
          }
          return;
      }
}

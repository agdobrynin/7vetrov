<?php
/**
 * Базовый класс контролеров
 */
namespace Core;

class Controller{

    protected static $app;

    public function __construct( $app )
    {
        self::$app = $app;
    }

    public static function View( $view, $data=null)
    {

        return self::$app->GetView()->Render($view, $data);
    }

    public static function Request( $key = null )
    {
        if( $key == null){
          return self::$app->Request();
        }else {
          return self::$app->Request( $key );
        }
    }
}

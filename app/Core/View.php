<?php
namespace Core;

class View{
    private $ViewPath;

    public function __construct( $path = null )
    {
      if( $path == null ){
        $this->ViewPath = realpath(__DIR__.'/../../views');
      }else{
        $this->ViewPath = realpath( $path );
      }
      $this->ViewPath .= "/";
    }

    public function setPath( $viewPath )
    {
        $this->viewPath = realpath( $viewPath );
        if( $this->viewPath === false ){
                throw new Exception("Can't find Views path: $viewPath");
        }
        $this->viewPath.="/";
    }

    public function __get($prop)
    {
      return $this->$prop;
    }

    public function Render( $Template, $data = null)
    {
        if( file_exists($this->ViewPath.$Template) ){
            error_reporting(E_ERROR | E_WARNING | E_PARSE);
            if(is_array($data)){
              extract($data, EXTR_OVERWRITE);
            }
            ob_start();
            include $this->ViewPath.$Template;
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        }
        throw new \Exception("View does not exist: ".$this->ViewPath.$Template);
    }
}

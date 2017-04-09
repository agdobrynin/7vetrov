<?php
namespace Controllers;

use \Core\Controller as Controller;
use \Core\Db as Db;
use \Models\CalculateList;

class ControllerList extends Controller{

    public function index()
    {
        try {
            $List = new CalculateList();
            $calculates = $List->GetList();
        } catch (\Exception $e) {
            $errors[] = $e->getMessage();
        }

        $title = "Список расчетов в базе";
        return self::View('list.php', compact(["calculates", "title", "errors"]));
    }

    public function search()
    {
        try {
            if( @self::Request('min')!==null || @self::Request('max')!==null ){

              $where= [];
              $min = @self::Request('min');
              if ( $min !== null && is_numeric($min)){
                $where['min'] = $min;
              }else{
                $min = '';
              }

              $max = @self::Request('max');
              if ( $max !== null && is_numeric($max)){
                $where['max'] = $max;
              }else{
                $max = '';
              }

              $List = new CalculateList();
              if(count($where)){
                $calculates = $List->GetList($where);
              }
            }
        } catch (\Exception $e) {
            $errors[] = $e->getMessage();
        }
        return self::View('list_search.php', compact(["calculates", "errors", "min", "max"]));
    }

}

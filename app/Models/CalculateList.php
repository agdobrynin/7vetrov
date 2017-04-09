<?php
namespace Models;

use \Core\Model as Model;
use \Core\Db as Db;

class CalculateList extends Model{
    /**
     * Выбрать коллекцию расчетов по условтю
     * @param array $where Условие
     * [
     *      'min' => значение кода больше или равно,
     *      'maх' => значение кода меньше или равно,
     * ]
     */
    public function GetList( array $where = [] )
    {
        $where_sql = [];
        $sql_where_1=''; $sql_where_2='';

        if(count($where)){
            foreach ($where as $key => $value) {
                if( ($key=='min' or $key=='max') && is_numeric($value) ){
                    $where_sql[]='CalcResults.secret_code'.($key=='min'? ' >= ': '<= ').$value;
                }
            }
        }
        if ( count($where_sql) ){
            $sql_where_1 = 'and ' . join(' and ', $where_sql);
            $sql_where_2 = 'Where secret_code not null';
        }

        $sql = '
        SELECT id, name, body,
        (
            SELECT GROUP_CONCAT(secret_code, "; ")
            FROM CalcResults
		    where CalcResults.calc_id = Calcs.id
            '.$sql_where_1.'
		    Order by calc_id
       ) AS secret_code
       FROM Calcs
       '.$sql_where_2.'
       Order by id';

       $result = @Db::query($sql);

       if ( $result == false ){
           throw new \Exception(Db::getError());
       }
       $calculates=[];
       while( $row = $result->fetchArray() ){
           $calculates[] = [
               "id" => $row["id"],
               "name"=>$row["name"],
               "body"=>$row["body"],
               "secret_code"=>$row["secret_code"],
           ];
       }
       return $calculates;
    }

}

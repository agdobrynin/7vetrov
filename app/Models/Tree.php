<?php
namespace Models;

use \Core\Model as Model;
use \Core\Db as Db;
use Core\Utils as Utils;

class Tree extends Model{

    protected $name;
    protected $parent_id;
    protected $table = 'tree';

    /**
     * [CreateTable description]
     * @method CreateTable Создать и заполнить таблицу с деревом объектов
     * @param integer $max_level максимально уровней вложенности
     * @param integer $min_child минимально потомков в узле
     * @param integer $max_child максимально потомков в узле
     */
    public function CreateTable($max_level = 5 , $min_child=2, $max_child = 5)
    {
        //Удалить таблицу
        DB::query("DROP TABLE ".$this->table);
        //Создать таблицу id, parent_id, name
        //для SqLite AUTOINCREMENT для MySQL AUTO_INCREMENT
        /*
        DB::CreateTable($this->table,[
            'id'        =>['integer', true, true],
            'parent_id' =>['integer'],
            'name'      =>['varchar(255)']
        ]);
        */
        if( DB::query("CREATE TABLE ".$this->table." (id INTEGER PRIMARY KEY AUTOINCREMENT, parent_id integer,name varchar(255))") === false ){
            throw new \Exception("Ошибка создания таблицы ".$this->table. " [ ".DB::errorText()." ]");
        }
        //Паполнить рандомными значениями с помощью rand ( int $min , int $max )
        return $this->GenetateTree( 0, $min_child, $max_child);
        //Utils::RandString();

    }

    protected function GenetateTree( $parent_id=0, $min_child =2 , $max_cild = 5 )
    {
        $child = [];
        $count = rand($min_child, $max_cild);
        for($i=0; $i < $count; $i++){
            $child[]=[$parent_id, Utils::RandString()];
        }
        //return json_encode($child);
        # множественное исполнение подготовленных выражений
        $stmt = DB::prepare("INSERT INTO ".$this->table."(parent_id, name) VALUES (?, ?)");
        foreach ($child as $element){
            $stmt->execute($element);
        }
        // var_dump(DB::lastInsertId());

    }

}

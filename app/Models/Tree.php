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
     * @return integer количество сгенерированных элементов
     */
    public function CreateTable($max_level = 5 , $min_child=2, $max_child = 5)
    {
        //Удалить таблицу
        DB::query("DROP TABLE IF EXISTS ".$this->table);
        //Создать таблицу id, parent_id, name
        //для SqLite AUTOINCREMENT для MySQL
        $SQL = "CREATE TABLE ".$this->table." (id INTEGER PRIMARY KEY %s, parent_id INTEGER, name VARCHAR(255))";
        if( $this->getDriver() == "mysql" ){
            $SQL = sprintf( $SQL , "AUTO_INCREMENT");
        } elseif ($this->getDriver() == "sqlite") {
            $SQL = sprintf( $SQL , "AUTOINCREMENT");;
        }

        if( DB::query($SQL) === false ){
            throw new \Exception("Ошибка создания таблицы ".$this->table. " [ ".DB::errorText()." ]");
        }
        //Паполнить рандомными значениями с помощью rand ( int $min , int $max )
        $this->GenerateChild( 0, $min_child, $max_child, 0, $max_level);
        return DB::run("SELECT count(id) FROM ".$this->table)->fetchColumn();
    }

    /**
     * Генерация дерева
     *
     *  Рекурсивный метод для генерации дерева
     *
     * @param integer $parent_id родительский id
     * @param integer $min_child минимальное кол-во детей
     * @param integer $max_cild  максимальное кол-во детей
     * @param integer $level     текущий уроверь (для рекурсии)
     * @param integer $max_level максимально уровней
     */
    protected function GenerateChild( $parent_id=0, $min_child =2 , $max_cild = 5, $level = 0, $max_level = 3 )
    {
        $child = [];
        $count = rand($min_child, $max_cild);
        for($i=0; $i < $count; $i++){
            $child[]=[$parent_id, Utils::RandString()];
        }
        //множественное исполнение подготовленных выражений
        $SQL = "INSERT INTO ".$this->table."(parent_id, name) VALUES (?, ?)";
        $stmt = DB::prepare($SQL);
        if( $stmt === false ){
            throw new \Exception("Ошибка в запросе: ".$SQL." \n".DB::errorText());
        }

        foreach ($child as $element){
            $stmt->execute($element);
            if($level == $max_level) return true;
            $level++;
            $this->GenerateChild(DB::lastInsertId(), $min_child, $max_cild , $level , $max_level );
        }
        return true;
    }
    /**
     * Получить массив ввиде дерева
     * @see http://blog.tekerson.com/2009/03/03/converting-a-flat-array-with-parent-ids-to-a-nested-tree/
     *
     * @return array
     */
    public function getTree()
    {
        $SQL = "SELECT * FROM ".$this->table;
        $flat = DB::run($SQL)->fetchAll(\PDO::FETCH_ASSOC);
        $indexed = [];
        foreach ($flat as $index => $row) {
            $indexed[$row['id']] = $row;
            $indexed[$row['id']]['child'] = array();
        }

        foreach ($indexed as $id => $row) {
            $indexed[$row['parent_id']]['child'][$id] =& $indexed[$id];
        }
        return $indexed;
    }

}

<?php
namespace Controllers;

use Core\Controller as Controller;
use \Models\Tree;

class ControllerTask3 extends Controller{

    protected $title="Задание #3";

    public function index()
    {
        $title=$title = $this->title;
        $Tree = new Tree();
        $tree_count = $Tree->getTreeCount();
        return self::View('task3.php', compact(["title", "tree_count"]));
    }

    /**
     * Создание таблицы и заполнение рандомными значениями
     * @return object JSON
     */
    public function reset()
    {

        $Tree = new Tree();
        //Уровней вложенности
        $levels = self::Request("levels");
        $levels = $levels ? $levels : 6;
        //Минисмально потомков
        $min_child = 2;
        //Максимально потомков
        $max_child = (int)self::Request("childs");
        $max_child = $max_child > $min_child ? $max_child : 10;
        //Создать таблицу
        $cnt = $Tree->CreateTable($levels , $min_child, $max_child);
        header('Content-Type: application/json');
        return json_encode([
            "title" => "Сообщение",
            "body" => "Сгенерировано дерево c ".$cnt." элементами. Уровней: $levels , потомков от: $min_child до $max_child"
        ]);
    }

    /**
     * Получение дерево
     * @return object JSON
     */
    public function tree()
    {
        $Tree = new Tree();
        header('Content-Type: application/json');
        return json_encode($Tree->getTree());
    }


}

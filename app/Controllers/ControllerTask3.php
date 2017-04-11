<?php
namespace Controllers;

use Core\Controller as Controller;
use \Models\Tree;

class ControllerTask3 extends Controller{

    protected $title="Задание #3";

    public function index()
    {
        $title=$title = $this->title;
        return self::View('task3.php', compact(["title"]));
    }

    /**
     * Создание таблицы и заполнение рандомными значениями
     * @return boolean
     */
    public function resetTree()
    {
        $Tree = new Tree();
        //Создать таблицу 5 уровней, от 4 до 8 детей в узле
        return $Tree->CreateTable(5 , 4, 8);
    }

    /**
     * Получение дерево
     * @return object JSON
     */
    public function getTree()
    {
        $Tree = new Tree();
        return $Tree->GetTree();
    }


}

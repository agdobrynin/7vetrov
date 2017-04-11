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
    public function reset()
    {
        $Tree = new Tree();
        $res = $Tree->CreateTable(5 , 2, 7);
        return $res;
    }

    /**
     * Получение дерева
     * @return object JSON
     */
    public function tree()
    {

    }


}

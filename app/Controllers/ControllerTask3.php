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
     * @return object JSON
     */
    public function reset()
    {
        $Tree = new Tree();
        //Создать таблицу 5 уровней, от 4 до 8 детей в узле
        header('Content-Type: application/json');
        return json_encode([
            "title" => "Сообщение",
            "body" => "Сгенерировано дерево c ".$Tree->CreateTable(5 , 4, 8)." элементами."
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
        return json_encode($Tree->GetTree());
    }


}

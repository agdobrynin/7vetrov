<?php
namespace Controllers;

use Core\Controller as Controller;
use Core\Utils as Utils;

class ControllerTask3 extends Controller{

    protected $title="Задание #3";

    public function index()
    {
        $title=$title = $this->title;
        return self::View('task3.php', compact(["title"]));
    }

    /**
     * Создание таблицы и заполнение рандомными значениями
     * @param integer $max_level максимально уровней вложенности
     * @param integer $max_child максимально потомков в узле
     * @return boolean
     */
    public function reset( $max_level = 5 , $max_child = 5 )
    {
        return Utils::RandString();
    }

    /**
     * Получение дерева
     * @return object JSON
     */
    public function tree()
    {

    }


}

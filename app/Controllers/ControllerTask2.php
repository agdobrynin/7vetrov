<?php
namespace Controllers;

use Core\Controller as Controller;

class ControllerTask2 extends Controller{

    protected $title="Задание #2";
    /**
     * Главная страница
     * @return \Core\View
     */
    public function index()
    {
        $title=$title = $this->title;
        return self::View('task2.php', compact(["title"]));
    }
    /**
     * Обработка текста по ключам
     * @return \Core\View
     */
    public function create()
    {
        $title=$this->title;
        $subject = self::Request("content");
        $key = [];
        $result1 = [];
        $pattern = "/([a-z]+):/ius";
        preg_match_all($pattern, $subject , $keys);
        $text = preg_split($pattern,$subject);
        for ( $i=0, $c=count($keys[1]); $i < $c ; $i++ ) {
            $result1[$keys[1][$i]]=$text[$i+1];
        }
        return self::View('task2.php', compact(["title", "result1", "subject"]));
    }
}

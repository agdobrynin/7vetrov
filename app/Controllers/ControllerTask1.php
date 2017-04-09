<?php
namespace Controllers;

use Core\Controller as Controller;

class ControllerTask1 extends Controller{

    public function index()
    {
        $title="Задание #1";
        return self::View('task1.php', compact(["title"]));
    }

    public function create()
    {
        $title="Задание #1";
        $subject = self::Request("content");
        $matches = [];
        //[НАИМЕНОВАНИЕ_ТЕГА:описание]данные[/НАИМЕНОВАНИЕ_ТЕГА]
        $pattern = "~\[([\w]*)\b[^\]]*>~siU";
        preg_match_all($pattern, $subject , $matches);
        $result1=$matches;
        $result2=$subject;

        return self::View('task1.php', compact(["title", "result1", "result2"]));
    }
}

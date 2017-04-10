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
        $result1 = [];
        $result2 = [];
        //[НАИМЕНОВАНИЕ_ТЕГА:описание]данные[/НАИМЕНОВАНИЕ_ТЕГА]
        $pattern = "#\[([\w]+):?([\w\s]*)?\](.+?)(\[/([\w]+)\]|\[)#ius";
        preg_match_all($pattern, $subject , $matches);
        if( count($matches[5]) ){
            foreach ($matches[5] as $key => $value) {
                if( $value == $matches[1][$key] ){
                    //Данные между тегами
                    $result1[$value] = $matches[3][$key];
                    //описание тега
                    if( $matches[2][$key] ){
                        $result2[$value] = $matches[2][$key];
                    }
                }
            }
        }
        return self::View('task1.php', compact(["title", "result1", "result2", "subject"]));
    }
}

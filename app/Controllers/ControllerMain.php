<?php
namespace Controllers;

use Core\Controller as Controller;

class ControllerMain extends Controller{

    public function index()
    {
        return self::View('master.php');
    }
}

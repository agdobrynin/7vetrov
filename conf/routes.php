<?php
// route и действие
return [

    //Главная страница
    '/' => 'ControllerMain@index',

    //Страница задания 1
    '/task1' => 'ControllerTask1@index',
    //Страница задания 1 обработка
    '/task1/calc' => 'ControllerTask1@create',
];

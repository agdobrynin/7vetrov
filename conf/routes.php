<?php
// route и действие
return [

    //Главная страница с использованием namespace
    '/' => 'Controllers\\ControllerMain@index',

    //Страница задания 1
    '/task1' => 'ControllerTask1@index',
    //Страница задания 1 обработка
    '/task1/create' => 'ControllerTask1@create',

    //Страница задания 2
    '/task2' => 'ControllerTask2@index',
    //Страница задания 2 обработка
    '/task2/create' => 'ControllerTask2@create',

    //Страница задания 3
    '/task3' => 'ControllerTask3@reset'
];

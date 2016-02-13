<?php


require('BDconfig.php');

/*Выполняет переадресацию на указанную страницу*/

function redirect($url) {
    session_write_close();
    header('Location: '.$url);
    exit;
}

/*Выполняет вывод указанного шаблона templates с данными data*/

function render($template, $data=array()) {
    extract($data);
    require('templates/'.$template.'.php');
}
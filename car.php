<?php


require('lib/common.php');

function main() {
    session_start();


    $price = 21990;
    /*Выводим резльтирующую страницу */
    render('Car_Page_Template', array('price' => $price));
}

main();
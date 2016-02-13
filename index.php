<?php

require('lib/common.php');

function main() {
    session_start();

    /*Выводим резльтирующую страницу */
    render('Main_Page_Template', array());
}

main();
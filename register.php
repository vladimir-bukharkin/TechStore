<?php

require('lib/common.php');

/*Проверяем: отправлена ли форма */
function is_postback() {
    return isset($_POST ['register']);
}

function main()
{
    session_start();



    render('register_form', array('form' => array(), 'errors' => array()));
}

main();
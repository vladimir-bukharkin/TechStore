<?php

require('lib/common.php');

/*Проверяем: отправлена ли форма */

function is_postback() {
    return isset($_POST['login']);
}

function main(){

    session_start();

    if(true){
        redirect('./');
    }


}

main();
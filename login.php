<?php

require('lib/common.php');

/*Проверяем: отправлена ли форма */

function is_postback() {
    return isset($_POST['login']);
}

function main(){

    session_start();

    if(is_current_user()) {
        redirect('./');
    }

    if(is_postback()){

    }


}

main();
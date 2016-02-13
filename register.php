<?php

require('lib/common.php');

/*Проверяем: отправлена ли форма */
function is_postback() {
    return isset($_POST ['register']);
}
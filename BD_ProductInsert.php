<?php

require('lib/common.php');

/*
 * Проверяет, что была выполнена отправка формы регистрации
 */
function is_postback()
{
    return isset($_POST['title']);
}

/*
 * Точка входа скрипта
 */
function main()
{
    $product = array();
    $errors  = empty_errors();

    if (is_postback()) {
        // подключаемся к базе данных
        $dbh = db_connect();
        $post_result = add_product($dbh, $product, $errors);
        db_close($dbh);

        if ($post_result) {
            // перенаправляем на список товаров
            render('sucsess_register', array());
        } else render('BD_ProductInsert_T', array(
            'form' => $_POST, 'errors' => $errors));
    }else {
        // отправляем пользователю чистую форму для входа
        render('BD_ProductInsert_T', array(
            'form' => array(), 'errors' => array()
        ));
    }
}


main();
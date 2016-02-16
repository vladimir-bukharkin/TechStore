<?php

require('lib/common.php');


/*
* Проверяет, что была выполнена отправка формы входа
*/
function is_postback()
{
    return isset($_GET['product_id']);
}

/*
 * Точка входа скрипта
 */
function main()
{
    session_start();
    /* Если была выполнена отправка формы,  то открыть запрашиваемую страницу,
    * иначе открыть главную страницу
    */
    if(is_postback()) {
        // обрабатываем отправленную форму
        $dbh = db_connect();
        $items_result = db_product_find_by_product_id($dbh, $_GET['product_id']);
        $category_items = db_product_find_category_all($dbh);
        db_close($dbh);

        render('Product_Page_Template', array(
            'items' => $items_result, 'category' => $category_items));
    } else {
        redirect('index.php');
    }
}

main();
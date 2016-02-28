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
        if (is_current_user()) {
            $count_in_car = product_count_in_car($dbh);
        } else $count_in_car = array();

        $items_result = db_product_find_by_product_id($dbh, $_GET['product_id']);
        $category_items = db_product_find_category_all($dbh);
        db_close($dbh);

        render('Product_Page_Template', array(
            'items' => $items_result, 'category' => $category_items, 'count_in_car' => $count_in_car));
    } else {
        redirect('index.php');
    }
}

main();
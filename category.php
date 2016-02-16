<?php

require('lib/common.php');
/*
* Проверяет, что была выполнена отправка формы входа
*/
function is_postback()
{
    return isset($_GET['catgory_id']);
}

/*
 * Точка входа скрипта
 */
function main()
{
    session_start();
    // обрабатываем отправленную форму
    //Если передан гет запрос, то открыть запрашиваемую страницу,
    //иначе открыть категорию catgory_id=1
    $dbh = db_connect();
    if(is_postback()) {
        $items_result = db_product_find_by_category_id($dbh, $_GET['catgory_id']);
    } else
        $items_result = db_product_find_by_category_id($dbh, 1);

    $category_items = db_product_find_category_all($dbh);
    db_close($dbh);

    render('Category_Page_Template', array(
        'items' => $items_result, 'category' => $category_items));

}

main();
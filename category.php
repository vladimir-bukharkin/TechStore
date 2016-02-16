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

    // обрабатываем отправленную форму
    $dbh = db_connect();
    $items_result = db_product_find_by_category_id($dbh, $_GET['catgory_id']);
    $category_items = db_product_find_category_all($dbh);
    db_close($dbh);

    render('Category_Page_Template', array(
        'items' => $items_result, 'category' => $category_items));
}

main();
<?php

require('lib/common.php');

/*
 * Точка входа скрипта
 */
function main()
{

    // обрабатываем отправленную форму
    $dbh = db_connect();
    $items_result = db_product_find_by_product_id($dbh, $_GET['product_id']);
    $category_items = db_product_find_category_all($dbh);
    db_close($dbh);

    render('Product_Page_Template', array(
        'items' => $items_result, 'category' => $category_items));
}

main();
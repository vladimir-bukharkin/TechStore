<?php

require('lib/common.php');

/*
 * “очка входа скрипта
 */
function main()
{
    session_start();

    // обрабатываем отправленную форму
    $dbh = db_connect();
    //извлекаем массив попул€рных товаров
    $popular_result = db_product_find_popular_all($dbh);
    for ($i=0; $i < count($popular_result); $i++) {
        $items_result[$i] = db_product_find_by_product_id($dbh, $popular_result[$i]['products_id']);
    }
    //ѕеремешиваем массив попул€рных товаров
    shuffle($items_result);

    $category_items = db_product_find_category_all($dbh);
    db_close($dbh);

        render('Main_Page_Template', array(
            'items' => $items_result, 'category' => $category_items));
}

main();

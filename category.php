<?php

require('lib/common.php');

/*
 * Точка входа скрипта
 */
function main()
{


    // обрабатываем отправленную форму
    $dbh = db_connect();
    $items_result = db_product_find_by_category_id($dbh, 1);
    db_close($dbh);

    render('Category_Page_Template', array(
        'items' => $items_result));
}

main();
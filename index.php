<?php

require('lib/common.php');

/*
 * Точка входа скрипта
 */
function main()
{


        // обрабатываем отправленную форму
        $dbh = db_connect();
        $items_result[] = db_product_find_by_product_id($dbh, 40);
        $items_result[] = db_product_find_by_product_id($dbh, 41);
        db_close($dbh);

            render('Main_Page_Template', array(
                'items' => $items_result));
}

main();

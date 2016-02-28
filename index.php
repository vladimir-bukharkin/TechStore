<?php

require('lib/common.php');

function is_postbuy()
{
    return isset($_POST['buy_product_id']);
}
/*
 * Точка входа скрипта
 */
function main()
{
    session_start();

    // обрабатываем отправленную форму
    $dbh = db_connect();

    if (is_current_user()) {
        $count_in_car = product_count_in_car($dbh);
    } else $count_in_car = array();

    if (is_postbuy()) {
        if (is_current_user()) {
            $product = array('count' => 1, 'user_id' => $_SESSION['user_id'], 'product_id' => $_POST['buy_product_id']);
            db_product_incar_insert($dbh, $product);
        } else redirect('login.php');
    }

    //извлекаем массив популярных товаров
    $items_result = get_popular_products($dbh);
    $category_items = db_product_find_category_all($dbh);
    db_close($dbh);

        render('Main_Page_Template', array(
            'items' => $items_result, 'category' => $category_items, 'post' => $_POST, 'count_in_car' => $count_in_car));
}

main();

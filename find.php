<?php

require('lib/common.php');
/*
* Проверяет, что была выполнена отправка формы входа
*/
function is_postback()
{
    return isset($_GET['catgory_id']);
}

function is_postbuy()
{
    return isset($_POST['buy_product_id']);
}

/*Передан ли запрос на поиск товара по названию?*/
function is_getfind()
{
    return isset($_GET['search_text']) && $_GET['search_text'] != null;
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

    if (is_current_user()) {
        $count_in_car = product_count_in_car($dbh);
    } else $count_in_car = array();

    if (is_postbuy()) {
        if (is_current_user()) {
            $product = array('count' => 1, 'user_id' => $_SESSION['user_id'], 'product_id' => $_POST['buy_product_id']);
            db_product_incar_insert($dbh, $product);
        } else redirect('login.php');
    }

    /*Если передан поисковой запрос и он не пустой, то находим товар по введенному поисковому запросу */
    if(is_getfind())
    {
        $items_result = db_product_find_like_title($dbh, $_GET['search_text']);
        $search_text = $_GET['search_text'];
        if ($items_result == null) $items_result = 'products_not_found';
    } else {
        $items_result = null;
        $search_text = null;
    }

    $category_items = db_product_find_category_all($dbh);


    db_close($dbh);

    render('Find_Template', array(
        'items' => $items_result, 'category' => $category_items, 'count_in_car' => $count_in_car, 'search_text' => $search_text));

}

main();
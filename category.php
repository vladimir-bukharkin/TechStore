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

    $count_in_car = product_count_in_car($dbh);

    if (is_postbuy()) {
        if (is_current_user()) {
            $product = array('count' => 1, 'user_id' => $_SESSION['user_id'], 'product_id' => $_POST['buy_product_id']);
            db_product_incar_insert($dbh, $product);
        } else redirect('login.php');
}

    if(is_postback()) {
        $items_result = db_product_find_by_category_id($dbh, $_GET['catgory_id']);
    } else
        $items_result = db_product_find_by_category_id($dbh, 1);

    $category_items = db_product_find_category_all($dbh);
    db_close($dbh);

    render('Category_Page_Template', array(
        'items' => $items_result, 'category' => $category_items, 'count_in_car' => $count_in_car));

}

main();
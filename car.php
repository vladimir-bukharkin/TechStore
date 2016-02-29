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

    if (is_postbuy()) {
        if (is_current_user()) {
            $product = array('count' => 1, 'user_id' => $_SESSION['user_id'], 'product_id' => $_POST['buy_product_id']);
            db_product_incar_insert($dbh, $product);
        } else redirect('login.php');
    }

    if (isset($_POST['product_decrement']))  {
        if (is_current_user()) {
            $product = array('count' => 1, 'user_id' => $_SESSION['user_id'], 'product_id' => $_POST['product_decrement']);
            $result = db_product_incar_decrement($dbh, $product);
            if($result == null || $result == array()) {}
        } else redirect('login.php');
    }

    if (isset($_POST['product_delete']))  {
        if (is_current_user()) {
            $product = array('user_id' => $_SESSION['user_id'], 'product_id' => $_POST['product_delete']);
            db_product_incar_delete($dbh, $product);
        } else redirect('login.php');
    }
    
    $count_in_car = product_count_in_car($dbh);

    $items_result = get_popular_products($dbh);

    $car_items = db_get_product_in_car_by_user($dbh);

    db_close($dbh);




    render('Car_Page_Template', array(
        'items' => $items_result, 'car_items' => $car_items, 'count_in_car' => $count_in_car));
}

main();
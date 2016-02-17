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

    $items_result = get_popular_products($dbh);
    $user_car = db_car_find_by_user_id($dbh, $_SESSION['user_id']);

    $total = 0;

    for ($i = 0; $i < count($user_car); $i++) {
        $car_items[] = db_product_find_by_product_id($dbh, $user_car[$i]['products_id']);
        unset($car_items[$i][0]['description']);
        $car_items[$i][0]['count'] = $user_car[$i]['count'];
        $car_items[$i][0]['row_amount'] = $car_items[$i][0]['price']*$car_items[$i][0]['count'];
        $total += $car_items[$i][0]['row_amount'];
    }
        $car_items[0]['total'] = $total;



        db_close($dbh);




    render('Car_Page_Template', array(
        'items' => $items_result, 'car_items' => $car_items));
}

main();
<?php

require('lib/common.php');

/*
 * Проверяет, что была выполнена отправка формы регистрации
 */
function is_postback()
{
    return isset($_POST['register']);
}

/*
 * Точка входа скрипта
 */
function main()
{
    // создаем сессию
    session_start();

    /**************************************************************************
     * Вывод "Популярное" на страницу и меню
     */
    $dbh = db_connect();
    $items_result = get_popular_products($dbh);
    $category_items = db_product_find_category_all($dbh);
    db_close($dbh);

    /**************************************************************************
     * Регистрация
     */
    if (is_current_user()) {
        // если пользователь уже залогинен, то отправляем его на глапную
        redirect('./');
    }

    if (is_postback()) {
        // обрабатываем отправленную форму
        $dbh = db_connect();
        $post_result = register_user($dbh, $user, $errors);
        db_close($dbh);

        if ($post_result) {
            // перенаправляем на главную
            render('sucsess_register', array());
        } else {
            // информация о пользователе заполнена неправильно, выведем страницу с ошибками
            render('register_form', array(
                'form' => $_POST, 'errors' => $errors,'items' => $items_result, 'category' => $category_items
            ));
        }
    } else {
        // отправляем пользователю чистую форму для регистрации
        render('register_form', array(
            'form' => array(), 'errors' => array(), 'items' => $items_result, 'category' => $category_items
        ));
    }
}

main();

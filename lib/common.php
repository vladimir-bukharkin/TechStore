<?php


require('BDconfig.php');

/*Выполняет переадресацию на указанную страницу*/

function redirect($url)
{
    session_write_close();
    header('Location: '.$url);
    exit;
}

/*Выполняет вывод указанного шаблона templates с данными data*/

function render($template, $data=array())
{
    extract($data);
    require('templates/'.$template.'.php');
}

/*
*  Для пользователя, вошедшего в систему храним в сесии его ID
*/

/*Функция для проверки: имеется ли пользователь в сети*/
function is_current_user()
{
    return isset($_SESSION['user_id']);
}

/*Функция возврщения индификатора пользователя*/
function get_current_id()
{
    return $_SESSION['user_id'];
}

/*Функция сохранения индификатора пользователя в сессии*/
function store_current_user_id($id)
{
    $_SESSION['user_id'] = $id;
}

/*Функция сохранения имени пользователя в сессии*/
function store_current_user_name($name)
{
    $_SESSION['username'] = $name;
}

/*Сбрасывает индификатор пользователя*/
function reset_current_user_id()
{
    unset($_SESSION['user_id']);
}

/* ****************************************************************************
* Функции работы с массивом ошибок
*/

/*
 * Инициализирует структуру массива для хранения информации об ошибках
 */
function empty_errors()
{
    return array(
        'fields' 	=> array(),
        'messages'	=> array(),
    );
}

/*
 * Проверяет, что есть ошибочные поля в описании ошибок
 */
function has_errors($errors)
{
    return isset($errors['fields']) && count($errors['fields']) > 0;
}

/*
 * Проверяет, что указанное поле есть в списке ошибочных полей
 */
function is_error($errors, $field)
{
    return isset($errors['fields']) && in_array($field, $errors['fields']);
}

/*
 * Добавляет описание ошибки в массив ошибок
 */
function add_error(&$errors, $field, $description)
{
    $errors['fields'][] = $field;
    $errors['messages'][$field] = "@$field-$description";
    return false;
}

/*загрузка изображения*/

/* ****************************************************************************
 * Валидация данных
 */

/*
 * Проверяет корректность строки в форме, если строка корректна, копирует ее в $obj
 * и возвращает true; false и заполненный массив ошибок, если нет
 */
function read_string($form, $field, &$obj, &$errors, $min, $max, $is_required, $default=null, $trim=true)
{
    $obj[$field] = $default;
    if (!isset($form[$field])) {
        return $is_required ? add_error($errors, $field, 'required') : true;
    }

    $value = $trim ? trim($form[$field]) : $form[$field];


    if (strlen($value) < $min)
        return add_error($errors, $field, 'too-short');

    if (strlen($value) > $max)
        return add_error($errors, $field, 'too-long');

    $obj[$field] = $value;
    return true;
}

/*Проверяет корректность загружаемой картинки
* Мы проверяем на расширение загружаемого файла. Если оно представляет собой PHP-скрипт,
* то мы такой файл просто не пропускаем. Дальше мы получаем MIME-type и размер.
* Проверяем их на удовлетворение нашим условиям. Если всё хорошо, то мы загружаем файл.
*/
function read_img($form, $field, &$obj, &$errors, $min, $max, $is_required, $default=null)
{
    $obj[$field] = $default;
    if (!isset($form[$field])) {
        return $is_required ? add_error($errors, $field, 'required') : true;
    }

    /*Проверка MIME-type*/
    $blacklist = array(".php", ".phtml", ".php3", ".php4", ".html", ".htm");
    foreach($blacklist as $item)
    {
        if(preg_match("/$item\$/i", $form[$field]['name'])) {
            return add_error($errors, $field, 'incorrect MIME-type');
        }
    }
    $type = $form[$field]['type'];
    $size = $form[$field]['size'];

    /*Проверяем тип файла, если тип не jpg, jpeg, png, то выводим ошибку*/
    if(($type != "image/jpg") && ($type != "image/jpeg") && ($type != "image/png")) {
        return add_error($errors, $field, 'incorrect type');
    }
    /*Проверяем размер файла*/
    if ($size > $max) {
        return add_error($errors, $field, 'large size img');
    }

    $value = $form[$field];
    $obj[$field] = $value;
    return true;
}

function read_email($form, $field, &$obj, &$errors, $min, $max, $is_required, $default=null)
{
    $obj[$field] = $default;
    if (!isset($form[$field])) {
        return $is_required ? add_error($errors, $field, 'required') : true;
    }

    $value = trim($form[$field]);
    if (strlen($value) < $min)
        return add_error($errors, $field, 'too-short');

    if (strlen($value) > $max)
        return add_error($errors, $field, 'too-long');

    // проверяем, что в строке задан адрес электронной почты
    if (!filter_var($value, FILTER_VALIDATE_EMAIL))
        return add_error($errors, $field, 'invalid');

    $obj[$field] = $value;
    return true;
}

function read_integer($form, $field, &$obj, &$errors, $min, $max, $is_required, $default=null)
{
    $obj[$field] = $default;
    if (!isset($form[$field])) {
        return $is_required ? add_error($errors, $field, 'required') : true;
    }

    // проверяем, что передано число
    $value = filter_var($form[$field], FILTER_VALIDATE_INT);
    if ($value === false)
        return add_error($errors, $field, 'invalid');

    if (is_int($min) && $value < $min)
        return add_error($errors, $field, 'too-small');

    if (is_int($max) && $value > $max)
        return add_error($errors, $field, 'too-big');

    $obj[$field] = $value;
    return true;
}

/*
 * Проверяет корректность десятичного вещественного числа в форме, если передано правильное число,
 * копирует его в $obj и возвращает true; false и заполненный массив ошибок, если нет
 */

function read_decimal($form, $field, &$obj, &$errors, $min, $max, $is_required, $default=null)
{
    $obj[$field] = $default;
    if (!isset($form[$field])) {
        return $is_required ? add_error($errors, $field, 'required') : true;
    }

    // проверяем, что передано число
    $pattern = '/^[-+]?[0-9]*\.?[0-9]+$/';
    $value = trim($form[$field]);
    if (!preg_match($pattern, $value))
        return add_error($errors, $field, 'invalid');

    if (is_string($min) && $min != '' && bccomp($value, $min) == -1)
        return add_error($errors, $field, 'too-small');

    if (is_string($max) && $max != '' && bccomp($value, $max) == 1)
        return add_error($errors, $field, 'too-big');

    $obj[$field] = $value;
    return true;
}

/*
 * Проверяет корректность выбора одного из значений в форме, если выбрано значение
 * из указанного списка, копирует его в $obj и возвращает true; false и заполненный
 * массив ошибок, если нет
 */
function read_list($form, $field, &$obj, &$errors, $list, $is_required, $default=null)
{
    $obj[$field] = $default;
    if (!isset($form[$field])) {
        return $is_required ? add_error($errors, $field, 'required') : true;
    }

    $value = trim($form[$field]);
    if (!in_array($value, $list))
        return add_error($errors, $field, 'invalid');

    $obj[$field] = $value;
    return true;
}

/*
 * Проверяет корректность логического значения, если корректно, копирует его
 * в $obj и возвращает true; false и заполненный массив ошибок, если нет
 */
function read_bool($form, $field, &$obj, &$errors, $true, $is_required, $default=null)
{
    $obj[$field] = $default;
    if (!isset($form[$field])) {
        return $is_required ? add_error($errors, $field, 'required') : true;
    }

    $value = trim($form[$field]);
    $obj[$field] = $value === $true;
    return true;
}

/********************************************************
/*
 * Выполняет вход пользователя в систему, возвращает true, если вход
 * выполнен успешно, и false и заполненный массив ошибок в противном
 * случае
 */

function login_user($dbh, &$user, &$errors)
{
    $user = array();
    $errors = empty_errors();

    // считываем строки из запроса
    read_string($_POST, 'username', $user, $errors, 2, 64, true);
    read_string($_POST, 'password', $user, $errors, 6, 20, true);

    if (has_errors($errors))
        return false;


    // форма передана правильно, ищем пользователя и проверяем пароль
    $db_user = db_user_find_by_login($dbh, $user['username']);
    // смотрим, есть ли такой пользователь и правильно ли передан пароль
    if ($db_user == null || $db_user['password'] !== crypt($user['password'], $db_user['password']))
        return add_error($errors, 'password', 'invalid');

    // пользователь ввел правильные имя и пароль, запоминаем его в сессии
    store_current_user_id($db_user['id']);
    store_current_user_name($user['username']);
    return true;
}

/*Выполняем выход из системы*/
function logout_user()
{
    reset_current_user_id();
}

/*
 * Выполняет ркгистрацию пользователя, возвращает true, если регистраиция
 * завершилась успешно, и false и заполненный массив ошибок в противном
 * случае
 */

function register_user($dbh, &$user, &$errors)
{
    $user = array();
    $errors = empty_errors();

    // считываем строки из запроса
    read_string($_POST, 'username', $user, $errors, 2, 64, true);
    read_email($_POST, 'e-mail', $user, $errors, 2, 64, true);
    read_string($_POST, 'password', $user, $errors, 6, 24, true);
    read_string($_POST, 'confirm-password', $user, $errors, 6, 24, true);
    read_list($_POST, 'gender', $user, $errors, array('M', 'F'), false);
    read_bool($_POST, 'newsletter', $user, $errors, '1', false, false);

    // пароль и подтверждение пароля должны совпадать
    if (!is_error($errors, 'password') &&
        !is_error($errors, 'confirm-password') &&
        $user['password'] != $user['confirm-password']) {
        $errors['fields'][] = 'password';
        add_error($errors, 'confirm-password', 'dont-match');
    }

    if (has_errors($errors))
        return false;

    // защищаем пароль пользователя
    $user['password'] = crypt($user['password']);
    unset($user['password_confirmation']);

    // форма передана правильно, сохраняем пользователя в базу данных
    $db_user = db_user_insert($dbh, $user);

    // автоматически логиним пользователя после регистрации, запоминая его в сессии
    store_current_user_id($db_user['id']);
    return true;
}


/*
 * Добавляет описание товара в базу данных, возвращает true, если регистраиция
 * завершилась успешно, и false и заполненный массив ошибок в противном
 * случае
 */
function add_product($dbh, &$product, &$errors)
{
    $product = array();
    $errors  = empty_errors();

    // считываем строки из запроса
    read_string($_POST, 'title', $product, $errors, 2, 60, false);
    read_integer($_POST, 'category_id', $product, $errors, 1, null, true);
    read_decimal($_POST, 'price', $product, $errors,  '0.0', null, true);
    read_integer($_POST, 'stock', $product, $errors, 1, null, true);
    read_string($_POST, 'description', $product, $errors, 1, 10000, false, null, false);
    read_img($_FILES, 'img', $product, $errors, 0, 204800, true);

    if (has_errors($errors))
        return false;

    // форма передана правильно, сохраняем пользователя в базу данных
    $db_product = db_product_insert($dbh, $product);

    return true;
}

/* ****************************************************************************
 * Список пользователей в базе данных
 */

/*
 * Выполняет подключение к базе данных
 */


function db_connect()
{
    $dbh = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (mysqli_connect_errno()) {
        db_handle_error($dbh);
    }

    mysqli_set_charset($dbh, "utf8");
    return $dbh;
}

/*
 * Закрывает подключение к базе данных
 */
function db_close($dbh)
{
    mysqli_close($dbh);
}

/*
 * Обработка ошибок подключения к базе данных
 */
function db_handle_error($dbh)
{
    $code = '@unknown-error';
    $message = '';
    if (mysqli_connect_error()) {
        $code = '@connect-error';
        $message = mysqli_connect_error();
    }

    if (mysqli_error($dbh)) {
        $code = '@query-error';
        $message =mysqli_error($dbh);
    }

    render('error', array(
        'code' => $code, 'message' => $message,
    ));
    exit;
}


/*
 * Извлекает из базы данных список пользователей
 */
function db_user_find_all($dbh)
{
    $query = 'SELECT * FROM users';
    $result = array();

    // выполняем запрос к базе данных
    $qr = mysqli_query($dbh, $query, MYSQLI_STORE_RESULT);
    if ($qr === false)
        db_handle_error($dbh);

    // последовательно извлекаем строки
    while ($row = mysqli_fetch_assoc($qr))
        $result[] = $row;

    // освобождаем ресурсы, связанные с хранением результата
    mysqli_free_result($qr);

    return $result;
}

/*
 * Выполняет поиск в базе данных и загрузку пользователя с указанным id
 */
function db_user_find_by_id($dbh, $id)
{
    $query = 'SELECT * FROM users WHERE id=?';

    // подготовливаем запрос для выполнения
    $stmt = mysqli_prepare($dbh, $query);
    if ($stmt === false)
        db_handle_error($dbh);

    mysqli_stmt_bind_param($stmt, 's', $id);

    // выполняем запрос и получаем результат
    if (mysqli_stmt_execute($stmt) === false)
        db_handle_error($dbh);

    // получаем результирующий набор строк
    $qr = mysqli_stmt_get_result($stmt);
    if ($qr === false)
        db_handle_error($dbh);

    // извлекаем результирующую строку
    $result = mysqli_fetch_assoc($qr);

    // освобождаем ресурсы, связанные с хранением результата и запроса
    mysqli_free_result($qr);
    mysqli_stmt_close($stmt);

    return $result;
}

/*
 * Выполняет поиск в базе данных и загрузку пользователя с указанным логином
 * (логином считаем адрес электронной почты и ник пользователя)
 */
function db_user_find_by_login($dbh, $login)
{
    $query = 'SELECT * FROM users WHERE email=? OR nickname=?';

    // подготовливаем запрос для выполнения
    $stmt = mysqli_prepare($dbh, $query);
    if ($stmt === false)
        db_handle_error($dbh);

    mysqli_stmt_bind_param($stmt, 'ss', $login, $login);

    // выполняем запрос и получаем результат
    if (mysqli_stmt_execute($stmt) === false)
        db_handle_error($dbh);

    // получаем результирующий набор строк
    $qr = mysqli_stmt_get_result($stmt);
    if ($qr === false)
        db_handle_error($dbh);

    // извлекаем результирующую строку
    $result = mysqli_fetch_assoc($qr);

    // освобождаем ресурсы, связанные с хранением результата и запроса
    mysqli_free_result($qr);
    mysqli_stmt_close($stmt);

    return $result;
}

/*
 * Вставляет в базу данных строку с информацией о пользователе, возвращает массив
 * с данными пользователя и его id в базе данных
 */
function db_user_insert($dbh, $user)
{
    $query = 'INSERT INTO users(nickname,email,password,gender,newsletter) VALUES(?,?,?,?,?)';

    // подготовливаем запрос для выполнения
    $stmt = mysqli_prepare($dbh, $query);
    if ($stmt === false)
        db_handle_error($dbh);

    mysqli_stmt_bind_param($stmt, 'ssssi',
        $user['username'], $user['e-mail'], $user['password'], $user['gender'], $user['newsletter']);

    // выполняем запрос и получаем результат
    if (mysqli_stmt_execute($stmt) === false)
        db_handle_error($dbh);

    // получаем идентификатор вставленной записи
    $user['id'] = mysqli_insert_id($dbh);

    // освобождаем ресурсы, связанные с хранением результата и запроса
    mysqli_stmt_close($stmt);

    return $user;
}

/*products*/

function db_category_find_all($dbh)
{
    $query = 'SELECT * FROM categories ORDER BY title';
    $result = array();

    // выполняем запрос к базе данных
    $qr = mysqli_query($dbh, $query, MYSQLI_STORE_RESULT);
    if ($qr === false)
        db_handle_error($dbh);

    // последовательно извлекаем строки
    while ($row = mysqli_fetch_assoc($qr))
        $result[] = $row;

    // освобождаем ресурсы, связанные с хранением результата
    mysqli_free_result($qr);

    return $result;
}


/*
 * Вставляет в базу данных строку с информацией о товаре, возвращает массив
 * с данными товара и его id в базе данных
 */
function db_product_insert($dbh, $product)
{
    $query = 'INSERT INTO products(title,category_id,price,stock,description,img) VALUES(?,?,?,?,?,?)';

    // подготовливаем запрос для выполнения
    $stmt = mysqli_prepare($dbh, $query);
    if ($stmt === false)
        db_handle_error($dbh);

    mysqli_stmt_bind_param($stmt, 'sssssb',
        $product['title'], $product['category_id'], $product['price'], $product['stock'], $product['description'], $product['img']);

    // выполняем запрос
    if (mysqli_stmt_execute($stmt) === false)
        db_handle_error($dbh);

    // получаем идентификатор вставленной записи
    $product['id'] = mysqli_insert_id($dbh);

    // освобождаем ресурсы, связанные с хранением результата и запроса
    mysqli_stmt_close($stmt);

    return $product;
}

/*
 * Выполняет поиск в базе данных и загрузку товаров, принадлежащих указанной категории
 */
function db_product_find_by_category_id($dbh, $category_id)
{
    $query = 'SELECT * FROM products WHERE category_id=?';
    $result = array();

    // подготовливаем запрос для выполнения
    $stmt = mysqli_prepare($dbh, $query);
    if ($stmt === false)
        db_handle_error($dbh);

    mysqli_stmt_bind_param($stmt, 's', $category_id);

    // выполняем запрос и получаем результат
    if (mysqli_stmt_execute($stmt) === false)
        db_handle_error($dbh);

    // получаем результирующий набор строк
    $qr = mysqli_stmt_get_result($stmt);
    if ($qr === false)
        db_handle_error($dbh);

    // последовательно извлекаем строки
    while ($row = mysqli_fetch_assoc($qr))
        $result[] = $row;

    // освобождаем ресурсы, связанные с хранением результата и запроса
    mysqli_free_result($qr);
    mysqli_stmt_close($stmt);

    return $result;
}

function db_product_find_by_product_title($dbh, $product_title)
{
    $query = 'SELECT * FROM products WHERE title=?';
    $result = array();

    // подготовливаем запрос для выполнения
    $stmt = mysqli_prepare($dbh, $query);
    if ($stmt === false)
        db_handle_error($dbh);

    mysqli_stmt_bind_param($stmt, 's', $product_title);

    // выполняем запрос и получаем результат
    if (mysqli_stmt_execute($stmt) === false)
        db_handle_error($dbh);

    // получаем результирующий набор строк
    $qr = mysqli_stmt_get_result($stmt);
    if ($qr === false)
        db_handle_error($dbh);

    // последовательно извлекаем строки
    while ($row = mysqli_fetch_assoc($qr))
        $result[] = $row;

    // освобождаем ресурсы, связанные с хранением результата и запроса
    mysqli_free_result($qr);
    mysqli_stmt_close($stmt);

    return $result;
}

function db_product_find_by_product_id($dbh, $product_id)
{
    $query = 'SELECT * FROM products WHERE id=?';
    $result = array();

    // подготовливаем запрос для выполнения
    $stmt = mysqli_prepare($dbh, $query);
    if ($stmt === false)
        db_handle_error($dbh);

    mysqli_stmt_bind_param($stmt, 's', $product_id);

    // выполняем запрос и получаем результат
    if (mysqli_stmt_execute($stmt) === false)
        db_handle_error($dbh);

    // получаем результирующий набор строк
    $qr = mysqli_stmt_get_result($stmt);
    if ($qr === false)
        db_handle_error($dbh);

    // последовательно извлекаем строки
    while ($row = mysqli_fetch_assoc($qr))
        $result[] = $row;

    // освобождаем ресурсы, связанные с хранением результата и запроса
    mysqli_free_result($qr);
    mysqli_stmt_close($stmt);

    return $result;
}


/*
 * Извлекает из базы данных список товаров
 */
function db_product_find_category_all($dbh)
{
    $query = 'SELECT * FROM categories';
    $result = array();


    $qr = mysqli_query($dbh, $query, MYSQLI_STORE_RESULT);
    if ($qr === false)
        db_handle_error($dbh);

    // последовательно извлекаем строки
    while ($row = mysqli_fetch_assoc($qr))
        $result[] = $row;

    // освобождаем ресурсы, связанные с хранением результата
    mysqli_free_result($qr);

    return $result;
}


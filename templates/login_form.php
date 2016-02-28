<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <title>Интернет-магазин цифровой и бытовой техники</title>
</head>

<body>
<!--Header-->
<div class="header">
    <div class="layout-positioner">
        <div class="lname">
            <div class="logo">
                <a href="./"><img alt="TS Магазин цифрофой техники" src="Images/logo.png"></a>
            </div>
        </div>
        <!--Поиск -->
        <div class="search">
            <form action="find.php" method="get">
                <input class="inputSearch" type="text" name="search_text" value="<?= $search_text !== null ? $search_text : '' ?>" placeholder="Поиск...">
                <input class="submitSearchBottom" type="submit" name="send" value="">
            </form>
        </div>
        <div class="rightHeader">
            <a href="<?= is_current_user() ? 'car.php' : 'login.php' ?>">
                <div class="ToCar headCar">В корзину</div>
            </a>
            <?php if(is_current_user()) { ?>
                <div class="login_positioner">
                    Вы вошли в систему как: <br><div class="user"><?php echo $_SESSION['username']; ?></div>
                    <a href="logout.php"><div class="logout_button login_cell">Выход</div></a>
                </div>
            <?php } else { ?>
                <div class="login_positioner entry-positioner">
                    <a href="login.php"><div class="entry_button login_cell">Вход</div></a>
                    <a href="register.php"><div class="registration_button login_cell">Регистрация</div></a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class=" central-part">
    <div class="layout-positioner">
        <!-- menu -->
        <div class="main-menu">
            <div class="catalog">Каталог товаров</div>
            <ul>
                <?php for($i=0; $i<6; $i++):?>
                    <li class="notebook-menu"><a href="category.php">Ноутбуки и планшеты</a>
                        <ul class="sub">
                            <?php for($j=0; $j<3; $j++):?>
                                <li><a href="product.php">Ноутбук Lenovo IdeaPad G5045 80MQ001GRK</a></li>
                            <?php endfor;?>
                        </ul>
                    </li>
                <?php endfor;?>
            </ul>
        </div>

        <!-- Items -->
        <div class="main-part">
            <div class="login_form">
                <div class="login-row page-tittle">
                    Войти в личный кабинет
                </div>
                <?php if(has_errors($errors)) :?>
                    <div class="error-msg">
                        При заполнении формы возникли ошибки, пожалуйста проверьте правильность заполнения полей и нажмите "Войти"!
                    </div>
                <?php endif ?>
                <form action="login.php" method="post">
                    <div class="login-row <?= is_error($errors, 'username') ? 'error-field' : ''?>">
                        <label for="username">Имя пользователя<span class="required">*</span></label>
                        <input type="text" name="username" id="username"
                               value="<?= isset($form['username']) ? $form['username'] : '' ?>">
                    </div>
                    <div class="login-row <?= is_error($errors, 'password') ? 'error-field' : ''?>">
                        <label for="password">Пароль<span class="required">*</span></label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="login-row bottom-login">
                        <input type="submit" name="login" id="login" value="Войти">
                        <input type="reset" name="reset" id="reset" value="Очистить">
                    </div>
                    <div class="login-row">
                        Еще не зарегистрированы? <a href="./register.php">Зарегистрируйтесь!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <div class="layout-positioner">
        <div class="contackts">
            <p>Бухаркин Владимир</p>
            <p>Группа ВР-09-15-11</p>
        </div>
    </div>
    <?php foreach($errors as $a) foreach($a as $b) {echo $b;} ?>
</div>

</body>
</html>
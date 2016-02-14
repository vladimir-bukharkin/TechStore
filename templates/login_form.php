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
                <a href="Main_Page_Template.php"><img alt="TS Магазин цифрофой техники" src="Images/logo.png"></a>
            </div>
        </div>
        <div class="search">
            <form action="POMENYAT" method="get">
                <input class="inputSearch" type="text" name="search" value="" placeholder="Поиск...">
                <input class="submitSearchBottom" type="submit" name="send" value="">
            </form>
        </div>
        <div class="rightHeader">
            <a href="Car_Page_Template.php"><div class="ToCar headCar">В корзину</div></a>
            <div class="login_positioner">
                <a href="fgsg"><div class="entry_button login_cell">Вход</div></a>
                <a href="fgsg"><div class="registration_button login_cell">Регистрация</div></a>
            </div>
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
                    <li class="notebook-menu"><a href="Category_Page_Template.php">Ноутбуки и планшеты</a>
                        <ul class="sub">
                            <?php for($j=0; $j<3; $j++):?>
                                <li><a href="ProductPage.html">Ноутбук Lenovo IdeaPad G5045 80MQ001GRK</a></li>
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
                    <div class="login-row">
                        <label for="username">Имя пользователя<span class="required">*</span></label>
                        <input type="text" name="username" id="username" value="">
                    </div>
                    <div class="login-row">
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
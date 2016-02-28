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
                    Регистрация личного кабинета
                </div>
                <form action="BD_ProductInsert.php" method="post" enctype="multipart/form-data">
                    <div class="login-row">
                        <label for="title">title<span class="required">*</span></label>
                        <input type="text" name="title" id="title" value="">
                    </div>
                    <div class="login-row">
                        <label for="category_id">category_id<span class="required">*</span></label>
                        <input type="text" name="category_id" id="category_id" value="">
                    </div>
                    <div class="login-row">
                        <label for="price">price<span class="required">*</span></label>
                        <input type="text" name="price" id="price">
                    </div>
                    <div class="login-row">
                        <label for="stock">stock<span class="required">*</span></label>
                        <input type="text" name="stock" id="stock">
                    </div>
                    <div class="login-row">
                        <label for="description">description<span class="required">*</span></label>
                        <input type="text" name="description" id="description">
                    </div>
                    <div class="login-row">
                        <label for="img">Поле загрузки файла</label>
                        <input type="file" name="img" id="img" value=""/>
                    </div>
                    <div class="login-row bottom-login">
                        <input type="submit" name="register" id="register" value="ввод">
                        <input type="reset" name="reset" id="reset" value="Очистить">
                    </div>

                </form>
            </div>
            <div class="category_name popular">Популярное</div>
            <div class="main-window">
                <?php for($i=0; $i<6; $i++): ?>
                    <a href="Product_Page_Template.php">
                        <div class="item">
                            <div class="main-image">
                                <img alt="Notebook" src="Images/30023889m.jpg">
                            </div>
                            <div class="product-name">15.6" Ноутбук Asus X553MA 90NB04X1-M25360 черный</div>
                            <div class="Price">21990р.</div>
                            <a href="Car_Page_Template.php"><div class="ToCar">+Купить</div></a>
                        </div>
                    </a>
                <?php endfor;?>
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
    <?php print_r($file) ?>

</div>

</body>
</html>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link href="../css/Style1.css" rel="stylesheet" type="text/css">
    <title>Интернет-магазин цифровой и бытовой техники</title>
</head>
<body>
<!--Header-->
<div class="header">
    <div class="layout-positioner">
        <div class="lname">
            <div class="logo">
                <a href="MainPage.php"><img alt="TS Магазин цифрофой техники" src="../Images/logo.png"></a>
            </div>
        </div>
        <div class="search">
            <form action="POMENYAT" method="get">
                <input class="inputSearch" type="text" name="search" value="" placeholder="Поиск...">
                <input class="submitSearchBottom" type="submit" name="send" value="">
            </form>
        </div>
        <div class="rightHeader">
            <a href="fgsg"><div class="ToCar headCar">В корзину</div></a>
            <div class="login_positioner">
                <a href="fgsg"><div class="entry_button login_cell">Вход</div></a>
                <a href="fgsg"><div class="registration_button login_cell">Регистрация</div></a>
            </div>
        </div>
    </div>
</div>

<div class=" central-part">
    <div class="layout-positioner">
        <div class="link-line"><a href="MainPage.php">Главная страница</a> > <a href="CategoryPage.php">Категория</a> > Ноутбук Asus</div>
        <!-- menu -->
        <div class="main-menu">
            <div class="catalog">Каталог товаров</div>
            <ul>
                <?php for($i=0; $i<6; $i++):?>
                    <li class="notebook-menu"><a href="CategoryPage.php">Ноутбуки и планшеты</a>
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
            <div class="category_name">15.6" Ноутбук Asus X553MA 90NB04X1-M25360 черный</div>
            <div class="ProductID">Код товара 10046</div>
            <div class="main-window">
                <div class="Product-itemTable">
                            <div class="Product-itemRow">
                                <div class="product-Cell-image">
                                    <div class="product-image">
                                        <img alt="Notebook" src="../Images/30023889m.jpg">
                                    </div>
                                </div>
                                <div class="ProductPrice PriceCell">21990р.</div>
                                <div class="Car-Cell">
                                    <div class="ToCar ToCarPP">+Купить</div>
                                </div>
                            </div>
                </div>
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
</div>
</body>
</html>
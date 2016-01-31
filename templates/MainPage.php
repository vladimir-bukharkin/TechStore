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
                <a href="MainPage.php"><img alt="TS Магазин цифрофой техники" src="../Images/logo.png" width="100%" height="100%"></a>
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
        <div class="HelloDiv">Добро пожаловать на главную страницу магазина цифровой техники!</div>
        <!-- menu -->
        <div class="main-menu">
            <div class="catalog">Каталог товаров</div>
            <ul>
                <li class="notebook-menu"><a href="CategoryPage.php">Ноутбуки и планшеты</a>
                    <ul class="sub">
                        <li><a href="ProductPage.html">Ноутбук Lenovo IdeaPad G5045 80MQ001GRK</a></li>
                        <li><a href="ProductPage.html">Ноутбук Asus X553MA-SX859H (черный)</a></li>
                        <li><a href="ProductPage.html">Ноутбук HP 15-af003ur (ENERGY STAR) (черный)</a></li>
                    </ul>
                </li>
                <li class="PC-menu"><a href="CategoryPage.php">Компьютеры и периферия</a>
                    <ul>
                        <li><a href="ProductPage.html">Системный блок Apple Mac Pro (MD878) (черный)</a></li>
                        <li><a href="ProductPage.html">Монитор Apple Thunderbolt display 27 </a></li>
                        <li><a href="ProductPage.html">USB накопитель SanDisk Ultra Dual 3.0 32Gb (черный) </a></li>
                    </ul>
                </li>
                <li class="phones-menu"><a href="CategoryPage.php">Телефоны и смарт-часы</a>
                    <ul>
                        <li><a href="ProductPage.html">Мобильный телефон Highscreen Power Four (черный) </a></li>
                        <li><a href="ProductPage.html">Мобильный телефон Asus ZenFone 2 Laser ZE500KL 16Gb (красный)</a></li>
                        <li><a href="ProductPage.html">Мобильный телефон ZTE Blade S6 (серебристый)</a></li>
                    </ul>
                </li>
                <li class="network-device-menu"><a href="CategoryPage.php">Сетевое оборудование</a>
                    <ul>
                        <li><a href="ProductPage.html">Маршрутизатор Mikrotik RB951G-2HnD</a></li>
                        <li><a href="ProductPage.html">Маршрутизатор ASUS RT-N11P</a></li>
                        <li><a href="ProductPage.html">Серверные шкафы 19'</a></li>
                    </ul>
                </li>
                <li class="hardware-PC-menu"><a href="CategoryPage.php">Комплектующие для ПК</a>
                    <ul>
                        <li><a href="ProductPage.html">Процессор AMD FX-8320 OEM</a></li>
                        <li><a href="ProductPage.html">Процессор Intel Core i7-5960X BOX</a></li>
                        <li><a href="ProductPage.html">Процессор Intel Core i7-4960X OEM</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Popular -->
        <div class="main-part">
            <div class="category_name popular">Популярное</div>
            <div class="main-window">
                <?php for($i=0; $i<6; $i++): ?>
                    <a href="ProductPage.html">
                        <div class="item">
                            <div class="main-image">
                                <img alt="Notebook" src="../Images/30023889m.jpg" width="100%" height="100%">
                            </div>
                            <div class="product-name">15.6" Ноутбук Asus X553MA 90NB04X1-M25360 черный</div>
                            <div class="Price">21990р.</div>
                            <div class="ToCar">+Купить</div>
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
</div>
</body>
</html>
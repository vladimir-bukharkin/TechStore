<!DOCTYPE html>
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
                <a href="Main_Page_Template.php"><img alt="TS Магазин цифрофой техники" src="../Images/logo.png"></a>
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
                <a href="login_form.php"><div class="entry_button login_cell">Вход</div></a>
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
                                <li><a href="Product_Page_Template.php">Ноутбук Lenovo IdeaPad G5045 80MQ001GRK</a></li>
                            <?php endfor;?>
                        </ul>
                    </li>
                <?php endfor;?>
            </ul>
        </div>

        <!-- Items -->
        <div class="main-part">
            <div class="category_name">Список товаров</div>
            <div class="main-window">


                <div class="Product-itemTable">
                    <?php for($i=0; $i<2; $i++): ?>
                        <a href="Product_Page_Template.php">
                            <div class="Product-itemRow">
                                <div class="product-Cell-image">
                                    <div class="image-div">
                                        <img alt="Notebook" src="../Images/30023889m.jpg">
                                    </div>
                                </div>
                                <div class="product-name product-nameCell">15.6" Ноутбук Asus X553MA 90NB04X1-M25360 черный</div>
                                <div class="Price PriceCell">21990р.</div>
                                <div class="Car-Cell">
                                    <a href="Car_Page_Template.php"><div class="ToCar ToCarPP">+Купить</div></a>
                                </div>
                            </div>
                        </a>
                    <?php endfor;?>
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
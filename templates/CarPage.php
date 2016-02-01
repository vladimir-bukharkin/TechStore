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
        <!-- Items -->
        <div class="main-part">
            <div class="DescMyCar">Моя корзина</div>
            <div class="main-windowCar">
                <div class="Product-itemTable">
                    <?php for($i=0; $i<2; $i++): ?>
                        <div class="Product-itemRow">
                            <div class="product-Cell-image">
                                <div class="image-div image-divCar">
                                    <img alt="Notebook" src="../Images/30023889m.jpg">
                                </div>
                            </div>
                            <div class="product-name product-nameCell product-nameCar">
                                15.6" Ноутбук Asus X553MA 90NB04X1-M25360 черный
                                <div class="ProductID">Код товара:23523</div>
                            </div>
                            <div class="AmountCell">
                                <button class="Product-delete">X</button>
                                <div class="PriceDiv">21990р.</div>
                                <div class="AmountField">
                                    <button class="Min-button MPbutton" name="MinusBut">-</button>
                                    <input class="amount-product" type="text" name="amount-product" value="1">
                                    <button class="Plus-button MPbutton" name="PlusBut">+</button>
                                </div>
                            </div>
                        </div>
                    <?php endfor;?>
                </div>
                <div class="InTotal">Итого:<div class="TotalPrice">2015р.</div></div>
            </div>
            <input class="submitOffer" type="submit" name="SubmitOffer" value="Оформить заказ">
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
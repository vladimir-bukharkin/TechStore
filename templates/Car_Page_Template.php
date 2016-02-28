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
                <a href="./"><img alt="TS Магазин цифрофой техники" src="Images/logo.png"></a>
            </div>
        </div>
        <!--Поиск -->
        <div class="search">
            <form action="find.php" method="get">
                <input class="inputSearch" type="text" name="search_text" value="" placeholder="Поиск...">
                <input class="submitSearchBottom" type="submit" name="send" value="">
            </form>
        </div>
        <div class="rightHeader">
            <a href="<?= is_current_user() ? 'car.php' : 'login.php' ?>">
                <div class="ToCar headCar">В корзину
                    <?php if($count_in_car && is_current_user()) :?>
                        <div class="count_in_car"><?php echo $count_in_car?></div>
                    <?php endif ?>
                </div>
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
        <!-- Items -->
        <div class="main-part">
            <div class="DescMyCar">Моя корзина</div>
            <div class="main-windowCar">
                <div class="Product-itemTable">
                    <?php for($i=0; $i<count($car_items); $i++): ?>
                        <div class="Product-itemRow">
                            <div class="product-Cell-image">
                                <div class="image-div image-divCar">
                                    <img alt="Notebook" src="<?= $car_items[$i][0]['img'];?>">
                                </div>
                            </div>
                            <div class="product-name product-nameCell product-nameCar">
                                <a href="product.php"><?php echo $car_items[$i][0]['title'];?></a>
                                <div class="ProductID">Код товара:<?php echo $car_items[$i][0]['id'];?></div>
                            </div>
                            <div class="AmountCell">
                                <form action="car.php" method="post">
                                    <input type="hidden" name="product_delete" value="<?= $car_items[$i][0]['id'] ?>">
                                    <button type="submit" class="Product-delete">X</button>
                                </form>
                                <div class="PriceDiv">
                                    <?php echo $car_items[$i][0]['row_amount'];?>р.</div>
                                <div class="AmountField">
                                    <form action="car.php" method="post">
                                        <input type="hidden" name="product_decrement" value="<?= $car_items[$i][0]['id'] ?>">
                                        <button type="submit" class="Min-button MPbutton" name="MinusBut">-</button>
                                    </form>
                                        <input class="amount-product" type="text" name="amount-product"
                                               value="<?= intval($car_items[$i][0]['count']);?>">

                                    <form action="car.php" method="post">
                                        <input type="hidden" name="buy_product_id" value="<?= $car_items[$i][0]['id'] ?>">
                                        <button type="submit" class="Plus-button MPbutton"">+</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    <?php endfor;?>
                </div>
                <div class="InTotal">Итого:<div class="TotalPrice">
                        <?= intval($car_items[0]['total']);?>р.</div></div>
            </div>
            <input class="submitOffer" type="submit" name="SubmitOffer" value="Оформить заказ">
        </div>
        <div class="main-part PopularPart">
            <div class="category_name popular">Популярное</div>
            <div class="main-window">
                <?php for($i=0; $i<8; $i++): ?>

                    <div class="item">
                        <form action="product.php">
                            <input type="hidden" name="product_id" value="<?= $items[$i][0]['id'] ?>">
                            <button type="submit" class="hiddenButton">
                                <div class="main-image">
                                    <img alt="Notebook" src="<?= $items[$i][0]['img'];?>">
                                </div>
                                <div class="product-name popular-name"><?php echo $items[$i][0]['title'];?></div>
                                <div class="Price"><?php echo intval($items[$i][0]['price']);?>р.</div>
                            </button>
                        </form>
                        <form action="car.php" method="post">
                            <input type="hidden" name="buy_product_id" value="<?= $items[$i][0]['id'] ?>">
                            <button type="submit" class="hiddenButton">
                                <div class="ToCar">+Купить</div>
                            </button>
                        </form>
                    </div>
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

    <?php echo $count_in_car;   ?>
</div>
</body>
</html>
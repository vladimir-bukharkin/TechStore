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
        <div class="search">
            <form action="POMENYAT" method="get">
                <input class="inputSearch" type="text" name="search" value="" placeholder="Поиск...">
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
        <!-- menu -->
        <div class="main-menu">
            <div class="catalog">Каталог товаров</div>
            <ul>
                <?php for($i=0; $i<count($category); $i++):?>
                    <li class="notebook-menu">
                        <form action="category.php" method="get">
                            <input type="hidden" name="catgory_id" value="<?= $category[$i]['id'] ?>">
                            <button type="submit" class="hiddenButton">
                                <?php echo $category[$i]['title'];?>
                            </button>
                        </form>
                        <ul class="sub">
                            <?php for($j=0; $j<3; $j++):?>
                                <li><a href="">Производитель <?php echo $j ?></a></li>
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
                    <?php for($i=0; $i<count($items); $i++): ?>
                        <form action="product.php" method="get">
                            <input type="hidden" name="product_id" value="<?= $items[$i]['id'] ?>">

                            <div class="Product-itemRow">
                                <button type="submit" class="hiddenButton">
                                    <div class="product-Cell-image">
                                        <div class="image-div">
                                            <img alt="Notebook" src="<?= $items[$i]['img'];?>">
                                        </div>
                                    </div>
                                    <div class="product-name product-nameCell"><?php echo $items[$i]['title'];?></div>
                                    <div class="Price PriceCell"><?php echo intval($items[$i]['price']);?>р.</div>
                                </button>
                        </form>
                                <div class="Car-Cell">
                                    <form action="category.php" method="post">
                                        <input type="hidden" name="buy_product_id" value="<?= $items[$i]['id'] ?>">
                                        <button type="submit" class="hiddenButton">
                                            <div class="ToCar ToCarPP">+Купить</div>
                                        </button>
                                    </form>
                                </div>
                            </div>

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
    <?php print_r($_GET['catgory_id']); ?>

</div>
</body>
</html>
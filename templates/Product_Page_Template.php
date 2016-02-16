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
                <a href="index.php"><img alt="TS Магазин цифрофой техники" src="Images/logo.png"></a>
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
        <div class="link-line"><a href="./">Главная страница</a> >
            <a href="category.php"><?php echo $category[0]['title'];?></a> >
            <?php echo $items[0]['title'];?></div>
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
            <div class="category_name">Страница товара</div>
            <div class="product-tittle-name"><?php echo $items[0]['title'];?></div>
            <div class="ProductID">Код товара <?php echo intval($items[0]['id']);?></div>
            <div class="main-window main-windowProd">
                <div class="Product-itemTable">
                    <div class="Product-itemRow Product-itemRowNoHover">
                        <div class="product-Cell-image">
                            <div class="product-image">
                                <img alt="Notebook" src="<?= $items[0]['img'];?>">
                            </div>
                        </div>
                        <div class="PriceStockCar-div">
                            <div class="ProductPrice"><?php echo intval($items[0]['price']);?>р.</div>
                            <div class="inStock">Товар имеется на складе: <?php echo intval($items[0]['stock']);?>шт.</div>
                            <a href="<?= is_current_user() ? 'car.php' : 'login.php' ?>">
                                <div class="ToCar ToCarPP">+Купить</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="descriptionH">Описание</div>
            <div class="description">
                <h4>Описание <?php echo $items[0]['title'];?></h4>
                <?php echo $items[0]['description']; ?>
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
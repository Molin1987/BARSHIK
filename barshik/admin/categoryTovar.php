<?php
include "../connect.php";

$idCat = isset($_POST['idCat']) ? $_POST['idCat'] : false;
$Name = isset($_POST['Name']) ? $_POST['Name'] : false;
$Categ = isset($_POST['Tovar']) ? $_POST['Tovar'] : false;

$query = "SELECT Category_id, name FROM Category";
$result = mysqli_query($con, $query);
$result1 = mysqli_fetch_all($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление категориями напитков</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <nav class="nav">
            <div class="index">
                <h1 class="index_">Админ</h1>
            </div>
            <div class="cart_account">
                <a href="newTovar.php">Управление товарами</a>                     
                <a href="categoryTovar.php">Управление категориями напитков</a>
                <a href="orderManagement.php">Управление заказами</a>
                <a href="Panel-admin.php">Статистика и отчеты</a>
                <a href="/logout.php">Выйти</a>
            </div>
        </nav>
    </header>

    <div class="container">
        <h2 class="edit-tovar">Категории</h2>
        <div class="products">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Товары с категорией</th>
                        <th>Редактировать</th>
                        <th>Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result1 as $item): ?>
                        <tr>
                            <form action="cat_update.php" method="post">
                                <input name="id" type="hidden" value="<?= $item[0] ?>">
                                <td><input name="Name" value="<?= $item[1] ?>"></td>
                                <td>
                                    <?php
                                    $categoryTovar = "SELECT Product.* FROM Product INNER JOIN Category ON Category.Category_id = Product.Category_id WHERE Category.Category_id = $item[0]";
                                    $categoryResult = mysqli_fetch_all(mysqli_query($con, $categoryTovar));

                                    foreach ($categoryResult as $product) {
                                        echo $product[0] . " - " . $product[1] . "<br>";
                                    }
                                    ?>
                                </td>
                                <td><button type="submit" class="btn btn-primary">Редактировать</button></td>
                            </form>
                            <td><a href='cat_delete.php?item=<?= $item[0] ?>' class="btn btn-danger">Удалить</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div>
            <h2 class="edit-tovar">Добавление Категории</h2>
            <form action="categoryTovar_db.php" class="adding" method="POST">
                <div class="mb-3">
                    <input type="text" name="Name" class="form-control" placeholder="Название" required>
                </div>
                <button type="submit" name="add" class="btn btn-success">Создать</button>
            </form>
        </div>
    </div>

    <footer id="footer">
        <div class="container">
            <div class="connection">
                <div class="connect">
                    <p>Связь с нами</p>
                    <div class="images-connection">
                        <img src="../images/icons8-vk-com-48.png" alt="" srcset="">
                        <img src="../images/iconfinder-social-media-applications-23whatsapp-4102606_113811.png"
                            class="icon-whatsapp">
                    </div>
                </div>
                <div class="clock-work">
                    <p>Часы работы:</p>
                    <p>10:00 - 23:00</p>
                </div>
            </div>
            <hr>
            <p class="copirater">© 2023 Копирование запрещено. Все права защищены.</p>
        </div>
    </footer>
</body>
</html>

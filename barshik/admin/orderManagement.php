<?php
// Подключение к базе данных
include "../connect.php";

// Получение данных о заказах с деталями
$query = "SELECT * FROM Order_Product 
          INNER JOIN Product ON Product.Id_product = Order_Product.Id_product 
          INNER JOIN Orders ON Order_Product.Id_order = Orders.Id_order";
$result = mysqli_query($con, $query);
$queryOrder = mysqli_fetch_all($result); // Получение всех строк результата запроса в виде массива

// Получение детализированной информации о продуктах в каждом заказе
$infoProductQuery = "SELECT *, Product.Price FROM Order_Product 
                     INNER JOIN Orders ON Order_Product.Id_order = Orders.Id_order
                     INNER JOIN Product ON Product.Id_product = Order_Product.Id_product";
$infoProductResult = mysqli_query($con, $infoProductQuery);
$infoProduct = mysqli_fetch_all($infoProductResult); // Получение всех строк результата запроса в виде массива

// Обработка отправки формы для обновления статуса заказа
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $orderId = isset($_POST['orderId']) ? $_POST['orderId'] : '';
    $newStatus = isset($_POST['newStatus']) ? $_POST['newStatus'] : '';

    // Валидация входных данных (убедимся, что orderId и newStatus не пустые)
    if (!empty($orderId) && !empty($newStatus)) {
        // Защита от SQL-инъекций
        $orderId = mysqli_real_escape_string($con, $orderId);
        $newStatus = mysqli_real_escape_string($con, $newStatus);

        // Запрос на обновление статуса заказа в базе данных
        $updateQuery = "UPDATE Orders SET Status = '$newStatus' WHERE Id_order = '$orderId'";
        $result = mysqli_query($con, $updateQuery);

        // Проверка результата выполнения запроса
        if ($result) {
            // Успешное обновление статуса
            echo "<script>alert('Статус заказа успешно обновлен!');</script>";
            // Перенаправление на текущую страницу для предотвращения повторной отправки формы
            echo "<script>window.location.href = 'orderManagement.php';</script>";
            exit;
        } else {
            // Ошибка при выполнении запроса
            echo "Ошибка при обновлении статуса заказа: " . mysqli_error($con);
        }
    } else {
        // Неверные данные для обновления статуса заказа
        echo "Неверные данные для обновления статуса заказа.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление заказами</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
    <h2 class="edit-tovar">Управление заказами</h2>
    <div class="products">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Номер заказа</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Цена</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($queryOrder as $order): ?>
                    <tr>
                        <td><?= $order[1] ?></td>
                        <td>
                            <form action="orderManagement.php" method="post">
                                <input type="hidden" name="orderId" value="<?= $order[0] ?>">
                                <select name="newStatus">
                                    <option value="Готовим" <?= ($order[13] === "Готовим") ? "selected" : "" ?>>Готовим</option>
                                    <option value="Доставка" <?= ($order[13] === "Доставка") ? "selected" : "" ?>>Доставка</option>
                                    <option value="Выполнено" <?= ($order[13] === "Выполнено") ? "selected" : "" ?>>Выполнено</option>
                                </select>
                                <button type="submit">Обновить статус</button>
                            </form>
                        </td>
                        <td><?= $order[12] ?></td>
                        <td><?= $order[14] ?></td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#orderDetails<?= $order[0] ?>"><button class="view-details">Подробности</button></a>
                            <a href='deleteOrder.php?item=<?= htmlspecialchars($order[0]); ?>&itenOr=<?= htmlspecialchars($order[2]); ?>'><button class="delete-order">Удалить заказ</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<footer id="footer">
    <div class="container">
        <div class="connection">
            <div class="connect">
                <p>Связь с нами</p>
                <div class="images-connection">
                    <img src="../images/icons8-vk-com-48.png" alt="" srcset="">
                    <img src="../images/iconfinder-social-media-applications-23whatsapp-4102606_113811.png" class="icon-whatsapp">
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

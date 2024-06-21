<?php
require_once "../connect.php";

$result = mysqli_query($con, "SELECT COUNT(*) AS total_orders FROM `Orders`");
$sql = mysqli_fetch_all(mysqli_query($con,"SELECT SUM(Total_price) FROM `Orders`"));

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $total_orders = $row['total_orders'];
}

$result_total_revenue = mysqli_query($con, "SELECT SUM(Total_price) AS total_revenue FROM `Orders`");
if ($result_total_revenue && mysqli_num_rows($result_total_revenue) > 0) {
    $row_total_revenue = mysqli_fetch_assoc($result_total_revenue);
    $total_revenue = $row_total_revenue['total_revenue'];
}

$orders = mysqli_fetch_all(mysqli_query($con, 'SELECT * FROM `Orders` '));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика и отчеты</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h2 class="stats-header">Таблица статистики и отчетов</h2>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Количество заказов</th>
                        <th>Выручка за заказ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= $order[0] ?></td>
                            <td><?= $order[4] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <table class="table">
                <thead>
                    <tr>
                        <th>Общее количество заказов</th>
                        <th>Общая выручка</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($total_orders) ?></td>
                        <td><?= htmlspecialchars(number_format($total_revenue, 2)) ?></td>
                    </tr>
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

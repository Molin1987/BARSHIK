<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h2>Добавить новый товар</h2>
    <form action="add_product.php" method="post">
        Название товара: <input type="text" name="name"><br>
        Цена: <input type="text" name="price"><br>
        Описание: <textarea name="description"></textarea><br>
        Категория: <textarea name="Category_id"></textarea><br>
        <input type="submit" value="Добавить товар">
    </form>

    <h2>Удалить товар</h2>
    <form action="delete_product.php" method="post">
        ID товара: <input type="text" name="id"><br>
        <input type="submit" value="Удалить товар">
    </form>

    <h2>Редактировать товар</h2>
    <form action="edit_product.php" method="post">
        ID товара: <input type="text" name="id"><br>
        Название товара: <input type="text" name="name"><br>
        Цена: <input type="text" name="price"><br>
        Описание: <textarea name="description"></textarea><br>
        <input type="submit" value="Сохранить изменения">
    </form>

    <h2>Редактировать статус заказа</h2>
    <form action="edit_order_status.php" method="post">
        ID заказа: <input type="text" name="id"><br>
        Новый статус: 
        <select name="status">
            <option value="В обработке">В обработке</option>
            <option value="Доставлено">Доставлено</option>
            <option value="Отменено">Отменено</option>
        </select><br>
        <input type="submit" value="Сохранить изменения">
    </form>
</body>
</html>

<?php
include "connect.php";

$name = $_POST['name'];
$description = $_POST['description'];
$category = $_POST['Category_id'];
$price = $_POST['price'];
// $image = $_POST['Image'];

$sql = "INSERT INTO Product (name, price, description, Category_id) VALUES ('$name', $price, '$description', '$category')";

if ($conn->query($sql) === TRUE) {
    echo "Товар успешно добавлен";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>

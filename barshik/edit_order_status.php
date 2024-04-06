<?php
include "connect.php";

$id = $_POST['id'];
$status = $_POST['status'];

$sql = "UPDATE orders SET status='$status' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Статус заказа успешно изменен";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

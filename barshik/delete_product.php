<?php
include "connect.php";

$id = $_POST['id'];

$sql = "DELETE FROM Product WHERE Id_product = $id";

if ($conn->query($sql) === TRUE) {
    echo "Товар успешно удален";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

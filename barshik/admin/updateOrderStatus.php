<?php 
include "../connect.php";

// Проверяем, что orderId и newStatus переданы через POST
if (isset($_POST['orderId']) && isset($_POST['newStatus'])) {
    $orderId = $_POST['orderId']; 
    $newStatus = $_POST['newStatus']; 
    
    // Экранируем данные для безопасности
    $orderId = mysqli_real_escape_string($con, $orderId);
    $newStatus = mysqli_real_escape_string($con, $newStatus);

    // Формируем и выполняем запрос на обновление статуса
    $query = "UPDATE Orders SET Status = '$newStatus' WHERE Id_order = '$orderId'";

    $result = mysqli_query($con, $query); 

    if ($result) { 
        echo "<script>alert('Статус обновлен'); 
        location.href = 'orderManagement.php'; 
        </script>"; 
    } else { 
        echo "Ошибка при обновлении статуса заказа: " . mysqli_error($con); 
    } 
} else {
    echo "Не удалось получить orderId и newStatus из формы.";
}
?>

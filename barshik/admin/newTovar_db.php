<?php
include "../connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['Name']);
    $category = mysqli_real_escape_string($con, $_POST['Category_id']);
    $price = mysqli_real_escape_string($con, $_POST['Price']);
    $description = mysqli_real_escape_string($con, $_POST['Description']);
    $image = $_FILES['Image'];

    // Проверка на ошибки при загрузке файла
    if ($image['error'] === 0) {
        // Путь к директории для загрузки изображений
        $targetDir = "../images/";
        $targetFile = $targetDir . basename($image['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Проверка на допустимые форматы файлов
        $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];
        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                // Вставка данных в базу данных
                $query = "INSERT INTO Product (Name, Category_id, Price, Description, Image) VALUES ('$name', '$category', '$price', '$description', '" . mysqli_real_escape_string($con, $image['name']) . "')";
                if (mysqli_query($con, $query)) {
                    header("Location: newTovar.php");
                    exit();
                } else {
                    echo "Ошибка: " . $query . "<br>" . mysqli_error($con);
                }
            } else {
                echo "Ошибка при загрузке файла.";
            }
        } else {
            echo "Недопустимый формат файла. Разрешены только JPG, JPEG, PNG и GIF.";
        }
    } else {
        echo "Ошибка при загрузке файла.";
    }
}
?>

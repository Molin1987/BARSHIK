<?php
include "../connect.php";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = isset($_POST['Name']) ? $_POST['Name'] : '';

    // Validate input
    if (!empty($Name)) {
        // Sanitize the input to prevent SQL injection
        $Name = mysqli_real_escape_string($con, $Name);

        // Insert into Category table
        $queryAdd = "INSERT INTO `Category` (`Name`) VALUES ('$Name')";
        $result = mysqli_query($con, $queryAdd);

        if ($result) {
            echo "<script>alert('Категория создана!');</script>";
            header("Location: categoryTovar.php");
            exit;
        } else {
            echo "Ошибка при добавлении категории: " . mysqli_error($con);
        }
    } else {
        echo "Название категории не может быть пустым";
    }
}
?>
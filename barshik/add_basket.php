<?php
session_start();
require_once 'connect.php';

$id_tovar = $_GET["id_product"];
$id_user = $_SESSION["User_id"];

// Fetch the cart for the user
$cart_query = mysqli_query($con, "SELECT `content` FROM `Basket` WHERE `User_id` = $id_user");
$cart = mysqli_fetch_assoc($cart_query);

if (!$cart) {
    // If cart doesn't exist for the user, create a new one
    $compount = [$id_tovar => 1]; // Associative array for new item
    $compount_json = json_encode($compount);

    $sql = "INSERT INTO `Basket` (`User_id`, `Content`, `product_id`) VALUES ('$id_user', '$compount_json', '$id_tovar')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION["cart"] = $compount_json;
        $_SESSION["message"] = "Товар добавлен в корзину";
        header("Location: /");
        exit;
    }
} else {
    // Update existing cart content
    $cart_content = json_decode($cart["content"], true);

    if (array_key_exists($id_tovar, $cart_content)) {
        $cart_content[$id_tovar]++;
    } else {
        $cart_content[$id_tovar] = 1;
    }

    $compount = json_encode($cart_content);
    $sql = "UPDATE `Basket` SET `Content`='$compount' WHERE `User_id` = $id_user";

    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION["cart"] = $compount;
        $_SESSION["message"] = "Товар добавлен в корзину";
        header("Location: /");
        exit;
    }
}

// If any SQL query fails
$_SESSION["error"] = "Ошибка при обновлении корзины";
header("Location: /");
exit;
?>
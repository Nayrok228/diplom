<?php
// Получаем значения из формы
$user_name = $_POST["username"];
$phone = $_POST["phone"];

// Подключение к базе данных
$servername = "tv";
$username_db = "root";
$password_db = "";
$dbname = "diplom";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Вставляем значения в базу данных
$sql = "INSERT INTO payments (name1, phone) VALUES ('$user_name', '$phone')";
if ($conn->query($sql) === TRUE) {
    echo "Отлично, вы оставили заявку на подключение, с вами скоро свяжутся!";
} else {
    echo "Ошибка при обработке заявки. Пожалуйста, попробуйте еще раз.";
}

$conn->close();
?>

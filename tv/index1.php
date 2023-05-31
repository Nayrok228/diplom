<?php
// Подключение к серверу MySQL
$servername = "tv";
$username = "root";
$password = "";
$dbname = "diplom";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Получение данных из формы
$name1 = $_POST["name1"];
$name2 = $_POST["name2"];
$email1 = $_POST["email1"];
$email2 = $_POST["email2"];
$pass1 = $_POST["pass1"];
$pass2 = $_POST["pass2"];
$tel = $_POST["tel"];

// Проверка наличия данных
if (empty($name1) || empty($name2) || empty($email1) || empty($email2) || empty($pass1) || empty($pass2) || empty($tel)) {
    die("Ошибка: Заполните все поля формы.");
}

// Хеширование пароля
$hashedPassword = password_hash($pass1, PASSWORD_DEFAULT);

// Выполнение операций с базой данных (пример)
$sql = "INSERT INTO users (name1, name2, email1, email2, pass1, pass2, tel) VALUES ('$name1', '$name2', '$email1', '$email2', '$hashedPassword', '$pass2', '$tel')";

if ($conn->query($sql) === TRUE) {
    echo "Регистрация успешно завершена.";
} else {
    echo "Ошибка регистрации: " . $conn->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>

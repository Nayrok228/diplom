<?php
session_start();

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
$email = $_POST["email"];
$pass = $_POST["pass"];

// Проверка данных в базе данных
$sql = "SELECT * FROM users WHERE email1='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row["pass1"];

    if (password_verify($pass, $hashedPassword)) {
        // Авторизация успешна, сохраняем данные пользователя в сессию
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["user_name"] = $row["name1"];
        $_SESSION["user_surname"] = $row["name2"];
        $_SESSION["user_email"] = $row["email1"];
        $_SESSION["user_phone"] = $row["tel"];
        $_SESSION["user_passport"] = $row["passport"];
        $_SESSION["user_phone2"] = $row["phone"];
        $_SESSION["is_logged_in"] = true;

        // Перенаправление на страницу личного кабинета
        header("Location: profile.php");
        exit;
    } else {
        echo "Неправильный пароль.";
    }
} else {
    echo "Пользователь не найден.";
}

$conn->close();
?>

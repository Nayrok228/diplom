<?php
session_start();
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $is_logged_in = true;
} else {
    $user_id = null;
    $is_logged_in = false;
}

if ($is_logged_in) {
    // Получение данных из формы
    $passport = $_POST["passport"];
    $phone = $_POST["phone"];

    // Проверка наличия данных
    if (empty($passport) || empty($phone)) {
        die("Ошибка: Заполните все поля формы.");
    }

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

    // Выполнение операции с базой данных для обновления данных профиля (пример)
    $sql = "UPDATE users SET passport = '$passport', phone = '$phone' WHERE id = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        // Закрытие соединения с базой данных
        $conn->close();

        // Перенаправление на страницу профиля
        header("Location: profile.php");
        exit;
    } else {
        echo "Ошибка обновления данных профиля: " . $conn->error;
    }

    // Закрытие соединения с базой данных
    $conn->close();
} else {
    echo "Ошибка: Пользователь не авторизован.";
}
?>

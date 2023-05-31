<?php
session_start();
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $user_name = $_SESSION["user_name"];
    $user_surname = $_SESSION["user_surname"];
    $user_email = $_SESSION["user_email"];
    $user_phone = $_SESSION["user_phone"];
    $is_logged_in = true;

    // Получение данных паспорта и резервного номера телефона из базы данных
    $servername = "tv";
    $username = "root";
    $password = "";
    $dbname = "diplom";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }

    $sql = "SELECT passport, phone FROM users WHERE id='$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $passport = $row["passport"];
        $phone = $row["phone"];
    } else {
        $passport = "";
        $phone = "";
    }

    $conn->close();
} else {
    $user_id = null;
    $user_name = null;
    $user_surname = null;
    $user_email = null;
    $user_phone = null;
    $is_logged_in = false;
}
// Обработка обновления профиля
if (isset($_POST["passport"]) && isset($_POST["phone"])) {
    $passport = $_POST["passport"];
    $phone = $_POST["phone"];

    // Обновление данных пользователя в базе данных
    $sql = "UPDATE users SET passport='$passport', phone='$phone' WHERE id=$user_id";
    if ($conn->query($sql) === TRUE) {
        echo "Профиль успешно обновлен.";
        // Обновление сохраненных данных в сессии
        $_SESSION["user_passport"] = $passport;
        $_SESSION["user_phone"] = $phone;
    } else {
        echo "Ошибка при обновлении профиля: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <header>
        <img src="logo.png" alt="Логотип">
        <h1>BarhatTV</h1>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="about.php">О нас</a></li>
                <li><a href="services.php">Услуги</a></li>
                <li><a href="contacts.php">Поддержка</a></li>
                <?php
                if ($is_logged_in) {
                    echo '<li><a href="profile.php">Личный кабинет</a></li>';
                }
                ?>
            </ul>
        </nav>
        <div class="user-menu">
            <?php
            if ($is_logged_in) {
                echo '<div id="user-info">
                            <span id="user-name">Привет, ' . $user_name . '!</span>
                            <a href="logout.php" class="login-button">Выйти</a>';
            } else {
                echo '<div class="button-container">
                            <a href="auth.php" class="login-button">Войти</a>
                        </div>
                        <div class="button-container">
                            <a href="registration.php" class="register-button">Зарегистрироваться</a>
                        </div>';
            }
            ?>
        </div>
    </header>

    <main>
        <section>
            <h2>Личный кабинет</h2>
            <?php
            if ($is_logged_in) {
                if (!empty($passport) && !empty($phone)) {
                    // Данные паспорта и резервного номера телефона уже добавлены
                    echo "<p>Имя: " . $user_name . "</p>";
                    echo "<p>Фамилия: " . $user_surname . "</p>";
                    echo "<p>Электронная почта: " . $user_email . "</p>";
                    echo "<p>Номер телефона: " . $user_phone . "</p>";
                    echo "<p>Паспорт: " . $passport . "</p>";
                    echo "<p>Резервный номер телефона: " . $phone . "</p>";
                } else {
                    // Форма для ввода данных паспорта и резервного номера телефона
                    echo "<p>Имя: " . $user_name . "</p>";
                    echo "<p>Фамилия: " . $user_surname . "</p>";
                    echo "<p>Электронная почта: " . $user_email . "</p>";
                    echo "<p>Номер телефона: " . $user_phone . "</p>";

                    echo '<form action="update_profile.php" method="post">
                            <label for="passport">Паспорт:</label>
                            <input type="text" id="passport" name="passport" placeholder="Введите номер паспорта" required><br>
                            <label for="phone">Резервный номер телефона:</label>
                            <input type="text" id="phone" name="phone" placeholder="Введите резервный номер телефона" required><br>
                            <input type="submit" value="Сохранить">
                        </form>';
                }
            } else {
                echo "<p>Вы не авторизованы.</p>";
            }
            ?>
        </section>
    </main>

    <footer>
        &copy; 2023 BarhatTV. Все права защищены.
    </footer>
</body>

</html>
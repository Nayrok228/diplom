<?php
session_start();
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $user_name = $_SESSION["user_name"];
    $is_logged_in = true;
} else {
    $user_id = null;
    $user_name = null;
    $is_logged_in = false;
}

$success_message = "";
$error_message = "";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $hostname = "tv";
    $username = "root";
    $password = "";
    $dbname = "diplom";

    // Подключение к базе данных
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }

    // Подготовка SQL-запроса для вставки данных в таблицу
    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Данные успешно добавлены в базу данных
        $success_message = "Данные успешно отправлены в базу данных.";
    } else {
        // Ошибка при выполнении запроса
        $error_message = "Ошибка: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BarhatTV - Поддержка</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" type="text/css" href="registr.css">
    <link rel="stylesheet" type="text/css" href="auth.css">
    <script src="script.js"></script>
  </head>

<body>
    <header>
        <img src="logo.png" alt="Логотип компании BarhatTV">
        <h1>BarhatTV</h1>
        <nav>
            <ul class="menu">
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

            <div class="user-menu">
                <?php
                if ($is_logged_in) {
                    echo '<div id="user-info">
                            <span id="user-name">Привет, ' . $user_name . '!</span>
                            <a href="logout.php" class="login-button">Выйти</a>';
                } else {
                    echo '<button onclick="show(\'block\')" class="regbutton">Регистрация</button>
                          <button onclick="showAuth(\'block\')" class="authbutton">Авторизация</button>';
                }
                ?>
            </div>
        </nav>

        <!--Формы регистрации и авторизации-->
        <!-- Задний прозрачный фон -->
        <div onclick="show('none')" id="gray"></div>
        <div id="window">
            <!-- Картинка крестика -->
            <img class="close" src="close.png" alt="" onclick="show('none')">
            <div class="form">
                <h2>Регистрация</h2>
                <form action="index1.php" name="f1" method="post">
                    <input type="text" placeholder="Имя" name="name1" class="input">
                    <input type="text" placeholder="Фамилия" name="name2" class="input">
                    <input type="email" placeholder="Ваш email" name="email1" class="input">
                    <input type="email" placeholder="Подтвердите email" name="email2" class="input">
                    <input type="password" placeholder="Пароль" name="pass1" class="input">
                    <input type="password" placeholder="Подтвердите пароль" name="pass2" class="input">
                    <input type='tel' placeholder="Мобильный телефон" name="tel" class="input">
                    <input type="submit" value="Регистрация" name="sab" class="input"> Нажимая «Регистрация»,
                    вы подтверждаете, что прочитали и согласны с нашими Условиями Пользования и Политикой Конфиденциальности.
                </form>
            </div>
        </div>

        <!--Задний прозрачный фон для авторизации-->
        <div onclick="showAuth('none')" id="grayAuth"></div>
        <div id="windowAuth">
            <!-- Картинка крестика -->
            <img class="close" src="close.png" alt="" onclick="showAuth('none')">
            <div class="form">
                <h2>Авторизация</h2>
                <form action="auth.php" name="f2" method="post">
                    <input type="email" placeholder="Электронная почта" name="email" class="input">
                    <input type="password" placeholder="Пароль" name="pass" class="input">
                    <input type="submit" value="Войти" name="auth" class="input">
                    <input type="button" value="Зарегистрироваться" onclick="showAuth('none'); show('block')" class="input">
                </form>
            </div>
        </div>
    </header>

  <main>
    <section class="contacts-section">
      <h2>Поддержка</h2>
      <div class="contact-info">
        <p><strong>Адрес:</strong> г. Санкт-Петербург, улица Набережная Реки Помойки, дом 228.</p>
        <p><strong>Телефон:</strong> +7 812-555-35-35</p>
        <p><strong>Email:</strong> barhatTV@support.com</p>
      </div>
      <div class="contact-form">
        <h3>Свяжитесь с нами</h3>
        <form>
          <label for="name">Имя и Фамилия:</label>
          <input type="text" id="name" name="name" required>
  
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
  
          <label for="message">Опишите вашу проблему:</label>
          <textarea id="message" name="message" rows="4" required></textarea>
  
          <button type="submit">Отправить</button>
          </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if ($success_message != "") {
                        echo '<p class="success-message">' . $success_message . '</p>';
                    }
                    if ($error_message != "") {
                        echo '<p class="error-message">' . $error_message . '</p>';
                    }
                }
                ?>
      </div>
    </section>
  </main>

  <footer>
    &copy; 2023 BarhatTV. Все права защищены.
  </footer>
</body>
</html>
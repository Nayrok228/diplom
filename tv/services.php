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

// Проверка если кнопка "Подключить" была нажата
if (isset($_POST['connect'])) {
    if ($is_logged_in) {
        header("Location: pay.php"); // Перекидывает на страницу оплаты
        exit();
    } else {
        echo '<script>
        function showAuth(display) {
            var authForm = document.getElementById("windowAuth");
            authForm.style.display = display;
        }

        function showConfirmationDialog() {
            var confirmation = confirm("Для подключения необходимо авторизоваться. Перейти к авторизации?");
            if (confirmation) {
                showAuth(\'block\');
            }
        }

        // Вызываем showConfirmationDialog() при нажатии на кнопку "Подключить"
        document.addEventListener("DOMContentLoaded", function() {
            var connectButtons = document.getElementsByClassName("service-button");
            Array.from(connectButtons).forEach(function(button) {
                button.addEventListener("click", showConfirmationDialog);
            });
        });
      </script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BarhatTV - Пакеты и Услуги</title>
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
        <section class="services-section">
            <h2>Пакеты и Тарифы</h2>
            <div class="service">
                <h3>Единый ULTRA</h3>
                <p>233 канала (58 HD, 8 UHD) и 47 радиостанций</p>
                <p>Цена: 2500 рублей в год</p>
                <form method="post">
                    <button class="service-button" type="submit" name="connect" id="connectButton">Подключить</button>
                </form>
            </div>
            <div class="service">
                <h3>Детский</h3>
                <p>18 каналов (3 HD)</p>
                <p>Цена: 1500 рублей в год или 250 рублей в месяц</p>
                <form method="post">
                    <button class="service-button" type="submit" name="connect" id="connectButton">Подключить</button>
                </form>
            </div>
            <div class="service">
                <h3>Взрослый</h3>
                <p>10 каналов (4 HD, 1 UHD)</p>
                <p>Цена: 1800 рублей в год, 300 рублей в месяц или 600 рублей за 3 месяца</p>
                <form method="post">
                    <button class="service-button" type="submit" name="connect" id="connectButton">Подключить</button>
                </form>
            </div>
            <div class="service">
                <h3>Смотри Кино и ТВ</h3>
                <p>200+ каналов (78 HD) и 30000+ фильмов</p>
                <p>Цена: 999 рублей в год, 149 рублей в месяц или 399 рублей за 3 месяца</p>
                <form method="post">
                    <button class="service-button" type="submit" name="connect" id="connectButton">Подключить</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        &copy; 2023 BarhatTV. Все права защищены.
    </footer>

</body>
</html>

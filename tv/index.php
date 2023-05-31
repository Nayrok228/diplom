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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BarhatTV - Главная</title>
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
        <h2>Добро пожаловать в мир развлечений и цифровых сервисов от BarhatTV!</h2>
        <p>
            Мы - ведущий поставщик ТВ услуг в России, стремящийся улучшить качество жизни каждого жителя страны
            путем предоставления доступа к медиаинформационному и развлекательному пространству. С момента нашего
            основания в 2018 году, под брендом BarhatTV, мы неуклонно развиваемся и предлагаем нашим клиентам
            самые современные цифровые продукты и сервисы.
        </p>
        <p>
            BarhatTV - это не только телевидение нового поколения, которое можно смотреть через спутниковую
            антенну или онлайн, но и множество удивительных digital-сервисов. Мы создаем единое информационное
            пространство развлечений и услуг для всей вашей семьи. У нас вы сможете наслаждаться онлайн-кинотеатром,
            умным домом, видеонаблюдением и спутниковым интернетом.
        </p>
        <p>
            Используя гибридные приемники с подключением к интернету или нашу удобную мобильную и веб-платформу,
            вы сможете получить доступ к богатому ассортименту контента в любое время и из любого места. Загляните
            в мир кинематографа с нашим онлайн-кинотеатром, который предлагает широкий выбор фильмов и сериалов на любой вкус.
        </p>
        <p>
            BarhatTV - это не только надежность и высокое качество, но и признание нашей компании как одного из
            ведущих операторов восточной Европы. Мы гордимся нашим статусом и стремимся предоставить лучший сервис
            для наших клиентов.
        </p>
        <p>
            Присоединяйтесь к миллионам довольных клиентов BarhatTV и откройте для себя мир развлечений и цифровых
            возможностей прямо у себя дома.
        </p>

        <div class="cta">
            <h2>Готовы начать?</h2>
            <p>Выбирайте пакеты или услугу, которую хотите подключить.</p>
            <a href="services.php">Пакеты и услуги</a>
        </div>
    </main>

    <footer>
        &copy; 2023 BarhatTV. Все права защищены.
    </footer>
</body>

</html>

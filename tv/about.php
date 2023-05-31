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
    <title>BarhatTV - О нас</title>
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
    <section class="about-section">
      <h2>О нас</h2>
      <p>BarhatTV - это компания, которая предоставляет широкий спектр телевизионных услуг своим клиентам. Она была основана в 2018 году и на сегодняшний день является одним из лидеров в области телевизионного вещания в России.
    
        Компания предлагает широкий выбор каналов различных тематик, включая новости, развлечения, спорт, кино, музыку и детские программы. Клиенты могут выбирать пакеты каналов в зависимости от своих потребностей и предпочтений.
        
        Одной из главных преимуществ BarhatTV является высокое качество телевизионного сигнала. Компания использует передовые технологии для передачи и обработки телевизионного контента, что обеспечивает стабильную и высококачественную картинку и звук.
        
        Кроме того, BarhatTV также предлагает услуги видеозаписи и аренды фильмов. Клиенты могут заказывать фильмы онлайн и смотреть их в любое удобное время, не выходя из дома.
        
        Компания также активно развивает свои технологические возможности, предлагая своим клиентам доступ к интерактивным сервисам, таким как видеозапись программ, просмотр электронной программы и многое другое.
        
        В целом, BarhatTV - это надежный поставщик телевизионных услуг с широким выбором каналов и высоким качеством телевизионного сигнала. Компания активно развивается и предлагает своим клиентам передовые технологии для удобного и комфортного просмотра телевизионных программ.</p>
    </section>
  </main>

  <footer>
    &copy; 2023 BarhatTV. Все права защищены.
  </footer>

</body>
</html>
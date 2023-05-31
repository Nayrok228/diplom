<?php
session_start();

// Очищаем данные сеанса
session_unset();
// Уничтожаем сеанс
session_destroy();

// Перенаправление на главную страницу или другую страницу после выхода
header("Location: index.php");
exit();
?>

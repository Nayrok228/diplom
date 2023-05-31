// Функция показа
function show(state) {
  document.getElementById('window').style.display = state;
  document.getElementById('gray').style.display = state;
}

// Функция показа формы авторизации
function showAuth(state) {
  document.getElementById('windowAuth').style.display = state;
  document.getElementById('grayAuth').style.display = state;
  document.getElementById('window').style.display = 'none';
  document.getElementById('gray').style.display = 'none';
}



function showAuthForm() {
  document.getElementById('windowAuth').style.display = 'block';
  document.getElementById('grayAuth').style.display = 'block';
  document.getElementById('window').style.display = 'none';
  document.getElementById('gray').style.display = 'none';
}

function showRegistrationForm() {
  document.getElementById('window').style.display = 'block';
  document.getElementById('gray').style.display = 'block';
}

function login(username) {
  document.getElementById('user-name').textContent = username;
  document.getElementById('user-info').style.display = 'block';
  document.getElementById('logout-button').style.display = 'block';
}

function logout() {
  fetch('logout.php')
    .then(response => response.text())
    .then(data => {
      if (data === 'success') {
        location.reload();
      } else {
        console.log('Ошибка выхода');
      }
    })
    .catch(error => {
      console.log('Ошибка запроса:', error);
    });
}

function goToProfile() {
  // Здесь перенаправьте пользователя на страницу его личного кабинета
  // Например:
  window.location.href = "profile.php";
}
function logout() {
  // Отправляем запрос на сервер для выхода пользователя
  // Можно использовать AJAX или другие методы отправки запросов
  // Перенаправление на страницу выхода
  window.location.href = "logout.php";
}

// Получение элементов из DOM
var userMenu = document.querySelector(".user-menu");
var userName = document.getElementById("user-name");
var logoutButton = document.getElementById("logout-button");
var userInfo = document.getElementById("user-info");

// Функция для показа имени пользователя и кнопки выхода
function showUserInfo(name) {
    userName.textContent = name;
    userInfo.style.display = "block";
    logoutButton.style.display = "block";
}

// Функция для скрытия имени пользователя и кнопки выхода
function hideUserInfo() {
    userName.textContent = "";
    userInfo.style.display = "none";
    logoutButton.style.display = "none";
}

function showConfirmationDialog() {
  var confirmation = confirm("Для подключения необходимо авторизоваться. Перейти к авторизации?");
  if (confirmation) {
      showAuth('block');
  }
}
function showAuth(display) {
  var authForm = document.getElementById("windowAuth");
  authForm.style.display = display;
}


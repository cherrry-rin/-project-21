<?php
// Установка Cookie с выбранной темой
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme'])) {
    setcookie('theme', $_POST['theme'], time() + 86400, '/'); // Cookie действует 1 день
    header("Location: " . $_SERVER['PHP_SELF']); // Перезагрузка страницы
    exit;
}

// Определение текущей темы
$theme = $_COOKIE['theme'] ?? 'light'; // По умолчанию светлая тема
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выбор темы</title>
</head>
<body style="background-color: <?= $theme === 'dark' ? '#333' : '#fff' ?>; color: <?= $theme === 'dark' ? '#fff' : '#000' ?>;">
    <h1>Выбор темы</h1>
    <p>Текущая тема: <?= $theme === 'dark' ? 'Тёмная' : 'Светлая' ?></p>
    <form method="POST">
        <button type="submit" name="theme" value="light" <?= $theme === 'light' ? 'disabled' : '' ?>>Светлая тема</button>
        <button type="submit" name="theme" value="dark" <?= $theme === 'dark' ? 'disabled' : '' ?>>Тёмная тема</button>
    </form>
</body>
</html>

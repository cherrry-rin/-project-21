<?php
session_start();

// Сохраняем позицию прокрутки в сессии
if (isset($_POST['scroll_position'])) {
    $_SESSION['scroll_position'] = intval($_POST['scroll_position']);
}


if (!isset($_COOKIE['theme'])) {
    setcookie('theme', 'dark', time() + (30 * 24 * 60 * 60), "/"); // 30 дней
}


$cookie_value = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : "Cookie 'theme' не установлено.";

// Удаление cookie
if (isset($_GET['delete_cookie'])) {
    setcookie('theme', '', time() - 3600, "/"); 
    header("Location: " . $_SERVER['PHP_SELF']); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Сохранение позиции прокрутки</title>
</head>
<body>
    <div style="height: 2000px;">
        <p>Прокрутите вниз, чтобы увидеть, как сохраняется позиция прокрутки.</p>
    </div>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="scroll_position" value="<?php echo isset($_SESSION['scroll_position']) ? $_SESSION['scroll_position'] : 0; ?>">
        <button type="submit">Сохранить позицию прокрутки</button>
    </form>

    <div style="height: 2000px;"></div>

    <p><?php echo $cookie_value; ?></p>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?delete_cookie=1">Удалить cookie</a>

    <?php if (isset($_SESSION['scroll_position'])): ?>
        <script>
            window.onload = function() {
                window.scrollTo(0, <?php echo $_SESSION['scroll_position']; ?>);
            };
        </script>
    <?php endif; ?>
</body>
</html>

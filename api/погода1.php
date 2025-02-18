<?php
$apiKey = 'e347a7350b9a1d121e33cb7e903def6b';

if (isset($_POST['city'])) {
    $city = urlencode($_POST['city']);
    $url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric&lang=ru";
}

    $response = file_get_contents($url);
    $weatherData = json_decode($response, true);

    if ($weatherData['cod'] == 200) {
        $weatherDescription = $weatherData['weather'][0]['description'];
        $temperature = $weatherData['main']['temp'];
        $humidity = $weatherData['main']['humidity'];
        $windSpeed = $weatherData['wind']['speed'];
        $cityName = $weatherData['name'];
    } else {
        $errorMessage = "Город не найден. Пожалуйста, попробуйте еще раз.";
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Погода в городе</title>
</head>
<body>
    <h1>Узнайте погоду в вашем городе</h1>
    <form method="post">
        <input type="text" name="city" placeholder="Введите город" required>
        <button type="submit">Узнать погоду</button>
    </form>

    <?php if (isset($errorMessage)): ?>
    <p><?php echo $errorMessage; ?></p>
<?php elseif (isset($cityName)): ?>
    <h2>Погода в <?php echo $cityName; ?></h2>
    <p>Описание: <?php echo $weatherDescription; ?></p>
    <p>Температура: <?php echo $temperature; ?> °C</p>
    <p>Влажность: <?php echo $humidity; ?>%</p>
    <p>Скорость ветра: <?php echo $windSpeed; ?> м/с</p>
<?php endif; ?>
</body>
</html>
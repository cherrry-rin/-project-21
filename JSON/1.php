<?php
$jsonData = file_get_contents('products.json');
$products = json_decode($jsonData, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Ошибка при декодировании JSON:'. json_last_error_msg());
}

$filteredProducts = array_filter($products, function($product) {
    return $product['price'] > 1000;
});

foreach ($filtredProducts as $product){
    echo 'название:' . $product['name'] . ',категория:' . $product['category'] . ',цена:' . $product['price'] . PHP_EOL;
}
?>
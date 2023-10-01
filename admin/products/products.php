<?php
require_once('../../config.php');
require_once('../../lib/jsonReader.php');

function getProducts()
{
    $products = readJsonFile(PRODUCTS_DATA);
    return $products;
}

function getProduct($id)
{
    $products = getProducts();
    if (isset($products[$id])) {
        return $products[$id];
    }
    return null;
}

function addProduct($data)
{
    appendJsonFile(PRODUCTS_DATA, $data);
}

function updateProduct($id, $data)
{
    $products = getProducts();
    if (isset($products[$id])) {
        $products[$id] = $data;
        return writeJsonFile(PRODUCTS_DATA, $products);
    }
    return false;
}
function deleteProduct($id)
{
    $products = getProducts();
    if (isset($products[$id])) {
        unset($products[$id]);
        $products = array_values($products);
        $json_data = json_encode($products, JSON_PRETTY_PRINT);
        file_put_contents(PRODUCTS_DATA, $json_data);
        return true;
    }
    return false;
}

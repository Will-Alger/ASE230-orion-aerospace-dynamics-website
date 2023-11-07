<?php

require_once(__DIR__ . '/../../config.php');
require_once(root . '/admin/utility/JsonHelper.php');

// require_once('../../config.php');
// require_once('../../lib/jsonReader.php');



// function getProducts()
// {
//     $products = readJsonFile(PRODUCTS_DATA);
//     return $products;
// }

// function getProduct($id)
// {
//     $products = getProducts();
//     if (isset($products[$id])) {
//         return $products[$id];
//     }
//     return null;
// }

// function addProduct($data)
// {
//     appendJsonFile(PRODUCTS_DATA, $data);
// }

// function updateProduct($id, $data)
// {
//     $products = getProducts();
//     if (isset($products[$id])) {
//         $products[$id] = $data;
//         return writeJsonFile(PRODUCTS_DATA, $products);
//     }
//     return false;
// }
// function deleteProduct($id)
// {
//     $products = getProducts();
//     if (isset($products[$id])) {
//         unset($products[$id]);
//         $products = array_values($products);
//         $json_data = json_encode($products, JSON_PRETTY_PRINT);
//         file_put_contents(PRODUCTS_DATA, $json_data);
//         return true;
//     }
//     return false;
// }


class Product
{
    public $name;
    public $description;
    public $applications;
    public $id;

    public function __construct($name, $description, $applications)
    {
        $this->name = $name;
        $this->description = $description;
        $this->applications = $applications;
    }
}

class ProductManager
{
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function getProducts()
    {
        $productsData = JsonHelper::read($this->filename);
        $products = [];
        foreach ($productsData as $item) {
            $product = new Product($item['name'], $item['description'], $item['applications']);
            $product->id = $item['id'];
            $products[] = $product;
        }
        return $products;
    }

    public function getProduct($id)
    {
        $products = $this->getProducts();
        foreach ($products as $product) {
            if ($product->id == $id) {
                return $product;
            }
        }
        return null;
    }

    public function addProduct(Product $product)
    {
        $products = $this->getProducts();
        $ids = array_map(function ($product) {
            return $product->id;
        }, $products);
        $nextId = count($ids) > 0 ? max($ids) + 1 : 1;
        $product->id = $nextId;

        $products[] = [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'applications' => $product->applications
        ];
        JsonHelper::write($this->filename, $products);
    }

    public function updateProduct($id, $newData)
    {
        $products = $this->getProducts();
        $updated = false;
        foreach ($products as $index => $product) {
            if ($product->id == $id) {
                $product->name = $newData['name'] ?? $product->name;
                $product->description = $newData['description'] ?? $product->description;
                $product->applications = $newData['applications'] ?? $product->applications;
                $products[$index] = (array) $product;
                $updated = true;
                break;
            }
        }

        if ($updated) {
            JsonHelper::write($this->filename, $products);
        }

        return $updated;
    }

    public function deleteProduct($id)
    {
        $products = $this->getProducts();
        $products = array_filter($products, function ($product) use ($id) {
            return $product->id != $id;
        });
        $productsArray = array_map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'applications' => $product->applications
            ];
        }, array_values($products));
        JsonHelper::write($this->filename, $productsArray);
    }
}

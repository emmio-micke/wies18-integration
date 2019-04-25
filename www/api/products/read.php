<?php

// Allow any site to fetch this result.
header("Access-Control-Allow-Origin: *");

// Set header to let browser know to expect json instead of html.
header("Content-Type: application/json; charset=UTF-8");

// Product class.
include_once '../classes/product.php';
$products_object = new \wiesapi\Product();

// Check if querystring is set to look for id or number of products.
$no_of_products = $_GET['no'] ?? null;
$product_id = $_GET['id'] ?? null;

// Get products.
$products = $products_object->getProducts($product_id, $no_of_products);

// Setup response structure.
$response = [
    'info' => [
        'posts' => count($products),
    ],
    'results' => $products
];

// Different response depending on if we get any products or not.
if ($products) {
    http_response_code(200);

    $response['info']['message'] = 'Everything was ok';
} else {
    http_response_code(404);

    $response['info']['message'] = 'No products found';
}

// Format response.
echo json_encode($response);

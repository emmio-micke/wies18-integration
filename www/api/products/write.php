<?php

// Allow any site to fetch this result.
header("Access-Control-Allow-Origin: *");

// Set header to let browser know to expect json instead of html.
header("Content-Type: application/json; charset=UTF-8");

// Setup POST to be the only acceptable way to contact this page.
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Product class.
include_once '../classes/product.php';
$products_object = new \wiesapi\Product();

// Get the posted data.
$product_data = json_decode(file_get_contents('php://input'));

// Setup response structure.
$response = [
    'results' => null
];

// Try to create product.
if ($products_object->createProduct($product_data)) {
    http_response_code(201);

    $response['info']['message'] = 'Product was created';
    $response['results'] = $product_data;
} else {
    http_response_code(503);

    $response['info']['message'] = 'Could not create product';
}

// Format response.
echo json_encode($response);

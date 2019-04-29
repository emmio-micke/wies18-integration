<?php

// Get URI.
$request_uri = $_SERVER['REQUEST_URI'];

var_dump($request_uri);

// Get querystring.
$querystring = $_SERVER["QUERY_STRING"];

// Get the querystring parts.
$request_parts = explode('/', $querystring);
// var_dump($request_parts);

// Get request method. (GET, POST etc).
$request_method = strtolower($_SERVER['REQUEST_METHOD']);
//var_dump($request_method);


$class = $request_parts[0];
$args = $request_parts[1] ?? null;
$body_data = json_decode(file_get_contents('php://input'));

$response = [
    'info' => null,
    'results' => null
];

if ($class == 'product') {
    include 'classes/product.php';
    $product_obj = new Product();

    if ($request_method == 'post') {
        // create product
    }

    if ($request_method == 'get') {
        // get product(s)
    }
}


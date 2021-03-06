<pre>
<?php
require_once('vendor/stripe/stripe-php/init.php');

\Stripe\Stripe::setApiKey('sk_test_gqRwA4XZP6Q6N7FtzuQO6KzZ00jzZNh9BK'); //YOUR_STRIPE_SECRET_KEY

// Get the token from the JS script
$token = $_POST['stripeToken'];

// This is a 20.00 charge in SEK.
// Charging a Customer
// Create a Customer
$name_first = "Batosai";
$name_last = "Ednalan";
$address = "New Cabalan Olongapo City";
$state = "Zambales";
$zip = "22005";
$country = "Philippines";
$phone = "09306408219";

$user_info = [
    'First Name' => $name_first,
    'Last Name' => $name_last,
    'Address' => $address,
    'State' => $state,
    'Zip Code' => $zip,
    'Country' => $country,
    'Phone' => $phone
];

// $customer_id = 'cus_F6Ai4gLolcMAb3';


if (isset($customer_id)) {
    try {
        // Use Stripe's library to make requests...
        $customer = \Stripe\Customer::retrieve($customer_id);
    } catch (\Stripe\Error\Card $e) {
        // Since it's a decline, \Stripe\Error\Card will be caught
        $body = $e->getJsonBody();
        $err  = $body['error'];
    
        print('Status is:' . $e->getHttpStatus() . "\n");
        print('Type is:' . $err['type'] . "\n");
        print('Code is:' . $err['code'] . "\n");
        // param is '' in this case
        print('Param is:' . $err['param'] . "\n");
        print('Message is:' . $err['message'] . "\n");
    } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly
    } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
    } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
    } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
    } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
    } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
    }
} else {
    try {
        // Use Stripe's library to make requests...
        $customer = \Stripe\Customer::create(array(
            'email' => 'rednalan23@gmail.com',
            'source' => $token,
            'metadata' => $user_info,
        ));
    } catch (\Stripe\Error\Card $e) {
        // Since it's a decline, \Stripe\Error\Card will be caught
        $body = $e->getJsonBody();
        $err  = $body['error'];
    
        print('Status is:' . $e->getHttpStatus() . "\n");
        print('Type is:' . $err['type'] . "\n");
        print('Code is:' . $err['code'] . "\n");
        // param is '' in this case
        print('Param is:' . $err['param'] . "\n");
        print('Message is:' . $err['message'] . "\n");
    } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly
    } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
    } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
    } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
    } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
    } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
    }
}

if (isset($customer)) {
    print_r($customer);

    $charge_customer = true;

    // Save the customer id in your own database!
    // Charge the Customer instead of the card
    try {
        // Use Stripe's library to make requests...
        $charge = \Stripe\Charge::create(array(
            'amount' => 2000,
            'description' => 'Bribes to teacher',
            'currency' => 'sek',
            'customer' => $customer->id,
            'metadata' => $user_info
        ));
    } catch (\Stripe\Error\Card $e) {
        // Since it's a decline, \Stripe\Error\Card will be caught
        $body = $e->getJsonBody();
        $err  = $body['error'];
    
        print('Status is:' . $e->getHttpStatus() . "\n");
        print('Type is:' . $err['type'] . "\n");
        print('Code is:' . $err['code'] . "\n");
        // param is '' in this case
        print('Param is:' . $err['param'] . "\n");
        print('Message is:' . $err['message'] . "\n");

        $charge_customer = false;
    } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly
    } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
    } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
    } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
    } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
    } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
    }

    if ($charge_customer) {
        print_r($charge);
    }
}

// You can charge the customer later by using the customer id.
 
//Making a Subscription Charge
// Get the token from the JS script
//$token = $_POST['stripeToken'];
// Create a Customer
//$customer = \Stripe\Customer::create(array(
//    "email" => "paying.user@example.com",
//    "source" => $token,
//));

// or you can fetch customer id from the database too.
// Creates a subscription plan. This can also be done through the Stripe dashboard.
// You only need to create the plan once.

//$subscription = \Stripe\Plan::create(array(
//    "amount" => 2000,
//    "interval" => "month",
//    "name" => "Gold large",
//    "currency" => "cad",
//    "id" => "gold"
//));

// Subscribe the customer to the plan
//$subscription = \Stripe\Subscription::create(array(
//    "customer" => $customer->id,
//    "plan" => "gold"
//));

//print_r($subscription);

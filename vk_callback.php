<?php

session_start();

// composer autoloader
require 'vendor/autoload.php';

// import VK classes
use VK\Client\VKApiClient;
use VK\OAuth\VKOAuth;
use VK\OAuth\Scopes\VKOAuthUserScope;

// initialize VK API client
$vk = new VKApiClient();

// initialize VK OAuth client
$oauth = new VKOAuth();

// base URL of your application
$redirect_uri = 'https://pyis.fun/vk_callback.php';

// handle OAuth callback
if (isset($_GET['code'])) {
	$response = $oauth->getAccessToken('51524037', '3MbL9kjwV26RApD3EFP6', $redirect_uri, $_GET['code']);
    $access_token = $response['access_token'];
    $user_info = $vk->users()->get($access_token);
    $user_id = $user_info[0]['id'];
    $first_name = $user_info[0]['first_name'];
    $last_name = $user_info[0]['last_name'];
    // Create connection
    $conn = new mysqli("localhost", "pyis", "9wAxegZQ8h!", "PyIs");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // check if user already exists
    $stmt = $conn->prepare("SELECT id FROM accounts WHERE vkid = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // update user's information
        $stmt = $conn->prepare("UPDATE accounts SET name = ?, surname = ? WHERE vkid = ?");
        $stmt->bind_param("ssi", $first_name, $last_name, $user_id);
        $stmt->execute();
    } else {
        // insert new user
        $stmt = $conn->prepare("INSERT INTO accounts (vkid, name, surname) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $first_name, $last_name);
        $stmt->execute();
    }

    // create session variable
    $_SESSION['user_id'] = $user_id;

    // close connection
    $conn->close();
	echo "Checking Your ID:\n";
	echo $_SESSION['user_id'];
	header('Location: https://pyis.fun/testing');
}

?>
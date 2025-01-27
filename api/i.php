<?php
// Set headers for JSON response and allow POST requests
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Define the file where data will be saved
$filename = 'received_data.txt';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw JSON input
    $inputData = json_decode(file_get_contents("php://input"), true);

    // Validate input data (optional)
    if (empty($inputData)) {
        http_response_code(400); // Bad Request
        echo json_encode(["message" => "Invalid or empty JSON data provided."]);
        exit;
    }

    // Get the client IP address
    $clientIp = $_SERVER['REMOTE_ADDR'];

    // Create a response
    $response = [
        "key" => "KYOJIN LKING",
        "ip" => $clientIp, // Include the client IP address in the response
        "UUID" => "2DE30CF2-D125-4E60-8735-FC05852A89B0",
        "time" => date("Y-m-d H:i:s"), // Current server time
        "agent" => "Free%20Fire/2019117860 CFNetwork/1399 Darwin/22.1.0",
        "amount" => "99999999999 KYOJIN",
        "status" => "heheheboy",
        "received_data" => $inputData // Echo back the received POST data
    ];

    // Save the received data to the file (append mode)
    $dataToSave = "Timestamp: " . date("Y-m-d H:i:s") . "\n";
    $dataToSave .= "IP: " . $clientIp . "\n";
    $dataToSave .= "Received Data: " . print_r($inputData, true) . "\n";
    $dataToSave .= "----------------------------------------------------\n";

    // Append the data to the file (in plain text format)
    file_put_contents($filename, $dataToSave, FILE_APPEND);

    // Send the JSON response
    echo json_encode($response);
} else {
    // If the method is not POST, return a 405 Method Not Allowed error
    http_response_code(405);
    echo json_encode(["message" => "Only POST requests are allowed."]);
}
?>
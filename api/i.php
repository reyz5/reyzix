<?php
// Set headers for JSON response and allow POST requests
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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

    // Create a response
    $response = [
        "key" => "KYOJIN LKING",
        "ip" => "2a02:aee3f:aaaa:c101:2993:rr3c:dc87:0000, 000.000.000.000",
        "UUID" => "2DE30CF2-D125-4E60-8735-FC05852A89B0",
        "time" => date("Y-m-d H:i:s"), // Current server time
        "agent" => "Free%20Fire/2019117860 CFNetwork/1399 Darwin/22.1.0",
        "amount" => "99999999999 KYOJIN",
        "status" => "heheheboy",
        "received_data" => $inputData // Echo back the received POST data
    ];

    // Send the JSON response
    echo json_encode($response);
} else {
    // If the method is not POST, return a 405 Method Not Allowed error
    http_response_code(405);
    echo json_encode(["message" => "Only POST requests are allowed."]);
}
?>

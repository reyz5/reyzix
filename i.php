<?php
// Set headers for JSON response and allow all requests
header("Content-Type: text/html; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Create a response template
$response = [
    "key" => "REYZIX LHWAY",
    "UUID" => "2DE30CF2-D125-4E60-8735-FC05852A89B0",
    "time" => date("Y-m-d H:i:s"), // Current server time
    "agent" => "Free%20Fire/2019117860 CFNetwork/1399 Darwin/22.1.0",
    "amount" => "777777777 REYZIX",
    "status" => "heheheboy"
];

// Check if the method is GET or POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw JSON input (if needed)
    $inputData = json_decode(file_get_contents("php://input"), true);

    // Validate key in the POST request
    if (isset($inputData['key']) && $inputData['key'] === 'KYOJIN LKING') {
        $response["message"] = "Verification successful! Data received via POST.";
        
        // Optionally add input data in the response
        $response["input"] = $inputData;
    } else {
        // If the key is not correct
        $response["message"] = "Verification failed. Invalid key.";
    }

    // Send the JSON response for POST
    echo json_encode($response);

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check for key in GET request (if it's passed in the query string)
    if (isset($_GET['key']) && $_GET['key'] === 'KYOJIN LKING') {
        $response["message"] = "Verification successful! Data received via GET.";
    } else {
        // If the key is not correct
        $response["message"] = "Verification failed. Invalid key.";
    }

    // Respond to GET requests
    echo json_encode($response);

} else {
    // If method is neither GET nor POST
    http_response_code(405); // Method Not Allowed
    echo json_encode(["message" => "Only GET and POST requests are allowed."]);
}
?>

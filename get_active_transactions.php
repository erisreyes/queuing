<?php
// Set the Content-Type header to application/json to indicate that the response will be in JSON format
header('Content-Type: application/json');

// Include the required files for the code to work
require_once 'queue.php';
require_once 'config.php';

// Create a new Queue object and pass the $conn variable as a parameter to the constructor
$queue = new Queue($conn);

// Call the getActiveCustomers() method of the Queue object to retrieve the active customers from the database
$customers = $queue->getActiveTransactions();

// Encode the $customers array into a JSON string and output it to the response
echo json_encode($customers);


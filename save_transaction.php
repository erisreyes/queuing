<?php
session_start(); // Start the session at the beginning

require_once 'queue.php';
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $queue = new Queue($conn);
    $result = $queue->addToQueue($_POST['name'], $_POST['office_unit'], $_POST['emp_category'], $_POST['area_transaction'], $_POST['transaction_concern']);
    $_SESSION['result'] = $result; // Store the result in session
   
    header("Location: index.php"); // Redirect back to index.php
    exit; // Make sure script stops here
}

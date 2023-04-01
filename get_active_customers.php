<?php
header('Content-Type: application/json');

require_once 'queue.php';
require_once 'config.php';

$queue = new Queue($conn);
$customers = $queue->getActiveCustomers();
echo json_encode($customers);

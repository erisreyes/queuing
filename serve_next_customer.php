<?php
require_once 'queue.php';
require_once 'config.php';

$queue = new Queue($conn);
$queue->getNextCustomer();

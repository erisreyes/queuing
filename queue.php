<?php
require_once 'config.php';

class Queue
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addToQueue($name)
    {
        $uniqueNumber = $this->generateUniqueNumber();
        $status = 'waiting';
        $sql = "INSERT INTO customers (name, unique_number, status) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sis", $name, $uniqueNumber, $status);
        $stmt->execute();
        return ['name' => $name, 'unique_number' => $uniqueNumber];
    }

    public function generateUniqueNumber()
    {
        return rand(1000, 9999);
    }

    public function getNextCustomer()
    {
        $sql = "UPDATE customers SET status='served' WHERE id=(SELECT id FROM customers WHERE status='waiting' ORDER BY id LIMIT 1)";
        $this->conn->query($sql);
    }

    public function getActiveCustomers()
    {
        $sql = "SELECT name, unique_number, status FROM customers WHERE status='waiting'";
        $result = $this->conn->query($sql);
        $customers = [];
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
        return $customers;
    }
}

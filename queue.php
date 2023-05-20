<?php
require_once 'config.php';

class Queue
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addToQueue($employee_name, $unit_id, $emp_category, $transaction_area_id, $transaction_concern)
    {
        $status = 'Pending';
        $unique_number =  $this->generateUniqueNumber();
        $sql = "INSERT INTO transaction (name, unit_id, emp_category_id, transaction_area_id, unique_number, status, concern) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("siiiiss", $employee_name, $unit_id, $emp_category, $transaction_area_id, $unique_number, $status, $transaction_concern);
        $stmt->execute();
        return ['employee_name' => $employee_name, 'unit_id' => $unit_id, 'emp_category' => $emp_category, 'transaction_area_id' => $transaction_area_id, 'unique_number' => $unique_number, 'status' => $status, 'concern' => $transaction_concern];
    }

    public function generateUniqueNumber()
    {
        return rand(1000, 9999);
    }

    public function getNexttransaction()
    {
        $sql = "UPDATE transaction SET status='served' WHERE id=(SELECT id FROM transaction WHERE status='waiting' ORDER BY id LIMIT 1)";
        $this->conn->query($sql);
    }

    public function getActiveTransactions()
    {
        $sql = "SELECT name, unique_number, status FROM transaction WHERE status='Serving'";
        $result = $this->conn->query($sql);
        $transactions = [];
        while ($row = $result->fetch_assoc()) {
            $transactions[] = $row;
        }
        return $transactions;
    }
}

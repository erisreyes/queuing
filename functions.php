<?php
require_once 'config.php'; // Include the database configuration if it's not already included

function getUnits($conn) {
    $sql = "SELECT id, unit FROM unit";
    $result = $conn->query($sql);
    $units = array();
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $units[] = $row;
        }
    }
    
    return $units;
}

function getEmployeeCategories($conn) {
    $sql = "SELECT * FROM emp_category";
    $result = $conn->query($sql);
    $categories = array();
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    
    return $categories;
}

function getTransactionAreas($conn) {
    $sql = "SELECT * FROM transaction_area";
    $result = $conn->query($sql);
    $transaction_areas = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $transaction_areas[] = array('id' => $row['id'], 'name' => $row['name'], 'description' => $row['description']);
        }
    }

    return $transaction_areas;
}

?>

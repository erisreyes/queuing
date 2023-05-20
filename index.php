<?php
session_start();

require_once 'functions.php';

$units = getUnits($conn);
$employee_categories = getEmployeeCategories($conn);
$transaction_areas = getTransactionAreas($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queue System</title>
    <!-- Flatly Bootstrap CSS -->
    <link rel="stylesheet" href="css\bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="jumbotron mt-4">
            <h1 class="display-4">HR Helpdesk</h1>
            <p class="lead">Welcome to HR Helpdesk!</p>
            <p>We are here to assist you with any HR concerns, issues or questions you may have. The HR Team is dedicated to providing prompt and efficient support to ensure that your concerns are all properly attended.</p>
            <p>Thank you!</p>
        </div>
        <hr>
        <form action="save_transaction.php" method="post" class="mt-3">
            <div class="form-group col-md-5">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group col-md-5">
                <label for="office_unit">Office/Unit:</label>
                <select id="office_unit" name="office_unit" class="form-control" required>
                    <option value="" disabled selected hidden>-- select an option --</option>
                    <?php
                    foreach ($units as $unit) {
                        echo "<option value='{$unit['id']}'>{$unit['unit']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-md-5">
                <label for="emp_category">Employee Category:</label>
                <select id="emp_category" name="emp_category" class="form-control" required>
                    <option value="" disabled selected hidden>-- select an option --</option>
                    <?php
                    foreach ($employee_categories as $category) {
                        echo "<option value='{$category['id']}'>{$category['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-md-5">
                <label for="area_transaction">Area of Transaction:</label>
                <select id="area_transaction" name="area_transaction" class="form-control" onchange="addTextArea()" required>
                    <option value="">-- select an option --</option>
                    <?php
                    foreach ($transaction_areas as $area) {
                        echo "<option value='{$area['id']}' title='{$area['description']}'>{$area['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div id="textAreaContainer" class="col-md-4" style="margin-left: 20px; padding: 10px"></div>

            <button type="submit" class="btn btn-primary mt-2">Enter</button>
        </form>
        <?php
        if (isset($_SESSION['result'])) {
            $result = $_SESSION['result'];
            echo "<p class='mt-4'>Your name: {$result['employee_name']}</p>";
            echo "<p>Your unique number: {$result['unique_number']}</p>";
            
            // Unset the session variable so it doesn't keep showing
            unset($_SESSION['result']);
        }
        ?>
    </div>

    <!-- JS -->
    <script>
        function addTextArea() {
            var selectBox = document.getElementById('area_transaction');
            var textAreaContainer = document.getElementById('textAreaContainer');
            
            // if any option other than the default is selected
            if(selectBox.value != "") {
                var textArea = document.createElement('textarea');
                textArea.className = "form-control";
                textArea.name = "transaction_concern";
                textArea.placeholder = "briefly state your concern...";
                textArea.required = true; // add required attribute to textarea
                textAreaContainer.innerHTML = '';
                textAreaContainer.appendChild(textArea);
            } else {
                textAreaContainer.innerHTML = '';
            }
        }
    </script>

    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>

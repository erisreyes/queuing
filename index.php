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
        <h1 class="mt-5">Enter your name</h1>
        <form action="index.php" method="post" class="mt-3">
            <div class="form-group col-md-5">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Enter</button>
        </form>
        <?php
        require_once 'queue.php';
        require_once 'config.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $queue = new Queue($conn);
            $result = $queue->addToQueue($_POST['name']);
            echo "<p class='mt-4'>Your name: {$result['name']}</p>";
            echo "<p>Your unique number: {$result['unique_number']}</p>";
        }
        ?>
    </div>

    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>

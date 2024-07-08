<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $_POST['task'];
    $user_id = $_SESSION['user_id'];
    
    $sql = "INSERT INTO todos (user_id, task) VALUES ('$user_id', '$task')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Task</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h2 class="card-title text-center">Add a Task</h2>
                    <form method="post" action="create.php">
                        <div class="form-group">
                            <label for="task">Task:</label>
                            <input type="text" class="form-control" id="task" name="task" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="index.php">Back to To-Do List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

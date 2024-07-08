<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $task = $_POST['task'];
    
    $sql = "UPDATE todos SET task='$task' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM todos WHERE id='$id'";
    $result = $conn->query($sql);
    $todo = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update Task</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h2 class="card-title text-center">Edit Task</h2>
                    <form method="post" action="update.php">
                        <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
                        <div class="form-group">
                            <label for="task">Task:</label>
                            <input type="text" class="form-control" id="task" name="task" value="<?php echo $todo['task']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Edit</button>
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

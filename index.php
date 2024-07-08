<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('includes/db.php');

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM todos WHERE user_id='$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>To-Do List</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="my-4 text-center">To-Do List</h2>
    <div class="text-right mb-3">
        <a href="create.php" class="btn btn-success">Add New Task</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Task</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['task']; ?></td>
                <td>
                    <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

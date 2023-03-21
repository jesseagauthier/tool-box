<?php
// Connect to MySQL server
$servername = "localhost:3306";
$username = "tasklistuser";
$password = "6&Ynq0h44";
$dbname = "db_task";

$conn = mysqli_connect($servername, $username, $password);

// Select database
mysqli_select_db($conn, $dbname);

// Check if task completed
if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];
    $sql = "UPDATE tasks SET complete = 'complete' WHERE id = $task_id";
    mysqli_query($conn, $sql);
}

mysqli_close($conn);

<?php
// Connect to MySQL server
$servername = "localhost:3306";
$username = "tasklistuser";
$password = "6&Ynq0h44";
$dbname = "db_task";

$conn = mysqli_connect($servername, $username, $password);

// Select database
mysqli_select_db($conn, $dbname);

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Get form data
  $name = $_POST['name'];
  $person_assigned = $_POST['person_assigned'];
  $priority = $_POST['priority'];
  $complete = $_POST['complete'];

  // Insert data into database
  $sql = "INSERT INTO tasks (name, person_assigned, priority, complete) VALUES ('$name', '$person_assigned', '$priority', '$complete')";

  if (mysqli_query($conn, $sql)) {
    header('Location: index.php');
    exit;
  } else {
    $error = mysqli_error($conn);
    header('Location: index.php?error=' . urlencode($error));
    exit;
  }
}

// Check if task completed
if (isset($_POST['task_id'])) {
  $task_id = $_POST['task_id'];
  $sql = "UPDATE tasks SET complete = 'complete' WHERE id = $task_id";
  mysqli_query($conn, $sql);
}

mysqli_close($conn);

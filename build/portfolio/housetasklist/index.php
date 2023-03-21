<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
    <!-- Custom CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="main.css" rel="stylesheet" <?php echo time(); ?>>
    <script src="main.js"></script>
    <style>
        .complete {
            background-color: green;
            color: white;
        }
    </style>
</head>

<body>
    <div class="">
        <div class="">
            <div class="task-form">
                <h2>Household Task Tracker</h2>
                <form method="post" action="add_task.php">
                    <!-- Input field for task name -->
                    <div class="">
                        <label for="name" class="form-label"></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Task" required>
                    </div>
                    <!-- Dropdown list for person assigned -->
                    <div class="">
                        <label for="person_assigned" class="form-label"></label>
                        <select id="person_assigned" name="person_assigned" class="form-select" required>
                            <option value="">Assign</option>
                            <option value="jesse">Jesse</option>
                            <option value="Mark">Mark</option>
                        </select>
                    </div>
                    <!-- Dropdown list for task priority -->
                    <div class="">
                        <label for="priority" class="form-label"></label>
                        <select id="priority" name="priority" class="form-select" required>
                            <option value="">Priority</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                    <!-- Hidden input field for task completion status -->
                    <input type="hidden" id="complete" name="complete" value="incomplete">
                    <!-- Submit button -->
                    <button type="submit" class="">Add Task</button>
                    <?php
                    // Check for error message in the URL parameters and display it if present
                    if (isset($_GET['error'])) {
                        echo "<p class='text-danger'>Error: " . $_GET['error'] . "</p>";
                    }
                    ?>
                </form>
            </div>
        </div>
        <div class="">
            <div class="">
                <?php
                // Connect to MySQL server
                $servername = "localhost:3306";
                $username = "tasklistuser";
                $password = "6&Ynq0h44";
                $dbname = "db_task";

                $conn = mysqli_connect($servername, $username, $password);

                // Select database
                mysqli_select_db($conn, $dbname);

                // Retrieve data from database
                $sql = "SELECT id, name, person_assigned, priority, date_added, complete FROM tasks WHERE complete='incomplete' ORDER BY date_added DESC";
                $result = mysqli_query($conn, $sql);

                // Create HTML table
                echo "<table class='task-list'>";
                echo "<thead><tr><th>Task</th><th>Assigned</th><th>Priority</th><th>Date Added</th><th>Complete</th></tr></thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr";
                    if ($row["complete"] == "complete") {
                        echo " class='complete'";
                    }
                    echo ">";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["person_assigned"] . "</td>";
                    echo "<td>" . $row["priority"] . "</td>";
                    echo "<td>" . $row["date_added"] . "</td>";
                    echo "<td>";
                    if ($row["complete"] == "complete") {
                        echo "Completed";
                    } else {
                        echo "<button type='button' class='mark-complete' data-task-id='" . $row["id"] . "' onclick='markComplete(" . $row["id"] . ")'>Mark Complete</button>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }

                echo "</table>";
                mysqli_close($conn);
                ?>
            </div>
        </div>
</body>

</html>
<?php
// Check if password is submitted
if (isset($_POST['password'])) {
    // Check if password is correct
    $password = $_POST['password'];
    if ($password === 'Bailey1967!!') { // Replace 'your_password_here' with your actual password
        // Connect to database
        $conn = mysqli_connect('localhost:3306', 'project_manager', 'Bailey1967!!', 'project_tracker');

        // Retrieve data from database
        $sql = "SELECT * FROM project_manager;";
        $result = mysqli_query($conn, $sql);
    }
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="style.php" media="screen">
    <script src="main.js" defer></script>
    <title>Time Tracker</title>
</head>
<main>
    <div class="container">
        <h2 class="display-4 col-12 text-center">Project Tracker</h2>
        <div class="row">
            <!-- Input -->
            <div class="">
                <form class="" method="post" action="newproject.php">
                    <!--Name  -->
                    <label for="project-name">Name</label>
                    <input type="text" id="project_name" name="project-name" required>
                    <!-- Contact -->
                    <label for="contact">Contact</label>
                    <input type="text" id="contact" name="contact" required>
                    <!-- Email -->
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <!-- Phone -->
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" required>
                    <!-- Project Type -->
                    <label for="type">Project Type</label>
                    <select name="project_type" id="type" required>
                        <option value="web">Web Development</option>
                        <option value="design">Web Design</option>
                        <option value="WordPress">WordPress</option>
                        <option value="UI">UI</option>
                    </select>
                    <?php
                    if (isset($_GET['error']) && $_GET['error'] == 'duplicate') {
                        echo "<p class='error-message'>This project already exists.</p>";
                    }
                    ?>

                    <input type="submit" name="Submit" id="submit" value="Add New Project">
                </form>
            </div>

            <div><?php
                    session_start();
                    // Check if password is submitted
                    if (isset($_POST['password'])) {
                        // Check if password is correct
                        $password = $_POST['password'];
                        if ($password === 'Bailey1967!!') { // Replace 'your_password_here' with your actual password
                            $_SESSION['password'] = $password; // Set password in session variable
                        } else {
                            $error = true;
                        }
                    }

                    // Check if password is in session variable
                    if (!isset($_SESSION['password']) || $_SESSION['password'] !== 'Bailey1967!!') {
                        // Display password form if not in session or if session is incorrect
                        echo '  <div class="password_form">
                <form method="post" action="">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <input type="submit" value="Submit">
                </form>
            </div>
            ';
                        // Stop further execution of code until correct password is entered
                        exit();
                    }

                    // Connect to database using prepared statements
                    $conn = mysqli_connect('localhost:3306', 'project_manager', 'Bailey1967!!', 'project_tracker');

                    // Prepare and execute the statement to retrieve data from database
                    $stmt = mysqli_prepare($conn, "SELECT projectname, contact_name, contact_email, contact_phone, project_type) FROM project_manager");
                    mysqli_stmt_execute($stmt);

                    // Bind the results to variables
                    mysqli_stmt_bind_result($stmt, $name, $contact, $email, $phone, $project_type);

                    // Generate HTML table
                    echo '
        <table class="project-summary">
            <h2 class="h1 text-center">Project List</h2>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Project Type</th>
                </tr>
            </thead>
            <tbody>
    ';

                    // Fetch the rows and display them in the table
                    while (mysqli_stmt_fetch($stmt)) {
                        echo '
            <tr>
                <td>' . htmlspecialchars($name) . '</td>
                <td>' . htmlspecialchars($contact) . '</td>
                <td>' . htmlspecialchars($email) . '</td>
                <td>' . htmlspecialchars($phone) . '</td>
                <td>' . htmlspecialchars($project_type) . '</td>
            </tr>
        ';
                    }

                    echo '
        </tbody>
    </table>
';
                    ?>

            </div>
        </div>
</main>
<footer class="container text-center mt-5">
    <p>Versiofn Happy Taco f6.0</p>
</footer>

<body>
</body>

</html>
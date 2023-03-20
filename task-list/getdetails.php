<?php
// Connect to database
$conn = mysqli_connect('localhost:3306', 'project_manager', 'Bailey1967!!', 'project_tracker');

// Retrieve project details
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM project_manager WHERE id='$id';";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $name = $row['projectname'];
        $contact_name = $row['contact_name'];
        $contact_email = $row['contact_email'];
        $contact_phone = $row['contact_phone'];
        $project_type = $row['project_type'];

        // Generate HTML table
        echo '
            <table class="project-details">
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
                    <tr>
                        <td class="">' . $name . '</td>
                        <td class="">' . $contact_name . '</td>
                        <td class="">' . $contact_email . '</td>
                        <td class="">' . $contact_phone . '</td>
                        <td class="">' . $project_type . '</td>
                    </tr>
                </tbody>
            </table>
        ';
    } else {
        echo 'Project not found.';
    }
} else {
    echo 'Invalid request.';
}

// Close database connection
mysqli_close($conn);

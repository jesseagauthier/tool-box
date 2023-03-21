$(document).ready(function () {
    // Handle mark complete button clicks
    $(".mark-complete").click(function () {
        // Get task ID from the button's data attribute
        var taskId = $(this).data("task-id");

        // Send AJAX request to server to update task status
        $.ajax({
            url: "update_task.php",
            type: "POST",
            data: { task_id: taskId },
            success: function (response) {
                // Update task row in the table
                var row = $("button[data-task-id='" + taskId + "']").closest("tr");
                row.addClass("complete");
                row.find(".mark-complete").remove();
            },
            error: function (xhr, status, error) {
                console.log("Error updating task status: " + error);
            }
        });
    });
});

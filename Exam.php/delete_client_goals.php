<?php
    // Connection details
    include('database_connection.php');

    // Check if goal_id is set
    if(isset($_REQUEST['goal_id'])) {
        $goal_id = $_REQUEST['goal_id'];

        // Prepare and execute the DELETE statement for the client_goals table
        $stmt = $connection->prepare("DELETE FROM client_goals WHERE goal_id=?");
        $stmt->bind_param("i", $goal_id);

        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Delete Record</title>
            <script>
                function confirmDelete() {
                    return confirm("Are you sure you want to delete this record?");
                }
            </script>
        </head>
        <body>
            <form method="post" onsubmit="return confirmDelete();">
                <input type="hidden" name="goal_id" value="<?php echo $goal_id; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='client_goals.php'>OK</a>"; // Assuming client_goals.php is the page displaying client goals records
                } else {
                    echo "Error deleting data: " . $stmt->error;
                }
            }
            ?>
        </body>
        </html>
        <?php

        $stmt->close();
    } else {
        echo "goal_id is not set.";
    }

    $connection->close();
?>

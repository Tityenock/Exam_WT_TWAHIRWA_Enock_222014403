<?php
    // Connection details
    include('database_connection.php');

    // Check if exercise_id is set
    if(isset($_REQUEST['exercise_id'])) {
        $exercise_id = $_REQUEST['exercise_id'];

        // Prepare and execute the DELETE statement for the exercises table
        $stmt = $connection->prepare("DELETE FROM exercises WHERE exercise_id=?");
        $stmt->bind_param("i", $exercise_id);

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
                <input type="hidden" name="exercise_id" value="<?php echo $exercise_id; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='exercises.php'>OK</a>"; // Assuming exercises.php is the page displaying exercise records
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
        echo "exercise_id is not set.";
    }

    $connection->close();
?>

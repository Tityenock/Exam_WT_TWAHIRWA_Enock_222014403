<?php
    // Connection details
    include('database_connection.php');

    // Check if trainer_id is set
    if(isset($_REQUEST['trainer_id'])) {
        $trainer_id = $_REQUEST['trainer_id'];

        // Prepare and execute the DELETE statement for the trainers table
        $stmt = $connection->prepare("DELETE FROM trainers WHERE trainer_id=?");
        $stmt->bind_param("i", $trainer_id);

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
                <input type="hidden" name="trainer_id" value="<?php echo $trainer_id; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='trainers.php'>OK</a>"; // Assuming trainers.php is the page displaying trainer records
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
        echo "trainer_id is not set.";
    }

    $connection->close();
?>

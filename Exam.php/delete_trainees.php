<?php
    // Connection details
    include('database_connection.php');

    // Check if trainee_id is set
    if(isset($_REQUEST['trainee_id'])) {
        $trainee_id = $_REQUEST['trainee_id'];

        // Prepare and execute the DELETE statement for the trainees table
        $stmt = $connection->prepare("DELETE FROM trainees WHERE trainee_id=?");
        $stmt->bind_param("i", $trainee_id);

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
                <input type="hidden" name="trainee_id" value="<?php echo $trainee_id; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='trainees.php'>OK</a>"; // Assuming trainees.php is the page displaying trainee records
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
        echo "trainee_id is not set.";
    }

    $connection->close();
?>

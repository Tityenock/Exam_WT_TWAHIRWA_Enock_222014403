<?php
    // Connection details
    include('database_connection.php');

    // Check if plan_id is set
    if(isset($_REQUEST['plan_id'])) {
        $plan_id = $_REQUEST['plan_id'];

        // Prepare and execute the DELETE statement for the fitnessplan table
        $stmt = $connection->prepare("DELETE FROM fitness_plan WHERE plan_id=?");
        $stmt->bind_param("i", $plan_id);

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
                <input type="hidden" name="plan_id" value="<?php echo $plan_id; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='fitness_plan.php'>OK</a>"; // Assuming fitnessplan.php is the page displaying fitness plan records
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
        echo "plan_id is not set.";
    }

    $connection->close();
?>

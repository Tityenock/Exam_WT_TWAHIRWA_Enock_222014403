<?php
    // Connection details
    include('database_connection.php');

    // Check if review_id is set
    if(isset($_REQUEST['review_id'])) {
        $review_id = $_REQUEST['review_id'];

        // Prepare and execute the DELETE statement for the reviews table
        $stmt = $connection->prepare("DELETE FROM reviews WHERE review_id=?");
        $stmt->bind_param("i", $review_id);

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
                <input type="hidden" name="review_id" value="<?php echo $review_id; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='reviews.php'>OK</a>"; // Assuming reviews.php is the page displaying review records
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
        echo "review_id is not set.";
    }

    $connection->close();
?>

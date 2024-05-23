<?php
    // Connection details
    include('database_connection.php');

    // Check if payment_id is set
    if(isset($_REQUEST['payment_id'])) {
        $payment_id = $_REQUEST['payment_id'];

        // Prepare and execute the DELETE statement for the client_payments table
        $stmt = $connection->prepare("DELETE FROM client_payments WHERE payment_id=?");
        $stmt->bind_param("i", $payment_id);

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
                <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='client_payments.php'>OK</a>"; // Assuming client_payments.php is the page displaying client payments records
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
        echo "payment_id is not set.";
    }

    $connection->close();
?>

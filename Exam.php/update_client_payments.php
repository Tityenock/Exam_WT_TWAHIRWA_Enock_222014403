<?php
    // Connection details
    include('database_connection.php');

    // Initialize variables
    $payment_id = $client_id = $amount = $payment_date = '';

    // Check if payment_id is set
    if(isset($_REQUEST['payment_id'])) {
        $payment_id = $_REQUEST['payment_id'];
        
        $stmt = $connection->prepare("SELECT * FROM client_payments WHERE payment_id=?");
        $stmt->bind_param("i", $payment_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $client_id = $row['client_id'];
            $amount = $row['amount'];
            $payment_date = $row['payment_date'];
        } else {
            echo "Payment record not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Payment Record</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Payment Record form -->
    <h2><u>Update Form of Payment Record</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="payment_id" value="<?php if(isset($payment_id)) echo $payment_id; ?>">
        
        <label for="client_id">Client ID:</label>
        <input type="number" name="client_id" value="<?php echo $client_id; ?>">
        <br><br>

        <label for="amount">Amount:</label>
        <input type="number" name="amount" value="<?php echo $amount; ?>">
        <br><br>

        <label for="payment_date">Payment Date:</label>
        <input type="date" name="payment_date" value="<?php echo $payment_date; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $payment_id = $_POST['payment_id'];
    $client_id = $_POST['client_id'];
    $amount = $_POST['amount'];
    $payment_date = $_POST['payment_date'];
    
    // Update the payment record in the database
    $stmt = $connection->prepare("UPDATE client_payments SET client_id=?, amount=?, payment_date=? WHERE payment_id=?");
    $stmt->bind_param("idis", $client_id, $amount, $payment_date, $payment_id);
    $stmt->execute();
    
    // Redirect to client_payments.php or any other page displaying payment records
    header('Location: client_payments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

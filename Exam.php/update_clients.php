<?php
    // Connection details
    include('database_connection.php');

    // Check if client_id is set
    if(isset($_REQUEST['client_id'])) {
        $client_id = $_REQUEST['client_id'];
        
        $stmt = $connection->prepare("SELECT * FROM clients WHERE client_id=?");
        $stmt->bind_param("i", $client_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $trainer_id = $row['trainer_id'];
            $start_date = $row['start_date'];
            $end_date = $row['end_date'];
        } else {
            echo "Client not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Client</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Client form -->
    <h2><u>Update Form of Client</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
        
        <label for="trainer_id">Trainer ID:</label>
        <input type="number" name="trainer_id" value="<?php echo $trainer_id; ?>">
        <br><br>

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" value="<?php echo $start_date; ?>">
        <br><br>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" value="<?php echo $end_date; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $client_id = $_POST['client_id'];
    $trainer_id = $_POST['trainer_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    // Update the client record in the database
    $stmt = $connection->prepare("UPDATE clients SET trainer_id=?, start_date=?, end_date=? WHERE client_id=?");
    $stmt->bind_param("issi", $trainer_id, $start_date, $end_date, $client_id);
    $stmt->execute();
    
    // Redirect to clients.php or any other page displaying client records
    header('Location: clients.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

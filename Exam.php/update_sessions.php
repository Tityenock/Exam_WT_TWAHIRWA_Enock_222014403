<?php
    // Connection details
    include('database_connection.php');

    // Initialize variables
    $trainer_id = $trainee_id = $session_date = $session_time = $session_status = $session_id = '';

    // Check if session_id is set
    if(isset($_REQUEST['session_id'])) {
        $session_id = $_REQUEST['session_id'];
        
        $stmt = $connection->prepare("SELECT * FROM sessions WHERE session_id=?");
        $stmt->bind_param("i", $session_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $session_id = $row['session_id'];
            $trainer_id = $row['trainer_id'];
            $trainee_id = $row['trainee_id'];
            $session_date = $row['session_date'];
            $session_time = $row['session_time'];
            $session_status = $row['session_status'];
        } else {
            echo "Session not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Session</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Session form -->
    <h2><u>Update Form of Session</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        
        <label for="trainer_id">Trainer ID:</label>
        <input type="number" name="trainer_id" value="<?php echo $trainer_id; ?>">
        <br><br>

        <label for="trainee_id">Trainee ID:</label>
        <input type="number" name="trainee_id" value="<?php echo $trainee_id; ?>">
        <br><br>

        <label for="session_date">Session Date:</label>
        <input type="date" name="session_date" value="<?php echo $session_date; ?>">
        <br><br>

        <label for="session_time">Session Time:</label>
        <input type="time" name="session_time" value="<?php echo $session_time; ?>">
        <br><br>

        <label for="session_status">Session Status:</label>
        <select name="session_status">
            <option value="Scheduled" <?php if(isset($session_status) && $session_status == "Scheduled") echo "selected"; ?>>Scheduled</option>
            <option value="Ongoing" <?php if(isset($session_status) && $session_status == "Ongoing") echo "selected"; ?>>Ongoing</option>
            <option value="Completed" <?php if(isset($session_status) && $session_status == "Completed") echo "selected"; ?>>Completed</option>
            <option value="Cancelled" <?php if(isset($session_status) && $session_status == "Cancelled") echo "selected"; ?>>Cancelled</option>
        </select>
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form

    $trainer_id = $_POST['trainer_id'];
    $trainee_id = $_POST['trainee_id'];
    $session_date = $_POST['session_date'];
    $session_time = $_POST['session_time'];
    $session_status = $_POST['session_status'];
    
    // Update the session record in the database
    $stmt = $connection->prepare("UPDATE sessions SET trainer_id=?, trainee_id=?, session_date=?, session_time=?, session_status=? WHERE session_id=?");
    $stmt->bind_param("iisssi", $trainer_id, $trainee_id, $session_date, $session_time, $session_status, $session_id);
    $stmt->execute();
    
    // Redirect to sessions.php or any other page displaying session records
    header('Location: sessions.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

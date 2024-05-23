<?php
    // Connection details
    include('database_connection.php');

    // Initialize variables
    $trainer_id = $expertise = $certification = $hourly_rate = $availability = '';

    // Check if trainer_id is set
    if(isset($_REQUEST['trainer_id'])) {
        $trainer_id = $_REQUEST['trainer_id'];
        
        $stmt = $connection->prepare("SELECT * FROM trainers WHERE trainer_id=?");
        $stmt->bind_param("i", $trainer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $expertise = $row['expertise'];
            $certification = $row['certification'];
            $hourly_rate = $row['hourly_rate'];
            $availability = $row['availability'];
        } else {
            echo "Trainer profile not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Trainer Profile</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Trainer Profile form -->
    <h2><u>Update Form of Trainer Profile</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="trainer_id" value="<?php if(isset($trainer_id)) echo $trainer_id; ?>">
        
        <label for="expertise">Expertise:</label>
        <input type="text" name="expertise" value="<?php echo $expertise; ?>">
        <br><br>

        <label for="certification">Certification:</label>
        <input type="text" name="certification" value="<?php echo $certification; ?>">
        <br><br>

        <label for="hourly_rate">Hourly Rate:</label>
        <input type="number" name="hourly_rate" value="<?php echo $hourly_rate; ?>">
        <br><br>

        <label for="availability">Availability:</label>
        <input type="text" name="availability" value="<?php echo $availability; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $trainer_id = $_POST['trainer_id'];
    $expertise = $_POST['expertise'];
    $certification = $_POST['certification'];
    $hourly_rate = $_POST['hourly_rate'];
    $availability = $_POST['availability'];
    
    // Update the trainer profile record in the database
    $stmt = $connection->prepare("UPDATE trainers SET expertise=?, certification=?, hourly_rate=?, availability=? WHERE trainer_id=?");
    $stmt->bind_param("ssisi", $expertise, $certification, $hourly_rate, $availability, $trainer_id);
    $stmt->execute();
    
    // Redirect to trainers.php or any other page displaying trainer profile records
    header('Location: trainers.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

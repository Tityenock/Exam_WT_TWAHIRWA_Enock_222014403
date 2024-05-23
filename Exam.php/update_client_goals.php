<?php
    // Connection details
    include('database_connection.php');

    // Initialize variables
    $goal_id = $client_id = $goal_description = $target_date = '';

    // Check if goal_id is set
    if(isset($_REQUEST['goal_id'])) {
        $goal_id = $_REQUEST['goal_id'];
        
        $stmt = $connection->prepare("SELECT * FROM client_goals WHERE goal_id=?");
        $stmt->bind_param("i", $goal_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $client_id = $row['client_id'];
            $goal_description = $row['goal_description'];
            $target_date = $row['target_date'];
        } else {
            echo "Goal not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Goal</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Goal form -->
    <h2><u>Update Form of Goal</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="goal_id" value="<?php if(isset($goal_id)) echo $goal_id; ?>">
        
        <label for="client_id">Client ID:</label>
        <input type="number" name="client_id" value="<?php echo $client_id; ?>">
        <br><br>

        <label for="goal_description">Goal Description:</label>
        <input type="text" name="goal_description" value="<?php echo $goal_description; ?>">
        <br><br>

        <label for="target_date">Target Date:</label>
        <input type="date" name="target_date" value="<?php echo $target_date; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $goal_id = $_POST['goal_id'];
    $client_id = $_POST['client_id'];
    $goal_description = $_POST['goal_description'];
    $target_date = $_POST['target_date'];
    
    // Update the goal record in the database
    $stmt = $connection->prepare("UPDATE client_goals SET client_id=?, goal_description=?, target_date=? WHERE goal_id=?");
    $stmt->bind_param("issi", $client_id, $goal_description, $target_date, $goal_id);
    $stmt->execute();
    
    // Redirect to goals.php or any other page displaying goal records
    header('Location: client_goals.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

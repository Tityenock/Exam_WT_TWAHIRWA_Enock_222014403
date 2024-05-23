<?php
    // Connection details
    include('database_connection.php');

    // Initialize variables
    $plan_id = $trainer_id = $plan_name = $description = $duration = $price = '';

    // Check if plan_id is set
    if(isset($_REQUEST['plan_id'])) {
        $plan_id = $_REQUEST['plan_id'];
        
        $stmt = $connection->prepare("SELECT * FROM fitness_plan WHERE plan_id=?");
        $stmt->bind_param("i", $plan_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $trainer_id = $row['trainer_id'];
            $plan_name = $row['plan_name'];
            $description = $row['description'];
            $duration = $row['duration'];
            $price = $row['price'];
        } else {
            echo "Plan not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Fitness Plan</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Fitness Plan form -->
    <h2><u>Update Form of Fitness Plan</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="plan_id" value="<?php if(isset($plan_id)) echo $plan_id; ?>">
        
        <label for="trainer_id">Trainer ID:</label>
        <input type="number" name="trainer_id" value="<?php echo $trainer_id; ?>">
        <br><br>

        <label for="plan_name">Plan Name:</label>
        <input type="text" name="plan_name" value="<?php echo $plan_name; ?>">
        <br><br>

        <label for="description">Description:</label>
        <input type="text" name="description" value="<?php echo $description; ?>">
        <br><br>

        <label for="duration">Duration:</label>
        <input type="text" name="duration" value="<?php echo $duration; ?>">
        <br><br>

        <label for="price">Price:</label>
        <input type="text" name="price" value="<?php echo $price; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $plan_id = $_POST['plan_id'];
    $trainer_id = $_POST['trainer_id'];
    $plan_name = $_POST['plan_name'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    
    // Update the fitness plan record in the database
    $stmt = $connection->prepare("UPDATE fitness_plan SET trainer_id=?, plan_name=?, description=?, duration=?, price=? WHERE plan_id=?");
    $stmt->bind_param("issdii", $trainer_id, $plan_name, $description, $duration, $price, $plan_id);
    $stmt->execute();
    
    // Redirect to fitness_plans.php or any other page displaying fitness plan records
    header('Location: fitness_plan.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

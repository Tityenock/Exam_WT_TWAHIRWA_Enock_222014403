<?php
    // Connection details
    include('database_connection.php');

    // Initialize variables
    $trainee_id = $goals = $fitness_level = $preferred_workout_time = $medical_conditions = '';

    // Check if trainee_id is set
    if(isset($_REQUEST['trainee_id'])) {
        $trainee_id = $_REQUEST['trainee_id'];
        
        $stmt = $connection->prepare("SELECT * FROM trainees WHERE trainee_id=?");
        $stmt->bind_param("i", $trainee_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $goals = $row['goals'];
            $fitness_level = $row['fitness_level'];
            $preferred_workout_time = $row['preferred_workout_time'];
            $medical_conditions = $row['medical_conditions'];
        } else {
            echo "Trainee profile not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Trainee Profile</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Trainee Profile form -->
    <h2><u>Update Form of Trainee Profile</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="trainee_id" value="<?php if(isset($trainee_id)) echo $trainee_id; ?>">
        
        <label for="goals">Goals:</label>
        <input type="text" name="goals" value="<?php echo $goals; ?>">
        <br><br>

        <label for="fitness_level">Fitness Level:</label>
        <input type="text" name="fitness_level" value="<?php echo $fitness_level; ?>">
        <br><br>

        <label for="preferred_workout_time">Preferred Workout Time:</label>
        <input type="text" name="preferred_workout_time" value="<?php echo $preferred_workout_time; ?>">
        <br><br>

        <label for="medical_conditions">Medical Conditions:</label>
        <input type="text" name="medical_conditions" value="<?php echo $medical_conditions; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $trainee_id = $_POST['trainee_id'];
    $goals = $_POST['goals'];
    $fitness_level = $_POST['fitness_level'];
    $preferred_workout_time = $_POST['preferred_workout_time'];
    $medical_conditions = $_POST['medical_conditions'];
    
    // Update the trainee profile record in the database
    $stmt = $connection->prepare("UPDATE trainees SET goals=?, fitness_level=?, preferred_workout_time=?, medical_conditions=? WHERE trainee_id=?");
    $stmt->bind_param("ssssi", $goals, $fitness_level, $preferred_workout_time, $medical_conditions, $trainee_id);
    $stmt->execute();
    
    // Redirect to trainee_profiles.php or any other page displaying trainee profile records
    header('Location: trainees.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

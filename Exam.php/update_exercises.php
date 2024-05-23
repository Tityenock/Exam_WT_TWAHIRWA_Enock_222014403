<?php
    // Connection details
    include('database_connection.php');

    // Check if exercise_id is set
    if(isset($_REQUEST['exercise_id'])) {
        $exercise_id = $_REQUEST['exercise_id'];
        
        $stmt = $connection->prepare("SELECT * FROM exercises WHERE exercise_id=?");
        $stmt->bind_param("i", $exercise_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $exercise_name = $row['exercise_name'];
            $description = $row['description'];
            $muscle_group = $row['muscle_group'];
        } else {
            echo "Exercise not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Exercise</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Exercise form -->
    <h2><u>Update Form of Exercise</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="exercise_id" value="<?php echo $exercise_id; ?>">
        
        <label for="exercise_name">Exercise Name:</label>
        <input type="text" name="exercise_name" value="<?php echo $exercise_name; ?>">
        <br><br>

        <label for="description">Description:</label>
        <textarea name="description"><?php echo $description; ?></textarea>
        <br><br>

        <label for="muscle_group">Muscle Group:</label>
        <input type="text" name="muscle_group" value="<?php echo $muscle_group; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $exercise_id = $_POST['exercise_id'];
    $exercise_name = $_POST['exercise_name'];
    $description = $_POST['description'];
    $muscle_group = $_POST['muscle_group'];
    
    // Update the exercise record in the database
    $stmt = $connection->prepare("UPDATE exercises SET exercise_name=?, description=?, muscle_group=? WHERE exercise_id=?");
    $stmt->bind_param("sssi", $exercise_name, $description, $muscle_group, $exercise_id);
    $stmt->execute();
    
    // Redirect to exercises.php or any other page displaying exercise records
    header('Location: exercises.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

<?php
    // Connection details
    include('database_connection.php');

    // Initialize variables
    $review_id = $trainer_id = $trainee_id = $rating = $review_content = $timestamp = '';

    // Check if review_id is set
    if(isset($_REQUEST['review_id'])) {
        $review_id = $_REQUEST['review_id'];
        
        $stmt = $connection->prepare("SELECT * FROM reviews WHERE review_id=?");
        $stmt->bind_param("i", $review_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $trainer_id = $row['trainer_id'];
            $trainee_id = $row['trainee_id'];
            $rating = $row['rating'];
            $review_content = $row['review_content'];
            $timestamp = $row['timestamp'];
        } else {
            echo "Reviews not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Reviews</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Review form -->
    <h2><u>Update Form of Reviews</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="review_id" value="<?php if(isset($review_id)) echo $review_id; ?>">
        
        <label for="trainer_id">Trainer ID:</label>
        <input type="number" name="trainer_id" value="<?php echo $trainer_id; ?>">
        <br><br>

        <label for="trainee_id">Trainee ID:</label>
        <input type="number" name="trainee_id" value="<?php echo $trainee_id; ?>">
        <br><br>

        <label for="rating">Rating:</label>
        <input type="number" name="rating" value="<?php echo $rating; ?>">
        <br><br>

        <label for="review_content">Review Content:</label>
        <input type="text" name="review_content" value="<?php echo $review_content; ?>">
        <br><br>

        <label for="timestamp">Timestamp:</label>
        <input type="datetime-local" name="timestamp" value="<?php echo date('Y-m-d\TH:i', strtotime($timestamp)); ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $review_id = $_POST['review_id'];
    $trainer_id = $_POST['trainer_id'];
    $trainee_id = $_POST['trainee_id'];
    $rating = $_POST['rating'];
    $review_content = $_POST['review_content'];
    $timestamp = $_POST['timestamp'];
    
    // Update the review record in the database
    $stmt = $connection->prepare("UPDATE reviews SET trainer_id=?, trainee_id=?, rating=?, review_content=?, timestamp=? WHERE review_id=?");
    $stmt->bind_param("iiissi", $trainer_id, $trainee_id, $rating, $review_content, $timestamp, $review_id);
    $stmt->execute();
    
    // Redirect to reviews.php or any other page displaying review records
    header('Location: reviews.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

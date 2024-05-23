<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Review Information</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    /* CSS styles for consistent styling */
a:link {
    color: #0066cc;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Comments */
/* This is a comment */

    a {
      padding: 7px;
      color: white;
      background-color: turquoise;
      text-decoration: none;
      margin-right: 5px;
    }

    a:visited {
      color: purple;
    }

    a:link {
      color: brown;
    }

    a:hover {
      background-color: white;
    }

    a:active {
      background-color: red;
    }

    button.btn {
      margin-left: 15px; 
      margin-top: 7px;
    }

    input.form-control {
      padding: 10px;
    }

    table {
      width: 75%; /* Set table to full width */
      border-collapse: revert; /* Merge borders */
      /* CSS for Table Design with Special First Column */

/* Table */
table {
    width: 70%;
    border-collapse: collapse;
}

/* Special Styling for First Column */
td:first-child {
    background-color: #333333;
    color: #ffffff;
}

/* Table Cells */
td {
    padding: 8px;
    border-bottom: 1px solid #dddddd;
}

/* Hover Effect */
tr:hover {
    background-color: #e9e9e9;
}

    }

    th, td {
      border: 2px solid black; /* Table borders */
      padding: 10px; /* Padding for readability */
      text-align: left;
    }

    th {
      background-color: orange; /* Header row color */
    }

    section {
      padding: 20px; 
      border-bottom: 3px solid #ddd; /* Bottom border for section */
    }

    footer {
      text-align: center; 
      padding: 10px; 
      background-color: darkgray; /* Footer background color */
    }
  </style>
  <!-- JavaScript function for insert confirmation -->
  <script>
    function confirmInsert() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>
</head>

<body style="background-color: lightblue;"> <!-- Corrected placement of body tag -->
  <header>
    <ul style="list-style-type: none; padding: 0;"> <!-- No list-style -->
      <li style="display: inline; margin-right: 10px;">
           <ul style="list-style-type: none; padding: 0;">
    </li>
    <li style="display: inline; margin-right: 8px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./clients.php">clients</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./exercises.php">exercises</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./fitness_plan.php">fitness_plan</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./client_goals.php">client_goals</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./reviews.php"> reviews</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./sessions.php">sessions</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./trainees.php">trainees</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./trainers.php">trainers</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./workout_plans.php">workout_plansworkout_plans</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./client_payments.php">client_payments</a></li>

      <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: greenyellow; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="logout.php">Logout</a>
        </div>
      </a>
    </li>
    </ul>
  </header>
<body style="background-color: yellowgreen;">


  <h1>Reviews Form</h1>
  <form method="post" onsubmit="return confirmInsert();">
    <!-- Review form fields -->
    <label for="review_id">Review ID:</label>
    <input type="number" id="review_id" name="review_id" required><br><br>

    <label for="trainer_id">Trainer ID:</label>
    <input type="number" id="trainer_id" name="trainer_id" required><br><br>

    <label for="trainee_id">Trainee ID:</label>
    <input type="number" id="trainee_id" name="trainee_id" required><br><br>

    <label for="rating">Rating:</label>
    <input type="number" id="rating" name="rating" required><br><br>

    <label for="review_content">Review Content:</label>
    <textarea id="review_content" name="review_content" required></textarea><br><br>

    <label for="timestamp">Timestamp:</label>
    <input type="datetime-local" id="timestamp" name="timestamp" required><br><br>

    <input type="submit" name="add" value="Insert"><br><br>
    <a href="./home.html">Go Back to Home</a>
  </form>

  <?php
  include('database_connection.php'); // Include the database connection

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Retrieve input values from POST request
    $review_id = $_POST['review_id'];
    $trainer_id = $_POST['trainer_id'];
    $trainee_id = $_POST['trainee_id'];
    $rating = $_POST['rating'];
    $review_content = $_POST['review_content'];
    $timestamp = $_POST['timestamp'];

    // Prepare SQL statement for insertion
    $stmt = $connection->prepare("INSERT INTO reviews (review_id, trainer_id, trainee_id, rating, review_content, timestamp) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiss", $review_id, $trainer_id, $trainee_id, $rating, $review_content, $timestamp); // Bind parameters

    // Execute the statement and check for success
    if ($stmt->execute()) {
      echo "New record has been added successfully.<br><br><a href='reviews.php'>Back to Form</a>";
    } else {
      echo "Error inserting data: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
  }
  ?>

  <section>
    <h2>Reviews Detail</h2>
    <table>
      <tr>
        <th>Review ID</th>
        <th>Trainer ID</th>
        <th>Trainee ID</th>
        <th>Rating</th>
        <th>Review Content</th>
        <th>Timestamp</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      // Select all reviews from the database
      $sql = "SELECT * FROM reviews";
      $result = $connection->query($sql); // Execute the query

      if ($result->num_rows > 0) {
        // Loop through the results and generate table rows
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['review_id']}</td>
                  <td>{$row['trainer_id']}</td>
                  <td>{$row['trainee_id']}</td>
                  <td>{$row['rating']}</td>
                  <td>{$row['review_content']}</td>
                  <td>{$row['timestamp']}</td>
                  <td><a style='padding:4px' href='delete_reviews.php?review_id={$row['review_id']}'>Delete</a></td> 
                  <td><a style='padding:4px' href='update_reviews.php?review_id={$row['review_id']}'>Update</a></td> 
                </tr>";
        }
      } else {
        // If no data is found, display a message in the table
        echo "<tr><td colspan='8'>No data found</td></tr>";
      }
      ?>
    </table>
  </section>

  <footer>
    <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @ENOCK</h2>
  </footer>
</body>
</html>
